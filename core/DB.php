<?php

class DB
{
    const TYPE_NOT_AVAILABLE = "Type {type} of {var} is not available";
    const CONFIG_NOT_SET     = "Database config not set";
    const EMPTY_RESULT       = "Result array is empty";
    const LAST_ID_NOT_SET    = "Last inserted id not set";

    private $db;
    private $constraints = [];
    private $query = '';
    private $lastId;
    private $logger;
    private static $config;

    protected static $instance;

    protected function __clone(){}

    public function __call($name, $arguments)
    {
        if ($name == 'selectAll') $this->select($arguments[0]);
        return $this;
    }

    public static function setConfig(array $config)
    {
        self::$config = $config;
    }


    protected function __construct(){

        $config = self::$config;

        $this->db = new \PDO(
            $config['type'].':host='.$config['host'].';dbname='.$config['dbname'],
                 $config['login'],
                 $config['password'],
                 $config['options']
        );
    }

    public static function getObject()
    {
        if (isset(self::$config)){
            if (!isset(self::$instance)){
                self::$instance = new self;
            }

            return self::$instance;
        }
        throw new \Exception(self::CONFIG_NOT_SET);
    }


    /**
     * @param string $table
     * @param array $fields
     *
     * Builds select query
     *
     * @return $this
     */
    public function select($table, array $fields = [])
    {
        if (empty($fields)){
            $this->query = "SELECT * FROM {$table} ";
        }
        else {
            $this->query = "SELECT " . implode(', ', $fields) . " FROM  {$table} ";
        }
        return $this;
    }

    /**
     * @param string $field
     * @param $value
     * @param string $operator
     * @param string $condition
     *
     * Adds 'where' constraints
     *
     * @return $this
     */
    public function where($field, $value, $operator = '=', $condition = 'AND' )
    {
        $this->constraints['where'] []= [
            'field' => $field,
            'value' => $value,
            'operator' => $operator,
            'condition' => $condition
        ];

        return $this;
    }

    public function whereIn($filed, array $values, $condition = 'AND')
    {
        $this->constraints['in'] []= [
            'field'     => $filed,
            'values'    => $values,
            'condition' => $condition
        ];

        return $this;
    }

    protected function addValue($value) {
        if (is_string($value) || is_numeric($value)) return $this->db->quote($value);
        elseif (is_null($value)) return "NULL";
        else {
            $message = str_replace('{var}', $value, self::TYPE_NOT_AVAILABLE);
            $message = str_replace('{type}', gettype($value), $message);
            throw new \Exception($message);
        }
    }


    /**
     *Builds query and saves it in query field
     */
    protected function buildQuery()
    {
        if (!empty($this->constraints['where'])){
            $where = $this->constraints['where'];

            $this->query .= "WHERE ";

            $nOfWhere = count($where);

            if (1 === $nOfWhere ){
                $this->query .= "{$where[0]['field']} {$where[0]['operator']} " . $this->addValue($where[0]['value']) . " ";
            }
            else {
                for ($i = 0; $i < $nOfWhere - 1; $i++){
                    $this->query .= "{$where[$i]['field']} {$where[$i]['operator']} " . $this->addValue($where[$i]['value']) . " {$where[$i]['condition']} ";
                }
                $this->query .= "{$where[$i]['field']} {$where[$i]['operator']} " . $this->addValue($where[$i]['value']) . " ";
            }
        }

        if (!empty($this->constraints['in'])) {
            $where_ins = $this->constraints['in'];
            $where_in = array_shift($where_ins);
            $values = '(' . implode(', ' , $this->prepareValues($where_in['values']) ) . ')';
            if (empty($this->constraints['where'])) {
              $this->query .= "WHERE {$where_in['field']} IN {$values} ";
            } else {
              $this->query .= "{$where_in['condition']} {$where_in['field']} IN {$values} ";
            }
            foreach ($where_ins as $where_in) {
              $values = '(' . implode(', ' , $this->prepareValues($where_in['values']) ) . ')';
              $this->query .= "{$where_in['condition']} {$where_in['field']} IN {$values} ";
            }
        }

        if (!empty($this->constraints['order'])){
            $this->query .= "ORDER BY ";

            $last = array_pop($this->constraints['order']);
            $nOfOrder = count($this->constraints['order']);
            if ($nOfOrder > 0){
                foreach ($this->constraints['order'] as $order){
                    $this->query .= " {$order['field']} {$order['ord']}, ";
                }
            }
            $this->query .= " {$last['field']} {$last['ord']}";
        }

        if (isset($this->constraints['limit'])){
            $this->query .= "LIMIT {$this->constraints['limit']}";
        }

    }

    /**
     * Gets fetched result
     * @return array
     */
    public function get()
    {

        if (isset($this->query)){
            $this->buildQuery();
            $data = $this->query()->fetchAll();
            return $data;
        }
        return [];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function first()
    {
        $result = $this->get();
        if (!empty($result)) return $result[0];
        else throw new \Exception(self::EMPTY_RESULT);
    }

    /**
     * Executes query from $this->query field
     * @return \PDOStatement
     */
    protected function query()
    {
        if (isset($this->logger)){
            $time_start = microtime(true);
            $statement = $this->db->query($this->query);
            $time_end = microtime(true);
            $this->logger->log($this->query , round( ($time_end - $time_start),8) );

        }else{
            $statement = $this->db->query($this->query);
        }

        $this->cleanFields();

        return $statement;
    }

    /**
     * Executes non-result query
     * @return int
     */
    protected function exec()
    {

        if (isset($this->logger)){
            $time_start = microtime(true);

            $affected_rows = $this->db->exec($this->query);

            $time_end = microtime(true);
            $this->logger->log($this->query, round( ($time_end - $time_start),8));
        }
        else {
            $affected_rows = $this->db->exec($this->query);
            if (strpos($this->query, "INSERT") >= 0) $this->lastId = $this->db->lastInsertId();
        }

        $this->cleanFields();

        return $affected_rows;
    }

    public function getLastId()
    {
        if (isset($this->lastId)) return $this->lastId;
        else throw new \Exception(self::LAST_ID_NOT_SET);
    }

    public function getColumns($table) {
        $columns = [];

        $this->select($table)->limit(0);
        $this->buildQuery();

        $result = $this->query();

        for ($i = 0; $i < $result->columnCount(); $i++) {
            $col = $result->getColumnMeta($i);
            $columns[] = $col['name'];
        }

        return $columns;
    }


    /**
     * @param string $table
     * @param string $rightField
     * @param string $leftField
     *
     * Adds to query JOIN statement
     *
     * @param string $operator
     * @return $this
     */
    public function join($table, $leftField, $rightField, $operator = '=')
    {
        $this->query .= "JOIN {$table} ON {$leftField} {$operator} {$rightField} ";
        return $this;
    }

    public  function leftJoin($table, $leftField , $rightField, $operator = '=')
    {
        $this->query .= "LEFT JOIN {$table} ON {$leftField} {$operator} {$rightField} ";
        return $this;
    }

    public function limit($offset, $limit = null)
    {
        if (!isset($limit)) $this->constraints['limit'] = $offset;
        else $this->constraints['limit'] = "{$offset}, $limit";
        return $this;
    }


    /**
     * @param string $table
     * @param array $values [field_name => field_value]
     *
     * Inserts data in table
     *
     * @return int
     */
    public function insert( $table, array $values)
    {
        $this->query = "INSERT INTO {$table} ";
        $columns = array_keys($values);
        $this->query .= "(" . implode(', ', $columns) . ") ";
        $values = $this->prepareValues($values);
        $this->query .= "VALUES (" . implode(', ' ,$values) . ")";
        $affected_rows = $this->exec();
        return $affected_rows;
    }

    public function delete($table)
    {
        $this->query = "DELETE FROM {$table} ";
        return $this;
    }

    public function execute()
    {
        if (isset($this->query)){
            $this->buildQuery();

            $affected_rows = $this->exec();
            return $affected_rows;
        }
        else return null;
    }

    /**
     * Builds Update query
     *
     * @param string $table
     * @param array $fieldsAndValues [ field_name => value ]
     * @return $this
     */
    public function update($table, $fieldsAndValues)
    {
        $this->query = "UPDATE {$table} SET ";
        $nOFUpdates = count($fieldsAndValues);
        $fields = array_keys($fieldsAndValues);
        $values = $this->prepareValues(array_values($fieldsAndValues));

        for ($i = 0; $i < $nOFUpdates; $i++){
            if ($i > 0 ) $this->query .= ', ';
            $this->query .= $fields[$i] . ' = ' . $values[$i];
        }
        $this->query .= ' ';

        return $this;
    }

    public function orderBy($field, $ord = 'ASC')
    {
        $this->constraints['order'][] = [ 'field' => $field, 'ord' => $ord ];
        return $this;
    }



    protected function prepareValues(array $values)
    {
        array_walk($values, function (&$val){
            $val = $this->addValue($val);
        });
        return $values;
    }

    protected function cleanFields()
    {
        $this->constraints = [];
        $this->query = '';
    }

    public function count() {
      $this->query = preg_replace(
        '@SELECT (.*) FROM@',
        'SELECT COUNT(1) as total FROM',
        $this->query
      );
      $result = $this->get();
      return (int) $result['total'];
    }

}
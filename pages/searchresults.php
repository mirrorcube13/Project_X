<?php

$no_city = FALSE;
$params = [];
$hotels = [];
$db = DB::getObject();

$city = $db->select('cities')->first();
$params['c_name'] = $city['c_name'];
if (isset($_GET['action']) && $_GET['action'] === 'search') {
  $params = $_GET;
  unset($params['action']);
    try {
      $city = $db->select('cities')
        ->where('c_name' , strtolower($params['c_name']))
        ->first();
    } catch (Exception $exception) {
        $no_city = 'К сожалению, выбранный город отсутсвует в нашем каталоге';
    }

    $hotels = get_hotels($params);
}
?>

<div id="search_info">
	<div class="container">
		<div class="row">
            <?php if ($no_city): ?>
              <h1><?= $no_city ?></h1>
            <?php else: ?>
			<h1><?= $city['c_name'] ?></h1>
			<p><?= $city['с_description'] ?></p>
            <?php endif ?>
			<hr>
		</div>
	</div>

</div>

<div id="search_results">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
                <div id="main-form">
                  <?php get_search_form($params, TRUE) ?>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <?php render_hotels($hotels) ?>
            </div>
		</div>
	</div>
</div>
<?php include_once 'parts/footer.php'?>
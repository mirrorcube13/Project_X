<?php

$no_city = FALSE;
$params = [];
$db = DB::getObject();

$city = $db->select('cities')->first();
$params['c_name'] = $city['c_name'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
      $city = $db->select('cities')
        ->where('c_name' , strtolower($_POST['c_name']))
        ->first();
    } catch (Exception $exception) {
        $no_city = 'К сожалению, выбранный город отсутсвует в нашем каталоге';
    }
    $params = $_POST;
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
				<div id="hotel">
					<img src="../img/hotel.jpg" style="float: left;height: 200px;width: 200px;">
					<h1>hotel 1</h1>
					<p>some text</p>
					<p>100$</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once 'parts/footer.php'?>
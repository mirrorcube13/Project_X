<?php

$no_city = FALSE;
$db = DB::getObject();
$city = $db->select('cities')->first();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
      $city = $db->select('cities')
        ->where('c_name' , strtolower($_POST['c_name']))
        ->first();
    } catch (Exception $exception) {
        $no_city = 'К сожалению, выбранный город отсутсвует в нашем каталоге';
    }
}
?>

<div id="search_info">
	<div class="container">
		<div class="row">
            <?php if ($no_city): ?>
              <h1><?= $no_city ?></h1>
            <?php else: ?>
			<h1><?= ucfirst($city['c_name']) ?></h1>
			<p><?= ucfirst($city['с_description']) ?></p>
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
	<form action="searchresults" method="post" >
					<h2><i class="fas fa-search"></i> Поиск отелей</h2>
					<hr>
					<label>Город, отель, место или адрес</label><input type="text" size="30" value="Например, Токио" onfocus="if (this.value == ' Например, Токио') {this.value = '';}" onblur="if (this.value == '') {this.value = ' Например, Токио';}">
					<hr>
					<div class="row">
						<div class="col-md-6">Заезд<br><input id="date" type="date"></div>
						<div class="col-md-6">Выезд<br><input id="date" type="date"></div>
					</div>
					<hr>
		    <select name="" id="adult" class="">
			                <option value="1" selected="selected">1 взрослый</option>
			                <option value="2" >2 взрослых</option>
			                <option value="3">3 взрослых</option>
			                <option value="4">4 взрослых</option>
			                <option value="5">5 взрослых</option>
			                <option value="6">6 взрослых</option>
			                <option value="7">7 взрослых</option>
			                <option value="8">8 взрослых</option>
			                <option value="9">9 взрослых</option>
			                <option value="10">10 взрослых</option>
		        		</select>
		        		<select name="" id="child" class="">
			                <option value="0" selected="selected">Без детей</option>
			                <option value="1">1 ребенок</option>
			                <option value="2">2 детей</option>
			                <option value="3">3 детей</option>
			                <option value="4">4 детей</option>
			                <option value="5">5 детей</option>
		        		</select>
		        		<select name="" id="hotel-number" class="">
			                <option value="1" selected="selected">1 номер</option>
			                <option value="2">2 номера</option>
			                <option value="3">3 номера</option>
			                <option value="4">4 номера</option>
			                <option value="5">5 номеров</option>
			                <option value="6">6 номера</option>
			                <option value="7">7 номера</option>
			                <option value="8">8 номера</option>
			                <option value="9">9 номеров</option>
			                <option value="10">10 номеров</option>
		        		</select>
				 	<hr>
				 	<input type="submit" value="Искать" onclick="">
				</form>
</div>

<div id="filter">
	<form>			
   <h4>Количество звезд</h4>
   <p><input type="checkbox" name="star1" value="1"> 1 звезда</p>
   <p><input type="checkbox" name="star2" value="2"> 2 звезды</p>
   <p><input type="checkbox" name="star3" value="3"> 3 звезды</p>
   <p><input type="checkbox" name="star4" value="4"> 4 звезды</p>
   <p><input type="checkbox" name="star5" value="5"> 5 звезд</p>
   <hr>				
   <h4>Удобства</h4>
   <p><input type="checkbox" name="a" value="1"> Бесплатный Wi-fi</p>
   <p><input type="checkbox" name="a" value="2"> Трансфер от/до аэропорта</p>
   <p><input type="checkbox" name="a" value="3"> Парковка</p>
   <p><input type="checkbox" name="a" value="4"> Бассейн</p>
   <p><input type="checkbox" name="a" value="5"> Фитнес-центр</p>
   <hr>
   <h4>Удобства в номере</h4>
   <p><input type="checkbox" name="a" value="1"> Балкон</p>
   <p><input type="checkbox" name="a" value="2"> Кондиционер</p>
   <p><input type="checkbox" name="a" value="3"> Кофемашина</p>
   <p><input type="checkbox" name="a" value="4"> Ванна</p>			
	</form>
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
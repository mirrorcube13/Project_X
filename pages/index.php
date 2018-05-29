<div id="section1">
  <div class="container-fluid">
    <div class="col-md-4">
      <div id="main-form">
        <form onsubmit="alert('submit');return false" >
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
            <option value="5">2 взрослых</option>
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
          </select>
          <hr>
          <input type="submit" value="Искать" onclick="location.href='searchresults.html'">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <h1>Бронирование отелей со скидками до 60%</h1>
      <h3>Забронируйте номер по выгодной цене!</h3>
    </div>
  </div>


  <div id="arrow" class="arrow">
    <a href="#about-us">↓</a>
  </div>
</div>

<div id="about-us">
  <div class="container">
    <div class="row">
      <h2>Бронирование отелей на Hotellook </h2>
      <p class="icon"><i class="fas fa-key"></i></p>
      <h3>Наши основные преимущества </h3>
      <br>
    </div>
    <div class="row">
      <div class="col-md-4"><img src="img/icon/Social  Engagement.png" class="img-responsive" style="height: 150px;margin: auto;"><h3>Сервис, которому вы можете доверять</h3><p>Круглосуточное многоязычное обслуживание без проблем </p></div>
      <div class="col-md-4"><img src="img/icon/Affiliate Marketing.png" class="img-responsive" style="height: 150px;margin: auto;"><h3>Без скрытых платежей</h3><p>Сайт показывает окончательную цену на отель. Никаких дополнительных налогов и скрытых комиссий. </p></div>
      <div class="col-md-4"><img src="img/icon/Online Presence.png" class="img-responsive" style="height: 150px;margin: auto;"><h3>Международное покрытие </h3><p> Более 1 200 000 отелей в более чем 200 странах и рейсы в более чем 5000 городов
        </p></div>
    </div>
  </div>
</div>

<div id="popular-cities">
  <div class="container">
    <h2 class="centered">Популярные направления</h2>
    <p class="icon"><i class="fas fa-building"></i></p><br><br>
    <div class="row">
      <div class="col-md-4"><div style="background:#000"><img src="img/top/moskva.jpg" class="img-responsive"><h2 style="color: white">Москва</h2></div></div>
      <div class="col-md-4"><div style="background:#000"><img src="img/top/paris.jpg" class="img-responsive"><h2 style="color: white">Париж</h2></div></div>
      <div class="col-md-4"><div style="background:#000"><img src="img/top/rome.jpg" class="img-responsive"><h2 style="color: white">Рим</h2></div></div>
    </div><br>
    <div class="row">
      <div class="col-md-4"><div style="background:#000"><img src="img/top/germany.jpg" class="img-responsive"><h2 style="color: white">Мюнхен</h2></div></div>
      <div class="col-md-4"><div style="background:#000"><img src="img/top/tokyo.jpg" class="img-responsive"><h2 style="color: white">Токио</h2></div></div>
      <div class="col-md-4"><div style="background:#000"><img src="img/top/vegas.jpg" class="img-responsive"><h2 style="color: white">Лас-Вегас</h2></div></div>
    </div>
  </div>
</div>

<div id="section4">
  <div class="container">
    <div class="row">
      <h2>Большое количество вариантов бронирования</h2>
      <p class="icon"><i class="fas fa-search"></i></p>
    </div>
    <div class="row">
      <div class="col-md-3"><img src="img/icon/s1.svg"><p>287 000<br>отелей</p></div>
      <div class="col-md-3"><img src="img/icon/s2.svg"><p>54 000<br>хостелов</p></div>
      <div class="col-md-3"><img src="img/icon/s3.svg"><p>683 000<br>гостевых домов</p></div>
      <div class="col-md-3"><img src="img/icon/s4.svg"><p>1 502 000<br>апартаментов </p></div>
    </div>
  </div>
</div>
<div id="section5">
  <div class="container">
    <div class="row">
      <h2>Some text</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur velit laboriosam accusantium voluptas perspiciatis quasi qui natus expedita cum, reprehenderit in excepturi, incidunt fugit nisi voluptates voluptatibus temporibus totam obcaecati!</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur velit laboriosam accusantium voluptas perspiciatis quasi qui natus expedita cum, reprehenderit in excepturi, incidunt fugit nisi voluptates voluptatibus temporibus totam obcaecati!</p>
    </div>
  </div>
</div>

<footer>
  <a href=""><i class="fab fa-vk"></i> Вконтакте</a>
  <a href=""><i class="fab fa-facebook-f"></i> Facebook</a>
  <a href=""><i class="fab fa-instagram"></i> Instagram</a>
  <hr>
  <p>2018</p>
</footer>
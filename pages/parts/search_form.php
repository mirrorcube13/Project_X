<?php

$adults_opts = [
  '1 взрослый' => 1,
  '2 взрослых' => 2,
  '3 взрослых' => 3,
  '4 взрослых' => 4,
  '5 взрослых' => 5,
];

$child_opts = [
  'Без детей' => 0,
  '1 ребенок' => 1,
  '2 детей' => 2,
  '3 детей' => 3,
  '4 детей' => 4,
  '5 детей' => 5,
];

$stars_opts = [
  '1 звезда' => 1,
  '2 звезды' => 2,
  '3 звезды' => 3,
  '4 звезды' => 4,
  '5 звезд' =>  5,
];

$convs_opts = [
  'Бесплатный Wi-fi' => 'rc_wifi',
  'Трансфер от/до аэропорта' => 'rc_transfer',
  'Парковка' => 'rc_parking',
  'Бассейн' => 'rc_pool',
  'Фитнес-центр' => 'rc_fitness',
];

$room_convs_opts = [
  'Балкон' => 'rc_balcony',
  'Кондиционер' => 'rc_cond',
  'Кофемашина' => 'rc_coffee',
  'Ванна' => 'rc_tub',
];

?>
<form action="searchresults" method="get">
  <h2><i class="fas fa-search"></i> Поиск отелей</h2>
  <hr>
  <label>Город, отель, место или адрес</label>
  <input name="c_name" type="text" size="30" value="<?= render($params['c_name']) ?>" placeholder="Например, Токио">
  <hr>
  <div class="row">
    <div class="col-md-6">Заезд<br><input name="r_start" id="date" type="date" value="<?= render($params['r_start']) ?>"></div>
    <div class="col-md-6">Выезд<br><input name="r_end" id="date" type="date" value="<?= render($params['r_end']) ?>"></div>
  </div>
  <hr>
  <select name="r_capacity" id="adult" class="">
    <?php foreach ($adults_opts as $label => $value): ?>
    <option value="<?= $value ?>" <?= render_selected($params['r_capacity'], $value) ?>><?= $label ?></option>
    <?php endforeach; ?>
  </select>
  <select name="r_capacity_child" id="child" class="">
    <?php foreach ($child_opts as $label => $value): ?>
      <option value="<?= $value ?>" <?= render_selected($params['r_capacity_child'], $value) ?>><?= $label ?></option>
    <?php endforeach; ?>
  </select>
  <hr>
  <input type="hidden" name="action" value="search">
  <input type="submit" value="Искать">

<?php if ($convs): ?>
  <div id="filter">
    <h4>Количество звезд</h4>
    <?php foreach ($stars_opts as $label => $value): ?>
    <p><input type="checkbox" name="rc_stars[]" value="<?= $value ?>" <?= render_checked($params['rc_stars'], $value) ?>><?= $label ?></p>
    <?php endforeach; ?>
    <hr>
    <h4>Удобства</h4>
    <?php foreach ($convs_opts as $label => $value): ?>
      <p><input type="checkbox" name="convs[]" value="<?= $value ?>" <?= render_checked($params['convs'], $value) ?>><?= $label ?></p>
    <?php endforeach; ?>
    <hr>
    <h4>Удобства в номере</h4>
    <?php foreach ($room_convs_opts as $label => $value): ?>
      <p><input type="checkbox" name="convs[]" value="<?= $value ?>" <?= render_checked($params['convs'], $value) ?>><?= $label ?></p>
    <?php endforeach; ?>
  </div>
  <?php endif;?>
</form>
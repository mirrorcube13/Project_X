<?php if (empty($hotels)): ?>
  <h2>К сожалению по вашему запросу ничего не найдено</h2>
<?php else: ?>
  <?php foreach ($hotels as $hotel): ?>
    <div id="hotel">
      <img src="/img/hotels/<?= $hotel['r_id'] ?>.jpg" style="float: left;height: 200px;width: 200px;">
      <h1><?= $hotel['r_name'] ?></h1>
      <p><?= $hotel['r_desc'] ?></p>
      <p><?= $hotel['r_price'] ?>$</p>
      <p>С <?= date('m.d.Y', $hotel['r_start']) ?> по <?= date('m.d.Y', $hotel['r_end']) ?></p>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

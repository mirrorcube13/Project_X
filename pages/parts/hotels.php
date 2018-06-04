<?php if (empty($hotels)): ?>
  <h2>К сожалению по вашему запросу ничего не найдено</h2>
<?php else: ?>
  <?php foreach ($hotels as $hotel): ?>
    <div id="hotel">
<div class="row">
  <div class="col-md-4 image-block-zoom">
    <img src="/img/hotels/<?= $hotel['r_id'] ?>.jpg" сlass="img-zoom" width="200" height="200">
  </div>
  <div class="col-md-8">
    <h1><?= $hotel['r_name'] ?>  <span><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></span> </h1> <!-- добавил звезды -->
    <p><?= $hotel['r_desc'] ?></p>
    <p>Цена:<?= $hotel['r_price'] ?>$</p>
    <p>С <?= date('m.d.Y', $hotel['r_start']) ?> по <?= date('m.d.Y', $hotel['r_end']) ?></p>
    <button type="button">Подробнее</button><!-- Добавил кнопку -->
  </div>
</div>

      

    </div>
  <?php endforeach; ?>
<?php endif; ?>

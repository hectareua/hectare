<h1>Нове питання про партнерьскі ціни</h1>

<?php if ($model->product): ?>
    <div>Продукт: <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/web/products/view', 'product_id' => $model->product->id, 'category_id' => $model->product->category_id]);?>">
        <?=$model->product->name?>
    </a></div>
<?php endif; ?>
<div>Ім'я: <?=$model->name?></div>
<div>Електронна адреса: <?=$model->email?></div>
<div>Телефон: <?=$model->phone?></div>

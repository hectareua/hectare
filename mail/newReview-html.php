<h1>Новий відгук на сайті</h1>

<?php if ($model->product): ?>
    <div>Продукт: <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/web/products/view', 'product_id' => $model->product->id, 'category_id' => $model->product->category_id]);?>">
        <?=$model->product->name?>
    </a></div>
<?php endif; ?>
<div>Ім'я: <?=$model->name?></div>
<div>телефон: <?=$model->phone?></div>
<div>Відгук: <?=$model->text?></div>

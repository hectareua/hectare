Нове питання до продукту

<?php if ($model->product): ?>
Продукт: <?=$model->product->name?>
URL: <?=Yii::$app->urlManager->createAbsoluteUrl(['/web/products/view', 'product_id' => $model->product->id, 'category_id' => $model->product->category_id]);?>
<?php endif; ?>

Ім'я: <?=$model->name?>

Електронна адреса: <?=$model->email?>

Телефон: <?=$model->phone?>

Текст: <?=$model->text?>

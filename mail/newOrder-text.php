Нове замовлення

Повне ім'я платника: <?=$model->billing_fullname?>

Місто платника: <?=$model->billing_city?>

Регіон платника: <?=$model->billing_region?>

Телефон платника: <?=$model->billing_phone?>

Електронна адреса платника: <?=$model->billing_email?>

Повне ім'я отримувача: <?=$model->delivery_fullname?>

Адреса отримувача: <?=$model->delivery_address?>

Місто отримувача: <?=$model->delivery_city?>

Регіон отримувача: <?=$model->delivery_region?>

Країна отримувача: <?=$model->delivery_country_id?>

Телефон отримувача: <?=$model->delivery_phone?>

------------------------------------------------------------
<?php foreach($model->orderProducts as $orderProduct): ?>

<?=$orderProduct->product->id?> <?=$orderProduct->product->name?>:
<?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
<?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
<?php endforeach; ?>
<?=$orderProduct->amount?> x <?=number_format($orderProduct->product->currencyPrice, 2)?> грн.

<?php endforeach; ?>
------------------------------------------------------------
Загальна вартість: <?=number_format($model->price, 2)?> грн.
Система сплати: <?=$model->paymentSystem->name?>
<?php if ($model->comment): ?>

Коментар: <?=$model->comment?>

<?php endif; ?>

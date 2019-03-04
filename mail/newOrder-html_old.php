<h1>Нове замовлення</h1>

<div>Повне ім'я платника: <?=$model->billing_fullname?></div>
<div>Місто платника: <?=$model->billing_city?></div>
<div>Регіон платника: <?=$model->billing_region?></div>
<div>Телефон платника: <?=$model->billing_phone?></div>
<div>Електронна адреса платника: <?=$model->billing_email?></div>
<div>Повне ім'я отримувача: <?=$model->delivery_fullname?></div>
<div>Адреса отримувача: <?=$model->delivery_address?></div>
<div>Місто отримувача: <?=$model->delivery_city?></div>
<div>Регіон отримувача: <?=$model->delivery_region?></div>
<div>Країна отримувача: <?=$model->delivery_country_id?></div>
<div>Телефон отримувача: <?=$model->delivery_phone?></div>

<table>
    <tr>
        <th>ID товару</th>
        <th>Назва товару</th>
        <th>Варіант</th>
        <th>Кількість</th>
        <th>Ціна</th>
    </tr>
    <?php foreach($model->orderProducts as $orderProduct): ?>
        <td><?=$orderProduct->product->id?></td>
        <td><?=$orderProduct->product->name?></td>
        <td>
            <?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
                <?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
            <?php endforeach; ?>
        </td>
        <td><?=$orderProduct->amount?></td>
        <td><?=number_format($orderProduct->product->currencyPrice, 2)?> грн.</td>
    <?php endforeach; ?>
</table>
<div>Загальна вартість: <?=number_format($model->price, 2)?> грн.</div>
<div>Система сплати: <?=$model->paymentSystem->name?></div>
<?php if ($model->comment): ?>
    <div>Коментар: <?=$model->comment?></div>
<?php endif; ?>
<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['admin/order/view/', 'id' => $model->id])?>">Переглянути</a>

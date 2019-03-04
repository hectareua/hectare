<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({

        'transactionId': '<?= $order->id; ?>', // Уникальный идентификатор транзакции
        'transactionTotal': <?= $totalPrice; ?>, // Общая сумма транзакции
        'transactionProducts': [
            <?php foreach ($order->orderProducts as $orderProduct): ?>
                {
                'sku': '<?= $order->id; ?>', // Идентификатор товара
                'name': '<?= $orderProduct->product->name; ?>', // Название товара
                'category': '<?= $orderProduct->product->category->name; ?>', // Категория товара
                'price': <?= $orderProduct->product->price; ?>, // Цена за единицу товара
                'quantity': <?= $orderProduct->amount; ?> // Количество единиц товара
                },
            <?php endforeach; ?>
        ],
        'event': 'trackTrans'
    });</script> 
<?php
$this->title = Yii::t('web', 'Оформление заказа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>
<div class="cart-success">Дякуємо за покупку</div>


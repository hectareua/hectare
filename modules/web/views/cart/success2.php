<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'ecommerce': {
            'currencyCode': 'UAH',
            'purchase': {
                'actionField': {
                    'id': '<?= $order->id; ?>',
                    'affiliation': 'hectare.com.ua',
                    'revenue': <?= $totalPrice; ?>,
                    'shipping': 0,
                    'tax': 0.00
                },
                'products': [
<?php foreach ($order->orderProducts as $orderProduct): ?>
                        {
                            'name': '<?= $orderProduct->product->name; ?>',
                            'id': '<?= $order->id; ?>',
                            'price': <?= $orderProduct->product->price; ?>,
                            'category': '<?= $orderProduct->product->category->name; ?>',
                            'quantity': <?= $orderProduct->amount; ?>
                        },
<?php endforeach; ?>
                ]
            }
        },
        'event': 'gtm-ee-event',
        'gtm-ee-event-category': 'Enhanced Ecommerce',
        'gtm-ee-event-action': 'Purchase',
        'gtm-ee-event-non-interaction': 'False',
    });</script> 
<?php
$this->title = Yii::t('web', 'Оформление заказа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>
<div class="cart-success">Дякуємо за покупку</div>


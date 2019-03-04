<?php
use app\components\Url;

$this->title = Yii::t('web', 'Корзина');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
$this->registerCssFile('@web/css/bootstrap.min.css');
$this->registerJsFile('@web/js/bootstrap.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/web/js/cart.js');
?>


<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a itemprop="item"
                                                                               href="<?= Url::to(['default/index']) ?>"><span
                        itemprop="name"> <?= Yii::t('web', 'Главная') ?> </span> » </a>
            <meta itemprop="position" content="1"/>
        </li>

        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?= Url::to(['categories/index']) ?>"> <span
                        itemprop="name"><?= Yii::t('web', 'Интернет-магазин') ?></span> » </a>
            <meta itemprop="position" content="2"/>
        </li>

        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem"><span itemprop="name"><?= Yii::t('web', 'Корзина') ?></span>
            <meta itemprop="position" content="3"/>
        </li>
    </ol>
    <div class="cart">
        <div class="cart__title"><?= Yii::t('web', 'Корзина') ?></div>
        <?php if (!empty($models)): ?>
            <div class="cart-itemList">
                <div class="cart-itemList-header">
                    <div class="cart-itemList-header__photo"><?= Yii::t('web', 'фото') ?></div>
                    <div
                            class="cart-itemList-header__name"><?= Yii::t('web', 'наименование') ?></div>
                    <div
                            class="cart-itemList-header__price"><?= Yii::t('web', 'цена') ?></div>
                    <div
                            class="cart-itemList-header__itogo"><?= Yii::t('web', 'разом') ?></div>
                    <div
                            class="cart-itemList-header__quantity"><?= Yii::t('web', 'количество') ?>
                    </div>
                    <?php if ($bonuses > 0 && $purchaseType == 0) : ?>
                    <?php if (!$bonusRequest) : ?>
                    <div
                            class="cart-itemList-header__bonuses"><?= Yii::t('web', 'Бонусы') ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <div
                            class="cart-itemList-header__total"><?= Yii::t('web', 'сумма') ?></div>
                    <div
                            class="cart-itemList-header__del"><?= Yii::t('web', 'удалить') ?></div>
                </div>
                <form action="<?= Url::to(['cart/refresh']) ?>" method="POST" class="refresh_form">
                    <?php foreach ($models as $index => $model): ?>
                        <div class="cart-itemList-item">
                            <div class="cart-itemList-item__photo-block">
                                <div class="cart-itemList-item__photo"
                                     style="background-image: url(<?= $model->product->image->url ?>); height: 100px !important; width: 100px !important;"></div>
                            </div>

                            <div class="cart-itemList-item__name">
                                <p>
                                    <?= $model->product->id ?>
                                    <?= $model->product->name ?>
                                    <?php foreach ($model->attributeValues as $attributeValue): ?>
                                        <br><?= $attributeValue->option->attr->name ?>: <?= $attributeValue->option->name ?>
                                    <?php endforeach; ?>
                                </p>
                            </div>

                            <div class="cart-itemList-item__price">
                                <p>
                                    <?= number_format($model->PricePerBaseMeasure, 2) ?> грн<br><?= $model->ykazatel ? 'за ' . $model->ykazatel : Yii::t('web', 'ед') ?>.
                                </p>
                            </div>

                            <div class="cart-itemList-item__itogo">
                                <p>
                                    <?= number_format($model->price, 2) ?> грн.
                                </p>
                            </div>

                            <div class="cart-itemList-item__quantity">
                                <p>
                                    <input type="number" name="cart[<?= $index ?>]" class="cart-itemList-item__quantity__input amount_placeholder" value="<?= $model->amount ?>">
                                </p>
                            </div>
                            <?php if ($bonuses > 0 && $purchaseType == 0) : ?>
                            <?php if (!$bonusRequest) : ?>
                            <div class="cart-itemList-item__bonuses">
                                <p>
                                    <input type="number" name="bonusUsed[<?= $index ?>]" class="cart-itemList-item__quantity__input amount_placeholder" value="<?= $model->bonusUsed ?>">
                                </p>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <div
                                    class="cart-itemList-item__total"><p><?= number_format($model->totalPrice, 2) ?>
                                    грн</p></div>
                            <div
                                    class="cart-itemList-item__del remove_button" data-id="<?= $index ?>"></div>
                        </div>
                    <?php endforeach; ?>
                </form>
                <?php $this->registerJs("
                    $(document).ready(function(){
                        $('.amount_placeholder').change(function(){
                            $('.refresh_form').submit();
                        });
        
                        $('.remove_button').click(function(){
                            if (confirm('" . Yii::t('web', 'Действительно удалить?') . "'))
                                location = '" . Url::to(['cart/remove']) . "?index='+$(this).data('id');
                        });
                    });
                "); ?>
            </div>
        <?php endif; ?>
        <?php if (empty($models)): ?>
            <p><?= Yii::t('web', 'Корзина пуста!') ?></p>
        <?php endif; ?>
        <?php if (!empty($totalPrice)): ?>
            <div class="cart__totalPrice">
                <?php if ($bonuses > 0 && $purchaseType == 0) : ?>
                    <?php if ($bonusRequest) : ?>
                        <span><?= Yii::t('web', 'Ожидаеться списание бонусов') ?>.&nbsp;</span>
                    <?php elseif (!$bonusRequest) : ?>
                        <span style="float:left;"><?= Yii::t('web', 'Доступно бонусов') //Yii::t('web', 'Бонусов использовано') //$totalBonusUsed?>&nbsp;<?= $bonuses; ?></span>
                    <?php endif; ?>
                <?php endif; ?>
                <?= Yii::t('web', 'К оплате') ?>
                <span><?= number_format($totalPrice, 2) ?></span> грн
            </div>
        <?php endif; ?>
        <div class="cart-buttons">
            <a href="<?= Url::to(['categories/index']) ?>"
               class="cart-buttons__back"><?= Yii::t('web', 'Магазин') ?></a>
            <?php if (!empty($models)): ?>
                <a href="<?= Url::to(['cart/checkout']) ?>"
                   class="cart-buttons__order" onclick="yaCounter44862661.reachGoal('oformlenie_v_korzine'); return true;"><?= Yii::t('web', 'Оформить заказ') ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="space"></div>
<div class="space"></div>

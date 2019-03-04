<?php
use app\components\Url;
$this->title = Yii::t('web', 'Доставка') . ' ' . Yii::t('web', 'и оплата') . ' | Гектар';
$lang = '';
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'Доставка') . ' ' . Yii::t('web', 'и оплата') . Yii::t('web', ' ✔ Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (096) 733-73-30')]);

if(Yii::$app->language == 'uk') {$lang='_uk';}
?>
<div class="delivery">
    <div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


<!--        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope-->
<!--     itemtype="http://schema.org/ListItem"><span itemprop="name">--><?//=Yii::t('web', 'Доставка')?><!--</span> <meta itemprop="position" content="2" /></li>-->
    </ol>

        <div class="delivery__title"><?=Yii::t('web', 'Доставка')?> <?=Yii::t('web', 'и оплата')?></div>
        <h2><?=Yii::t('web', 'Схема работы')?></h2>
        <ul class="delivery-list">
            <li class="delivery-list-item">
                <div class="delivery-list-item__img"></div>
                <div class="delivery-list-item__description">
                    <?=$this->context->siteInfo->{'dostavka1'.$lang}?>
                </div>
            </li>
            <li class="delivery-list-item delivery-list-item_2">
                <div class="delivery-list-item__img"></div>
                <div class="delivery-list-item__description">
                    <?=$this->context->siteInfo->{'dostavka2'.$lang}?>
                </div>
            </li>
            <li class="delivery-list-item delivery-list-item_3">
                <div class="delivery-list-item__img"></div>
                <div class="delivery-list-item__description">
                    <?=$this->context->siteInfo->{'dostavka3'.$lang}?>
                </div>
            </li>
            <li class="delivery-list-item delivery-list-item_4">
                <div class="delivery-list-item__img"></div>
                <div class="delivery-list-item__description">
                    <?=$this->context->siteInfo->{'dostavka4'.$lang}?>
                </div>
            </li>
            <li class="delivery-list-item delivery-list-item_5">
                <div class="delivery-list-item__img"></div>
                <div class="delivery-list-item__description">
                    <?=$this->context->siteInfo->{'dostavka5'.$lang}?>
                </div>
            </li>
            <li class="delivery-list-item delivery-list-item_6">
                <div class="delivery-list-item__img"></div>
                <div class="delivery-list-item__description">
                    <?=$this->context->siteInfo->{'dostavka6'.$lang}?>
                </div>
            </li>
        </ul>

    </div>



</div>
<div class="space"></div>

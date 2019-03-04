<?php
use app\components\Url;
$this->title = Yii::t('web', 'Интернет-магазин семян, удобрений, средств защиты, инвентаря');

if (!empty($category->seoDescription)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Большой выбор удобрений, семян и средст защиты ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
}

if (isset($category->seoKeywords))
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"> <?=Yii::t('web', 'Интернет-магазин')?> </span> <meta itemprop="position" content="2" /> </li>
    </ol>
    <div class="catalog">
        <!-- <div class="catalog__title"><?=Yii::t('web', 'Интернет-магазин')?></div> -->
        <ul class="catalog-list">
            <?php foreach ($models as $model): ?>
                <?php if(count($model->categories) > 0 || count($model->products) > 0) : ?>
                    <li class="catalog-list-item">
                        <a href="<?=Url::toCategory($model)?>" class="catalog-list-item__image" style="background-image:url('<?php if($model->image->url) { echo $model->image->url; }?>')"> </a>
                        <a href="<?=Url::toCategory($model)?>" class="catalog-list-item__title"><?=$model->name?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="shares">
        <div class="wrapper">
            <?= $this->render('/partial/_sale', compact('saleProducts')) ?>
        </div>
    </div>
    <div class="space"></div>


</div>

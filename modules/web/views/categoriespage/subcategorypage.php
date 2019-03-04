<?php
use app\components\Url;
$this->title = $category->seoTitle?$category->seoTitle:$category->name;
if (!empty($category->seoDescription)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Большой выбор удобрений, семян и средств защиты ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
}
if ($category->seoKeywords)
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>

        <?php foreach ($parents as $parent): ?>
            <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a  itemprop="item"  href="<?=Url::toCategory($parent)?>"> <span itemprop="name"><?=$parent->name?></span> » </a> <meta itemprop="position" content="3" /></li>
        <?php endforeach; ?>

        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=$category->name?></span><meta itemprop="position" content="4" /></li>

    </ol>
    <div class="catalog">
        <h1 class="catalog__title"><?=$this->params['seoH1'] ?: ($category->seoHeader? $category->seoHeader : $category->name) ?></h1>
        <ul class="catalog-list">
            <?php foreach ($models as $model): ?>
            <?php if(count($model->categories) > 0 || count($model->products) > 0) : ?>
                <li class="catalog-list-item subcategories-list-item">
                   22 <a href="<?=Url::toCategory($model)?>" class="catalog-list-item__image" style="background-image:url('<?=$model->image->url?>')"> </a>
                    <a href="<?=Url::toCategory($model)?>" class="catalog-list-item__title"><span><?=$model->name?></span></a>
                </li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="dynamic_content"><?=$this->params['seoText'] ?: $category->description?></div>
    </div>
    <div class="space"></div>
</div>

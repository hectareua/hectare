<?php
use app\components\Url;
if ($model->seoTitle) {
    $this->title = $model->seoTitle;
} else {
    $this->title = Yii::t('web', 'news-seo-meta-template-title', ['name' => $model->title]);
}
if ($model->seoDescription) {
    $this->registerMetaTag(['name' => 'description', 'content' => $model->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'news-seo-meta-template-description', ['name' => $model->title])], 'description');
}
if ($model->seoKeywords) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $model->seoKeywords], 'keywords');
} else {
    $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::t('web', 'news-seo-meta-template-keywords', ['name' => $model->title])], 'keywords');
}
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a itemprop="item" href="<?=Url::to(['articles/index'])?>"><span itemprop="name"><?=Yii::t('web', 'Статьи')?></span> </a><meta itemprop="position" content="2" /></li>


<!--        <li itemprop="itemListElement" itemscope-->
<!--         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name">--><!--</span><meta itemprop="position" content="3" /></li>-->
    </ol>
    <h1><?= $this->params['seoH1'] ?: $model->title ?></h1>
    <div class="dynamic_content"><?=$this->params['seoText'] ?: $model->text?></div>
</div>

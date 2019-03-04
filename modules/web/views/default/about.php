<?php
use app\components\Url;

$this->title = Yii::t('web', 'О компании') . ' | Гектар';
if(Yii::$app->language == 'ru') {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'О компании') . '. Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.']);
} else {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'О компании') . '. Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.']);
}
?>
<div class="wrapper aboutpage">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


<!--        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope-->
<!--     itemtype="http://schema.org/ListItem"><span itemprop="name">--><?//=Yii::t('web', 'О компании')?><!--</span> <meta itemprop="position" content="2" /></li>-->
    </ol>
    <h1 style="font-size:2rem;"><?=$this->params['seoH1'] ?: Yii::t('web', 'О компании')?></h1>
    <div class="dynamic_content"><?=$this->params['seoText'] ?: $info->aboutUsText?></div>
</div>

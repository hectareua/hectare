<?php
use app\components\Url;
$this->title = Yii::t('web', 'Партнеры') . ' | Гектар';
if(Yii::$app->language == 'ru') {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'Партнеры') . '. Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.']);
} else {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'Партнеры') . '. Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.']);
}

?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


<!--        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope-->
<!--     itemtype="http://schema.org/ListItem"><span itemprop="name">--><?//=Yii::t('web', 'Партнеры')?><!--</span> <meta itemprop="position" content="2" /></li>-->
    </ol>
    <h2 style="font-size:2rem;"><?=Yii::t('web', 'Партнеры')?></h2>
    <div>
        <div style="text-align: center; margin:20px 0;">
            <?php foreach ($partners as $partner): ?>
                <div class="partners__img"><img src="<?=$partner->image->url?>"></div>
            <?php endforeach; ?>
        </div>
        <div class="dynamic_content"><?= $this->params['seoText'] ?: $this->context->siteInfo->partnersText?></div>
    </div>
</div>

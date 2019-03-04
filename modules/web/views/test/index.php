<?php
use app\components\Url;
use yii\widgets\LinkPager;


?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope 
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

<!--        <li itemprop="itemListElement" itemscope-->
<!--         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name">--><?//=Yii::t('web', 'Новости')?><!--</span><meta itemprop="position" content="2" /></li>-->
    </ol>
    <div class="news">
        <div class="news-list">
            <?php foreach ($models as $model): ?>
                <?php $url = Url::toNews($model); ?>
                <div class="news-list-item">
                    <div class="news-list-item__title"><?=$model->title?></div>
                    <div class="news-list-item__img" style="background-image: url(<?=$model->image->url?>)"></div>
                    <div class="news-list-item__content"><?=\yii\helpers\StringHelper::truncateWords($model->text, 100, '...', true)?></div>
                    <div class="news-list-item-additional">
                        <!-- <a href="" class="news-list-item-additional__addComment"><?=Yii::t('web', 'Добавить комментарий')?></a> -->
                        <a href="<?=$url?>" class="news-list-item-additional__more"><?=Yii::t('web', 'Подробнее')?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= LinkPager::widget([
        'pagination' => $pagination,
        'pageCssClass' => 'pagination__item',
        'prevPageCssClass' => 'pagination__item pagination__item_prev',
        'nextPageCssClass' => 'pagination__item pagination__item_next',
        'activePageCssClass' => 'pagination__item_active',
        'disabledPageCssClass' => 'hidden',
        'nextPageLabel' => Yii::t('web', 'Далее'),
        'prevPageLabel' => Yii::t('web', 'Назад'),
    ]) ?>
    <div class="space"></div>
</div>


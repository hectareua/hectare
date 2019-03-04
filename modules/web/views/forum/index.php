<?php
use app\components\Url;
use yii\widgets\LinkPager;
$this->title = Yii::t('web', 'Форум') . ' | Гектар';

if($page < $numberPages && $page>1) {
    $this->registerMetaTag(['name' => 'yandex', 'content' => 'noindex, follow']);
    $this->registerLinkTag(['rel' => 'next', 'href' => Url::current(['page' => $page + 1], true)], 'next');
    $this->registerLinkTag(['rel' => 'prev', 'href' => Url::current(['page' => $page - 1], true)], 'prev');
} else if ($page == $numberPages) {
    $this->registerMetaTag(['name' => 'yandex', 'content' => 'noindex, follow']);
    $this->registerLinkTag(['rel' => 'prev', 'href' => Url::current(['page' => $page - 1], true)], 'prev');
} else {
    $this->registerLinkTag(['name' => 'next', 'href' => Url::current(['page' => $page + 1], true)]);
    
}

if (Yii::$app->language == 'uk') {
    $this->registerMetaTag(['name' => 'description',  'content' => $this->title . ' . Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.'], 'description');
} else {
    $this->registerMetaTag(['name' => 'description',  'content' => $this->title . ' . Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.'], 'description');
}
?>
<div class="wrapper">
    <ol class="breadcrumbs">
        <li class="breadcrumbs__item"><a href="<?=Url::to(['default/index'])?>"><?=Yii::t('web', 'Главная')?> » </a></li>
        <li class="breadcrumbs__item"><?=Yii::t('web', 'Форум')?></li>
    </ol>
    <div class="forum-main">
        <h1 class="forum__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Форум') ?></h1>
        <div class="forum-main-list">
            <?php foreach ($models as $model): ?>
                <div class="forum-main-list-item">
                    <div class="forum-main-list-item__title"><?=$model->name?></div>
                    <?php if ($model->image): ?>
                        <div class="forum-main-list-item__img" style="background-image: url(<?=$model->image->url?>)"></div>
                    <?php endif; ?>
                    <div class="forum-main-list-item__content"><?=$model->text?></div>
                    <div class="forum-main-list-item-additional">
                        <!-- <a href="" class="forum-main-list-item-additional__addComment">Добавить комментарий</a> -->
                        <a href="<?=Url::toForum($model)?>" class="forum-main-list-item-additional__more"><?=Yii::t('web', 'Подробнее')?></a>
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

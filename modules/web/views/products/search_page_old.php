<?php
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
$this->title = Yii::t('web', 'Интернет-магазин семян, удобрений, средств защиты, инвентаря');

if (!empty($category->seoDescription)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Большой выбор удобрений, семян и средст защиты ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
}

if (isset($category->seoKeywords))
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
?>
<div class="wrapper" style="overflow:hidden; padding-bottom:30px;">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"> <?=Yii::t('web', 'Интернет-магазин')?> </span> <meta itemprop="position" content="2" /> </li>
    </ol>
    <h1 class="items__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Результаты поиска') ?></h1>
    <div class="catalog">
        <!-- <div class="catalog__title"><?=Yii::t('web', 'Интернет-магазин')?></div> -->
        <ul>
            <?php foreach ($models as $model): ?>
                
                    <li class="itemsList-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <a href="<?=Url::toProduct($model)?>" class="itemsList-item__img" style="background-image:url('<?php if($model->image->url) { echo $model->image->url; }?>')"> </a>
                        <a href="<?=Url::toProduct($model)?>" class="catalog-list-item__title"><?=$model->name?></a>
                        <div class="itemsList-item__from"><?=$model->manufacturer?$model->manufacturer->name:null?></div>
                        <div class="itemsList-item__rating">
                            <?php $pRating = count($model->reviews) ? round(array_sum(ArrayHelper::getColumn($model->reviews, 'rating')) / count($model->reviews)) : 0; ?>
                            <span class="rating-star item-list__rating">
                                <?php for($i = 1; $i <= $pRating; $i++): ?>
                                    <span>★</span>
                                <?php endfor; ?>
                                <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                                    <span>☆</span>
                                <?php endfor; ?>
                                <a href="<?=Url::toProduct($model).'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($model->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
                                </span>
                        </div>
                        <div class="itemsList-item__price"><?=number_format($model->currencyPrice, 2)?> грн <?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''): ?> / <?=$model->ykazatel;?><?php endif; ?></div>
                    </li>
 
            <?php endforeach; ?>
        </ul>
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
    <div class="shares"></div>
    <div class="space"></div>


</div>

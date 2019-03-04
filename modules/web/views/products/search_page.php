<?php
use app\components\Url;
use app\helpers\Helper;
use app\models\Country;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
$this->title = Yii::t('web', 'Интернет-магазин семян, удобрений, средств защиты, инвентаря');
$lang = Yii::$app->language;

if (!empty($category->seoDescription)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Большой выбор удобрений, семян и средст защиты ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
}

if (isset($category->seoKeywords))
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
?>
<div class="items">
<div class="wrapper" style="overflow:hidden; padding-bottom:30px;">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"> <?=Yii::t('web', 'Интернет-магазин')?> </span> <meta itemprop="position" content="2" /> </li>
    </ol>
    <h1 class="items__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Результаты поиска') ?></h1>

        <!-- <div class="catalog__title"><?=Yii::t('web', 'Интернет-магазин')?></div> -->
        <ul>
            <?php foreach ($models as $model): ?>
                <li class="itemsList-item col-lg-2 col-md-2 col-sm-3 col-xs-6">
                <?php if (($model->category->delivery===1)||($model->manufacturer->delivery===1)||($model->delivery===1)) : ?>
                <div class="ftruck"></div>
            <?php endif; ?><!--<?=$model->super?>-->
                <?php if ($model->super===1) : ?>
                    <div class="superprice<?=$lang?>"></div>
                <?php endif; ?>
                <?php if ($model->topsale===1) : ?>
                    <div class="topsale<?=$lang?>"></div>
                <?php endif; ?>
				<?php if ($model->is_seeds===1) : ?>
                    <div class="seeds<?=$lang?>"></div>
                <?php endif; ?>
				<?php if ($model->b_friday===1) : ?>
                    <div class="black-fridayru"></div>
                <?php endif; ?>
                <a href="<?=Url::toProduct($model)?>" class="itemsList-item__img" style="background-image:url('<?=$model->image?Helper::thumbnail($model->image, 150, 150):null ?>')"></a>
                <?php if (!empty($model->bonus)) : ?>
                    <strong class="bonus_line">+<?= $model->bonus ?> бонусов</strong>
                <?php endif; ?>
                <?php if (1 - $model->discountRate): ?>
                    <div class="itemsList-item-sale">
                        <div class="itemsList-item-sale__percent"><span>-<?=(int)$model->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                        <div class="itemsList-item-sale__old"><span><?=number_format($model->currencyOldPrice, 2)?></span> грн</div>
                        <div class="itemsList-item-sale__rest">
                            <?php if ($model->discount_till): ?>
                                <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                                <span><?=$model->discountDaysLeft?></span>
                                <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($model->discount_one_c): ?>
                    <div class="itemsList-item-sale">
                        <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$model->discount_one_c?>%</span> <?=Yii::t('web', 'скидка')?></div>
                    </div>
                <?php endif; ?>
                <?php if ($model->manufacturer->discount && $model->discount_one_c == ''): ?>
                    <div class="itemsList-item-sale">
                        <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$model->manufacturer->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                    </div>
                <?php endif; ?>
                <div class="itemsList-item__title"><a href="<?=Url::toProduct($model)?>"><?=$model->name?></a></div>
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
                                </span>

                    <a href="<?=Url::toProduct($model).'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($model->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
                </div>
                <?php if($attrs[$model->id]['attribute_id'] && $attrs[$model->id]['value_id']){?>
                    <div class="itemsList-item__attr" data-name="attrs[<?php echo $attrs[$model->id]['attribute_id'];?>]"  data-value="<?=$attrs[$model->id]['value_id']?>"></div>
                <?php } ?>
                <?php if($model->is_in_stock == 1): ?>
                    <div class="itemsList-item__status"><?=Yii::t('web', 'Есть в наличии')?></div>
                <?php elseif ($model->is_over == 1):?>
                    <div class="itemsList-item__status is-over" style="color: red"><?=Yii::t('web', 'Заканчиваеться')?></div>
                <?php elseif ($model->price_specify == 1):?>
                    <div class="itemsList-item__status"><?=Yii::t('web', 'Цену уточнять')?></div>
                <?php elseif ($model->is_suspended == 1):?>
                    <div class="itemsList-item__status is-suspended" style="color: red; padding:0 6px"><?=Yii::t('web', 'Приостановлена продажа')?></div>
                <?php elseif ($model->under_the_order == 1):?>
                    <div class="itemsList-item__status" style="color: red; padding:0 6px"><?=Yii::t('web', 'Под заказ')?></div>
                <?php else:?>
                    <div class="itemsList-item__status" style="color: black"><?=Yii::t('web', 'Нет в наличии')?></div>
                <?php endif;?>

                <div class="itemsList-item__price"><?=$model->currencyPriceForAttribute != 0 ? number_format($model->currencyPriceForAttribute,2) : number_format($model->currencyPrice, 2)?> грн <?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''): ?> / <?=$model->ykazatel;?><?php endif; ?></div>
                <div class="itemsList-item__more itemsList-item-btn"><a href="<?=Url::toProduct($model)?>"><?=Yii::t('web', 'Подробнее')?></a></div>
                <div class="itemsList-item__buy itemsList-item-btn" data-id="<?=$model->id?>"><?=Yii::t('web', 'Купить');?></div>
                <div class="itemsList-desc">
                    <div class="item-main-left-table">
                        <?php foreach ($model->fieldValues as $fieldValue): ?>
                            <div class="item-main-left-table__option"><?=$fieldValue->option->field->name?></div>
                            <div itemprop="brand"  class="item-main-left-table__value"><?=$fieldValue->option->name?></div>
                        <?php endforeach; ?>
                        <?php if ($model->manufacturer): ?>
                            <div class="item-main-left-table__option"><?=Yii::t('web','Производитель')?></div>
                            <span itemprop="brand" class="item-main-left-table__value"><?=$model->manufacturer->name?></span>
                            <?php if ($model->manufacturer->country_id>0) :?>
                                <div class="item-main-left-table__option"><?=Yii::t('web','Страна')?></div>
                                <?php $country = Country::find()->all();  ?>
                                <span class="item-main-left-table__value"><?php echo $country[$model->manufacturer->country_id-1]->name_uk; ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($model->dv): ?>
                            <div class="item-main-left-table__option" style="width: 56%;float: left;"><?=Yii::t('web','Действующее вещество')?></div>
                            <span class="item-main-left-table__value"><?=$model->dvvalue?></span>
                        <?php endif; ?>
                    </div>
                </div>
                </li><?php endforeach; ?>
            
        </ul>

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
</div>



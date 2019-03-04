<?php
$lang = Yii::$app->language;
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;

?>
<ul class="top-list">
    <?php foreach ($topProducts as $topProduct): ?>
        <?php $url = Url::toProduct($topProduct); ?>
        <li class="shares-list-item">
            <div class="shares-list-item__title"><a href="<?=$url?>"><?=$topProduct->name?></a></div>
            <a href="<?=$url?>" class="shares-list-item__img" style="background-image: url(<?=$topProduct->image?Helper::thumbnail($topProduct->image, 188, 188):'' ?>)">
                <?php if ($topProduct->topsale===1) : ?>
                    <div class="topsale<?=$lang?>"></div>
                <?php endif; ?>
            </a>
            <div class="shares-list-item__price"><?=number_format($topProduct->currencyPriceForAttribute, 2)?> грн <?php if (!$topProduct->ykazatel == '0' && !$topProduct->ykazatel == ''): ?> / <?=$topProduct->ykazatel;?><?php endif; ?></div>
            <?php if (1 - $topProduct->discountRate): ?>
                        <div class="itemsList-item-sale__wrapper">
                            <div class="itemsList-item-sale__old"><span><?=number_format($topProduct->oldCurrencyPriceForAttribute, 2)?></span> грн</div>
                            <div class="itemsList-item-sale__percent"><span>-<?=(int)$topProduct->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                            <div class="itemsList-item-sale__rest">
                                <?php if ($topProduct->discount_till): ?>
                                    <?=(($topProduct->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                                    <span><?=$topProduct->discountDaysLeft?></span>
                                    <?=(($topProduct->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
			 <?php if ($topProduct->discount_one_c && !(1 - $topProduct->discountRate)): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$topProduct->discount_one_c?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <?php if ($topProduct->manufacturer->discount && $topProduct->discount_one_c == '' && !(1 - $topProduct->discountRate)): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$topProduct->manufacturer->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <div class="shares-list-item__wrapper">
                <div class="shares-list-item__from"><?=Yii::t('web', 'Производитель')?>: <?=$topProduct->manufacturer?$topProduct->manufacturer->name:null?></div>
                <div class="shares-list-item__rating">
                    <?php $pRating = count($topProduct->reviews) ? round(array_sum(ArrayHelper::getColumn($topProduct->reviews, 'rating')) / count($topProduct->reviews)) : 0; ?>
                    <span class="rating-star item-list__rating">
                        <?php for($i = 1; $i <= $pRating; $i++): ?>
                            <span>★</span>
                        <?php endfor; ?>
                        <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                            <span>☆</span>
                        <?php endfor; ?>
                    </span>
                    <a href="<?=$url.'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($topProduct->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
                </div>
            </div>
            <div class="shares-list-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
        </li>
    <?php endforeach; ?>
</ul>

<?php
$lang = Yii::$app->language;
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;

?>

<ul class="best-list">
    <?php foreach ($bestPriceProducts as $bestPriceProduct): ?>
        <?php $url = Url::toProduct($bestPriceProduct); ?>
        <li class="shares-list-item">
            <div class="shares-list-item__title"><a href="<?=$url?>"><?=Yii::t('web', $bestPriceProduct->name);?></a></div>
            <a href="<?=$url?>" class="shares-list-item__img" style="background-image: url(<?=$bestPriceProduct->image?Helper::thumbnail($bestPriceProduct->image, 188, 188):'' ?>)">
                <?php if ($bestPriceProduct->super===1) : ?>
                    <div class="superprice<?=$lang?>"></div>
                <?php endif; ?>
            </a>
            <div class="shares-list-item__price"><?=number_format($bestPriceProduct->currencyPriceForAttribute, 2)?> грн <?php if (!$bestPriceProduct->ykazatel == '0' && !$bestPriceProduct->ykazatel == ''): ?> / <?=$bestPriceProduct->ykazatel;?><?php endif; ?></div>
            <?php if (1 - $bestPriceProduct->discountRate): ?>
                        <div class="itemsList-item-sale__wrapper">
                            <div class="itemsList-item-sale__old"><span><?=number_format($bestPriceProduct->oldCurrencyPriceForAttribute, 2)?></span> грн</div>
                            <div class="itemsList-item-sale__percent"><span>-<?=(int)$bestPriceProduct->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                            <div class="itemsList-item-sale__rest">
                                <?php if ($bestPriceProduct->discount_till): ?>
                                    <?=(($bestPriceProduct->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                                    <span><?=$bestPriceProduct->discountDaysLeft?></span>
                                    <?=(($bestPriceProduct->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
			 <?php if ($bestPriceProduct->discount_one_c && !(1 - $bestPriceProduct->discountRate)): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$bestPriceProduct->discount_one_c?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <?php if ($bestPriceProduct->manufacturer->discount && $bestPriceProduct->discount_one_c == '' && !(1 - $bestPriceProduct->discountRate)): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$bestPriceProduct->manufacturer->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <div class="shares-list-item__wrapper">
                <div class="shares-list-item__from"><?=Yii::t('web', 'Производитель')?>: <?=$bestPriceProduct->manufacturer?$bestPriceProduct->manufacturer->name:null?></div>
                <div class="shares-list-item__rating">
                    <?php $pRating = count($bestPriceProduct->reviews) ? round(array_sum(ArrayHelper::getColumn($bestPriceProduct->reviews, 'rating')) / count($bestPriceProduct->reviews)) : 0; ?>
                    <span class="rating-star item-list__rating">
                        <?php for($i = 1; $i <= $pRating; $i++): ?>
                            <span>★</span>
                        <?php endfor; ?>
                        <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                            <span>☆</span>
                        <?php endfor; ?>
                    </span>
                    <a href="<?=$url.'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($bestPriceProduct->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
                </div>
            </div>
            <div class="shares-list-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
        </li>
    <?php endforeach; ?>
</ul>

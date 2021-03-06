<?php
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;

?>
<ul class="only-list">
    <?php foreach ($saleProducts as $saleProduct): ?>
        <?php $url = Url::toProduct($saleProduct); ?>
        <li class="shares-list-item">
            <a href="<?=$url?>" class="shares-list-item__img" style="background-image: url(<?=$saleProduct->image?Helper::thumbnail($saleProduct->image, 188, 188):'' ?>)"></a>           
            <?php if (1 - $saleProduct->discountRate): ?>
                        <div class="itemsList-item-sale">
                            <div class="itemsList-item-sale__percent"><span>-<?=(int)$saleProduct->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                            <div class="itemsList-item-sale__old"><span><?=number_format($saleProduct->currencyOldPrice, 2)?></span> грн</div>
                            <div class="itemsList-item-sale__rest">
                                <?php if ($saleProduct->discount_till): ?>
                                    <?=(($saleProduct->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                                    <span><?=$saleProduct->discountDaysLeft?></span>
                                    <?=(($saleProduct->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
            <div class="shares-list-item__title"><a href="<?=$url?>"><?=$saleProduct->name?></a></div>
            <div class="shares-list-item__from"><?=$saleProduct->manufacturer?$saleProduct->manufacturer->name:null?></div>
            <div class="shares-list-item__rating">
                <?php $pRating = count($saleProduct->reviews) ? round(array_sum(ArrayHelper::getColumn($saleProduct->reviews, 'rating')) / count($saleProduct->reviews)) : 0; ?>
                <span class="rating-star item-list__rating">
                    <?php for($i = 1; $i <= $pRating; $i++): ?>
                        <span>★</span>
                    <?php endfor; ?>
                    <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                        <span>☆</span>
                    <?php endfor; ?>
                </span>
                <a href="<?=$url.'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($saleProduct->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
            </div>
            <div class="shares-list-item__price"><?=number_format($saleProduct->currencyPrice, 2)?> грн <?php if (!$saleProduct->ykazatel == '0' && !$saleProduct->ykazatel == ''): ?> / <?=$saleProduct->ykazatel;?><?php endif; ?></div>
            <div class="shares-list-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
        </li>
    <?php endforeach; ?>
</ul>

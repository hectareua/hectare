<?php
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;

?>
<ul class="shares-list">
    <?php foreach ($saleProducts as $saleProduct): ?>
        <?php $url = Url::toProduct($saleProduct); ?>
        <li class="shares-list-item">
            <div class="shares-list-item__title"><a href="<?=$url?>"><?=$saleProduct->name?></a></div>
            <a href="<?=$url?>" class="shares-list-item__img" style="background-image: url(<?=$saleProduct->image?Helper::thumbnail($saleProduct->image, 188, 188):'' ?>)"></a>
			<?php if ($saleProduct->stock_sum > 0): ?>
                <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center; color: green; margin-top: 5px;"><?=Yii::t('web', 'Остаток ')?><span><?=(int)$saleProduct->stock_sum?></span> <?=Yii::t('web', 'шт')?></div>
            <?php endif; ?>
            <?php if ($saleProduct->stock_sum == 0): ?>
                <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center; color: #ff0000; margin-top: 5px;font-weight: bold"><?=Yii::t('web', 'Распродано')?></div>
            <?php endif; ?>
            <div class="shares-list-item__price"><?=number_format($saleProduct->currencyPriceForAttribute, 2)?> грн <?php if (!$saleProduct->ykazatel == '0' && !$saleProduct->ykazatel == ''): ?> / <?=$saleProduct->ykazatel;?><?php endif; ?></div>
            <?php if (1 - $saleProduct->discountRate): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__old"><span><?=number_format($saleProduct->oldCurrencyPriceForAttribute, 2)?></span> грн</div>
                    <div class="itemsList-item-sale__percent" style="margin:0"><span>-<?=(int)$saleProduct->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                    <div class="itemsList-item-sale__rest">
                        <?php if ($saleProduct->discount_till): ?>
                            <?=(($saleProduct->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                            <span><?=$saleProduct->discountDaysLeft?></span>
                            <?=(($saleProduct->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($saleProduct->discount_one_c && !(1 - $saleProduct->discountRate)): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$saleProduct->discount_one_c?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <?php if ($saleProduct->manufacturer->discount && $saleProduct->discount_one_c == '' && !(1 - $saleProduct->discountRate)): ?>
                <div class="itemsList-item-sale__wrapper">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$saleProduct->manufacturer->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <div class="shares-list-item__wrapper">
                <div class="shares-list-item__from"><?=Yii::t('web', 'Производитель')?>: <?=$saleProduct->manufacturer?$saleProduct->manufacturer->name:null?></div>
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
            </div>
            <div class="shares-list-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
        </li>
    <?php endforeach; ?>
</ul>

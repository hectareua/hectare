<?php
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;

?>

<ul class="shares-list">
    <?php foreach ($blackFridayProducts as $blackFridayProduct): ?>
        <?php $url = Url::toProduct($blackFridayProduct); ?>
        <li class="shares-list-item">
            <a href="<?=$url?>" class="shares-list-item__img" style="background-image: url(<?=$blackFridayProduct->image?Helper::thumbnail($blackFridayProduct->image, 188, 188):'' ?>)">
                <?php if ($blackFridayProduct->b_friday===1) : ?>
                    <div class="black-fridayru"></div>
                <?php endif; ?>
            </a>
            <?php if (1 - $blackFridayProduct->discountRate): ?>
                <div class="itemsList-item-sale">
                    <div class="itemsList-item-sale__percent" style="margin: 0"><span>-<?=(int)$blackFridayProduct->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                    <div class="itemsList-item-sale__old"><span><?=number_format($blackFridayProduct->oldCurrencyPriceForAttribute, 2)?></span> грн</div>
                    <div class="itemsList-item-sale__rest">
                        <?php if ($blackFridayProduct->discount_till): ?>
                            <?=(($blackFridayProduct->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                            <span><?=$blackFridayProduct->discountDaysLeft?></span>
                            <?=(($blackFridayProduct->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($blackFridayProduct->discount_one_c): ?>
                <div class="itemsList-item-sale">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$blackFridayProduct->discount_one_c?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <?php if ($blackFridayProduct->manufacturer->discount && $blackFridayProduct->discount_one_c == ''): ?>
                <div class="itemsList-item-sale">
                    <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center;"><span>-<?=(int)$blackFridayProduct->manufacturer->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                </div>
            <?php endif; ?>
            <?php if ($blackFridayProduct->stock_sum > 0): ?>
                <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center; color: green; margin-top: 5px;"><?=Yii::t('web', 'Остаток ')?><span><?=(int)$blackFridayProduct->stock_sum?></span> <?=Yii::t('web', 'шт')?></div>
            <?php endif; ?>
            <?php if ($blackFridayProduct->stock_sum == 0): ?>
                <div class="itemsList-item-sale__percent" style="width: 100%; text-align: center; color: #ff0000; margin-top: 5px;font-weight: bold"><?=Yii::t('web', 'Продано')?></div>
            <?php endif; ?>
            <div class="shares-list-item__title"><a href="<?=$url?>"><?=$blackFridayProduct->name?></a></div>
            <div class="shares-list-item__from"><?=$blackFridayProduct->manufacturer?$blackFridayProduct->manufacturer->name:null?></div>
            <div class="shares-list-item__rating">
                <?php $pRating = count($blackFridayProduct->reviews) ? round(array_sum(ArrayHelper::getColumn($blackFridayProduct->reviews, 'rating')) / count($blackFridayProduct->reviews)) : 0; ?>
                <span class="rating-star item-list__rating">
                    <?php for($i = 1; $i <= $pRating; $i++): ?>
                        <span>★</span>
                    <?php endfor; ?>
                    <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                        <span>☆</span>
                    <?php endfor; ?>
                </span>
                <a href="<?=$url.'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($blackFridayProduct->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
            </div>
            <div class="shares-list-item__price"><?=number_format($blackFridayProduct->currencyPriceForAttribute, 2)?> грн <?php if (!$blackFridayProduct->ykazatel == '0' && !$blackFridayProduct->ykazatel == ''): ?> / <?=$blackFridayProduct->ykazatel;?><?php endif; ?></div>
            <div class="shares-list-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
        </li>
    <?php endforeach; ?>
</ul>

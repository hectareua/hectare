<?php
use app\components\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\captcha\Captcha;
$this->title = $model->seoTitle?$model->seoTitle:$model->name . Yii::t('web',' за ') . number_format($model->currencyPrice, 2) . Yii::t('web',' грн. купить в Николаеве, Киеве, Одессе, Украине | Гектар'); 
$this->registerMetaTag(['name' => 'description', 'content' => $model->seoDescription?$model->seoDescription:$model->name  . Yii::t('web','. ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ Звоните (067) 559-84-93')], 'description');
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seoKeywords], 'keywords');

?>
<div class="questionModalContainer modalContainer itemModal">
    <div class="modalLayout"></div>
    <div class="modal">
        <?php $form = ActiveForm::begin(); ?>
            <div class="modal__title"><?=Yii::t('web', 'Вопрос по товару')?></div>
            <div class="modal__close"></div>
            <?=$form->field($question, 'name')->label(false)->error(false)->input('text', ['class' => 'modal__input', 'placeholder' => Yii::t('web', 'Имя').'*', 'required' => ''])?>
            <?=$form->field($question, 'email')->label(false)->error(false)->input('email', ['class' => 'modal__input', 'placeholder' => Yii::t('web', 'Email').'*', 'required' => ''])?>
            <?=$form->field($question, 'phone')->label(false)->error(false)->input('tel', ['class' => 'modal__input', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
            <?=$form->field($question, 'text')->label(false)->error(false)->textArea(['class' => 'modal__textarea', 'placeholder' => Yii::t('web', 'Вопрос по товару').'*', 'required' => ''])?>
            <div id="recaptcha2"></div>
            <input type="submit" class="modal__submit">
        <?php ActiveForm::end(); ?>
    </div>
    <!-- <div class="modalSuccess">
        <div class="modalSuccess__message">Спасибо за Ваше сообщение!
            Мы свяжемся с Вами как можно быстрее.</div>
    </div> -->
</div>
<div  itemscope itemtype="http://schema.org/Product" class="items">
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
             itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>

            <?php foreach ($parents as $parent): ?>
                <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a  itemprop="item"  href="<?=Url::toCategory($parent)?>"> <span itemprop="name"><?=$parent->name?></span> » </a> <meta itemprop="position" content="3" /></li>
             <?php endforeach; ?>


        </ol>
        <div class="itemsSidebar">
            <?= $this->render('/partial/_categories', compact('categories')) ?>

        </div>
        <div class="item">
        <div class="item-image-and-sale" style="text-align: center;
      display: inline-block;
      vertical-align: top;
      position: relative;
      margin: 0 2%;
      width: 32%;">
            <img class="item__image" itemprop="image" src="<?=$model->image->url?>" title="<?= $model->name ?>" alt="<?= $model->name ?>">
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
        </div>           
            <div class="item-main">
                <h1 itemprop="name" class="item-main__title"><?=$this->params['seoH1'] ?: ($model->seoHeader? $model->seoHeader : $model->category->name . ' | '. $model->name) ?></h1>
                <div class="item-main__id"><?=Yii::t('web','Арт.')?> <?=$model->id?></div>
                <!-- <div class="item-main-visibility">
                    <div class="item-main-visibility__see"><img src="http://hectare.prodevs.com.ua/img/visibility.png" alt=""></div>
                    <div class="item-main-visibility__text">228</div>
                </div> -->
                <form action="<?=Url::to(['cart/add', 'product_id' => $model->id])?>" method="POST">
                    <div class="item-main-left">
                        <div class="item-main-left-table">
                            <?php foreach ($model->fieldValues as $fieldValue): ?>
                                <div class="item-main-left-table__option"><?=$fieldValue->option->field->name?></div>
                                <div itemprop="brand"  class="item-main-left-table__value"><?=$fieldValue->option->name?></div>
                            <?php endforeach; ?>
                            <?php if ($model->manufacturer): ?>
                                <div class="item-main-left-table__option"><?=Yii::t('web','Производитель')?></div>
                                <span itemprop="brand" class="item-main-left-table__value"><?=$model->manufacturer->name?></span>
                            <?php endif; ?>
                            <?php if ($model->dv): ?>
                                <div class="item-main-left-table__option" style="width: 56%;float: left;"><?=Yii::t('web','Действующее вещество')?></div>
                                <span itemprop="dv" style="width: 42%;" class="item-main-left-table__value"><?=$model->dvvalue?></span>
                            <?php endif; ?>
                        </div>

                        <div class="item-main-left-additional">
                            <?php if ($model->attributeValues): ?>
                                <?php
                                    $attributes = [];
                                    $attributesValues = [];
                                    foreach ($model->attributeValues as $attributeValue)
                                    {
                                        $attributes[$attributeValue->option->attr->id] = $attributeValue->option->attr;
                                        $attributesValues[$attributeValue->option->attr->id][] = $attributeValue;
                                    }
                                ?>
                                <?php foreach ($attributesValues as $attributeId=>$attributeOptions): ?>
                                    <div class="item-main-left-additional__option"><?=$attributes[$attributeId]->name?></div>
                                    <select class="item-main-left-additional__select product_attribute_select" name="attrs[<?=$attributeId?>]">
                                        <?php foreach ($attributeOptions as $attributeValue): ?>
                                            <option value="<?=$attributeValue->id?>" data-price="<?=$attributeValue->currencyPrice?>"><?=$attributeValue->option->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endforeach; ?>
                                <?php $this->registerJs("
                                    $(document).ready(function(){
                                        $('.product_attribute_select').change(function(){
                                            $('.price_placeholder').text($(this).find(':checked').data('price'));
                                        });
                                    });
                                "); ?>
                            <?php endif; ?>
                            <div class="item-main-left-additional__option"><?=Yii::t('web','Количество')?></div>
                            <input type="text" class="item-main-left-additional__input" value="1" name="amount">

                        </div>

                    </div>
                    <div class="item-main-right">
                        <?php if (1 - $model->discountRate): ?>
                            <div class="item-main-right__oldPrice"><?=Yii::t('web','Старая цена')?> <span><?=number_format($model->currencyOldPrice, 2)?> грн</span></div>
                            <div class="item-main-right__rest"> <span><?=$model->discountDaysLeft?></span> <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?> <?=Yii::t('web','до завершения акции')?></div>
                        <?php endif; ?>
                        <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="UAH" />
                            <span class="item-main-right__price">
                                <span itemprop="price" class="price_placeholder"><?=number_format($model->currencyPrice, 2, '.', '')?></span>

                                <br>грн<?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''): ?><span > / <?=$model->ykazatel;?></span><?php endif; ?>
                            </span>
                         
                            <?php if ($model->is_in_stock): ?>
                                <div itemprop="availability" class="item-main-right__availability"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Есть в наличии')?></div>
                            <?php else: ?>
                                <div class="item-main-right__nonAvailability"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Нет в наличии')?></div>
                            <?php endif; ?>
                        </span>

                        <div class="item-main-right__optCost">
                               <?php if (!$model->opt == ''): ?><p style="margin-top: 14px;color:#898989;    font-family: 'OpenSans Regular', sans-serif;"><?=number_format($model->optCurrencyPrice, 2, '.', '')?> грн.<?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''){ ?>/<?=$model->ykazatel;?><?php } ?> <?=Yii::t('web','при заказе от')?> <?=$model->opt;?> <?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''){ ?><?=$model->ykazatel;?><?php } ?></p><?php endif; ?>

                               
                        <?php if (!$model->opt1 == ''): ?><p style="margin-top: 14px;color:#898989;    font-family: 'OpenSans Regular', sans-serif;"><?=number_format($model->optCurrencyPrice1, 2, '.', '')?> грн.<?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''){ ?>/<?=$model->ykazatel;?><?php } ?> <?=Yii::t('web','при заказе от')?> <?=$model->opt1;?> <?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''){ ?><?=$model->ykazatel;?><?php } ?></p><?php endif; ?></div> 
                        <button class="item-main-right__submit"><?=Yii::t('web','Купить')?></button>
                        <a href="#" class="item-main-right__ask questionButton"><?=Yii::t('web','Задать вопрос по товару')?></a>

                        <?php $this->registerJs("
                            $('.questionButton').on('click', function(e) {
                                e.preventDefault();
                                $('.questionModalContainer').css('display','flex');
                            });
                        ");?>
                    </div>
                </form>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'item-main-form']]); ?>
                    <div class="item-main-form__title"><?=Yii::t('web','Узнать партнерские цены')?></div>
                    <?=Html::activeInput('text', $enquiry, 'name', ['class' => 'item-main-form__input item-main-form__input-margin', 'placeholder' => Yii::t('web','Имя').'*', 'required' => ''])
                    ?><?=Html::activeInput('email', $enquiry, 'email', ['class' => 'item-main-form__input item-main-form__input-margin', 'placeholder' => Yii::t('web','E-mail')])
                    ?><?=Html::activeInput('tel', $enquiry, 'phone', ['class' => 'item-main-form__input', 'placeholder' => Yii::t('web','Телефон').'*', 'required' => ''])?>
                    <div id="recaptcha3"></div>
                    <input type="submit" class="item-main-form__submit" value="<?=Yii::t('web', 'Отправить')?>">
                <?php ActiveForm::end(); ?>
            </div>
            <div class="tabs">
                <ul class="tabs-control">
                    <li class="tabs-control__item active"><h2><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Описание')?></a> </h2></li>
                    <li class="tabs-control__item"><h2><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Похожие товары')?></a></h2> </li>
                    <li class="tabs-control__item"><h2><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Отзывы')?></a></h2>
                    <!-- ЗДЕСЬ ВЫВОДИТЬ СЧЕТЧИК ОТЗЫВОВ / КОЛЯ
                        <p class="tabs-control__item_number">(+1)</p>
                    -->
                    </li>
                </ul>
                <ul class="tabs-list">
                    <li  itemprop="description" class="tabs-list__item active"><?=$model->description?></li>
                    <li class="tabs-list__item">
                        <ul class="simularList">
                            <?php foreach ($model->suggestedProducts as $suggestedProduct): ?>
                                <?php $url = Url::toProduct($suggestedProduct); ?>
                                <li class="simularList-item">
                                    <a href="<?=$url?>" class="simularList-item__img" style="background-image:url('<?=$suggestedProduct->image->url?>')"></a>
                                    <div class="simularList-item__title"><a href="<?=$url?>"><?=$suggestedProduct->name?></a></div>
                                    <div class="simularList-item__from"><?=$suggestedProduct->manufacturer?$suggestedProduct->manufacturer->name:null?></div>
                                    <div class="simularList-item__price"><?=number_format($suggestedProduct->currencyPrice, 2)?> грн</div>
                                    <div class="simularList-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="tabs-list__item">
                        <ul class="reviews-list">
                            <?php foreach ($reviews as $i=>$_review): ?>
                                <li  itemprop="review" itemscope itemtype="http://schema.org/Review"  class="reviews-list-item">
                                <div class="reviews-list-item-header">
                                    <span class="reviews-list-item-header__id">#<?=$i+1?></span>
                                    <meta content="<?=$model->name?>" itemprop="name">
                                    <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                                       <span class="reviews-list-item-header__from" itemprop="name"><?=$_review->name?></span>
                                    </span>
                                    <div class="reviews-list-item-header__date"><?=$_review->posted_at?></div>
                                    </div>
                                    <meta itemprop="datePublished" content="<?=$_review->posted_at?>">
                                    <div itemprop="reviewBody" class="reviews-list-item__content">
                                    <?=$_review->text?>
                                    </div>
                                    <!-- <div class="reviews-list-item__rate">+1</div> -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="message">
                            <?php $form = ActiveForm::begin() ?>
                                <div class="message__title"><?=Yii::t('web', 'Оставить отзыв')?></div>
                                <?=$form->field($review, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
                                <?=$form->field($review, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>
                                <?=$form->field($review, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
                                <div id="recaptcha4"></div>
                                <input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
                            <?php ActiveForm::end() ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="shares">
            <div class="wrapper">
                <?php if ($lastViewedProducts): ?>
                    <div class="shares__title"><?=Yii::t('web', 'Ранее вы смотрели')?></div>
                    <ul class="shares-list">
                        <?php foreach ($lastViewedProducts as $lastViewedProduct): ?>
                            <li class="shares-list-item">
                                <div class="shares-list-item__img" style="background-image:url('<?=$lastViewedProduct->image->url?>')"></div>
                                <div class="shares-list-item__title"><a href="<?=Url::toProduct($lastViewedProduct)?>"><?=$lastViewedProduct->name?></a></div>
                                <div class="shares-list-item__from"><?=$lastViewedProduct->manufacturer?$lastViewedProduct->manufacturer->name:null?></div>
                                <?php/*<div class="shares-list-item__rating">
                                    <?php $pRating = $model->rating; ?>
                                    <span class="rating-star">
                                        <?php for($i = 1; $i <= $pRating; $i++): ?>
                                            <span>★</span>
                                        <?php endfor; ?>
                                        <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                                            <span>☆</span>
                                        <?php endfor; ?>
                                    </span>
                                </div>*/ ?>
                                <div class="shares-list-item__price"><?=number_format($lastViewedProduct->currencyPrice, 2)?> грн</div>
                                <div class="shares-list-item__more"><a href="<?=Url::toProduct($lastViewedProduct)?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>
<div class="space"></div>


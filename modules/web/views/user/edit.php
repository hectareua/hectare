<?php
use app\components\Url;
use yii\widgets\ActiveForm;
$this->title = Yii::t('web', 'Личный кабинет');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>
<div class="cabinet" ng-app ng-init="delivery_differs = '<?=(int)$model->delivery_differs?>'" ng-cloak>
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Личный кабинет')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
        <div class="cabinet__title"><?=Yii::t('web', 'Изменить данные')?></div>
        <div class="cabinet-change">
                <?php $form = ActiveForm::begin() ?>
                <div class="orderForm-sidebar__error">
                    <?php if ($errors = $model->getErrors()): ?>
                        <?php foreach ($errors as $error): ?>
                            <?=$error[0]?><br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($errors = $user->getErrors()): ?>
                        <?php foreach ($errors as $error): ?>
                            <?=$error[0]?><br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?=$form->field($model, 'billing_first_name')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Имя').'*', 'required'=>''])?>
                <?=$form->field($model, 'billing_last_name')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Фамилия').'*', 'required'=>''])?>
                <?=$form->field($model, 'billing_middle_name')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Отчество').'*', 'required'=>''])?>
                <?=$form->field($user, 'email')->label(false)->error(false)->input('email', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Email').'*', 'required'=>''])?>
                <?=$form->field($model, 'billing_address')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Улица/Номер дома')])?>
                <?=$form->field($model, 'billing_postcode')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Почтовый индекс')])?>
                <?=$form->field($model, 'billing_city')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Город').'*', 'required'=>''])?>
                <?=$form->field($model, 'billing_region')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Область').'*', 'required'=>''])?>
                <?=$form->field($model, 'billing_country_id')->label(false)->error(false)->dropDownList($model->countries, ['prompt' => Yii::t('web', 'Страна'), 'class' => 'cabinet-change__select']);?>
                <?= $form->field($model, 'billing_phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('tel', ['class' => 'cabinet-change__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required'=>'']) ?>
                <div class="cabinet-change-block">
                    <div>Адресс доставки другой?</div>
                    <input type="radio" id="change_no" name="Client[delivery_differs]" ng-model="delivery_differs" value="0"><label for="change_no">Нет</label>
                    <input type="radio" id="change_yes" name="Client[delivery_differs]" ng-model="delivery_differs" value="1"><label for="change_yes">Да</label>
                </div>

                <div ng-if="delivery_differs == 1">
                    <?=$form->field($model, 'delivery_first_name')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Имя').'*', 'required'=>''])?>
                    <?=$form->field($model, 'delivery_last_name')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Фамилия').'*', 'required'=>''])?>
                    <?=$form->field($model, 'delivery_middle_name')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Отчество').'*', 'required'=>''])?>
                    <?=$form->field($model, 'delivery_address')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Улица/Номер дома')])?>
                    <?=$form->field($model, 'delivery_postcode')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Почтовый индекс')])?>
                    <?=$form->field($model, 'delivery_city')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Город').'*', 'required'=>''])?>
                    <?=$form->field($model, 'delivery_region')->label(false)->error(false)->input('text', ['class' => 'cabinet-change__input', 'placeholder' => Yii::t('web', 'Область').'*', 'required'=>''])?>
                    <?=$form->field($model, 'delivery_country_id')->label(false)->error(false)->dropDownList($model->countries, ['prompt' => Yii::t('web', 'Страна'), 'class' => 'cabinet-change__select']);?>
                    <?= $form->field($model, 'delivery_phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('tel', ['class' => 'cabinet-change__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required'=>'']) ?>
                </div>

                <button class="cabinet-change__submit"><?=Yii::t('web', 'Сохранить')?></button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="space"></div>

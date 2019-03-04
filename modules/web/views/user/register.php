<?php
use app\components\Url;
use yii\widgets\ActiveForm;
$this->title = Yii::t('web', 'Регистрация');
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Регистрация')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
    <div class="registration">
        <?php $form = ActiveForm::begin() ?>
            <div class="registration__title"><?=Yii::t('web', 'Регистрация')?></div>
            <?=$form->field($client, 'billing_first_name')->label(false)->error(false)->input('text', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Имя')])?>
            <?=$form->field($client, 'billing_last_name')->label(false)->error(false)->input('text', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Фамилия')])?>
            <?=$form->field($client, 'billing_middle_name')->label(false)->error(false)->input('text', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Отчество')])?>
            <?=$form->field($user, 'email')->label(false)->error(false)->input('email', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Email').'*', 'required' => ''])?>
            <?=$form->field($client, 'billing_city')->label(false)->error(false)->input('text', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Город')])?>
            <?=$form->field($client, 'billing_phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
            <!-- //$form->field($user, 'login')->label(false)->error(false)->input('text', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Логин').'*', 'required' => '']) -->
            <?=$form->field($user, 'passwordValue')->label(false)->error(false)->input('password', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Пароль').'*', 'required' => ''])?>
            <?=$form->field($user, 'passwordConfirmation')->label(false)->error(false)->input('password', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Подтвердить пароль').'*', 'required' => ''])?>
            <input type="submit" class="registration__submit" value="Регистрация">


        <?php ActiveForm::end() ?>

    </div>
    <div class="space"></div>
    <div class="space"></div>
    <div class="space"></div>
    <div class="space"></div>




</div>

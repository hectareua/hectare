<?php
use app\components\Url;
use yii\widgets\ActiveForm;
$this->title = Yii::t('web', 'Личный кабинет');

?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Личный кабинет')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
       <div class="authorisation">
            <?php $form = ActiveForm::begin() ?>
                <div class="authorisation__title"><?=Yii::t('web', 'Вход в личный кабинет')?></div>

                <?=$form->field($model, 'username')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>

                <?=$form->field($model, 'password')->label(false)->error(false)->input('password', ['class' => 'authorisation__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Пароль')])?>

                <div class="authorisation-block">
                    <input name="LoginForm[rememberMe]" type="hidden" value="0">
                    <input name="LoginForm[rememberMe]" <?=($model->rememberMe?'checked':'')?> type="checkbox" class="authorisation__checkbox" id="authorisation__checkbox" value="1">
                    <label for="authorisation__checkbox" class="authorisation__label"><?=Yii::t('web', 'Запомнить меня')?></label>
                </div>
                <div class="authorisation-block">
                    <a href="<?=Url::to(['user/recovery'])?>"><?=Yii::t('web', 'Забыли пароль?')?></a>
                </div>

                <a href="<?=Url::to(['user/register'])?>" class="authorisation__submit authorisation__register"><?=Yii::t('web', 'Регистрация')?></a>
                <input type="submit" class="authorisation__submit authorisation__login" value="<?=Yii::t('web', 'Логин')?>">
            <?php ActiveForm::end() ?>
        </div>
      <div class="space"></div>
    <div class="space"></div>
</div>

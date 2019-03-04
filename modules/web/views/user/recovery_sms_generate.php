<?php
use app\components\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$this->title = Yii::t('web', 'Восстановление доступа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Восстановление доступа')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
    <div class="password-recovery" style="width:auto; height:auto;">
        <?php $form = ActiveForm::begin() ?>
        <div class="password-recovery__title"><?=Yii::t('web', 'Восстановление доступа')?></div>
        <p><?=Yii::t('web', 'Пожалуйста, нажмите "Сгенерировать" для отправки sms с кодом.')?></p>

        <?=$form->field($model, 'billing_phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->input('text', ['class' => 'registration__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*'])?>

        <input type="submit" class="password-recovery__submit" value="<?=Yii::t('web', 'Сгенерировать')?>">
        <?php ActiveForm::end() ?>
    </div>
    <div class="space"></div>
</div>

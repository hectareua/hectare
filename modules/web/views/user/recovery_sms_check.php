<?php
use app\components\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$this->title = Yii::t('web', 'Восстановление доступа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);

$this->registerCss("

.pincode-input-text {
   /* width: 40px !important;*/
}

");

?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Восстановление доступа')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
    <div class="password-recovery">
            <?php $form = ActiveForm::begin() ?>
                <div class="password-recovery__title"><?=Yii::t('web', 'Восстановление доступа')?></div>
                <p><?=Yii::t('web', 'Пожалуйста, введите sms код.')?></p>
                <?=$form->field($model, 'validation_code',['options' => ['style' => 'margin: 0 auto; text-align: center;']])->label(false)->error(false)->input('text', ['class' => 'password-recovery__input', 'style' => '/*margin: 0 auto; width: 50%;text-align: center;*/', 'id' => 'pincode-input', 'required'=>'']) ?>
                <input type="submit" class="password-recovery__submit" style="margin-top:10px;" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end() ?>
        </div>
    <div class="space"></div>
</div>

<?php
$this->registerJs("$(document).ready(function(){ $('#pincode-input').pincodeInput({inputs:4,hidedigits:false});});");
?>

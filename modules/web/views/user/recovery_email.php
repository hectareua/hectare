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
    <div class="password-recovery">
            <?php $form = ActiveForm::begin() ?>
                <div class="password-recovery__title"><?=Yii::t('web', 'Восстановление доступа')?></div>
                <p><?=Yii::t('web', 'Пожалуйста, введите адрес электронной почты, указанный в параметрах вашей учётной записи. На него
                    будет отправлен специальный проверочный код. После его получения вы сможете ввести новый пароль для
                    вашей учётной записи.')?></p>
                <?=$form->field($model, 'email')->label(false)->error(false)->input('email', ['class' => 'password-recovery__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Email')]) ?>
                <input type="submit" class="password-recovery__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end() ?>
        </div>
    <div class="space"></div>
</div>

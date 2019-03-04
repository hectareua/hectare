<?php
use app\components\Url;
use yii\widgets\ActiveForm;
$this->title = Yii::t('web', 'Восстановление доступа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>

<?php $this->registerCss("
    @media screen and (max-width:640px){
        .password-recovery .password-recovery__input{
            width: 300px;
        }
        .password-recovery{
            height: 32rem !important;
        }
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
    <div class="password-recovery container">
            <?php $form = ActiveForm::begin() ?>
                <div class="password-recovery__title"><?=Yii::t('web', 'Восстановление доступа')?></div>
                <p><?=Yii::t('web', 'Для завершения процесса смены пароля, пожалуйста, введите новый пароль.')?></p>
                <?=$form->field($model, 'password')->label(false)->error(false)->input('password', ['class' => 'password-recovery__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Пароль')]) ?>
                <?=$form->field($model, 'passwordConfirmation')->label(false)->error(false)->input('password', ['class' => 'password-recovery__input', 'placeholder' => Yii::t('web', 'Подтвердить пароль').'*', 'required' => ''])?>

                <input type="submit" class="password-recovery__submit" value="<?=Yii::t('web', 'Подтвердить')?>">
            <?php ActiveForm::end() ?>
        </div>
    <div class="space"></div>
    <div class="space"></div>
</div>

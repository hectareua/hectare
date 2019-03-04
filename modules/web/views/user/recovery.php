<?php
use app\components\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$this->title = Yii::t('web', 'Восстановление доступа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumbs__item" >
                <a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a><meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumbs__item">
                <span itemprop="name"><?=Yii::t('web', 'Восстановление доступа')?></span><meta itemprop="position" content="2" />
            </li>
    </ol>

    <div class="authorisation">
        <div class="password-recovery__title"><?=Yii::t('web', 'Восстановление доступа')?></br><?=Yii::t('web', 'Используя:')?></div>
        <div style="display: inline-block; width: 200px; vertical-align: top;"">
        <a href="<?=Url::to(['user/recovery-sms'])?>" class="password-recovery__submit  password-recovery__sms"><?=Yii::t('web', 'Мобильный')?></a>
        <a href="<?=Url::to(['user/recovery-email'])?>" class="password-recovery__submit ">Email</a>
    </div>
</div>

<div class="space"></div>
</div>

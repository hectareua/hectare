<?php
use app\components\Url;
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
        <div class="password-recovery__title"><?=Yii::t('web', 'Восстановление доступа')?></div>
        <h2><?=Yii::t('web', 'Письмо отправлено на Ваш адрес электронной почты. Для смены пароля - перейдите по ссылке в письме')?></h2>
    </div>
    <div class="space"></div>
</div>

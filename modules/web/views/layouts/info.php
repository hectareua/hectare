<?php

use yii\helpers\Html;
use app\components\Url;
use yii\widgets\ActiveForm;
//use yii\captcha\Captcha;


$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
\app\assets\InfoAsset::register($this);


if ($this->params['seoTitle']) {
    $this->title = $this->params['seoTitle'];
}
if ($this->params['seoKeywords']) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['seoKeywords']], 'keywords');
}
if ($this->params['seoDescription']) {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->params['seoDescription']], 'description');
}
$lang = '';
if (Yii::$app->language == 'ru') {
    $lang = 'ru/';
};
$request = Yii::$app->request;
if ($request->get('utm_medium') || $request->get('utm_source') || $request->get('gclid') || $request->get('utm_campaign') || $request->get('utm_content') || $request->get('utm_term') || $request->get('_openstat')) {
    // print_r(Url::home(true).$request->pathInfo) ;
    $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::home(true) . $lang . $request->pathInfo]);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MTWJSTZ');</script>
    <!-- End Google Tag Manager -->
    <script charset="UTF-8"
            src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/b1ef9448d52b766f6b6b3c5ee29677e1_0.js"
            async></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- <link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon" />-->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="/favicons/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicons/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <?= Html::csrfMetaTags() ?>
    <link rel="alternate" hreflang="ru"
          href="<?= "https://$_SERVER[HTTP_HOST]" . Url::current(['language' => 'ru']) ?>"/>
    <link rel="alternate" hreflang="uk"
          href="<?= "https://$_SERVER[HTTP_HOST]" . substr(Url::current(['language' => '']), 1) ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>
<body class="<?php echo (trim($_SERVER['REQUEST_URI']) == '/ru' || trim($_SERVER['REQUEST_URI']) == '/') ? 'home' : 'page'; ?> <?php echo (strpos($_SERVER['REQUEST_URI'], '/product/') !== false) ? 'productpage' : ''; ?> <?php echo (strpos($_SERVER['REQUEST_URI'], '/bonus') !== false) ? 'bonuspage' : ''; ?>">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3MS3F"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<?php $this->beginBody() ?>
<!--<div class="hectare-info">-->
<!--    <div class="hectare-info-header">-->
<!--        <a href="/" class="main-page">-->
<!--            <span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span> --><? //=Yii::t('web','На главную')?>
<!--        </a>-->
<!--        <select class="header-top-languagePicker language_picker">-->
<!--            <option value="ru" --><? //= Yii::$app->language == 'ru' ? 'selected' : '' ?><!-- data-href="-->
<? //= Url::current(['language' => 'ru']) ?><!--">Рус</option>-->
<!--            <option value="uk" --><? //= Yii::$app->language == 'uk' ? 'selected' : '' ?><!-- data-href="-->
<? //= Url::current(['language' => 'uk']) ?><!--">Укр</option>-->
<!--        </select>-->

<div class="outer-wrap">
    <div class="inner-wrap">
        <nav class="mobile_nav">
            <div class="btnClose"></div>
            <div class="mobile_nav_inner" style="overflow: hidden; padding: 0px; width: 180px;">


                <div class="jspContainer" style="width: 180px; height: 640px;">
                    <div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 180px;">
                        <ul class="menu nopadding">
                            <li id="menu-item-11" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-11">
                                <a href="/" alt="На головну">На головну</a>
                            </li>
                            <?php foreach ($this->params['tabs'] as $tab):?>
                            <li id="menu-item-11" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-11">
                                <a href="<?=Url::toInfo($tab)?>"><?=$tab->name_uk?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <hr>
                        <!--<ul class="menu nopadding">
                            <li>
                                <a href="#">Блог</a>
                            </li>
                            <li>
                                <a href="#">Про нас</a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </nav>
        <header>
            <div class="fixedTopPanel">
                <div class="container">
                    <div class="row">
                        <div class="col-12 menu-center">
                            <div class="f_left">
                                <div class="hide_show_menu">
                                    <div class="hide_show_menu_icon"></div>
                                </div>
                                <div class="logo">
                                    <a href="/info" class="main_logo"></a>
                                </div>
                            </div>
                            <div class="f_right">

                                <ul class="list soc_list">
                                    <?php if ($this->context->siteInfo->fb_link): ?>
                                        <li class="facebook">
                                            <a href="<?=$this->context->siteInfo->fb_link?>" target="_blank"></a>
                                        </li>
                                    <?php endif;?>
                                    <?php if ($this->context->siteInfo->gp_link): ?>
                                        <li class="google">
                                            <a href="<?=$this->context->siteInfo->gp_link?>" target="_blank"></a>
                                        </li>
                                    <?php endif;?>
                                    <?php if ($this->context->siteInfo->vk_link): ?>
                                        <li class="instagram">
                                            <a href="<?= $this->context->siteInfo->vk_link ?>" target="_blank"></a>
                                        </li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="mainNav">
                                <nav class="category main-menu">
                                    <ul class="list main-menu-list">
                                        <!--<li class="b_search search_icon"></li>-->
                                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-11">
                                            <a href="/" alt="На головну" title="На головну"><i class="fa fa-home" style="font-size: 20px;" aria-hidden="true"></i></a>
                                        </li>
                                        <?php foreach ($this->params['tabs'] as $tab):?>
                                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-11">
                                            <a href="<?=Url::toInfo($tab)?>"><?=$tab->name_uk?></a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </header>
        <?= $content; ?>
        <!--<footer class="footer">-->
        <!--    <div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Copyright © -->
        <? //= date('Y') ?><!-- -->
        <? //= Yii::t('web', '«Гектар» является зарегистрированной торговой маркой. Все права защищены.') ?><!--</div>-->
        <!--</footer>-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="footer-logo" href="/info">
                            <img src="/img/logo-info.png" alt="logo">
                        </a>
                        <ul class="list soc_list">
                            <?php if ($this->context->siteInfo->fb_link): ?>
                                <li class="facebook">
                                    <a href="<?=$this->context->siteInfo->fb_link?>" target="_blank"></a>
                                </li>
                            <?php endif;?>
                            <?php if ($this->context->siteInfo->yt_link): ?>
                                <li class="youtube">
                                    <a href="<?=$this->context->siteInfo->yt_link?>" target="_blank"></a>
                                </li>
                            <?php endif;?>
                            <?php if ($this->context->siteInfo->gp_link): ?>
                                <li class="google">
                                    <a href="<?=$this->context->siteInfo->gp_link?>" target="_blank"></a>
                                </li>
                            <?php endif;?>
                            <?php if ($this->context->siteInfo->vk_link): ?>
                            <li class="instagram">
                                <a href="<?=$this->context->siteInfo->vk_link?>" target="_blank"></a>
                            </li>
                            <?php endif;?>
                        </ul>
						<div class="info-data">
							<p class="info-data-text">marketing@hectare.com.ua<br/>0676546645</p>
						</div>
                    </div>
                    <div class="col-12">
                        <div class="footer-desc-wrap">
                            <div class="footer-desc">
                                <?= Yii::t('web', '«Гектар» являється зареєстрованою торговою маркою. Всі права захищено.') ?>
                            </div>
                            <ul class="list footer_nav">
                                <li>
                                    <a href="/info/issue">Випуски</a>
                                </li>
                                <li>
                                    <a href="/info/article">Статті</a>
                                </li>
                                <li>
                                    <a href="/info/special-project">Спецпроекти</a>
                                </li>
                                <li>
									<a href="/info/about">Життя компанії</a>
                                </li>
                                <li>
                                    <a href="/info/issue">Випуски</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="mobileMenu-bg"></div>
    </div>
</div>
<?php



?>
<?php $this->endBody() ?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>-->

</body>
</html>
<?php $this->endPage() ?>


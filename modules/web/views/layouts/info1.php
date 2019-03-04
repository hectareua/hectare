<?php

use yii\helpers\Html;
use app\components\Url;
use yii\widgets\ActiveForm;
//use yii\captcha\Captcha;
use app\assets\WebAsset;

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
WebAsset::register($this);

$cssFiles = [
    '/css/bootstrap.min.css',
];

if ($this->params['seoTitle']) {
    $this->title = $this->params['seoTitle'];
}
if ($this->params['seoKeywords']) {
    $this->registerMetaTag(['name' => 'keywords',  'content' => $this->params['seoKeywords']], 'keywords');
}
if ($this->params['seoDescription']) {
    $this->registerMetaTag(['name' => 'description',  'content' => $this->params['seoDescription']], 'description');
}
$lang='';
if(Yii::$app->language == 'ru'){
    $lang = 'ru/';
};
$request = Yii::$app->request;
if($request->get('utm_medium') || $request->get('utm_source') || $request->get('gclid') || $request->get('utm_campaign') || $request->get('utm_content') || $request->get('utm_term') || $request->get('_openstat')){
    // print_r(Url::home(true).$request->pathInfo) ;
    $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::home(true).$lang.$request->pathInfo]);
}
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start':
                        new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-MTWJSTZ');</script>
        <!-- End Google Tag Manager -->
        <script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/b1ef9448d52b766f6b6b3c5ee29677e1_0.js" async></script>
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
        <link rel="alternate" hreflang="ru" href="<?= "https://$_SERVER[HTTP_HOST]" . Url::current(['language' => 'ru']) ?>" />
        <link rel="alternate" hreflang="uk" href="<?= "https://$_SERVER[HTTP_HOST]" . substr(Url::current(['language' => '']), 1) ?>" />
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head(); ?>
    </head>
<body class="<?php echo (trim($_SERVER['REQUEST_URI']) == '/ru' || trim($_SERVER['REQUEST_URI']) == '/') ? 'home' : 'page'; ?> <?php echo (strpos($_SERVER['REQUEST_URI'], '/product/') !== false) ? 'productpage' : ''; ?> <?php echo (strpos($_SERVER['REQUEST_URI'], '/bonus') !== false) ? 'bonuspage' : ''; ?>" >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3MS3F"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php $this->beginBody() ?>
<div class="hectare-info">
    <div class="hectare-info-header">
        <a href="/" class="main-page">
            <span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span> <?=Yii::t('web','На главную')?>
        </a>
        <select class="header-top-languagePicker language_picker">
            <option value="ru" <?= Yii::$app->language == 'ru' ? 'selected' : '' ?> data-href="<?= Url::current(['language' => 'ru']) ?>">Рус</option>
            <option value="uk" <?= Yii::$app->language == 'uk' ? 'selected' : '' ?> data-href="<?= Url::current(['language' => 'uk']) ?>">Укр</option>
        </select>
        <div class="contacts-social">
            <?php if ($this->context->siteInfo->yt_link): ?>
                <a href="<?= $this->context->siteInfo->yt_link ?>" class="contacts-social__item contacts-social__item_yt">
                    <i class="fa fa-youtube-square" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->vk_link): ?>
                <a href="<?= $this->context->siteInfo->vk_link ?>" class="contacts-social__item contacts-social__item_vk">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->fb_link): ?>
                <a href="<?= $this->context->siteInfo->fb_link ?>" class="contacts-social__item contacts-social__item_fb">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->ok_link): ?>
                <a href="<?= $this->context->siteInfo->ok_link ?>" class="contacts-social__item contacts-social__item_ok">
                    <i class="fa fa-odnoklassniki-square" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->gp_link): ?>
                <a href="<?= $this->context->siteInfo->gp_link ?>" class="contacts-social__item contacts-social__item_gp">
                    <i class="fa fa-google-plus-official " aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
    <?= $content; ?>
<footer class="footer">
    <div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Copyright © <?= date('Y') ?> <?= Yii::t('web', '«Гектар» является зарегистрированной торговой маркой. Все права защищены.') ?></div>
</footer>
<?php $this->endBody() ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script> -->

</body>
</html>
<?php $this->endPage() ?>


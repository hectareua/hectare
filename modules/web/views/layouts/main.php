<?php
	/* @var $this \yii\web\View */
	/* @var $content string */

	use yii\helpers\Html;
	use app\components\Url;
	use yii\widgets\ActiveForm;
	//use yii\captcha\Captcha;
	use app\assets\WebAsset;
	use app\modules\web\models\CallbackRequestForm;
	use app\models\CallbackRequest;

	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	WebAsset::register($this);

	$cssFiles = [
		'/css/bootstrap.min.css',
		'/css/main.css',
		'/css/edits.css',
		'/css/media.css',

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
<!doctype html>
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
	<meta name="viewport" content="width=340, initial-scale=1, maximum-scale=1 user-scalable=no">
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
	<meta name="google-site-verification" content="c4CbvnAtkLYMyKmU_I0JccTZISrf4TE3h29M5maTrcY" />
	<?= Html::csrfMetaTags() ?>
	<link rel="alternate" hreflang="ru" href="<?= "https://$_SERVER[HTTP_HOST]" . Url::current(['language' => 'ru']) ?>" />
	<link rel="alternate" hreflang="uk" href="<?= "https://$_SERVER[HTTP_HOST]" . substr(Url::current(['language' => '']), 1) ?>" />
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head(); ?>
	<script src="/js/blazy.min.js"></script>
	<script type="text/javascript">
		var bLazy = new Blazy();
	</script>
	<style type="text/css">
		html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}body{margin:0}header{display:block}a{background-color:transparent}img{border:0}input,select{margin:0;font:inherit;color:inherit}select{text-transform:none}input[type=submit]{-webkit-appearance:button}input::-moz-focus-inner{padding:0;border:0}input{line-height:normal}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px}body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}input,select{font-family:inherit;font-size:inherit;line-height:inherit}a{color:#337ab7;text-decoration:none}img{vertical-align:middle}.img-responsive{display:block;max-width:100%;height:auto}h2{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;margin-top:20px;margin-bottom:10px;font-size:30px}p{margin:0 0 10px}.text-center{text-align:center}ul{margin-top:0;margin-bottom:10px}ul ul{margin-bottom:0}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:768px){.container{width:750px}}@media (min-width:992px){.container{width:970px}}@media (min-width:1200px){.container{width:1170px}}.row{margin-right:-15px;margin-left:-15px}.form-group{margin-bottom:15px}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0}.container:after,.container:before,.row:after,.row:before{display:table;content:" "}.footer-contacts__tel{text-align:left;}.container:after,.row:after{clear:both}html,body,div,span,h2,p,a,img,i,ul,li,form,header,input{margin:0;padding:0;border:0;font-size:100%;font-family:"OpenSans Regular",sans-serif;vertical-align:baseline;-webkit-box-sizing:border-box;box-sizing:border-box}header{display:block}body{line-height:1}ul[class]{list-style:none}a{text-decoration:none;color:inherit;font-family:inherit}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}body.container{width:100vw}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}.sandwich-menu i{color:green;font-style:normal;margin-left:20px}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}html{font-family:"OpenSans-Regular",sans-serif;font-size:14px}.wrapper{width:1180px;margin:0 auto}.header .header-top{text-align:center;height:40px;line-height:40px;padding:5px 0;border-bottom:1px solid #c8c8c8;-webkit-box-sizing:content-box;box-sizing:content-box;width:100%;position:fixed;z-index:20;background:#FFF}.header .header-top .wrapper{position:relative}.header .header-top__tel{display:inline-block;color:#66221f;font-family:"OpenSans-Bold",sans-serif}.header .header-top-callBtn{padding:10px 25px;margin:0 30px;background:#f59f08;color:#fff;font-family:"OpenSans-Bold",sans-serif;font-weight:bolder;font-size:12px;text-transform:uppercase}.header .header-top-languagePicker{position:absolute;right:0;width:50px;height:40px;line-height:40px;background:url(../img/select.png) no-repeat 80% center;border:none;-moz-appearance:none;-webkit-appearance:none;font-family:"OpenSans-Light",sans-serif;font-size:.9rem;color:#898989;text-transform:uppercase}.header-mid{overflow:hidden;height:180px;line-height:180px;padding:40px 0}.header-mid-menu-left{display:inline-block;vertical-align:top;width:42%}.header-mid-menu-left-item{display:inline-block;line-height:normal;font-family:"OpenSans-Bold",sans-serif;font-weight:bolder;font-size:12px;color:#66221f}.header-mid-menu-left-item_img{display:inline-block;width:32px;height:32px;background:url(../img/sprites.png) no-repeat;vertical-align:middle}.header-mid-menu-left-item_text{display:inline-block;vertical-align:middle;margin-left:10px;text-transform:uppercase}.header-mid-menu-left-item_rw{margin:0 26%}.header-mid-menu-left-item_rw .header-mid-menu-left-item_img{background-position:-36px 0}.header-mid__logo{width:15%;height:110px;margin-top:20px;background:url(../img/logo.png) no-repeat top center;background-size:194px 121px;display:inline-block;background-color:#f5a009;outline:none}@media screen and (max-width:1200px){.header-mid__logo{background:url(../img/logo_.png) no-repeat bottom;background-color:transparent}}.header-mid-menu-right{display:inline-block;width:42%;vertical-align:top;text-align:right}.header-mid-menu-right-item{display:inline-block;line-height:normal;vertical-align:middle;font-family:"OpenSans-Bold",sans-serif;font-weight:bolder;font-size:12px;color:#66221f}.header-mid-menu-right-item_img{display:inline-block;width:32px;height:32px;background:url(../img/sprites.png) no-repeat;vertical-align:middle;position:relative}.header-mid-menu-right-item_img i{position:absolute;font-style:normal;display:block;width:115%;text-align:center;height:33px;line-height:33px;font-size:.9rem;color:#fff;font-family:"OpenSans-Bold",sans-serif}.header-mid-menu-right-item_text{display:inline-block;vertical-align:middle;margin-left:10px;text-align:left;text-transform:uppercase}.header-mid-menu-right-item_sc .header-mid-menu-right-item_img{background-position:-72px 0}.header-mid-menu-right-item_ct .header-mid-menu-right-item_img{background-position:-108px 0}.header-bottom{height:70px;position:relative;line-height:70px;background:#f59f08}.header-bottom-menu{display:inline-block;vertical-align:middle;width:74%}.header-bottom-menu__item{display:inline-block;font-family:"OpenSans-Bold",sans-serif;font-weight:bolder;color:#fff}.header-bottom-menu__item a{font-family:"OpenSans",sans-serif;font-weight:700;text-transform:uppercase;display:block;width:100%;height:100%}.header-bottom-menu__item:not(:first-child){padding-left:30px}.header-bottom-searchForm{display:inline-block;vertical-align:middle;width:25%;padding-left:10px;height:40px;position:relative}.header-bottom-searchForm input{padding-left:10px;width:100%;height:100%;background:#c47f06 url(../img/search-icon.png) no-repeat 95% center;color:#fff;padding-right:0;vertical-align:top;display:inline;line-height:normal}.header-bottom-searchForm input::-webkit-input-placeholder{line-height:normal}.header-bottom-searchForm input + ul{display:none;position:absolute;top:50px;left:0;right:0;z-index:40;border-width:1px;border-style:solid;border-color:#cbcfe2 #c8cee7 #c4c7d7;-webkit-border-radius:3px;border-radius:3px;background:#fff}.header-bottom-searchForm input + ul li{padding-left:20px;white-space:nowrap;font-size:14px;overflow:hidden;text-overflow:ellipsis}.slider-item{position:relative}.slider-item__link{display:block}.slider-item__img{display:block;width:100%;margin-bottom:7px;background-size:cover}.slider-item__description{position:absolute;height:100px;top:50%;margin-top:-50px;font-family:"OpenSans-Light",sans-serif;font-size:3.57rem;right:5%;color:#66221f;text-transform:uppercase;max-width:722px;line-height:1.2em}.main{width:100vw;margin-left:-15px;margin-right:-15px;padding:0}.footer-logoBlock__site{display:block;width:206px;height:90px;background:url(../img/footer-logo.png) no-repeat center;margin-bottom:20px}.footer-logoBlock__gPlay{display:block;width:190px;height:45px;background:url(../img/google-play.png) no-repeat center;margin-bottom:20px}.footer-logoBlock__appStore{display:block;width:190px;height:45px;background:url(../img/appstore.png) no-repeat center}.footer-contacts-list__item{line-height:2rem;font-family:"OpenSans-Light",sans-serif;display:block}.footer-contacts-list__item span{font-family:"OpenSans-Bold",sans-serif}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}.modalContainer{position:fixed;top:0;left:0;display:none;z-index:30;width:100%;height:100%;overflow:auto}.modalLayout{position:absolute;background:rgba(0,0,0,0.75);width:100%;height:100%}.modal{position:relative;width:43rem;height:25rem;background:#fff;display:block;margin:auto}.modal__title{height:100px;line-height:110px;color:#66221f;font-size:2.85rem;font-family:"OpenSans-Bold",sans-serif;text-align:center}.modal__close{position:absolute;width:40px;height:40px;top:0;right:0;background:url(../img/close_modal.png) no-repeat center}.modal__input{width:540px;height:40px;display:block;border:1px solid #bdbdbd;margin:0 auto 20px;padding-left:40px}.modal__submit{display:block;width:155px;height:40px;background:#00733a;color:#fff;text-transform:uppercase;margin:auto}.modalSuccess{position:relative;width:43rem;height:25rem;background:#fff;display:none;margin:auto;z-index:40}.modalSuccess__message{margin-top:10rem;text-align:center;font-family:"OpenSans-Bold",sans-serif;color:#66221f;font-size:1.5rem}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}.plashka{display:none}@media screen and (max-width: 1024px){.plashka{display:none;position:fixed;z-index:50;top:0;left:0;width:100%;height:100%;background:#f59f08;overflow:hidden;text-align:center}.plashka h2{font-size:5vw;width:100%;padding:0 7vw;margin-bottom:10vh}#web-view{margin-top:10vh;display:inline-block;font-size:6vmin;border:1px solid #fff;padding:2vmin 3vmin;-webkit-border-radius:2vmin;border-radius:2vmin;color:#00733a}.footer-logoBlock__appStore{display:inline-block;vertical-align:top;width:190px;margin-right:20px;height:45px;background:url(../img/appstore.png) no-repeat center}.footer-logoBlock__site{display:block;width:206px;height:90px;background:url(../img/footer-logo.png) no-repeat center;margin:20vw auto 20px}.footer-logoBlock__gPlay{display:inline-block;vertical-align:top;width:190px;height:45px;margin-right:20px;background:url(../img/google-play.png) no-repeat center;margin-bottom:20px}}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3rem;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}@font-face{font-family:"OpenSans-Bold";src:url(../fonts/OpenSans-Bold.ttf)}@font-face{font-family:"OpenSans-Regular";src:url(../fonts/OpenSans-Regular.ttf)}@font-face{font-family:"OpenSans-Light";src:url(../fonts/OpenSans-Light.ttf)}p{font-family:"OpenSans-Light",sans-serif;line-height:1.3em;color:#464646;font-size:13px;margin-bottom:12px}h2{font-size:18px;font-family:"OpenSans-Bold",sans-serif;color:#66221f;text-align:center;line-height:1.5em}.header-bottom-menu-list{width:100%;background-color:#fff;border:1px solid #f59f08;position:absolute;top:69px;left:0;color:#000;padding:10px;z-index:6;display:none}.header-bottom-menu-list-ul{line-height:24px;text-align:center}.header-bottom-menu-list-ul li{display:inline-block;vertical-align:top;text-align:center;margin:2px 3px;padding:5px}.header-bottom-menu-list-ul-item a{display:block}.header-bottom-menu-list-ul-item p{font-family:"OpenSans Regular",sans-serif;font-size:14px;color:#000}.header-bottom-menu-list-ul-item{width:192px;border:1px solid #e1e1e1;margin-bottom:7px!important}.header-bottom-menu-list-ul-item-block{height:60px;display:flex}.header-bottom-menu-list-ul-item-block p{display:inline-block;margin:auto!important;color:#66221f}.header-bottom-menu-list-ul-item__image{width:100%;height:142px;-webkit-background-size:contain;background-size:contain;background-repeat:no-repeat;background-position:center}.header-top-url{position:absolute;left:0;height:40px;line-height:40px;border:none;-moz-appearance:none;-webkit-appearance:none;font-family:"OpenSans-Light",sans-serif;font-size:.9rem;color:#898989;text-transform:uppercase}.header-top-url-list{display:inline-block}.header-top-url-list__item{line-height:2rem;margin-left:30px;margin-top:7px;float:left;font-family:"OpenSans-Light",sans-serif}.footer-contacts__tel.footer-contacts-list__item span{font-size:85%}.footer-contacts__tel.footer-contacts-list__item{font-size:17px;line-height:2}.footer-contacts__tel.footer-contacts-list__item span{/* font-size:100% */}.righttelblock{display:none}#recaptcha1{width:304px;overflow:hidden;margin:10px auto}.row{width:100vw}.text-center{text-align:center}.download-form{display:none}.hamburger-name{color:#fff;font-size:11px;text-align:center}.hamburger-box{width:40px;vertical-align:middle;height:24px;display:inline-block;position:relative}.hamburger-inner{display:block;top:50%;margin-top:-2px}.hamburger-inner,.hamburger-inner::before,.hamburger-inner::after{width:40px;height:4px;background-color:#fff;border-radius:0;position:absolute}.hamburger-inner::before,.hamburger-inner::after{content:"";display:block}.hamburger-inner::before{top:-10px}.hamburger-inner::after{bottom:-10px}.hamburger--collapse .hamburger-inner{top:auto;bottom:0}.hamburger--collapse .hamburger-inner::after{top:-20px}.telephone-xs{display:none}@media screen and (max-width:1200px){.wrapper{width:880px!important}.header-mid{height:130px;padding:0}.header-mid__logo{width:100%}.bonus,.menubrands,.menucontact{display:none}.header-mid-menu-left{display:none}.header-mid-menu-right{display:none}.footer-logoBlock__site{margin-top:0}.header-mid-menu-right{width:38%}.header-mid-menu-left{width:38%}.header-mid__logo{width:100%;background-size:15%;margin-bottom:-22px}.header-bottom{height:80px}.header-top-url-list__item{margin-left:15px}.header-bottom-menu__item{font-stretch:extra-condensed;font-size:90%}.header-bottom-menu{width:79%}.header-bottom-searchForm{width:20%}}@media screen and (max-width: 1084px){.slider-item__description{font-size:2rem;font-weight:bolder;padding:15px}}@media screen and (min-width: 1024px){.header-bottom-menu{display:inline-block!important}}@media screen and (max-width: 1024px){html{font-size:12px;background:#fff}.header-bottom-searchForm{position:relative;bottom:30px}.header-bottom-menu{display:inline-block!important;display:none!important}.home .header-bottom-menu:not(.catalog){display:none!important;}.home .header-bottom-menu.catalog{display:inline-block!important;}.header-bottom-menu__item__main{display:none}.header-bottom-searchForm{position:relative;bottom:0}.header .header-top__tel{display:none}.header .header-top{position:absolute;border-bottom:none;height:0}.header .header-top-callBtn{display:none}.slider-item__description{font-size:2rem;font-weight:bolder;padding:15px}.header-bottom-menu.catalog{float:none;bottom:calc(-110% - 407px);bottom:inherit;left:0;width:100%;z-index:10;background:#f59f08}.header-bottom-menu__item:first-child{margin-left:30px}.header-bottom .header-bottom-menu__item__main{display:none}.header-bottom-menu__item{display:block;font-size:15px;line-height:3em;border-bottom:1px solid #fff}.download-form{display:none;width:100%;height:100px;font-size:15px;color:#005a2d;background:rgba(255,255,255,0.5);padding:30px 20px;line-height:1.4em;position:absolute;z-index:601}#download-close{position:absolute;display:block;height:20px;line-height:20px;top:5px;right:5px;font-size:11px}.wrapper{padding:0 15px}.header-bottom{line-height:25px}.header-mid-menu-left-item{font-size:11px}.header-mid-menu-left-item_text{display:none}.header-mid-menu-right-item{font-size:11px}.header-mid-menu-right-item_text{display:none}.header-mid-menu-right{width:30%}.header-mid-menu-left{width:30%}.header-mid__logo{width:38%;background-size:contain;margin-bottom:0;margin-right:auto;margin-left:auto}.header-bottom-searchForm{width:260px;float:right;margin-top:20px;margin-right:20px}}@media screen and (max-width: 900px){html{font-size:12px}.righttelblock{display:block}.header-mid__logo{background-size:36%}.wrapper{width:600px!important}.header-bottom{line-height:25px}.header .header-top-languagePicker{right:-20px}.header-top-url{display:none}.header-mid-menu-left-item{font-size:11px}.header-mid-menu-left-item_text{display:none}.header-mid-menu-right-item{font-size:11px}.header-mid-menu-right-item_text{display:none}.header-mid-menu-right{width:30%}.header-mid-menu-left{width:30%}.header-mid__logo{width:85%}.header-bottom-searchForm{width:350px;float:right;margin-top:20px;margin-right:20px}.modal{width:90%;height:38rem}.modal__input{width:90%}#recaptcha1{width:90%;margin-bottom:20px}.form-group{margin-bottom:20px}}@media screen and (max-width:640px){html{font-size:10px}.header-bottom-searchForm{width:260px}.telephone-xs{display:block;height:40px;width:100%;line-height:40px;text-align:center;color:#66221f;font-size:14px;border-top:1px solid #66221f}.telephone-xs span:first-child{margin-right:20px}.footer-logoBlock__gPlay{display:inline-block;vertical-align:top;width:140px;height:45px;margin-right:7px;background:url(../img/google-play.png) no-repeat center;margin-bottom:20px}.footer-logoBlock__appStore{display:inline-block;vertical-align:top;width:140px;margin-right:0;height:45px;background:url(../img/appstore.png) no-repeat center}.wrapper{width:100%!important}.header-mid{height:90px;padding:0}.header-mid__logo{margin-top:0;display:block;height:65px;margin-top:10px;width:50%;z-index:200;position:relative;background-size:contain}.header .header-top-callBtn{left:25%;top:40px;line-height:12px;position:absolute;margin:0}.header-top{height:80px!important}.header .header-top-languagePicker{right:0;top:35px}.header .header-top__tel{margin-left:10px}.header-mid-menu-left{vertical-align:middle}.header-mid-menu-left-item{display:block;text-align:center;margin-bottom:16px}.header-mid-menu-right{width:28%;vertical-align:middle}.header-mid-menu-right-item{display:block;text-align:center;margin-bottom:16px}.footer-logoBlock__site{display:none}}@media screen and (max-width:370px){.header-bottom-searchForm{width:219px!important}.footer-contacts__tel{text-align:center;}}@media screen and (max-width:450px){.footer-contacts__tel{text-align:center;}}@media screen and (max-width:320px){.header-bottom-searchForm{width:180px!important}.telephone-xs{font-size:13px;font-stretch:extra-condensed;font-weight:700}.telephone-xs span:first-child{margin-right:10px}}#sandwich-close{position:absolute;top:5px;right:5px;width:32px;height:30px;background:url(https://openclipart.org/image/800px/svg_to_png/183568/close-button.png) no-repeat center;background-size:contain}.sandwich-menu-layout{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:499;}.header .header-top-aboutPicker {margin-left:15px;margin-top:1px;float: left;line-height: 40px;background: url(/images/ham.svg) no-repeat 0% center; border: none;cursor: pointer;-moz-appearance: none;-webkit-appearance: none;font-family: "OpenSans-Light", sans-serif;font-size: 0.9rem;color: #898989; text-transform: uppercase;width: 70px;padding-left: 25px;}.about_picker option {cursor:pointer;}.menumenu{background: url(/images/ham.svg) no-repeat 0% center;padding-left: 25px;}.mmenudrop{display:none;position: absolute;padding: 5px 10px;width: 160px;text-align: left;left: 0;} .menumenu.dropdown:hover .mmenudrop{display:block}li.newsBlock-list-item{cursor:pointer;}.schedule{display: block;position:absolute;right:20px;top: -15px;}.grafik{font-size:110%;margin-top:10px;}.rmargin10{margin-right:10px;}.problemtext{padding:0 20px 15px 20px;font-size:90%;color:#777;}.problemModalContainer .modal__title {height:60px;line-height:60px;font-size:1.85rem;}#problemtextarea{height:90px;}#problemModalButton.modal{height:40rem;}.mtop10{    margin-top:2px;}.form-group.field-callbackrequestform-servicetype{/* margin-bottom:0;width:20px;float:left;margin-top:-2px; */} .clr{clear:both}#problemModalButton .form-group {margin-bottom:5px;}#callbackrequestform-servicetype label {display:block;} .form-group.field-callbackrequestform-question >label,.form-group.field-callbackrequestform-servicetype >label {display:none;}.contactspan{width:45px;display:inline-block;}.footer-contacts__tel.footer-contacts-list__item{font-size: 13px;line-height: 1.4;}
	</style>
</head>
<body class="container <?php echo (trim($_SERVER['REQUEST_URI']) == '/ru' || trim($_SERVER['REQUEST_URI']) == '/') ? 'home' : 'page'; ?> <?php echo (strpos($_SERVER['REQUEST_URI'], '/product/') !== false) ? 'productpage' : ''; ?> <?php echo (strpos($_SERVER['REQUEST_URI'], '/bonus') !== false) ? 'bonuspage' : ''; ?>" >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3MS3F"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php $this->beginBody() ?>
<div class="callModalContainer modalContainer">
	<div class="modalLayout"></div>
	<div class="modal" id="callModalButton">

		<?php $callRequest = $this->context->callRequest; ?>
		<?php
			$form = ActiveForm::begin([
										  'action' => Url::to(['default/call']),
										  'options' => ['class' => 'call_request_form']
									  ]);
		?>
		<div class="modal__title"><?= Yii::t('web', 'Заказать звонок') ?></div>
		<div class="modal__close"></div>
		<?= $form->field($callRequest, 'name')->label(false)->error(false)->input('text', ['class' => 'modal__input', 'required' => '', 'placeholder' => Yii::t('web', 'Имя') . '*', 'required' => '']) ?>
		<?= $form->field($callRequest, 'phone')->label(false)->error(false)->input('tel', ['class' => 'modal__input', 'required' => '', 'placeholder' => Yii::t('web', 'Телефон') . '*', 'required' => '']) ?>
		<div id="recaptcha1"></div>
		<input type="submit" class="modal__submit" value="<?= Yii::t('web', 'Отправить') ?>">
		<?php ActiveForm::end(); ?>

	</div>
	<div class="modalSuccess">
		<div class="modalSuccess__message"><?= Yii::t('web', 'Спасибо за Ваше сообщение! Мы свяжемся с Вами как можно быстрее.') ?></div>
	</div>
</div>
<div class="header-free-delivery row"><strong style="text-transform: uppercase"><?=Yii::t('web', 'Бесплатная доставка')?></strong> <?=Yii::t('web','от')?> 5000 грн</div>
<header class="header row">
	<div class="header-top">
		<div class="wrapper">
			<div class="header-top-url">
				<ul class="header-top-url-list">
					<li class="header-top-url-list__item menumenu dropdown"><?= Yii::t('web', 'Меню') ?>
						<ul class="mmenudrop">
							<li> <a href="<?= Url::to(['default/history']) ?>"><?= Yii::t('web', 'О компании') ?></a></li>
							<li> <a href="<?= Url::to(['default/contact']) ?>"><?= Yii::t('web', 'Контакты') ?></a></li>
							<li> <a href="<?= Url::to(['default/bonusplus']) ?>"><?= Yii::t('web', 'Бонус+') ?></a></li>
							<li> <a href="<?= Url::to(['default/credits']) ?>"><?= Yii::t('web', 'Кредитование') ?></a></li>
							<li> <a href="<?= Url::to(['categories/brands']) ?>"><?= Yii::t('web', 'Производители') ?></a></li>
							<li> <a href="<?= Url::to(['categories/cure']) ?>"><?= Yii::t('web', 'Помощник') ?></a></li>
						</ul>
					</li>
					<?php /* <select id="sel" class="header-top-aboutPicker about_picker about_picker_<?= Yii::$app->language ?>" onclick="javascript:disp();">
								<option disabled="disabled" selected="selected" style="display:none;"><?= Yii::t('web', 'Меню') ?></option>
								<option value="<?= Url::to(['default/history']) ?>" data-href="<?= Url::to(['default/history']) ?>"><?= Yii::t('web', 'История компании') ?></option>
								<option value="<?= Url::to(['default/contact']) ?>" data-href="<?= Url::to(['default/contact']) ?>"><?= Yii::t('web', 'Контакты') ?></option>
								<option value="<?= Url::to(['default/bonus']) ?>" data-href="<?= Url::to(['default/bonus']) ?>"><?= Yii::t('web', 'Бонус+') ?></option>
							</select> 	*/ ?>
					<!--           <li class="header-top-url-list__item menubrands">
                                <?php /*   <a href="<?=Url::to(['default/about'])?>"><?=Yii::t('web', 'О компании')?></a> */ ?>
                                <a href="<?= Url::to(['categories/brands']) ?>"><?= Yii::t('web', 'Производители') ?></a>
                            </li>
                            <li class="header-top-url-list__item menucure">
                                <a href="<?= Url::to(['categories/cure']) ?>"><?= Yii::t('web', 'Помощник') ?></a>
                            </li>   		 -->

					<li class="header-top-url-list__item menubrands"><a href="<?= Url::to(['info/index']) ?>"><?= Yii::t('web', 'Журнал') ?></a></li>
					<li class="header-top-url-list__item menubrands"><a href="<?= Url::to(['default/shop']) ?>"><?= Yii::t('web', 'Магазины') ?></a></li>
					<?php /*    <li class="header-top-url-list__item menucontact">
                                <a href="<?= Url::to(['default/contact']) ?>"><?= Yii::t('web', 'Контакты') ?></a>
                            </li> */ ?>

					<?php /*     <li class="header-top-url-list__item bonus">
                                <a href="<?= Url::to(['default/bonus']) ?>"><?= Yii::t('web', 'Бонус+') ?></a>
                            </li> */ ?>
				</ul>
			</div>
			<div class="header-top__tel"><?= $this->context->siteInfo->contacts_cell_phone ?></div>
			<a href="#" class="header-top-callBtn callModalButton" data-toggle="modal" data-target="#callModalButton" onclick="javascript: jQuery('#callModalButton').css('display','block');"><?= Yii::t('web', 'Заказать звонок') ?></a>
			<div class="header-top__tel"><?= $this->context->siteInfo->contacts_cell_phone_2 ?></div>
			<?php if (!Yii::$app->user->isGuest): ?>
				<a href="<?= Url::to(['user/logout']) ?>" class="header-top__exit"><?= Yii::t('web', 'Выйти') ?></a>
			<?php endif; ?>
			<select class="header-top-languagePicker language_picker">
				<option value="ru" <?= Yii::$app->language == 'ru' ? 'selected' : '' ?> data-href="<?= Url::current(['language' => 'ru']) ?>">Рус</option>
				<option value="uk" <?= Yii::$app->language == 'uk' ? 'selected' : '' ?> data-href="<?= Url::current(['language' => 'uk']) ?>">Укр</option>
			</select>
		</div>
	</div>

	<div class="header-mid">
		<div class="wrapper text-center">
			<div class="hamburger hamburger--collapse item_header_menu menu_mobile">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
				<div class="hamburger-name">Меню</div>
			</div>
			<div class="item_header_menu mobile-search">
				<div class="header-bottom-searchForm search_form" id="mobile_form_search">
					<input type="text" class="header-bottom-searchForm__input search_input" placeholder="<?= Yii::t('web', 'поиск по сайту') ?>">
					<ul class="header-bottom-searchForm-result search_results">
						<li class="header-bottom-searchForm-result__item search_results_item_prototype" style="display: none;"><a href=""></a></li>
						<li class="header-bottom-searchForm-result__item search_results_none" style="display: none;"><?= Yii::t('web', 'Ничего не найдено') ?></li>
					</ul>
				</div>
			</div>
			<div class="item_header_menu basked">
				<a href="<?= Url::to(['cart/index']) ?>" class="header-mid-menu-right-item header-mid-menu-right-item_ct mobile-cart">
					<div class="header-mid-menu-right-item_img">
						<?php if($this->context->getCartTotalAmount()): ?>
							<i><?= $this->context->getCartTotalAmount()? : '' ?></i>
						<?php endif; ?>
					</div>
					<div class="header-mid-menu-right-item_text"><?= Yii::t('web', 'Корзина') ?>
						<br/><span><?php echo $this->renderDynamic('return number_format($this->context->getCartTotalSum(),2)." грн"? : "";' )?></span></div>
				</a>
			</div>
			<div class="item_header_menu mobile_contact">
				<a href="#" class="main-mobile-contact"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></a>
			</div>
			<?php /* <div class="schedule"><?= Yii::t('web', 'График работы с 8:00 до 20:00 без выходных') ?></div> */ ?>
			<div class="header-mid-menu-desk">
				<div class="row">
					<div class="col-md-2">
						<div class="item_desk_menu">
							<a href="<?= Url::to(['default/delivery']) ?>" class="header-mid-menu-left-item header-mid-menu-left-item_dl">
								<div class=" header-mid-menu-left-item_img"></div>
								<div class="header-mid-menu-left-item_text"><?= Yii::t('web', 'Доставка') ?> <br><?= Yii::t('web', 'и оплата') ?></div>
							</a>
						</div>
					</div>
					<div class="col-md-2">
						<div class="item_desk_menu">
							<a href="<?= Url::to(['categories/brands']) ?>" class="header-mid-menu-left-item header-mid-menu-left-item_rw">
								<div class="header-mid-menu-left-item_img"></div>
								<div class="header-mid-menu-left-item_text"><?= Yii::t('web', 'Производители') ?></div>
							</a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="item_desk_menu">
							<a href="<?= Url::to(['default/index']) ?>" class="header-mid__logo"></a>
						</div>
					</div>
					<div class="col-md-2">
						<div class="item_desk_menu">
							<a href="<?= Url::to(['user/index']) ?>" class="header-mid-menu-right-item header-mid-menu-right-item_sc">
								<?php
									if(!Yii::$app->user->isGuest){
										$user = Yii::$app->user->identity;
										$ratingUrl = Yii::$app->user->identity->getCabinetTrophy();
									}
									if(!Yii::$app->user->isGuest && $ratingUrl['trophyUrl'] !='' && ($user->ctype == 4 || $user->ctype == 8 || $user->ctype == 9)): ?>
										<?php if($ratingUrl['trophyUrl'] != '') {
											echo '<div class="star-rating">';
											for($i=0;$i<$ratingUrl['stars']; $i++){
												echo '<span class="fa fa-star" style="color:#ff7e19;font-size: 15px;"></span>';
											}
											for($i=0;$i<5-$ratingUrl['stars']; $i++){
												echo '<span class="fa fa-star-o" style="color:#000;font-size: 15px;"></span>';
											}
											echo '</div>';
										}?>
										<div class="header-mid-menu-right-item_img trophy-img-<?=Yii::$app->language?>" style="background: url('<?=$ratingUrl['trophyUrl']?>') no-repeat; background-size:cover;width:50px;height:50px;"></div>
									<?php else: ?>
										<div class="header-mid-menu-right-item_img"></div>
									<?php endif;?>
								<div class="header-mid-menu-right-item_text">
									<?php if(Yii::$app->user->isGuest): ?>
										<?= Yii::t('web', 'Личный') ?> <br> <?= Yii::t('web', 'кабинет') ?>
									<?php else: ?>
										<?= \app\models\User::findOne(['id' =>Yii::$app->user->id])->getFirstLastName(); ?>
									<?php endif;?>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-2">
						<div class="item_desk_menu">
							<a href="<?= Url::to(['cart/index']) ?>" class="header-mid-menu-right-item header-mid-menu-right-item_ct">
								<div class="header-mid-menu-right-item_img">
									<?php if($this->context->getCartTotalAmount()): ?>
										<i><?= $this->context->getCartTotalAmount()? : '' ?></i>
									<?php endif; ?>
								</div>
								<div class="header-mid-menu-right-item_text"><?= Yii::t('web', 'Корзина') ?>
									<br/><span><?php echo $this->renderDynamic('return number_format($this->context->getCartTotalSum(),2)." грн"? : "";' )?></span></div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="telephone-xs">
		<span><a href="tel:+<?= $this->context->siteInfo->contacts_cell_phone ?>"><?= $this->context->siteInfo->contacts_cell_phone ?></a></span>
		<span><a href="tel:+<?= $this->context->siteInfo->contacts_cell_phone_2 ?>"><?= $this->context->siteInfo->contacts_cell_phone_2 ?></a></span>
		<span class="mobile_phone_form_mobile"><a href="tel:+<?= $this->context->siteInfo->contacts_cell_phone_3 ?>"><?= $this->context->siteInfo->contacts_cell_phone_3 ?></a></span>
		<span class="mobile_phone_form_mobile"><a href="tel:+<?= $this->context->siteInfo->contacts_cell_phone_4 ?>"><?= $this->context->siteInfo->contacts_cell_phone_4 ?></a></span>
	</div>
	<div class="sandwich-menu">
		<div class="sandwich-menu-layout"></div>
		<ul>
			<!--                    <span id="sandwich-close"></span>-->
			<div class="sandwich-menu-title bg-menu-header">
				<div class="wrapper">
					<div class="close-btn">
						<div class="close-sandwich-menu-layout">X</div>
					</div>
					<div class="item_element_menu logo">
						<img src="/img/mission.png" alt="">
					</div>
					<div class="item_element_menu user_name">
						<?php if(!Yii::$app -> user -> isGuest): ?>
							<?= \app\models\User::findOne(['id' =>Yii::$app->user->id])->getFirstLastName(); ?>
						<?php else: ?>
							<a href="<?= Url::to(['user/index']) ?>"><?= Yii::t('web', 'Личный кабинет') ?></a>
						<?php endif ?>
					</div>
				</div>
				<div class="lang-box">
					<!--		                    <span style="margin-right: 10px;">--><?//=Yii::t('web', 'Выберите язык')?><!-- </span>-->
					<span>UA</span>
					<label class="lang-switch">
						<a href="<?=Yii::$app->language=='uk'?Url::current(['language' => 'ru']):Url::current(['language' => 'uk'])?>" style="vertical-align: middle;">
							<input type="checkbox" <?=Yii::$app->language=='ru'?'checked':''?>>
							<span class="lang-slider round"></span>
						</a>
					</label>
					<span>RU</span>
				</div>
				<!--	                    <a href="#">--><?//= Yii::t('web', 'Меню') ?><!--</a>-->
			</div>
			<li><a href="<?= Url::to(['default/index']) ?>"><?= Yii::t('web', 'Главная') ?></a></li>
			<li><a href="<?= Url::to(['user/index']) ?>"><?= Yii::t('web', 'Личный кабинет') ?></a></li>
			<li class="drop-menu">
				<a href="#"><?= Yii::t('web', 'Категории') ?></a>
				<div class="chevron-box">
					<i class="fa fa-chevron-down" aria-hidden="true"></i>
				</div>
				<div class="submenu">
					<?php foreach ($this->params['parentCategories'] as $parentCategory) : ?>
						<a href="<?= Url::toCategory($parentCategory) ?>"><?= $parentCategory->name ?></a>
					<?php endforeach; ?>
				</div>
			</li>
			<li class="drop-menu">
				<a href="<?= Url::to(['default/history']) ?>"><?= Yii::t('web', 'О компании') ?></a>
				<div class="chevron-box">
					<i class="fa fa-chevron-down" aria-hidden="true"></i>
				</div>
				<div class="submenu">
					<a href="<?= Url::to(['info/index']) ?>"><?= Yii::t('web', 'Журнал') ?></a>
					<a href="<?= Url::to(['default/partners']) ?>"><?= Yii::t('web', 'Партнеры') ?></a>
					<a href="<?= Url::to(['default/bonusplus']) ?>"><?= Yii::t('web', 'Бонус +') ?></a>
				</div>
			</li>

			<li><a href="<?= Url::to(['categories/brands']) ?>"><?= Yii::t('web', 'Производители') ?></a></li>
			<li><a href="<?= Url::to(['default/delivery']) ?>"><?= Yii::t('web', 'Доставка') ?></a></li>
			<li><a href="<?= Url::to(['cart/index']) ?>"><?= Yii::t('web', 'Корзина') ?></a><i><?= $this->context->getCartTotalAmount()? : '' ?></i></li>
			<li><a href="<?= Url::to(['categories/cure']) ?>"><?= Yii::t('web', 'Помощник') ?></a></li>
			<li><a href="<?= Url::to(['default/contact']) ?>"><?= Yii::t('web', 'Контакты') ?></a></li>

			<!--	                <li><a href="--><?//= Url::to(['news/index']) ?><!--">--><?//= Yii::t('web', 'Новости') ?><!--</a></li>-->
			<!--                    <li><a href="--><?//= Url::to(['default/credits']) ?><!--">--><?//= Yii::t('web', 'Кредитование') ?><!--</a></li>-->
			<!--                    <li><a href="--><?//= Url::to(['default/shop']) ?><!--">--><?//= Yii::t('web', 'Магазины') ?><!--</a></li>-->
<!--			<div class="socials_link">-->
<!--				<div class="text">-->
<!--					--><?//= Yii::t('web','Мы в соцсетях') ?>
<!--				</div>-->
<!--				<div class="links">-->
<!--					<div class="link_item">-->
<!--						<a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>-->
<!--					</div>-->
<!--					<div class="link_item">-->
<!--						<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>-->
<!--					</div>-->
<!--					<div class="link_item">-->
<!--						<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--					</div>-->
<!--					<div class="link_item">-->
<!--						<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
		</ul>
	</div>

	<div class="header-bottom" id="desk_form">
		<div class="wrapper">

			<div class="header-bottom-change">
				<ul class="header-bottom-menu">
					<li class="header-bottom-menu__item--opac "><a href="">Г</a></li>
					<li class="header-bottom-menu__item header-bottom-menu__item__main "><a href="<?= Url::to(['default/index']) ?>"><?= Yii::t('web', 'Главная') ?></a></li>
					<!--<li class="header-bottom-menu__item"><a href="--><?//=Url::to(['categories/index'])?><!--">--><?//=Yii::t('web', 'Интернет-магазин')?><!--</a></li>-->
					<!--<li class="header-bottom-menu__item"><a href="--><?//=Url::to(['news/index'])?><!--">--><?//=Yii::t('web', 'Новости')?><!--</a></li>-->
					<!--<li class="header-bottom-menu__item"><a href="--><?//=Url::to(['default/partners'])?><!--">--><?//=Yii::t('web', 'Партнеры')?><!--</a></li>-->
					<?php foreach ($this->params['parentCategories'] as $parentCategory) : ?>
						<li class="header-bottom-menu__item"><a href="<?= Url::toCategory($parentCategory) ?>"><?= $parentCategory->name ?></a>
							<?php if ($parentCategory->categories != null) : ?>
								<div class="header-bottom-menu-list">
									<ul class="header-bottom-menu-list-ul">
										<?php foreach ($parentCategory->categories as $subCategory) : ?>
											<?php if (count($subCategory->categories) > 0 || count($subCategory->products) > 0) : ?>
												<li class="header-bottom-menu-list-ul-item">
													<a href="<?= Url::toCategory($subCategory) ?>">
														<div>
															<div class="header-bottom-menu-list-ul-item__image" style="background-image: url('<?= $subCategory->image->url ?>')"></div>
															<div class="header-bottom-menu-list-ul-item-block"><p><?= $subCategory->name ?></p></div>
														</div>
													</a>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
					<li class="header-bottom-menu__item--opac  header-bottom-menu__item--cross"><a href="">Г</a></li>
					<!--                    <li class="header-bottom-menu__item"><a href="--><?//=Url::to(['default/about'])?><!--">--><?//=Yii::t('web', 'О компании')?><!--</a></li>-->
					<!--                    <li class="header-bottom-menu__item"><a href="--><?//=Url::to(['default/contact'])?><!--">--><?//=Yii::t('web', 'Контакты')?><!--</a></li>-->
				</ul>
			</div>
			<div class="header-bottom-searchForm search_form" id="desk_form_search">
				<input type="text" class="header-bottom-searchForm__input search_input" placeholder="<?= Yii::t('web', 'поиск по сайту') ?>">
				<ul class="header-bottom-searchForm-result search_results">
					<li class="header-bottom-searchForm-result__item search_results_item_prototype" style="display: none;"><a href=""></a></li>
					<li class="header-bottom-searchForm-result__item search_results_none" style="display: none;"><?= Yii::t('web', 'Ничего не найдено') ?></li>
				</ul>
			</div>
		</div>
	</div>

</header>
<?php
	$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
	$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
	$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
	$Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
	$webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
?>
<div class="download-form">Для удобства просмотра скачайте <a href="<?php
		if ($iPad || $iPhone || $iPod) {
			echo 'https://itunes.apple.com/app/korporacia-gektar/id1147659441';
		} else if ($Android) {
			echo 'https://play.google.com/store/apps/details?id=ua.com.hectare';
		}
	?>">мобильное приложение</a> <span id="download-close">закрыть</span></div>



<?= $content; ?>

<!--footer-->

<footer class="footer row">
	<div class="kolosok"></div>
	<div class="wrapper">
		<div class="footer-logoBlock col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<a href="<?= Url::to(['default/index']) ?>" class="footer-logoBlock__site"></a>
			<a href="<?= $this->context->siteInfo->google_play_link ?>" class="footer-logoBlock__gPlay"></a>
			<a href="<?= $this->context->siteInfo->app_store_link ?>" class="footer-logoBlock__appStore"></a>
		</div>
		<div class="footer-products col-lg-2 col-md-6 col-sm-12 col-xs-12 text-left">
			<div class="footer-company__title"><?= Yii::t('web', 'График работы') ?></div>
			<div class="grafik"><div class="contactspan">Пн-Пт</div> <?= Yii::t('web', 'с') ?> 8.00-18.00</div>
			<div class="grafik"><div class="contactspan">Сб</div> <?= Yii::t('web', 'с') ?> 9.00-14.00</div>
			<div class="grafik"><div class="contactspan"><?= Yii::t('web', 'Вс') ?></div> <?= Yii::t('web', 'Выходной') ?></div>
		</div>
		<div class="footer-company col-lg-4 col-md-6 col-sm-6 col-xs-6 text-left">
			<div class="footer-company__title" style="margin-left: 15%;"><?= Yii::t('web', 'Компания') ?></div>
			<ul class="footer-company-list rmargin10">
				<li class="footer-company-list__item">
					<a href="<?= Url::to(['news/index']) ?>"><?= Yii::t('web', 'Новости') ?></a>
				</li>
				<li class="footer-company-list__item">
					<a href="<?= Url::to(['default/history']) ?>"><?= Yii::t('web', 'О компании') ?></a>
				</li>
				<li class="footer-company-list__item">
					<a href="<?= Url::to(['default/contact']) ?>"><?= Yii::t('web', 'Контакты') ?></a>
				</li>
				<li class="footer-company-list__item">
					<a href="<?= Url::to(['reviews/index']) ?>"><?= Yii::t('web', 'Отзывы') ?></a>
				</li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['default/partners']) ?>"><?= Yii::t('web', 'Партнеры') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['default/delivery']) ?>"><?= Yii::t('web', 'Доставка и оплата') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['default/credits']) ?>"><?= Yii::t('web', 'Кредитование') ?></a></li>
			</ul>
			<ul class="footer-company-list">
				<li class="footer-company-list__item"><a href="<?= Url::to(['articles/index']) ?>"><?= Yii::t('web', 'Статьи') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['default/bonusplus']) ?>"><?= Yii::t('web', 'Бонус+') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['/web/sitemap/html']) ?>"><?= Yii::t('web', 'Карта сайта') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['categories/cure']) ?>"><?= Yii::t('web', 'Помощник') ?></a></li>
				<li class="footer-company-list__item"><a href="#" class="header-top-callBtn problemModalButton" data-toggle="modal" data-target="#problemModalButton" onclick="javascript: jQuery('#problemModalButton').css('display','block');"><?= Yii::t('web', 'Проблемы с заказом') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['default/shop']) ?>"><?= Yii::t('web', 'Магазины') ?></a></li>
				<li class="footer-company-list__item"><a href="<?= Url::to(['default/cooperation']) ?>"><?= Yii::t('web', 'Сотрудничество с нами') ?></a></li>
			</ul>
		</div>
		<div class="footer-contacts col-lg-3 col-md-4 col-sm-6 col-xs-6 text-left">
			<div class="footer-contacts__title"><?= Yii::t('web', 'Контакты') ?></div>

			<div class="footer-contacts__tel footer-contacts-list__item hidden-xs">
				<span><?= $this->context->siteInfo->contacts_cell_phone ?></span><br>
				<span><?= $this->context->siteInfo->contacts_cell_phone_2 ?></span><br>
				<span><?= $this->context->siteInfo->contacts_cell_phone_3 ?></span><br>
				<span><?= $this->context->siteInfo->contacts_cell_phone_4 ?></span><br>
			</div>

			<div class="footer-contacts-list" itemscope itemtype="http://schema.org/Organization">
				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<span class="footer-contacts__adress footer-contacts-list__item" itemprop="streetAddress"><?= $this->context->siteInfo->contactsAddress ?></span>
					<!--<span itemprop="postalCode">1237,</span><br>
					<span class="footer-contacts__adress footer-contacts-list__item" itemprop="addressLocality"> вул. Адміральська 15,</span>-->
				</div>
				<span class="footer-contacts__tel footer-contacts-list__item righttelblock" itemprop="telephone">
                            <span><?= $this->context->siteInfo->contacts_cell_phone ?> </span><br>
                            <span><?= $this->context->siteInfo->contacts_cell_phone_2 ?> </span><br>
                            <span><?= $this->context->siteInfo->contacts_cell_phone_3 ?> </span><br>
                            <span><?= $this->context->siteInfo->contacts_cell_phone_4 ?> </span>
                        </span>

				<span class="footer-contacts__adress footer-contacts-list__item" itemprop="email"><?= $this->context->siteInfo->contacts_second_email ?></span>
			</div>

			<div class="footer-contacts-social">
				<?php if ($this->context->siteInfo->yt_link): ?>
					<a href="<?= $this->context->siteInfo->yt_link ?>" class="footer-contacts-social__item footer-contacts-social__item_yt">
						<i class="fa fa-youtube-square" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->context->siteInfo->vk_link): ?>
					<a href="<?= $this->context->siteInfo->vk_link ?>" class="footer-contacts-social__item footer-contacts-social__item_vk">
						<i class="fa fa-instagram" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->context->siteInfo->fb_link): ?>
					<a href="<?= $this->context->siteInfo->fb_link ?>" class="footer-contacts-social__item footer-contacts-social__item_fb">
						<i class="fa fa-facebook-square" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->context->siteInfo->ok_link): ?>
					<a href="<?= $this->context->siteInfo->ok_link ?>" class="footer-contacts-social__item footer-contacts-social__item_ok">
						<i class="fa fa-odnoklassniki-square" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->context->siteInfo->gp_link): ?>
					<a href="<?= $this->context->siteInfo->gp_link ?>" class="footer-contacts-social__item footer-contacts-social__item_gp">
						<i class="fa fa-google-plus-official " aria-hidden="true"></i>
					</a>
				<?php endif; ?>
			</div>
		</div>

	</div>
	<div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Copyright © <?= date('Y') ?> <?= Yii::t('web', '«Гектар» является зарегистрированной торговой маркой. Все права защищены.') ?></div>
</footer>

<div class="problemModalContainer modalContainer">
	<div class="modalLayout"></div>
	<div class="modal" id="problemModalButton">

		<?php $callbackRequest = new CallbackRequestForm(); ?>
		<?php
			$form = ActiveForm::begin([
										  'action' => Url::to(['default/callback']),
										  'options' => ['class' => 'call_request_form']
									  ]);
		?>
		<div class="modal__title"><?= Yii::t('web', 'Обратная связь') ?></div>
		<div class="problemtext"><?= Yii::t('web', 'Письмо будет отправлено в службу поддержки. Мы приложим все усилия для того, чтобы ответить Вам максимально быстро.') ?></div>
		<div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="mtop10"><?= Yii::t('web', 'Выберите сервис') ?>:</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group mtop10">
					<?php /*
							<div><input class="" name="servicetype" type="radio" /><?= Yii::t('web', 'Магазин Гектар') ?></div>
							<div><input class="" name="servicetype" type="radio" /><?= Yii::t('web', 'Интернет магазин') ?></div>
							<div><input class="" name="servicetype" type="radio" /><?= Yii::t('web', 'Другое') ?></div>

							<div class="clr"><?= $form->field($callbackRequest, 'servicetype')->radio(array('label'=>'')) ?> <?= Yii::t('web', 'Магазин Гектар'); ?></div>
							<div class="clr"><?= $form->field($callbackRequest, 'servicetype')->radio(array('label'=>'')) ?> <?= Yii::t('web', 'Интернет магазин'); ?></div>
							<div class="clr"><?= $form->field($callbackRequest, 'servicetype')->radio(array('label'=>'')) ?> <?= Yii::t('web', 'Другое'); ?></div> */ ?>
					<?= $form->field($callbackRequest, 'servicetype')->radioList(array(Yii::t('web', 'Магазин Гектар')=> Yii::t('web', 'Магазин Гектар'), Yii::t('web', 'Интернет магазин') => Yii::t('web', 'Интернет магазин'), Yii::t('web', 'Другое') => Yii::t('web', 'Другое'))); ?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="mtop10"><?= Yii::t('web', 'Укажите причину обращения') ?>:</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<?php /*
						<select class="form-control mtop10" name="question">
							<option value = "<?= Yii::t('web', 'Вопрос по заказу') ?>"><?= Yii::t('web', 'Вопрос по заказу') ?></option>
							<option value = "<?= Yii::t('web', 'Вопрос по товару') ?>"><?= Yii::t('web', 'Вопрос по товару') ?></option>
							<option value = "<?= Yii::t('web', 'Жалоба на продавца') ?>"><?= Yii::t('web', 'Жалоба на продавца') ?></option>
							<option value = "<?= Yii::t('web', 'Другие общие вопросы') ?>"><?= Yii::t('web', 'Другие общие вопросы') ?></option>
						</select> */ ?>
				<?php echo $form->field($callbackRequest, 'question')->dropDownList([Yii::t('web', 'Вопрос по заказу') => Yii::t('web', 'Вопрос по заказу'), Yii::t('web', 'Вопрос по товару') => Yii::t('web', 'Вопрос по товару'), Yii::t('web', 'Жалоба на продавца') => Yii::t('web', 'Жалоба на продавца'), Yii::t('web', 'Другие общие вопросы') => Yii::t('web', 'Другие общие вопросы')]); ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="mtop10"><?= Yii::t('web', 'Номер Вашего заказа') ?>:</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<?php /*	<input class="form-control mtop10" name="orderno" placeholder="<?= Yii::t('web', 'Номер Вашего заказа') ?>" type="text" /> */ ?>
				<?= $form->field($callbackRequest, 'orderno')->label(false)->error(false)->input('text', ['class' => 'form-control mtop10', 'required' => '', 'placeholder' => Yii::t('web', 'Номер Вашего заказа') . '*', 'required' => ''])  ?>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="mtop10"><?= Yii::t('web', 'Сообщение') ?>:</div>
				<div>
					<?php /*	<textarea class="form-control mtop10" name="message" id="problemtextarea">
							</textarea> */ ?>
					<?= $form->field($callbackRequest, 'message')->textarea(['class' => 'form-control mtop10', 'id'=>'problemtextarea'])->label(''); ?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mtop10">
				<div class="mtop10"><?= Yii::t('web', 'Представьтесь, пожалуйста') ?>:</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mtop10">
				<?= $form->field($callbackRequest, 'name')->label(false)->error(false)->input('text', ['class' => 'form-control mtop10', 'required' => '', 'placeholder' => Yii::t('web', 'Представьтесь, пожалуйста') . '*', 'required' => '']) ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="mtop10"><?= Yii::t('web', 'Номер телефона') ?>:</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<?= $form->field($callbackRequest, 'phone')->label(false)->error(false)->input('tel', ['class' => 'form-control mtop10', 'required' => '', 'placeholder' => Yii::t('web', 'Номер телефона') . '*', 'required' => '']) ?>
			</div>
		</div>
		<div class="modal__close"></div>
		<?php /* <div id="recaptcha1"></div> */ ?>
		<input type="submit" class="modal__submit mtop10" value="<?= Yii::t('web', 'Отправить') ?>">
		<?php ActiveForm::end(); ?>

	</div>
	<div class="modalSuccess">
		<div class="modalSuccess__message"><?= Yii::t('web', 'Спасибо за Ваше сообщение! Мы свяжемся с Вами как можно быстрее.') ?></div>
	</div>
</div>

<?php foreach ($cssFiles as $css): ?>
	<?php echo Html::cssFile($css).PHP_EOL; ?>
<?php endforeach; ?>
<?php $this->registerJs("
        base_url_search = '" . Url::to(['products/search']) . "';

		if(typeof(ContainerFlex)!='function'){
			function ContainerFlex(tagclass, el){
				if(typeof(el)=='object') el.preventDefault();
				$('.'+tagclass).css('display','flex');
				$('#problemModalButton, #callModalButton').on('shown.bs.modal', function () {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop.in').hide();
                });
			}
		}
		$(document).ready(function(){

            $('.dynamic_content').copyright({extratxt: 'Источник: %source%', sourcetxt: '".$_SERVER['HTTP_HOST']."'});
            $('.language_picker').change(function(){
                location = $(this).find(':selected').data('href');
            });
            $('.callModalButton').on('click', function(e) {
				var el = e;
                ContainerFlex('callModalContainer', el);
            });
            $('.problemModalButton').on('click', function(e) {
				var el = e;
                ContainerFlex('problemModalContainer', el);
            });
            $('.about_picker').on('change', function(e) {
				document.location.href=$(this).val();
            });
            $('.captcha_refresh').on('click', function(e){
                e.preventDefault();

                $(this).parent().find('.captcha_image').yiiCaptcha('refresh');
            });
            var searchInputTimeout = null;
            var searchResultsHideTimeout = null;
            $('.search_input').on('focus', function(){
                if (searchResultsHideTimeout)
                {
                    clearTimeout(searchResultsHideTimeout);
                    searchResultsHideTimeout = null;
                }
                var input = $(this).val();
                if (input)
                    $('.search_results').show();
            });
            $('.search_input').on('blur', function(){
                searchResultsHideTimeout = setTimeout(function(){
                    $('.search_results').hide();
                }, 1000);
            });

            $('.search_input').keyup(function(e){
                var input = $(this).val();
                var str = $('#search').val();
                var url = base_url_search+'?searchString='+input;
                if (e.keyCode == 13) {
                    location.href = url;
                    //console.log(url);
                }
            });

            $('.search_input').on('input', function(){
                var input = $(this).val();
                if (input)
                    $('.search_results').show();
                if (searchInputTimeout)
                {
                    clearTimeout(searchInputTimeout);
                    searchInputTimeout = null;
                }
                if (searchResultsHideTimeout)
                {
                    clearTimeout(searchResultsHideTimeout);
                    searchResultsHideTimeout = null;
                }
                searchInputTimeout = setTimeout(function(){
                    $.getJSON(base_url_search+'?searchString='+input+'&searchPage=0', function(results){
                        $('.search_results_item').remove();
                        if (!results.length) {
                            $('.search_results_none').show();
                        } else {
                            $('.search_results_none').hide();
                            $(results).each(function(){
                                var data = this;
                                var elem = $('.search_results_item_prototype').clone();
                                elem.removeClass('search_results_item_prototype').addClass('search_results_item');
                                elem.find('a').attr('href', data.url);
                                elem.find('a').html(data.name);
                                $('.search_results').append(elem);
                                elem.show();
                            });
                        }
                    });
                }, 1000);
            });
            $(document).on('beforeSubmit', '.call_request_form', function () {
                var form = $(this);
                // return false if form still have some validation errors
                if (form.find('.has-error').length)
                {
                    return false;
                }
                // submit form
                $.ajax({
                    url    : form.attr('action'),
                    type   : form.attr('method'),
                    data   : form.serialize(),
                    success: function (response)
                    {
                        if (response == 'ok') {
                            form.parents('.modalContainer').find('.modal').hide();
                            form.parents('.modalContainer').find('.modalSuccess').show();
                        } else {
                            form.yiiActiveForm('updateMessages', response, true);
                        }
                    },
                    error  : function ()
                    {
                        console.log('internal server error');
                    }
                });
                return false;
            });
        });
    "); ?>
<script src="https://www.google.com/recaptcha/api.js?onload=test&render=explicit" async defer></script>
<script type="text/javascript">
	function test() {
		if ($('#recaptcha1').length) {
			grecaptcha.render('recaptcha1', {
				'sitekey': '6Ld18pUUAAAAAEi88MqBkdvfw-pUEKrZ6bDvo6xO'
			});
		}
		if ($('#recaptcha2').length) {
			grecaptcha.render('recaptcha2', {
				'sitekey': '6Leb8pUUAAAAALKUmuPgVBeQlszqJVcWqJ4TSrOn'
			});
		}
		if ($('#recaptcha3').length) {
			grecaptcha.render('recaptcha3', {
				'sitekey': '6Leb8pUUAAAAALKUmuPgVBeQlszqJVcWqJ4TSrOn'
			});
		}
		if ($('#recaptcha4').length) {
			grecaptcha.render('recaptcha4', {
				'sitekey': '6Leb8pUUAAAAALKUmuPgVBeQlszqJVcWqJ4TSrOn'
			});
		}
		if ($('#recaptcha5').length) {
			grecaptcha.render('recaptcha5', {
				'sitekey': '6Leb8pUUAAAAALKUmuPgVBeQlszqJVcWqJ4TSrOn'
			});
		}
	};
</script>
<!-- Start SiteHeart code -->
<script>
	(function(){
		var widget_id = 804176;
		_shcp =[{widget_id : widget_id}];
		var lang =(navigator.language || navigator.systemLanguage
			|| navigator.userLanguage ||"en")
		.substr(0,2).toLowerCase();
		var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
		var hcc = document.createElement("script");
		hcc.type ="text/javascript";
		hcc.async =true;
		hcc.src =("https:"== document.location.protocol ?"https":"http")
			+"://"+ url;
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hcc, s.nextSibling);
	})();
</script>

<!-- End SiteHeart code -->
<!--<script data-skip-moving="true">
        (function(w,d,u,b){
                s=d.createElement('script');r=1*new Date();s.async=1;s.src=u+'?'+r;
                h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.ua/b2179619/crm/site_button/loader_4_ihnp0i.js');
</script> -->


<script type="application/ld+json">
	{
		"@context" : "http://schema.org",
		"@type" : "Organization",
		"name" : "Hectare",
		"url" : "https://hectare.com.ua/",
		"sameAs" : [
			"https://www.youtube.com/channel/UClDBb2LZS_ydbqe3i1S5gNg",
			"https://plus.google.com/u/0/115495484453326381973",
			"https://www.facebook.com/hectare.com.ua/",
			"https://ok.ru/group/53331376079037",
			"https://vk.com/hectare_com_ua"
		]
	}
</script>
<script>
	var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};
	var hamburgers = document.querySelectorAll(".header-mid .hamburger");
	var menu = document.querySelectorAll(".sandwich-menu")[0];
	if (hamburgers.length > 0) {
		forEach(hamburgers, function(hamburger) {
			hamburger.addEventListener("click", function() {
				this.classList.toggle("is-active");
				menu.classList.toggle("menu-active",'hidden');
			}, false);
		});
	}
</script>
<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "Organization",
		"url": "https://hectare.com.ua/",
		"logo": "https://hectare.com.ua/img/logo.png"
	}
	window.onload = function() {
		jQuery(window).on("resize",function() {document.location.reload();});
	}
</script>
<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "Organization",
		"url": "https://hectare.com.ua/",
		"logo": "https://hectare.com.ua/img/logo.png"
	}
	window.onload = function() {
		jQuery(window).on("resize",function() {document.location.reload();});
	}
</script>
<?php $this->endBody() ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	/*(function (d, w, c) {
		(w[c] = w[c] || []).push(function () {
			try {
				w.yaCounter44862661 = new Ya.Metrika({
					id: 44862661,
					clickmap: true,
					trackLinks: true,
					accurateTrackBounce: true,
					webvisor: true
				});
			} catch (e) {
			}
		});

		var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () {
					n.parentNode.insertBefore(s, n);
				};
		s.type = "text/javascript";
		s.async = true;
		s.src = "//d31j93rd8oukbv.cloudfront.net/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else {
			f();
		}
	})(document, window, "yandex_metrika_callbacks"); */
</script>
<noscript><div><img src="//d31j93rd8oukbv.cloudfront.net/watch/44862661" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<script data-skip-moving="true">
	(function(w,d,u){
		var s=d.createElement('script');s.async=1;s.src=u+'?'+(Date.now()/60000|0);
		var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
	})(window,document,'https://crm.hectare.com.ua/upload/crm/site_button/loader_5_0217e0.js');
</script>

<script>
	(function(w, d, s, h, id) {
		w.roistatProjectId = id; w.roistatHost = h;
		var p = d.location.protocol == "https:" ? "https://" : "http://";
		var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
		var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
	})(window, document, 'script', 'cloud.roistat.com', '4989e6edf1ff5e7d4dcedd0d136a4446');
</script>


</body>
</html>
<?php $this->endPage() ?>

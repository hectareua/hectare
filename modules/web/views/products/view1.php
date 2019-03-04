<?php
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$lang = Yii::$app->language;
$lang1='';
if(Yii::$app->language == 'uk') {$lang1='_uk';}
/* @var $model \app\models\Product */

//use yii\captcha\Captcha;
$this->title = $model->seoTitle?$model->seoTitle:$model->name . Yii::t('web',' за ') . number_format($model->currencyPrice, 2) . Yii::t('web',' грн. купить в Николаеве, Киеве, Одессе, Украине | ') . '(' . Yii::t('web','Арт. ').$model->id .')'. (' | Гектар');
$this->registerMetaTag(['name' => 'description', 'content' => $model->seoDescription?$model->seoDescription:$model->name  . Yii::t('web', ' купить по цене ') . number_format($model->currencyPrice, 2) . ' грн (' . Yii::t('web','Арт. ').$model->id .')' . Yii::t('web',' ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ Звоните (067) 559-84-93')], 'description');
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seoKeywords], 'keywords');
$this->registerCss("

.raw .item-main-right__submit {
    height: 40px;
    border: none;
    line-height: 40px;
    background: #00733a;
    color: #fff;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-block;
    vertical-align: middle;
    float:none;
    width:auto;
    
    margin: 15px auto !important;
}

.type-buy{
    width: 120%;
    margin-left: -40px;
    text-align: justify;
}



#buy-shop, #shop-stocks{
    margin-top: -10px !important;
}



span.like-span {
    float:right;
}

span.like-span i.glyphicon-thumbs-up {
    color: #00733a;
    cursor:pointer
}

span.like-span i.glyphicon-thumbs-down {
    color: #f59f08;
    padding-left: 5px;
    cursor:pointer
}

div.like-value{
    width:15px;
    display:inline;
    font:300 normal 1.125em 'Roboto', Arial, Verdana, sans-serif; color: #34495e;
    text-align:center;
    background-color:transparent !important;
    border: none !important;
}
@media screen and (max-width:400px){
.shares{margin-top:50px !important;}
}
.messagecomment {
    border: 1px solid lightgrey;
    margin: 15px 5px 5px;
    padding: 10px;
}
.message_cancel {
    padding: 10px 25px;
    background: #f59f08;
    color: #fff;
    width: 155px;
    height: 40px;
    text-transform: uppercase;
    cursor: pointer;
}
.message__submit {
    display: inline-block !important;
}
.norma,.maincharact  {
    margin-top:50px;
    width: 100%;
}
.norma table,.maincharact table  {
    display:none
}
.norma.active table,.maincharact.active table  {
    display:table
}
.normtitle i,.partnertitle i,.maincharacttitle i{
	color: white;
    float: right;
    margin-right: 15px;
    font-size: 1.5em;
}
.normtitle, .partnertitle,.maincharacttitle {
    background: #f59f08;
	width: 100%;
	color:white;
    padding: 10px;
}
.normtitle,.partnertitle,.maincharacttitle {cursor:pointer;}
#w1 input,#w1 #recaptcha3 {display:none;}
#w1.active input {display:initial;}
#w1.active #recaptcha3 {display:block;}
.norma table,.maincharact table { width: 100%;}
.norma table td,.maincharact table td {width:50%;padding:5px;border:1px solid lightgrey;text-align:center;}
.rewiewlabel {font-family: \"OpenSans-Bold\", sans-serif; font-size: 1rem; color: #66221f;margin-bottom:10px;}
#w1.item-main-form {    
	border: 1px solid #c4c4c4;
    overflow: hidden;
    text-align: center;
    padding-bottom: 10px;
}
#w1 input[type=submit] {float: none;}
.partnertitle,.maincharacttitle {margin-bottom:5px;}
#productpricesenquiry-name {margin-left:5px;}
#productpricesenquiry-phone {margin-left:5px;}
#w1 .item-main-form__input {width: calc(32% - 20px);}
.tabs-list ul, .tabs-list ol {list-style: none !important;}



#slideshow-wrap {
    display: block;
    height: 380px; /* 300px; */
    min-width: 200px;
    max-width: 1240px; /* 1040px; /* 840px; */
    margin: 20px auto;
    border: 12px rgba(255,255,240,1) solid;
    -webkit-box-shadow: 0px 0px 5px rgba(0,0,0,.8);
    -moz-box-shadow: 0px 0px 5px rgba(0,0,0,.8);
    box-shadow: 0px 0px 5px rgba(0,0,0,.8);
    position: relative;
    
}

#slideshow-inner {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

#slideshow-inner>ul {
    list-style: none;
    height: 100%;
    width: 500%;
    overflow: hidden;
    position: relative;
    left: 0px;
    -webkit-transition: left .8s cubic-bezier(0.77, 0, 0.175, 1);
    -moz-transition: left .8s cubic-bezier(0.77, 0, 0.175, 1);
    -o-transition: left .8s cubic-bezier(0.77, 0, 0.175, 1);
    transition: left .8s cubic-bezier(0.77, 0, 0.175, 1);
	display: inline-block;
}

#slideshow-inner>ul>li {
    width: 20%;
    height: 200px;
    float: left;
    position: relative;
}

#slideshow-inner>ul>li>img {
    margin: auto;
    height: 100%;
}

#slideshow-wrap input[type=radio] {
    position: absolute;
    left: 50%;
    bottom: 15px;
    z-index: 100;
    visibility: hidden;
}

#slideshow-wrap label:not(.arrows):not(.show-description-label) {
    position: absolute;
    left: 50%;
    bottom: -45px;
    z-index: 100;
    width: 12px;
    height: 12px;
    background-color: rgba(200,200,200,1);
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    cursor: pointer;
    -webkit-box-shadow: 0px 0px 3px rgba(0,0,0,.8);
    -moz-box-shadow: 0px 0px 3px rgba(0,0,0,.8);
    box-shadow: 0px 0px 3px rgba(0,0,0,.8);
    -webkit-transition: background-color .2s;
    -moz-transition: background-color .2s;
    -o-transition: background-color .2s;
    transition: background-color .2s;
}

#slideshow-wrap label:not(.arrows):active { bottom: -46px }

#slideshow-wrap input[type=radio].complectsbutton:checked~label[for=button-1] { background-color: rgba(100,100,100,1) }

#slideshow-wrap label[for=button-1] { margin-left: -36px }

#slideshow-wrap label[for=button-2] { margin-left: -18px }

#slideshow-wrap label[for=button-4] { margin-left: 18px }

#slideshow-wrap label[for=button-5] { margin-left: 36px }

#slideshow-wrap input[type=radio]#button-1:checked~#slideshow-inner>ul { left: 0 }

#slideshow-wrap input[type=radio]#button-2:checked~#slideshow-inner>ul { left: -100% }

#slideshow-wrap input[type=radio]#button-3:checked~#slideshow-inner>ul { left: -200% }

#slideshow-wrap input[type=radio]#button-4:checked~#slideshow-inner>ul { left: -300% }

#slideshow-wrap input[type=radio]#button-5:checked~#slideshow-inner>ul { left: -400% }

label.arrows {
    font-family: 'WebSymbolsRegular';
    font-size: 25px;
    color: rgb(255,255,240);
    position: absolute;
    top: 50%;
    margin-top: -25px;
    display: none;
    opacity: 0.7;
    cursor: pointer;
    z-index: 5;
    background-color: transparent;
    -webkit-transition: opacity .2s;
    -moz-transition: opacity .2s;
    -o-transition: opacity .2s;
    transition: opacity .2s;
    text-shadow: 0px 0px 3px rgba(0,0,0,.8);
}

label.arrows:hover { opacity: 1 }

label.arrows:active { margin-top: -23px }

input[type=radio]#button-1:checked~.arrows#arrow-2, input[type=radio]#button-2:checked~.arrows#arrow-3, input[type=radio]#button-3:checked~.arrows#arrow-4, input[type=radio]#button-4:checked~.arrows#arrow-5 {
    right: -55px;
    display: block;
}

input[type=radio]#button-2:checked~.arrows#arrow-1, input[type=radio]#button-3:checked~.arrows#arrow-2, input[type=radio]#button-4:checked~.arrows#arrow-3, input[type=radio]#button-5:checked~.arrows#arrow-4 {
    left: -55px;
    display: block;
    -webkit-transform: scaleX(-1);
    -moz-transform: scaleX(-1);
    -ms-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    transform: scaleX(-1);
}

input[type=radio]#button-2:checked~.arrows#arrow-1 { left: -19px }

input[type=radio]#button-3:checked~.arrows#arrow-2 { left: -37px }

input[type=radio]#button-5:checked~.arrows#arrow-4 { left: -73px }

.description {
    position: absolute;
    top: 0;
    left: 0;
    width: 260px;
    font-family: 'Yanone Kaffeesatz';
    z-index: 1000;
}

.description input { visibility: hidden }

.description label {
    font-family: 'WebSymbolsRegular';
    background-color: rgba(255,255,240,1);
    position: relative;
    left: -17px;
    top: 00px;
    width: 40px;
    height: 27px;
    display: inline-block;
    text-align: center;
    padding-top: 7px;
    border-bottom-right-radius: 15px;
    cursor: pointer;
    opacity: 0;
    -webkit-transition: opacity .2s;
    -moz-transition: opacity .2s;
    -o-transition: opacity .2s;
    transition: opacity .2s;
    z-index: 5;
    color: rgb(20,20,20);
}

#slideshow-inner>ul>li:hover .description label { opacity: 1 }

.description input[type=checkbox]:checked~label { opacity: 1 }

.description .description-text {
    background-color: rgba(255,255,230,.5);
    padding-left: 45px;
    padding-top: 25px;
    padding-right: 15px;
    padding-bottom: 15px;
    position: relative;
    top: -35px;
    z-index: 4;
    opacity: 0;
    -webkit-transition: opacity .2s;
    -moz-transition: opacity .2s;
    -o-transition: opacity .2s;
    transition: opacity .2s;
    color: rgb(20,20,20);
}

.description input[type=checkbox]:checked~.description-text { opacity: 1 }
.complects-item{
    display: table-cell;
    width:10%;
    text-align: center;
	vertical-align: middle;
    font-size: 40px;
    color: grey;
}
.complectsslide{
    display: inline-block;
    height: 100%;
    width:1150px; /* 1015px;/* 816px;*/
    padding:20px;
}
.wrapper.complects .shares-list-item__price {
    font-size: 1.8rem;
}
.superpriceru,.superpriceuk,.topsaleru,.topsaleuk {
    position: absolute;
    width: 50%;
    height:30%;
    left: 5px;
    background: url(/img/superpriceuk.png) no-repeat;
    vertical-align: middle;
    background-size: 100% auto;
    margin-top: 5px;    
    z-index:2;
}
.superpriceru {
    background: url(/img/superpriceru.png) no-repeat;
    background-size: 100% auto;    
}
.topsaleru {
    background: url(/img/topsaleru.png) no-repeat;
    background-size: 100% auto;
}
.topsaleuk {
    background: url(/img/topsaleuk.png) no-repeat;
    background-size: 100% auto;
}
.buycomplect {
    width: 80px;
    height: 30px;
    border: none;
    line-height: 30px;
    background: #00733a;
    color: #fff;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-block;
    vertical-align: middle;
    float: none;
	font-size:14px;
    display: block !important;
    margin: 15px auto !important;
}
.shares-list-item__discount{
    font-size: 15px;
    font-weight: bold;
    color: orange;
    position: relative;
    margin-right: 5px;
    text-align: right;
    float: right;
}
.shares-list-item__discount.activedis{
	background: #00733a;
    color: #fff;
	padding: 5px;
}
.slidenav {display:none;}
.complects .item-main-right__submit {float:none;}
.complects-item.product.plusitem::after {
	content: \"+\";
	position: relative;
	
	display: block;
	float: right;
    margin-top: -160px;
    color: grey;
	font-size: 30px;
	font-weight: bold;
}
.complects .inbuy {
    background: #fff3b5;
    height: 130px;
    padding: 15px 0;
}
.wrapper.complects .shares-list-item__price{
    color: #f59f08;
}
.productpage .delivery-list-item {
    margin: 20px;
    width: 200px;
}
.wrapper.complects input[type=radio]#button-1:checked~.arrows#arrow-2, .wrapper.complects input[type=radio]#button-2:checked~.arrows#arrow-3, .wrapper.complects input[type=radio]#button-3:checked~.arrows#arrow-4, .wrapper.complects input[type=radio]#button-4:checked~.arrows#arrow-5 {
    background: url(http://hectare.com.ua/img/news-next.png) no-repeat;
    height: 36px;
    width: 22px;
    color: transparent;
    text-shadow: none;
}
.wrapper.complects input[type=radio]#button-2:checked~.arrows#arrow-1 {
    background: url(http://hectare.com.ua/img/news-next.png) no-repeat;
    height: 36px;
    width: 22px;
    color: transparent;
    text-shadow: none;    
}
.cheaperhead {
    font-size: 1.3rem;
    color: #f59f08;
}
.wrapper.complects .shares-list-item__img{max-height:115px;}


.btnflip {
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 150px;
  height: 30px;
  text-align: center;
  transform-style: preserve-3d;
  perspective: 1000px;
  transform-origin: center center;
  
}
.btnflip-item {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  text-align: center;
  line-height: 30px;
  font-size: 12px;
  background-color: rgba(0,0,0, .05);
  transform-style: preserve-3d;
  backface-visibility: hidden;
  border-radius: 15px;
  text-transform: uppercase;
  color: #fff;
  transition: 1s;
}
.btnflip-item.btnflip__front {
  transform: rotateX(0deg) translateZ(15px);
}
.btnflip:hover .btnflip-item.btnflip__front {
  transform: rotateX(-180deg) translateZ(15px);
}
.btnflip-item.btnflip__back {
  transform: rotateX(180deg) translateZ(15px);
}
.btnflip:hover .btnflip-item.btnflip__back {
  transform: rotateX(0deg) translateZ(15px);
}
.btnflip-item.btnflip__center {
  background: linear-gradient(to left, #f59f08, #f59f08);
}
.btnflip-item.btnflip__center::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to left, #00733a, #00733a);
  border-radius: 15px;
  transform: translateZ(-1px);
}
.btnflip:hover .btnflip-item.btnflip__center {
  transform: rotateX(-180deg);
}




@media only screen and (min-width: 40em) {
  .modal-overlay, .modal-overlay-shop {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 5;
    background-color: rgba(0, 0, 0, 0.6);
    opacity: 0;
    visibility: hidden;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    -webkit-transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), visibility 0.6s cubic-bezier(0.55, 0, 0.1, 1);
    transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), visibility 0.6s cubic-bezier(0.55, 0, 0.1, 1);
     z-index:999;
  }
  .modal-overlay.active, .modal-overlay-shop.active {
    opacity: 1;
    visibility: visible;
  }
}
/**
 * Modal
 */
.modal-sertificate, .modal-shops {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  position: relative;
  margin: 0 auto;
  background-color: #fff;
  max-width: 1000px;
  
  min-height: 45rem;
  padding: 1rem;
  border-radius: 3px;
  opacity: 0;
  overflow-y: auto;
  visibility: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transform: scale(1.2);
          transform: scale(1.2);
  -webkit-transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  z-index:1000;
}

.modal-shops{
    width:65%;
    align-items: initial;
    overflow: hidden;
}
.modal-sertificate .close-modal, .modal-shops .close-modal {
  position: absolute;
  cursor: pointer;
  top: 5px;
  right: 15px;
  opacity: 0;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), -webkit-transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), -webkit-transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), transform 0.6s cubic-bezier(0.55, 0, 0.1, 1), -webkit-transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  -webkit-transition-delay: 0.3s;
          transition-delay: 0.3s;
}
.modal-sertificate .close-modal svg, .modal-shops .close-modal svg {
  width: 1.75em;
  height: 1.75em;
}

.modal-shops .modal-header {
    position:absolute;
    top: -10px;
    left:20px;
    font-size: 20px;
    font-weight: bold;
}

.modal-shops p {
    margin: 10px 0;
    font-size: 15px;
    font-weight: bold;
}

.modal-shops .submit-shop:hover {
    background-color: #00733a !important;
}

.modal-sertificate .modal-content, .modal-shops .modal-content {
  opacity: 0;
  max-height: 80%;
  width: 90%;
  text-align: center;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  -webkit-transition-delay: 0.3s;
          transition-delay: 0.3s;
}

.modal-shops .modal-content {
  width: 100%;
  margin-top:40px;
  padding: 10px;
  text-align:left;
}

.modal-shops .row{
    width:100%;
}

.modal-sertificate.active, .modal-shops.active {
  visibility: visible;
  opacity: 1;
  -webkit-transform: scale(1);
          transform: scale(1);
}
.modal-sertificate.active .modal-content, .modal-shops.active .modal-content {
  opacity: 1;
}
.modal-sertificate.active .close-modal, .modal-shops.active .close-modal {
  -webkit-transform: translateY(10px);
          transform: translateY(10px);
  opacity: 1;
}

/**
 * Mobile styling
 */
@media only screen and (max-width: 39.9375em) {
  h1 {
    font-size: 1.5rem;
  }

  .modal-sertificate, .modal-shops {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -webkit-overflow-scrolling: touch;
    border-radius: 0;
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
    padding: 0 !important;
    max-width: 100%;
  }

  .close-modal {
    right: 20px !important;
  }
}




@media screen and (max-width:600px){
	.slidenav {
		display:block;
		text-align:left;
		font-size: 20px;
		color: orange;
	}
	.slidenav > span {
		cursor:pointer;
		font-weight:bold;
		width: 25px;
		height: 25px;
		display: inline-block;		
	}
	.slidefor {
		float:right;
		right:0px;
	}
	#slideshow-wrap > input, #slideshow-wrap > label {
		display:none !important;
	}
	.item__image {
		margin-top: 50px;
	}
	.superpriceru, .superpriceuk, .topsaleru, .topsaleuk {
	    width: 25%;
	}	
}
@media screen and (max-width:400px){
	.superpriceru,.superpriceuk,.topsaleru,.topsaleuk {
		height: 60%;
	}
	.complectsslide {
		width: 200px;
	    padding: 5px;
	}
	.complects-item{
		font-size: 20px
	}
	input[type=radio]#button-1:checked~.arrows#arrow-2, input[type=radio]#button-2:checked~.arrows#arrow-3, input[type=radio]#button-3:checked~.arrows#arrow-4, input[type=radio]#button-4:checked~.arrows#arrow-5 {
		right: -35px;
	}

	input[type=radio]#button-2:checked~.arrows#arrow-1, input[type=radio]#button-3:checked~.arrows#arrow-2, input[type=radio]#button-4:checked~.arrows#arrow-3, input[type=radio]#button-5:checked~.arrows#arrow-4 {
		left: -35px;
	}
	#slideshow-wrap {
		height:180px;	
	}
	.wrapper.complects{
		margin-bottom: 50px;
	}
	.complects-item {
		display: list-item !important;
		width: 49% !important;
		float: left;
	}
	.complects-item.equalitem{
		clear: left;
		color: orange;
		font-size: 30px;
		font-weight: bold;
		margin-top: 40px;
	}	
	#slideshow-wrap {
		height:initial !important;	
	}	
	.complectsslide {
		display:none;
	}
	.complectsslide.activeslide {
	    display:block;
	}
	.complectsslide {
		width: 70vw;
	}
	.complects-item.product.plusitem::after {
		content: \"+\";
		position: relative;
		right: -5px;
		display: block;
		float: right;
		margin-top: -130%;
		color: orange;
		font-size: 30px;
		font-weight: bold;
	}
}
.btn-info{
    background-color:#f59f08 !important;
}
.btn-info:hover, .btn-info.active, .btn-info:active, .open > .dropdown-toggle.btn-info{
    background-color:#00733a !important;
}

.dropdown-menu > .active > a, .dropdown-menu > .active > a:focus, .dropdown-menu > .active > a:hover{
    background-color:#00733a !important;
}
.modal-overlay-shop .dropdown-menu > li > a:focus, .modal-overlay-shop .dropdown-menu > li > a:hover {
    background-color:#f59f08 !important;
    color: #fff !important;
}
.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:active, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover {
    color: #fff;
}



");
/* 	#slideshow-wrap > label, .wrapper.complects {display:none;}
@media screen and (max-width:900px){
	#slideshow-wrap {
		display:none;
	}	.wrapper.complects::after {
		content: \">\";
		position: absolute;
		margin-top: -100%;
		width: 15px;
		height: 15px;
		right: 18px;
		font-size: 25px;
		z-index: 150;
		color: lightgrey;
	}
	.wrapper.complects::before {
		content: \"<\";
		position: absolute;
		margin-top: 50%;
		width: 15px;
		height: 15px;
		right: 18px;
		font-size: 25px;
		z-index: 150;
		color: lightgrey;
	}
} */
$this->registerCssFile("@web/css/bootstrap-select.min.css");
$this->registerJs("

base_url_add_like = '".Url::to(['/add-like/'])."';

$(document).ready(function() {
    $('i.glyphicon-thumbs-up, i.glyphicon-thumbs-down').click(function(){
        var self = $(this),
        c = self.data('count');
        type = self.attr('data-type');   
        review_id = self.attr('data-id'); 
        id = this.id;
        if (!c) c = 0;
        $.getJSON(base_url_add_like+'?id='+review_id+'&type='+type, function(results) {
          $('#like'+review_id+'-bs3').html(results.likes);
          $('#dislike'+review_id+'-bs3').html(results.dislikes);
          console.log(results);
         });
    });
 /*   $('.partnertitle').on('click','.glyphicon-hand-left',function(){
		$('#w1').toggleClass('active');
		$('#w1 .glyphicon-hand-left').removeClass('glyphicon-hand-left').addClass('glyphicon-hand-down');
	});
    $('.partnertitle').on('click','.glyphicon-hand-down',function(){
		$('#w1').toggleClass('active');
		$('#w1 .glyphicon-hand-down').removeClass('glyphicon-hand-down').addClass('glyphicon-hand-left');		
	}); */
    $('.normtitle').on('click',function(){  
		if ($('.norma .glyphicon').hasClass('glyphicon-hand-left')) {
			$('.norma .glyphicon-hand-left').removeClass('glyphicon-hand-left').addClass('glyphicon-hand-down');
		} else {
			$('.norma .glyphicon-hand-down').removeClass('glyphicon-hand-down').addClass('glyphicon-hand-left');
		}
		$('.norma').toggleClass('active');  		
	});	
    $('.maincharacttitle').on('click',function(){  
		if ($('.maincharact .glyphicon').hasClass('glyphicon-hand-left')) {
			$('.maincharact .glyphicon-hand-left').removeClass('glyphicon-hand-left').addClass('glyphicon-hand-down');
		} else {
			$('.maincharact .glyphicon-hand-down').removeClass('glyphicon-hand-down').addClass('glyphicon-hand-left');
		}
		$('.maincharact').toggleClass('active');  		
	});	
    $('.partnertitle').on('click',function(){  
		if ($('#w1 .glyphicon').hasClass('glyphicon-hand-left')) {
			$('#w1 .glyphicon-hand-left').removeClass('glyphicon-hand-left').addClass('glyphicon-hand-down');
		} else {
			$('#w1 .glyphicon-hand-down').removeClass('glyphicon-hand-down').addClass('glyphicon-hand-left');
		}
		$('#w1').toggleClass('active');  		
	});	

	$(document).on('click','.slidefor',function(){
		if ($('body').width()<600) {
			var curslide = $('.complectsslide.activeslide').data('ciid');
			$('.complectsslide.activeslide').removeClass('activeslide');
			if (curslide==$('#slideshow-inner').data('slid')) {curslide = 1;} else {curslide++;}
			$('.complectsslide[data-ciid='+curslide+']').addClass('activeslide');
		}
	});
	$(document).on('click','.slideback',function(){
		if ($('body').width()<600) { 
			var curslide = $('.complectsslide.activeslide').data('ciid');
			$('.complectsslide.activeslide').removeClass('activeslide');
			if (curslide==1) {curslide = $('#slideshow-inner').data('slid');} else {curslide--;}
			$('.complectsslide[data-ciid='+curslide+']').addClass('activeslide');
		}
	});
});

");
?>



<div class="questionModalContainer modalContainer itemModal">
    <div class="modalLayout"></div>
    <div class="modal">
        <?php $form = ActiveForm::begin(); ?>
            <div class="modal__title"><?=Yii::t('web', 'Вопрос по товару')?></div>
            <div class="modal__close"></div>
            <?=$form->field($question, 'name')->label(false)->error(false)->input('text', ['class' => 'modal__input', 'placeholder' => Yii::t('web', 'Имя').'*', 'required' => ''])?>
            <?=$form->field($question, 'email')->label(false)->error(false)->input('email', ['class' => 'modal__input', 'placeholder' => Yii::t('web', 'Email').'*', 'required' => ''])?>
            <?=$form->field($question, 'phone')->label(false)->error(false)->input('tel', ['class' => 'modal__input', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
            <?=$form->field($question, 'text')->label(false)->error(false)->textArea(['class' => 'modal__textarea', 'placeholder' => Yii::t('web', 'Вопрос по товару').'*', 'required' => ''])?>
            <div id="recaptcha2"></div>
            <input type="submit" class="modal__submit">
        <?php ActiveForm::end(); ?>
    </div>
    <!-- <div class="modalSuccess">
        <div class="modalSuccess__message">Спасибо за Ваше сообщение!
            Мы свяжемся с Вами как можно быстрее.</div>
    </div> -->
</div>
<div  itemscope itemtype="http://schema.org/Product" class="items">
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
             itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>

            <?php foreach ($parents as $parent): ?>
                <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a  itemprop="item"  href="<?=Url::toCategory($parent)?>"> <span itemprop="name"><?=$parent->name?></span> » </a> <meta itemprop="position" content="3" /></li>
             <?php endforeach; ?>


        </ol>
        <div class="itemsSidebar">
            <?= $this->render('/partial/_categories', compact('categories')) ?>

        </div>
        <div class="item">
        <div class="item-image-and-sale" style="text-align: center;
      display: inline-block;
      vertical-align: top;
      position: relative;
      overflow: hidden;
      margin: 0 2%;
      padding-bottom: 40px;
      width: 32%;">
            <?php if (($model->category->delivery===1)||($model->manufacturer->delivery===1)||($model->delivery===1)) : ?>
                <div class="ftruck"></div>
            <?php endif; ?>
			<?php if ($model->super===1) : ?>
				<div class="superprice<?=$lang?>"></div>
			<?php endif; ?>
			<?php if ($model->topsale===1) : ?>
				<div class="topsale<?=$lang?>"></div>
			<?php endif; ?>
            <img class="item__image" itemprop="image" src="<?=$model->image->url?>" title="<?= $model->name ?>" alt="<?= $model->name ?>">
            <?php if (!empty($model->bonus)) : ?>
                <strong class="bonus_line_single_product">+<?= $model->bonus ?> бонусов</strong>
            <?php endif; ?>
            <?php if (1 - $model->discountRate): ?>
                        <div class="itemsList-item-sale">
                            <div class="itemsList-item-sale__percent"><span>-<?=(int)$model->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                            <div class="itemsList-item-sale__old"><span><?=number_format($model->currencyOldPrice, 2)?></span> грн</div>
                            <div class="itemsList-item-sale__rest">
                                <?php if ($model->discount_till): ?>
                                    <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                                    <span><?=$model->discountDaysLeft?></span>
                                    <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
            <?php if(count($model->images)>1):?>
                <a class="btnflip" href="#">
                    <span class="btnflip-item btnflip__front"><?= Yii::t('web', 'Сертификат')?></span>
                    <span class="btnflip-item btnflip__center"></span>
                    <span class="btnflip-item btnflip__back"><?= Yii::t('web', 'Открыть')?></span>
                </a>
            <?php endif;?>
        </div>
            <div class="item-main">
                <h1 itemprop="name" class="item-main__title"><?= $this->params['seoH1'] ?: ($model->seoHeader? $model->seoHeader : $model->category->name . ' | '. $model->name) ?></h1>
                <div class="item-main__id"><?=Yii::t('web','Арт.')?> <?=$model->id?></div>

                <!-- <div class="item-main-visibility">
                    <div class="item-main-visibility__see"><img src="http://hectare.prodevs.com.ua/img/visibility.png" alt=""></div>
                    <div class="item-main-visibility__text">228</div>
                </div> -->
                <form id="form" action="<?=Url::to(['cart/add', 'product_id' => $model->id])?>" method="POST">
                    <div class="item-main-left">
                        <div class="item-main-left-table">
                            <?php foreach ($model->fieldValues as $fieldValue): ?>
                                <div class="item-main-left-table__option"><?=$fieldValue->option->field->name?></div>
                                <div itemprop="brand"  class="item-main-left-table__value"><?=$fieldValue->option->name?></div>
                            <?php endforeach; ?>
                            <?php if ($model->manufacturer): ?>
                                <div class="item-main-left-table__option"><?=Yii::t('web','Производитель')?></div>
                                <span itemprop="brand" class="item-main-left-table__value"><?=$model->manufacturer->name?></span>
                            <?php if ($model->manufacturer->country_id>0) :?>
                                <div class="item-main-left-table__option"><?=Yii::t('web','Страна')?></div>
                                <span class="item-main-left-table__value"><?php echo $country[$model->manufacturer->country_id-1]->name_uk; ?></span>
                             <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($model->dv): ?>
                                <div class="item-main-left-table__option" style="width: 56%;float: left;"><?=Yii::t('web','Действующее вещество')?></div>
                                <span style="width: 42%;"" class="item-main-left-table__value"><?=$model->dvvalue?></span>
                            <?php endif; ?>
                        </div>

                        <div class="item-main-left-additional">
                            <?php if ($model->attributeValues): ?>
                                <?php
                                    $attributes = [];
                                    $attributesValues = [];
                                    $attid = [];
                                    foreach ($model->attributeValues as $attributeValue)
                                    {
                                         //   $ssss= $attributeValue->availabilityStatus;
										$attid[] = $attributeValue->option->attr->id;
                                        $attributes[$attributeValue->option->attr->id] = $attributeValue->option->attr;
                                        $attributesValues[$attributeValue->option->attr->id][] = $attributeValue;
                                    }
                                ?>
                                <?php foreach ($attributesValues as $attributeId=>$attributeOptions): ?>
                                    <div class="item-main-left-additional__option"><?=$attributes[$attributeId]->name?></div>
                                    <select class="item-main-left-additional__select product_attribute_select" name="attrs[<?=$attributeId?>]">
                                        <?php foreach ($attributeOptions as $attributeValue): ?>
                                            <option
                                                value="<?=$attributeValue->id?>"
                                                data-price="<?=number_format($attributeValue->currencyPrice,2)?>"
                                                data-old-price="<?=number_format($attributeValue->currencyOldPrice, 2) ?>"
                                                data-opt_uk="<?=$attributeValue->currencyOptPrice?>"
                                                data-opt="<?=$attributeValue->opt?>"
                                                data-opt_uk1="<?=$attributeValue->currencyOptPrice1?>"
                                                data-opt1="<?=$attributeValue->opt1?>"
                                                data-status="<?php if($attributeValue->availabilityStatus !='') echo $attributeValue->availabilityStatus->getName()?>"
                                                >
                                                <?=$attributeValue->option->name?>

                                            </option>

                                        <?php endforeach; ?>
                                    </select>

                                <?php endforeach; ?>

                                <?php $this->registerJs("
                                    $(document).ready(function(){

                                        ykazatel = \"".$model->ykazatel."\";
                                        text = \"".Yii::t('web','при заказе от')."\";
                                        opt = $('.product_attribute_select').find(':checked').data('opt');
                                        opt_uk = $('.product_attribute_select').find(':checked').data('opt_uk');
                                        opt1 = $('.product_attribute_select').find(':checked').data('opt1');
                                        opt_uk1 = $('.product_attribute_select').find(':checked').data('opt_uk1');
                                        

                                        opt_row = '';
                                        if ((opt !== '' && opt !== 0) && (opt_uk !== '' && opt_uk !== 0)) {
                                            opt_row = '<p style=\"margin-top: 14px;color:#898989;    font-family: \'OpenSans Regular\', sans-serif;\">'+opt_uk+' грн'+(((ykazatel !== '0') && (ykazatel !== ''))? '/'+ykazatel:'') + ' ' + text + ' '+opt + (((ykazatel !== '0') && (ykazatel !== ''))? ' '+ykazatel:'')+'</p>';

                                         }

                                        opt_row1 = '';
                                        if ((opt1 !== '' && opt !== 0) && (opt_uk1 !== '' && opt_uk1 !== 0)) {
                                            opt_row1 = '<p style=\"margin-top: 14px;color:#898989;    font-family: \'OpenSans Regular\', sans-serif;\">'+opt_uk1+' грн'+(((ykazatel !== '0') && (ykazatel !== ''))? '/'+ykazatel:'') + ' ' + text + ' '+opt1 + (((ykazatel !== '0') && (ykazatel !== ''))? ' '+ykazatel:'')+'</p>';
                                        }
                                        opt_row = opt_row + opt_row1;

                                        $('.opt').html(opt_row);
                                        if($('.product_attribute_select').find('option:first-child').data('status') != ''){
                                            $('.item-main-right__availability').text($('.product_attribute_select').find('option:first-child').data('status'));
                                        }
                                        $('.price_placeholder').text($('.product_attribute_select').find('option:first-child').data('price'));
                                        $('.item-main-right__oldPrice span').text($('.product_attribute_select').find('option:first-child').data('old-price')+' грн');
                                        $('.itemsList-item-sale__old span').text($('.product_attribute_select').find('option:first-child').data('old-price')+' грн');

                                        $('.product_attribute_select').change(function() {
                                            $('.price_placeholder').text($(this).find(':checked').data('price'));
                                            $('.item-main-right__oldPrice span').text($(this).find(':checked').data('old-price')+' грн');
                                            $('.itemsList-item-sale__old span').text($(this).find(':checked').data('old-price')+' грн');
                                            if($(this).find(':checked').data('status') !=''){
                                                $('.item-main-right__availability').text($(this).find(':checked').data('status'));
                                            }
                                            var opt = $(this).find(':checked').data('opt');
                                            var opt_uk = $(this).find(':checked').data('opt_uk');
                                            var opt1 = $(this).find(':checked').data('opt1');
                                            var opt_uk1 = $(this).find(':checked').data('opt_uk1');

                                            opt_row = '';
                                            if ((opt !== '' && opt !== 0) && (opt_uk !== '' && opt_uk !== 0)) {
                                               opt_row = '<p style=\"margin-top: 14px;color:#898989;    font-family: \'OpenSans Regular\', sans-serif;\">'+opt_uk+' грн'+(((ykazatel !== '0') && (ykazatel !== ''))? '/'+ykazatel:'') + ' ' + text + ' '+opt + (((ykazatel !== '0') && (ykazatel !== ''))? ' '+ykazatel:'')+'</p>';
                                            }
                                            opt_row1 = '';
                                            if ((opt1 !== '' && opt !== 0) && (opt_uk1 !== '' && opt_uk1 !== 0)) {
                                                opt_row1 = '<p style=\"margin-top: 14px;color:#898989;    font-family: \'OpenSans Regular\', sans-serif;\">'+opt_uk1+' грн'+(((ykazatel !== '0') && (ykazatel !== ''))? '/'+ykazatel:'') + ' ' + text + ' '+opt1 + (((ykazatel !== '0') && (ykazatel !== ''))? ' '+ykazatel:'')+'</p>';
                                            }
                                            opt_row = opt_row + opt_row1;

                                            $('.opt').html(opt_row);


                                        });
                                    });
                                "); ?>
                            <?php endif; ?>
                            <div class="item-main-left-additional__option"><?=Yii::t('web','Количество')?></div>
                            <input type="text" class="item-main-left-additional__input" value="1" name="amount">
                            <?php if ($pRating = round($model->rating)): ?>
                                <div class="item-main-left-additional__option"><?=Yii::t('web','Оцінка')?></div>
                                <span class="rating-wrap">
                                    <span class="rating-star">
                                        <?php for($i = 1; $i <= $pRating; $i++): ?>
                                            <span>★</span>
                                        <?php endfor; ?>
                                        <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                                            <span>☆</span>
                                        <?php endfor; ?>
                                    </span>
                                    <a href="#" class="count-rating-star"><?= Helper::pluralForm(count($model->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
                                </span>

                                <div style="display: none;">
                                    <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                        <span itemprop="ratingValue"><?=$pRating;?></span>
                                        <span itemprop="bestRating"><?=$model->bestRating;?></span>
                                        <span itemprop="ratingCount"><?=count($model->reviews);?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="product-view-additionals">
                            <?php if (($model->category->delivery===1)||($model->manufacturer->delivery===1)||($model->delivery===1)) : ?>
								<div class="item-main-left-additional block-position left-position">
									<div class="item-main-left-additional__option">
										<div class="proddost header-mid-menu-left-item_img"></div>
										<div class="proddosttext header-mid-menu-left-item_text"><?=Yii::t('web','Бесплатная доставка')?></div>
									</div>
                                  </div>
                            <?php endif; ?>
                            <?php if ($model->manufacturer->opps===1 || $model->manufacturer->off_partner===1) : ?>
                                <div class="item-main-left-additional block-position right-position">
                                    <div class="item-main-left-additional__option con-tooltip top">
                                        <div class="proddost header-mid-menu-right-partner"></div>
                                        <div class="tooltip-partner">
                                                <div class="text-center">
                                                    <?php if($model->manufacturer->opps===1):?><?=Yii::t('web','Официальный дистрибьютор');?>
                                                    <?php elseif($model->manufacturer->off_partner===1):?><?=Yii::t('web','Официальный партнер');?>
                                                    <?php endif;?>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                    <div class="item-main-right">
                        <?php if (1 - $model->discountRate): ?>
                            <div class="item-main-right__oldPrice"><?=Yii::t('web','Старая цена')?> <span><?=number_format($model->currencyOldPrice, 2)?> грн</span></div>
                            <div class="item-main-right__rest"> <span><?=$model->discountDaysLeft?></span> <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?> <?=Yii::t('web','до завершения акции')?></div>
                        <?php endif; ?>
                        <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="UAH" />
                            <div class="item-main-right__price"><span itemprop="price" class="price_placeholder"><?=number_format($model->currencyPrice, 2, '.', '')?></span>

                            <br>грн<?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''): ?><span > / <?=$model->ykazatel;?></span><?php endif; ?></div>

                            <?php if ($model->is_in_stock): ?>
                                <div itemprop="availability" class="item-main-right__availability"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Есть в наличии')?></div>
                            <?php elseif ($model->is_over): ?>
                                <div itemprop="availability" class="item-main-right__availability" style="color: red"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Заканчиваеться')?></div>
                            <?php elseif ($model->price_specify): ?>
                                <div itemprop="availability" class="item-main-right__availability"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Цену уточнять')?></div>
                            <?php elseif ($model->is_suspended): ?>
                                <div itemprop="availability" class="item-main-right__availability" style="color: red"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Приостановлена продажа')?></div>
                            <?php elseif ($model->under_the_order): ?>
                                <div itemprop="availability" class="item-main-right__availability" style="color: red"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Под заказ')?></div>

                            <?php else: ?>
                                <div class="item-main-right__nonAvailability" style="color: black"><link itemprop="availability" href="http://schema.org/InStock"/><?=Yii::t('web','Нет в наличии')?></div>
                            <?php endif; ?>
                        </span>

                        <div class="item-main-right__optCost opt"></div>

                        <input id="purchaseType" type="hidden" value="0" name="purchaseType">

                        <div class="raw type-buy">
                            <button id="buy" class="item-main-right__submit" style="width:88px;"><?=Yii::t('web','Купить')?></button>
                            <button id="credit" type="button" class="item-main-right__submit" style="background: #f59f08; width:160px;"><?=Yii::t('web','Купить в кредит')?></button>
                            <?php if(Yii::$app->user->identity->ctype == 2):?>
                                <button id="shop-stocks" type="button" class="item-main-right__submit" style="background: #f59f08; width:100%; height: 50px;font-size: 14px;line-height: 18px;"><?=Yii::t('web','Посмотреть остатки на магазинах')?></button> <!--Посмотреть остатки на магазинах-->
                            <?php else: ?>
                                <button id="buy-shop" type="button" class="item-main-right__submit" style="background: #f59f08; width:100%; height: 50px;font-size: 14px;line-height: 18px;"><?=Yii::t('web','Зарезервируйте на сайте, заберите в магазине')?></button>
                            <?php endif;?>
                        </div>

                        <a href="#" class="item-main-right__ask questionButton"><?=Yii::t('web','Задать вопрос по товару')?></a>

                        <?php $this->registerJs("
							remove_cart_text = '".Yii::t('web', 'Действительно удалить?')."';
							remove_cart_link = '".Url::to(['cart/remove'])."';
						");
						$this->registerJsFile('/web/js/cart.js');
						$this->registerJs("
							$(document).ready(function(){
								$('.questionButton').on('click', function(e) {
									e.preventDefault();
									$('.questionModalContainer').css('display','flex');
									$('.questionModalContainer.modalContainer.itemModal .modal').css('display','block');
								});
								$('#credit').on('click', function(e) {
									$('#purchaseType').val('1');
									e.preventDefault();
									credit_buy_submit(form);
									return false;
								});

								$('#buy').on('click', function(e) {
									$('#purchaseType').val('0');
									e.preventDefault(); 
									credit_buy_submit(form);
								    console.log(form);
									return false;
								});
								
								$('#buy-shop').on('click', function(e) {
									$('#purchaseType').val('0');
									e.preventDefault(); 
									credit_buy_submit(form);
									return false;
								});
							});
						");?>
                    </div>
                </form>
                <?php if (count($norm)>0) { ?>
                <div class="norma">
					<h3 class="normtitle"><?=Yii::t('web','Нормы затрат препарата')?><i class="glyphicon glyphicon-hand-left"></i></h3>
					<table>
						<tr>
							<td>
								<?=Yii::t('web','Культура')?>
							</td>
							<td>
								<?=Yii::t('web','Нормы затрат препарата')?>, кг/га
							</td>
						</tr>
					<?php foreach($norm as $n) {?>
						<tr class="test">
							<td>
								<?php echo $plants[$n['plant_id']]->{($lang=='uk')?'name_'.$lang:'name'} ?>
							</td>
							<td>
								<?php echo $n->norma; ?>
							</td>
						</tr>
					<?php } ?>
					</table>
				</div>
                <?php } ?>

                <?php if ((count($maincharact)>0) && (($model->{'category_id'} == 2)||($model->category->{'parent_id'} == 2))) { ?>
                <div class="maincharact">
					<h3 class="maincharacttitle"><?=Yii::t('web','Основные характеристики')?><i class="glyphicon glyphicon-hand-left"></i></h3>
					<table>
						<tr>
							<td>
								<?=Yii::t('web','Наименование')?>
							</td>
							<td>
								<?=Yii::t('web','Значение')?>
							</td>
						</tr>
					<?php foreach($maincharact as $n) {?>
						<tr>
							<td>
								<?php echo $n['name_'.$lang]; ?>
							</td>
							<td>
								<?php echo $n->val; ?>
							</td>
						</tr>
					<?php } ?>
					</table>
				</div>
                <?php } ?>

                <?php $form = ActiveForm::begin(['options' => ['class' => 'item-main-form']]); ?>
					<h3 class="partnertitle"><?=Yii::t('web','Узнать партнерские цены')?><i class="glyphicon glyphicon-hand-left"></i></h3>
                    <?=Html::activeInput('text', $enquiry, 'name', ['class' => 'item-main-form__input item-main-form__input-margin', 'placeholder' => Yii::t('web','Имя').'*', 'required' => ''])
                    ?><?=Html::activeInput('email', $enquiry, 'email', ['class' => 'item-main-form__input item-main-form__input-margin', 'placeholder' => Yii::t('web','E-mail')])
                    ?><?=Html::activeInput('tel', $enquiry, 'phone', ['class' => 'item-main-form__input', 'placeholder' => Yii::t('web','Телефон').'*', 'required' => ''])?>
                    <div id="recaptcha3"></div>
                    <input type="submit" class="item-main-form__submit" value="<?=Yii::t('web', 'Отправить')?>">
                <?php ActiveForm::end(); ?>
            </div>
            <div class="tabs">
                <ul class="tabs-control">
                    <li class="tabs-control__item active"><h2><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Описание')?></h2></a> </li>
                    <li class="tabs-control__item"><h2><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Похожие товары')?></h2></a> </li>
                    <li class="tabs-control__item"><h2><a id="review-tab" href="" class="tabs-control__item_link"><?=Yii::t('web', 'Отзывы')?>&nbsp;(<?=count($reviews)?>)</h2></a>
                    <!-- ЗДЕСЬ ВЫВОДИТЬ СЧЕТЧИК ОТЗЫВОВ / КОЛЯ
                        <p class="tabs-control__item_number">(+1)</p>
                    -->
                    </li>
                    <li class="tabs-control__item"><h2><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Покупают вместе')?></h2></a> </li>
                    <li class="tabs-control__item"><h2><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Доставка')?> <?=Yii::t('web', 'и оплата')?></h2></a> </li>
                </ul>
                <ul class="tabs-list">
                    <li  itemprop="description" class="tabs-list__item active"><div class="test"><?=$model->description?></div></li>
                    <li class="tabs-list__item">
                        <ul class="simularList">
                            <?php foreach ($model->suggestedProducts as $suggestedProduct): ?>
                                <?php $url = Url::toProduct($suggestedProduct); ?>
                                <li class="simularList-item col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <a href="<?=$url?>" class="simularList-item__img" style="background-image:url('<?=$suggestedProduct->image->url?>')"></a>
                                    <div class="simularList-item__title"><a href="<?=$url?>"><?=$suggestedProduct->name?></a></div>
                                    <div class="simularList-item__from"><?=$suggestedProduct->manufacturer?$suggestedProduct->manufacturer->name:null?></div>
                                    <div class="simularList-item__price"><?=number_format($suggestedProduct->currencyPriceForAttribute, 2)?> грн</div>
                                    <div class="simularList-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="tabs-list__item">
                        <ul class="reviews-list">
                            <?php foreach ($reviews as $i=>$_review): ?>
                                <li  itemprop="review" itemscope itemtype="http://schema.org/Review"  class="reviews-list-item" data-uid="<?=$_review->user_id ?>">
                                <div class="reviews-list-item-header">
                                    <span class="reviews-list-item-header__id">#<?=$i+1?></span>
                                    <meta content="<?=$model->name?>" itemprop="name">
                                    <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                                       <span class="reviews-list-item-header__from" itemprop="name">
											<?php /* if ((int)($_review->user_id) < 3) { ?>
											<?=Yii::t('web', 'Администрация Гектар')?>
											<?php } else { */ ?>
												<?=$_review->name?>
											<?php /* } */ ?>
										</span>
                                    </span>
                                    <div style="display: none;">
                                        <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                            <span itemprop="ratingValue"><?=$_review->rating;?></span>
                                        </div>
                                    </div>
                                    <span class="rating-star">
                                        <?php $pRating = $_review->rating; ?>
                                        <?php for($i = 1; $i <= $pRating; $i++): ?>
                                            <span>★</span>
                                        <?php endfor; ?>
                                        <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                                            <span>☆</span>
                                        <?php endfor; ?>
                                    </span>
                                    <div class="reviews-list-item-header__date"><!--$_review->posted_at--></div>
                                    <span class="like-span">
                                        <i id="like<?=$_review->id ?>" data-type="1" data-id="<?=$_review->id ?>" class="glyphicon glyphicon-thumbs-up"></i>
                                        <div class="like-value" id="like<?=$_review->id ?>-bs3"><?=count($_review->likes) ?></div>
                                        <i id="dislike<?=$_review->id ?>" data-type="0" data-id="<?=$_review->id ?>" class="glyphicon glyphicon-thumbs-down"></i>
                                        <div class="like-value" id="dislike<?=$_review->id ?>-bs3"><?=count($_review->dislikes) ?></div>
                                    </span>
                        <?php /* if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id != $_review->user_id): */ ?>
							<div class="glyphicon glyphicon-comment" title="<?=Yii::t('web', 'Ответить на комментарий')?>" data-id="<?=$_review->id ?>"></div>
                        <?php /* endif; */ ?>
                                    </div>
                                    <meta itemprop="datePublished" content="<?=$_review->posted_at?>">
                                    <div itemprop="reviewBody" class="reviews-list-item__content">
                                    <?=$_review->text?>
                                    </div>
                                        <!-- <div class="reviews-list-item__rate">+1</div> -->
         <div class="messagecomment hidden"  id="messagecomment<?=$_review->id ?>">
            <?php $form = ActiveForm::begin() ?>
                <?=$form->field($review, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
                <?=$form->field($review, 'parent_id')->label(false)->error(false)->input('hidden', ['class' => 'message__input', 'required'=>'', 'style'=>'display:none']) ?>
               <!-- <?=$form->field($review, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>-->

               <?=$form->field($review, 'phone', ['inputOptions' => ['id' => 'phone_id']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999',])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'style'=>'display:none', 'value'=>'+38(111)11-11-111', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
                <?=$form->field($review, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
                <input type="hidden" name="chk" id="chk" value="chk">
                <div class="text-center btnsblock">
					<input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
					<input type="button" class="message_cancel" value="<?=Yii::t('web', 'Отменить')?>">
				</div>
            <?php ActiveForm::end() ?>

        </div>
                    <?php foreach ($_review->replies as $reply): ?>
                        <div class="reviews-list-item__content_reply" data-uid="<?=$reply->user_id ?>">
							<?php if ($reply->user_id<3) { ?>
							<div class="rewiewlabel"><?=$reply->name;?></div>
							<?php } ?>
                            <?=$reply->text?>
                        </div>
                    <?php endforeach; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="message">
                            <?php $form = ActiveForm::begin() ?>
                                <div class="message__title"><?=Yii::t('web', 'Оставить отзыв')?></div>
                                <?=$form->field($review, 'name')->label(false)->error(false)->input('text', ['class' => 'registration__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
                                <?=$form->field($review, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999' ])->label(false)->error(false)->textInput(['class' => 'registration__input', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>


                               <!-- <?= $form->field($review, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>-->
                                <?=$form->field($review, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
                                <div class="message__rating"><?=$form->field($review, 'rating')->label(Yii::t('web','Оцінка'))->radioList([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]) ?></div>
                                <div id="recaptcha4"></div>
                                <input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
                            <?php ActiveForm::end() ?>
                        </div>
                    </li>
					<li class="tabs-list__item">
			            <div class="wrapper7">
							<?php if ($model->alsobuyProducts): ?>
							<?php /*	<ul class="shares-list">
									<?php foreach ($model->alsobuyProducts as $alsobuyProduct): ?>
										<li class="shares-list-item">
											<div class="shares-list-item__img" style="background-image:url('<?=$alsobuyProduct->image->url?>')"></div>
											<div class="shares-list-item__title"><a href="<?=Url::toProduct($alsobuyProduct)?>"><?=$alsobuyProduct->name?></a></div>
											<div class="shares-list-item__from"><?=$alsobuyProduct->manufacturer?$alsobuyProduct->manufacturer->name:null?></div>
											<div class="shares-list-item__rating">
												<?php $pRating = count($alsobuyProduct->reviews) ? round(array_sum(ArrayHelper::getColumn($alsobuyProduct->reviews, 'rating')) / count($alsobuyProduct->reviews)) : 0; ?>
												<span class="rating-star item-list__rating">
													<?php for($i = 1; $i <= $pRating; $i++): ?>
														<span>★</span>
													<?php endfor; ?>
													<?php for($i = $pRating + 1; $i <= 5; $i++): ?>
														<span>☆</span>
													<?php endfor; ?>
												</span>
												<a href="<?=Url::toProduct($alsobuyProduct).'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($alsobuyProduct->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
											</div>
											<div class="shares-list-item__price"><?=number_format($alsobuyProduct->currencyPrice, 2)?> грн</div>
											<div class="shares-list-item__more"><a href="<?=Url::toProduct($alsobuyProduct)?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
										</li>
									<?php endforeach; ?>
								</ul> */ ?>
								<ul class="simularList">
									<?php foreach ($model->alsobuyProducts as $alsobuyProduct): ?>
										<?php $url = Url::toProduct($alsobuyProduct); ?>
										<li class="simularList-item col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<a href="<?=$url?>" class="simularList-item__img" style="background-image:url('<?=$alsobuyProduct->image->url?>')"></a>
											<div class="simularList-item__title"><a href="<?=$url?>"><?=$alsobuyProduct->name?></a></div>
											<div class="simularList-item__from"><?=$alsobuyProduct->manufacturer?$alsobuyProduct->manufacturer->name:null?></div>
											<div class="simularList-item__price"><?=number_format($alsobuyProduct->currencyPrice, 2)?> грн</div>
											<div class="simularList-item__more"><a href="<?=$url?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</li>
					<li class="tabs-list__item">
						<h2><?=Yii::t('web', 'Схема работы')?></h2>
						<ul class="delivery-list">
							<li class="delivery-list-item">
								<div class="delivery-list-item__img"></div>
								<div class="delivery-list-item__description">
									<?=$this->context->siteInfo->{'dostavka1'.$lang1}?>
								</div>
							</li>
							<li class="delivery-list-item delivery-list-item_2">
								<div class="delivery-list-item__img"></div>
								<div class="delivery-list-item__description">
									<?=$this->context->siteInfo->{'dostavka2'.$lang1}?>
								</div>
							</li>
							<li class="delivery-list-item delivery-list-item_3">
								<div class="delivery-list-item__img"></div>
								<div class="delivery-list-item__description">
									<?=$this->context->siteInfo->{'dostavka3'.$lang1}?>
								</div>
							</li>
							<li class="delivery-list-item delivery-list-item_4">
								<div class="delivery-list-item__img"></div>
								<div class="delivery-list-item__description">
									<?=$this->context->siteInfo->{'dostavka4'.$lang1}?>
								</div>
							</li>
							<li class="delivery-list-item delivery-list-item_5">
								<div class="delivery-list-item__img"></div>
								<div class="delivery-list-item__description">
									<?=$this->context->siteInfo->{'dostavka5'.$lang1}?>
								</div>
							</li>
							<li class="delivery-list-item delivery-list-item_6">
								<div class="delivery-list-item__img"></div>
								<div class="delivery-list-item__description">
									<?=$this->context->siteInfo->{'dostavka6'.$lang1}?>
								</div>
							</li>
						</ul>
					</li>
                </ul>
            </div>
        </div>
        <div class="shares">
          <?php /*  <div class="wrapper">
				<div class="shares__title"><?=Yii::t('web', 'Вместе с этим товаром покупают')?></div>
				<div class="alsobuy_tab">
					<div class="sprite-side slider-al similar-goods-slider-al" data-direction="left" >
						<img src="/img/_.gif" width="17" height="49" alt="<" class="sprite slider-al-icon">
					</div>
					<div class="sprite-side slider-ar similar-goods-slider-ar" data-direction="right" >
						<img src="/img/_.gif" width="17" height="49" alt=">" class="sprite slider-ar-icon">
					</div>
					<ul class="alsobuyList" style="width:<?php echo count($model->alsobuyProducts)*180; ?>px">
						<?php foreach ($model->alsobuyProducts as $alsobuyProduct): ?>
							<?php $url = Url::toProduct($alsobuyProduct); ?>
							<li class="alsobuyList-item text-center">
								<a href="<?=$url?>" class="alsobuyList-item__img" style="background-image:url('<?=$alsobuyProduct->image->url?>')"></a>
								<div class="alsobuyList-item__title">
									<a href="<?=$url?>"><?=$alsobuyProduct->name?></a>
								</div>
								<div class="alsobuyList-item__from">
									<?=$alsobuyProduct->manufacturer?$alsobuyProduct->manufacturer->name:null?>
								</div>
								<div class="alsobuyList-item__price">
									<?=number_format($alsobuyProduct->currencyPrice, 2)?> грн
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>	*/ ?>

            <div class="wrapper complects">
				<?php if ($cc = count($complects)): ?>
					<?php /* <div class="shares__title"><?=Yii::t('web', 'Вместе дешевле')?></div>				 */ ?>
					<div id="slideshow-wrap">
						<div class="cheaperhead"><?=Yii::t('web', 'Вместе дешевле')?></div>
						<?php
							$fl = true;
							for ($k=1;$k<=$cc;$k++) {
						?>
						<input type="radio" class="complectsbutton" id="button-<?=$k?>" name="controls" <?php if ($fl) {echo 'checked="checked"';$fl = false;} ?> />
						<label for="button-<?=$k?>"></label>
						<?php } ?>
						<?php
							$fl = true;
							for ($k=1;$k<=$cc;$k++) {
						?>
						<label for="button-<?=$k?>" class="arrows" id="arrow-<?=$k?>">></label>
						<?php } ?>
						<?php $fl = true; $slid = count($complects); $si = 0; ?>
						<div class="slidenav"><span class="slideback">&lt;</span>&nbsp;<span class="slidefor">&gt;</span></div>
						<div id="slideshow-inner" data-slid="<?=$slid?>">
							<ul class="list">

								<?php foreach ($complects as $c): ?>
									<?php $si++; ?>
									<div class="complectsslide complectsslide<?=$c['id']?><?php if ($fl) {echo ' activeslide ';$fl = false;} ?>" data-cid="<?=$c['id']?>" data-ciid="<?=$si?>">
										<?php $sumcomplect = 0;  ?>
										<?php $sumcomplectold = 0;  ?>
                                        <?php $positionForSlider = 0;  ?>
                                        <?php $active = 0;  ?>
<!--										--><?php //$this->registerCss(".complectsslide". $c['id'] ." .complects-item {width:". round((100/(count($c['products'])))) ."vw;}"); ?>
										<?php $last = count($c['products']); ?>

										<?php foreach($c['products'] as $i=>$p) { ?>





                                        <?php if( $positionForSlider == 0 && $p['slider'] == 1):?>
                                        <?php $mult = (isset($p['attribute']->option->multiplier))?($p['attribute']->option->multiplier/10000):1; ?>
                                        <?php $sumcomplect += $p['attribute']->getCurrencyPrice() * $mult * (1-$p['discount']/100); ?>
                                        <?php $sumcomplectold += $p['attribute']->getCurrencyPrice() * $mult; ?>
                                        <?php $positionForSlider++; ?>
                                        <div id="myCarousel" class="vertical-slider carousel vertical slide complects-item product" data-ride="carousel" data-interval="false">
                                            <div class="row">
                                                <span data-slide="next" class="btn-vertical-slider glyphicon glyphicon-chevron-up" style="font-size: 30px"></span>
                                            </div>
                                            <div class="carousel-inner">

                                                <?php foreach($c['products'] as $j=>$pp): ?>

                                                <?php if($pp['slider'] == 1):?>
                                                <?php $mult2 = (isset($pp['attribute']->option->multiplier))?($pp['attribute']->option->multiplier/10000):1; ?>
                                                <div class="item <?= $active == 0 ? 'active':'' ?>" style="width: 100%">
                                                    <div class="row">

                                                        <div class="complects-item product <?= $active == 0 ? 'in-cart':'' ?> <?=($j<$last-1)?'plusitem':''?>" data-attr="<?=$pp['attribute']->id?>" data-opt="<?=$pp['attribute']->option->id?>" data-pid="<?=$pp['product']->id?>">
                                                            <div class="shares-list-item__discount<?=($pp['discount']>0)?(' activedis">-'.$pp['discount'] .'%'):'">'?></div>
                                                        <div class="shares-list-item__img" style="background-image:url('<?=$pp['product']->image->url?>')"></div>
                                                        <div class="shares-list-item__title"><a href="<?=Url::toProduct($pp['product'])?>"><?=$pp['product']->name?></a></div>
                                                        <div class="shares-list-item__add"><?=$pp['attribute']->option->name?></div>

                                                        <?php if ($p['discount'] > 0) {?>
                                                            <div class="shares-list-item__price shares-list-item__oldprice"><?=number_format($pp['attribute']->getCurrencyPrice() * $mult2, 2)?> грн</div>
                                                            <div class="shares-list-item__price shares-list-item__newprice"><?=number_format($pp['attribute']->getCurrencyPrice() * $mult2 * (1-$pp['discount']/100), 2)?> грн</div>
                                                        <?php } else { ?>
                                                            <div class="shares-list-item__price shares-list-item__newprice"><?=number_format($pp['attribute']->getCurrencyPrice() * $mult2, 2)?> грн</div>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $active++; endif;?>
                                            <?php  endforeach;?>



                                        </div>
                                        <div class="row">
                                            <span data-slide="prev" class="btn-vertical-slider glyphicon glyphicon-chevron-down" style="font-size: 30px"></span>
                                        </div>
                                    </div>
                            <?php endif;?>









                                <?php if($p['slider'] == 0):?>
                                <?php $mult = (isset($p['attribute']->option->multiplier))?($p['attribute']->option->multiplier/10000):1; ?>
                                <?php $sumcomplect += $p['attribute']->getCurrencyPrice() * $mult * (1-$p['discount']/100); ?>
                                <?php $sumcomplectold += $p['attribute']->getCurrencyPrice() * $mult; ?>
                                            <div class="complects-item product in-cart <?=($i<$last-1)?'plusitem':''?>" data-attr="<?=$p['attribute']->id?>" data-opt="<?=$p['attribute']->option->id?>" data-pid="<?=$p['product']->id?>">
                                                <div class="shares-list-item__discount<?=($p['discount']>0)?(' activedis">-'.$p['discount'] .'%'):'">'?></div>
                                                <div class="shares-list-item__img" style="background-image:url('<?=$p['product']->image->url?>')"></div>
                                                <div class="shares-list-item__title"><a href="<?=Url::toProduct($p['product'])?>"><?=$p['product']->name?></a></div>
                                                <div class="shares-list-item__add"><?=$p['attribute']->option->name?></div>

                                                <?php if ($p['discount'] > 0) {?>
                                                <div class="shares-list-item__price shares-list-item__oldprice"><?=number_format($p['attribute']->getCurrencyPrice() * $mult, 2)?> грн</div>
                                                <div class="shares-list-item__price shares-list-item__newprice"><?=number_format($p['attribute']->getCurrencyPrice() * $mult * (1-$p['discount']/100), 2)?> грн</div>
                                                <?php } else { ?>
                                                <div class="shares-list-item__price shares-list-item__newprice"><?=number_format($p['attribute']->getCurrencyPrice() * $mult, 2)?> грн</div>

                                                <?php } ?>
                                            </div>
                                        <?php endif;?>
										<?php }?>

									<?php /*
										<div class="complects-item">
											<div class="shares-list-item__img" style="background-image:url('<?=$model->image->url?>')"></div>
											<div class="shares-list-item__title"><a href="<?=Url::toProduct($model)?>"><?=$model->name?></a></div>
										<?php /*	<div class="shares-list-item__add">

													if ($model->attributeValues){
														echo $attributesValues[$attid[0]]->option->name;
													}

											</div>	* /	?>
											<div class="shares-list-item__price"><?=number_format($model->currencyPrice, 2)?> грн</div>
										</div>
										<div class="complects-item">
											+
										</div>
										<div class="complects-item">
											<div class="shares-list-item__img" style="background-image:url('<?=$c['pair']->image->url?>')"></div>
											<div class="shares-list-item__title"><a href="<?=Url::toProduct($c['pair'])?>"><?=$c['pair']->name?></a></div>
											<div class="shares-list-item__price"><?=number_format($c['pair']->currencyPrice, 2)?> грн</div>
										</div>
										*/ ?>
										<div class="complects-item equalitem">
											=
										</div>
										<div class="complects-item">
											<div class="inbuy">
												<div class="shares-list-item__price shares-list-item__oldprice"><?=number_format($sumcomplectold, 2)?> грн</div>
												<div class="shares-list-item__price shares-list-item__newprice"><?=number_format($sumcomplect, 2)?> грн</div>
												<button data-cid="<?=$c['id'] ?>" class="buycomplect item-main-right__submit"><?=Yii::t('web','Купить')?> комплект</button>
											</div>
										</div>

									</div>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
                <?php endif; ?>
            </div>


            <div class="wrapper">
                <?php if ($lastViewedProducts): ?>
                    <div class="shares__title"><?=Yii::t('web', 'Ранее вы смотрели')?></div>
                    <ul class="shares-list">
                        <?php foreach ($lastViewedProducts as $lastViewedProduct): ?>
                            <li class="shares-list-item">
                                <div class="shares-list-item__img" style="background-image:url('<?=$lastViewedProduct->image->url?>')"></div>
                                <div class="shares-list-item__title"><a href="<?=Url::toProduct($lastViewedProduct)?>"><?=$lastViewedProduct->name?></a></div>
                                <div class="shares-list-item__from"><?=$lastViewedProduct->manufacturer?$lastViewedProduct->manufacturer->name:null?></div>
                                <div class="shares-list-item__rating">
                                    <?php $pRating = count($lastViewedProduct->reviews) ? round(array_sum(ArrayHelper::getColumn($lastViewedProduct->reviews, 'rating')) / count($lastViewedProduct->reviews)) : 0; ?>
                                    <span class="rating-star item-list__rating">
                                        <?php for($i = 1; $i <= $pRating; $i++): ?>
                                            <span>★</span>
                                        <?php endfor; ?>
                                        <?php for($i = $pRating + 1; $i <= 5; $i++): ?>
                                            <span>☆</span>
                                        <?php endfor; ?>
                                    </span>
                                    <a href="<?=Url::toProduct($lastViewedProduct).'#review-tab'?>" class="count-rating-star"><?= Helper::pluralForm(count($lastViewedProduct->reviews), [Yii::t('web', 'відгук'), Yii::t('web', 'відгука'), Yii::t('web', 'відгуків')]); ?></a>
                                </div>
                                <div class="shares-list-item__price"><?=$lastViewedProduct->currencyPriceForAttribute != 0 ? number_format($lastViewedProduct->currencyPriceForAttribute,2) : number_format($lastViewedProduct->currencyPrice, 2)?> грн</div>
                                <div class="shares-list-item__more"><a href="<?=Url::toProduct($lastViewedProduct)?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>
<div class="space"></div>

<?php if(count($model->images)>1):?>
    <div class="modal-overlay">
        <div class="modal-sertificate">

            <a class="close-modal">
                <svg viewBox="0 0 20 20">
                    <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                </svg>
            </a><!-- close modal -->

            <div class="modal-content">
                <?php for($i=1; $i< count($model->images); $i++):?>
                    <img class="item__image" itemprop="image" style="width: 40%" src="<?=$model->images[$i]->url?>" title="<?= $model->name ?>" alt="<?= $model->name ?>" oncontextmenu="return false;">
                <?php endfor;?>
            </div><!-- content -->

        </div><!-- modal -->
    </div><!-- overlay -->
<?php endif;?>
<?php if(Yii::$app->user->identity->ctype != 2):?>
    <div class="modal-overlay-shop">
        <div class="modal-shops">

            <a class="close-modal">
                <svg viewBox="0 0 20 20">
                    <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                </svg>
            </a><!-- close modal -->
            <p class="modal-header"><?= Yii::t('web', 'Забрать в магазине')?></p>
            <div class="modal-content">
                <div class="shops-header">
                    <div class="shops-header-left">

                        <p class="modal-desc"><?=Yii::t('web','Населенные пункты:')?></p>
                        <div class="row mobile-shops">
                            <div class="col-md-6 col-xs-12 text-left select-for-mobile">

                                <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>
                                <select class="selectpicker" data-size="7" data-style="btn-info" data-live-search="true" data-none-results-text="<?=Yii::t('web','Не удалось найти н.п.: ')?>{0}">
                                    <option value="default" selected="selected"><?=Yii::t('web',"Все населенные пункты")?></option>
                                    <?php foreach ($stocksByShops as $stocksByShop):?>

                                        <option data-availability="1" value="<?= $stocksByShop->stock1c->representative->id?>"><?= $stocksByShop->stock1c->representative->{'address'.$suff}?></option>
                                    <?php endforeach;?>
                                    <?php foreach ($shops as $shop):?>

                                        <option data-availability="0" value="<?=$shop->id?>"><?=$shop->{'address'.$suff}?></option>
                                    <?php endforeach;?>
                                </select>

                                <div class="city-delivery">
                                    <p style="font-weight: normal"><?=Yii::t('web', 'Укажите, где Вы ходите забрать заказ: ')?></p>
                                    <p class="select-address" style="padding-right: 5px"></p><span class="id-from-option" style="display:none"></span>
                                    <p class="select-address-availability"></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 delivery text-left">
                                <div class="row delivery-head">
                                    <div class="col-md-7 col-xs-12 text-left">
                                        <p class="delivery-text" style="font-size: 20px">Доставка:</p>
                                    </div>
<!--                                    <div class="col-md-5 col-xs-12 text-left">-->
<!--                                        <p>--><?//=Yii::t('web','Ваш город: ')?><!--<span class="choosen-city"></span></p>-->
<!--                                    </div>-->
                                </div>
                                <div class="row delivery-head">
                                    <div class="col-md-7 col-xs-6 text-left">
                                        <div class="hand-to-hand">
                                            <img src="<?=Url::to('@web/img/delivery-hand.png')?>" alt="Самовывоз" style="width: 40px" />
                                        </div>
                                        <div class="hand-to-hand">
                                            <p class="text-pickup"><?=Yii::t('web','Самовывоз с магазина Гектар ')?><br/><span><?=Yii::t('web','бесплатно')?></span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-xs-6 text-left">
                                        <div class="hand-to-hand right-side">
                                            <p class="text-pickup"><?=Yii::t('web','завтра после: 16:00 (при заказе до 14:00)')?><br/><a href="<?=Url::to(['default/shop'])?>"><?=Yii::t('web','Магазины на карте')?></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row delivery-head">
                                    <div class="col-md-7 col-xs-6 text-left">
                                        <div class="hand-to-hand">
                                            <img src="<?=Url::to('@web/img/delivery-truck.png')?>" alt="Самовывоз" style="width: 40px" />
                                        </div>
                                        <div class="hand-to-hand">
                                            <p class="text-pickup"><?=Yii::t('web','В отделении службы доставки')?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-xs-6 text-left">
                                        <div class="hand-to-hand right-side">
                                            <p class="text-pickup"><?=Yii::t('web','Передадим в Службу доставки сегодня')?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row availability-desc">
                            <div class="col-md-12">
                                <p style="font-weight: normal"><?=Yii::t('web','В перечне указаны все магазины, в которых данный товар есть в наличии.')?></p>
                            </div>
                        </div>
                        <div class="row  shop-availability" style="margin-left: 0">

<!--                            --><?php //if($stocksByShops):?>
                                <?php foreach ($stocksByShops as $stocksByShop):?>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="shop-address"><?= $stocksByShop->stock1c->representative->{'address'.$suff}?><span class="shop-id" style="display: none"><?=$stocksByShop->stock1c->representative->id?></span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="shop-availability-status" data-availability="1">
                                                (<?=Yii::t('web','Есть в наличии')?>)
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php foreach ($shops as $shop):?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="shop-address"><?= $shop->{'address'.$suff}?><span class="shop-id" style="display: none"><?=$shop->id?></span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="shop-availability-status" data-availability="0" style="color:red">
                                            (<?=Yii::t('web','Нет в наличии')?>)
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach;?>


                            </div>
                        </div>
                    <p class="help-status-red" style="display: none"><?=Yii::t('web', 'Нет в наличии')?></p>
                    <p class="help-status-green" style="display: none"><?=Yii::t('web', 'Есть в наличии')?></p>
<!--                    <button type="submit" class="submit-shop btn btn-success" style="background-color:#f59f08; position:absolute; bottom:0;right:0;padding: 5px 50px;">--><?//=Yii::t('web','Сохранить')?><!--</button>-->
                    </div>
                    </div>

                </div>

            </div><!-- content -->

        </div><!-- modal -->
    </div><!-- overlay -->
<?php else: ?>

    <div class="modal-overlay-shop">
        <div class="modal-shops">

            <a class="close-modal">
                <svg viewBox="0 0 20 20">
                    <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                </svg>
            </a><!-- close modal -->
            <p class="modal-header"><?= Yii::t('web', 'Остатки на магазинах')?></p>
            <div class="modal-content">
                <div class="shops-header">
                    <div class="shops-header-left">

                        <p class="modal-desc"><?=Yii::t('web','Населенные пункты:')?></p>
                        <div class="row mobile-shops">
                            <div class="col-md-6 col-xs-12 text-left select-for-mobile">

                                <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>
                                <select class="selectpicker for-partner" data-size="7" data-style="btn-info" data-live-search="true" data-none-results-text="<?=Yii::t('web','Не удалось найти н.п.: ')?>{0}">
                                    <option value="default" selected="selected"><?=Yii::t('web',"Все населенные пункты")?></option>
                                    <?php foreach ($stocksByShops as $stocksByShop):?>

                                        <option data-availability="<?=$stocksByShop->stock?>" value="<?= $stocksByShop->stock1c->representative->id?>"><?= $stocksByShop->stock1c->representative->{'address'.$suff}?></option>
                                    <?php endforeach;?>
                                    <?php foreach ($shops as $shop):?>

                                        <option data-availability="0" value="<?=$shop->id?>"><?=$shop->{'address'.$suff}?></option>
                                    <?php endforeach;?>
                                </select>


                            </div>
                            <div class="col-md-6 city-delivery">
<!--                                <p style="font-weight: normal">--><?//=Yii::t('web', 'Остаток на: ')?><!--</p>-->
                                <p class="select-address" style="padding-right: 5px"></p><span class="id-from-option" style="display:none"></span>
                                <p class="select-address-availability"></p>
                            </div>
                        </div>
                        <div class="row availability-desc">
                            <div class="col-md-12">
                                <p style="font-weight: normal"><?=Yii::t('web','Остатки на магазинах')?></p>
                            </div>
                        </div>
                        <div class="row  shop-availability for-partner" style="margin-left: 0">

                            <!--                            --><?php //if($stocksByShops):?>
                            <?php foreach ($stocksByShops as $stocksByShop):?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="shop-address"><?= $stocksByShop->stock1c->representative->{'address'.$suff}?><span class="shop-id" style="display: none"><?=$stocksByShop->stock1c->representative->id?></span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="shop-availability-status" data-availability="1">
                                            (<?=$stocksByShop->stock;?>)
                                        </p>
                                        <p class="help-status-green" style="display: none"><?=$stocksByShop->stock;?></p>
                                    </div>
                                </div>

                            <?php endforeach;?>
                            <?php foreach ($shops as $shop):?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="shop-address"><?= $shop->{'address'.$suff}?><span class="shop-id" style="display: none"><?=$shop->id?></span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="shop-availability-status" data-availability="0" style="color:red">
                                            (<?=Yii::t('web','Нет в наличии')?>)
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach;?>


                        </div>
                    </div>
                    <p class="help-status-red" style="display: none"><?=Yii::t('web', 'Нет в наличии')?></p>

                    <!--                    <button type="submit" class="submit-shop btn btn-success" style="background-color:#f59f08; position:absolute; bottom:0;right:0;padding: 5px 50px;">--><?//=Yii::t('web','Сохранить')?><!--</button>-->
                </div>
            </div>

        </div>

    </div><!-- content -->

    </div><!-- modal -->
    </div><!-- overlay -->

<?php endif;?>



<?php
$this->registerCss("
	.wrapper.complects .shares-list-item__title {
		margin-top: -5px;
	}
	.wrapper.complects .shares-list-item__add {
		font-size: 14px;
		margin-top: -5px;
	}
	.wrapper.complects .shares-list-item__price {
		font-size: 1.3rem;
		margin-top: 5px;
	}
	.wrapper.complects .shares-list-item__price.shares-list-item__oldprice {
		text-decoration:line-through;
		color:grey;
		font-size:0.8rem;
		margin-bottom: 5px;
	}	
	.btn-vertical-slider{ 
	    position:absolute !important;

        cursor:pointer;
        left:42%;
	}
	
	.btn-vertical-slider:hover{ 
        color: #f59f08;
	}
	.btn-vertical-slider[data-slide=\"next\"]{
	    top:-10%;
	   
	}
	.btn-vertical-slider[data-slide=\"prev\"]{
	    top:97%;
	    
	}
	#slideshow-inner{
	    
	}
	.shares .wrapper ul {
        padding-top:5px;
    }
    a {  cursor:pointer;}
    #myCarousel .row{
        width: 100%;
        margin-right: 0;
        margin-left: 0;
    }
    #myCarousel .carousel-inner{
        /*overflow: visible;*/
    }
    .carousel.vertical .carousel-inner .item {
      -webkit-transition: 0.6s ease-in-out top;
         -moz-transition: 0.6s ease-in-out top;
          -ms-transition: 0.6s ease-in-out top;
           -o-transition: 0.6s ease-in-out top;
              transition: 0.6s ease-in-out top;
    }
        
     .carousel.vertical .active {
      top: 0;
    }
    
     .carousel.vertical .next {
      top: 100%;
    }
    
     .carousel.vertical .prev {
      top: -100%;
    }
    
     .carousel.vertical .next.left,
    .carousel.vertical .prev.right {
      top: 0;
    }
    
     .carousel.vertical .active.left {
      top: -100%;
      left:100% !important;
    }
    
     .carousel.vertical .active.right {
      top: 100%;
      left: -100% !important;
    }
    
    .delivery{
        padding: 0 !important;
        margin:0;
    }
    
    .delivery-head .col-md-6 p{
        line-height: 0;
    }
    
    .delivery-head .col-md-6, .delivery-head .col-md-5, .delivery-head .col-md-7{
        padding:0;
    }
    
     .delivery-head{
        padding-bottom:10px;
        margin-bottom:10px;
        border-bottom: 1px solid skyblue;
    }
    
    .delivery-head .hand-to-hand p{
        line-height:1;
        font-weight: bold;
    }
    
    .delivery-head .hand-to-hand span{
        font-weight: normal;
    }
    
    .delivery-head .hand-to-hand {
        display:inline-block;
        vertical-align:middle;
    }
    .delivery-head .hand-to-hand:first-child {
        margin-right:10px;
    }
    
    .delivery-head .hand-to-hand .text-pickup{
        width:200px;
    }
    
    .delivery-head .hand-to-hand.right-side .text-pickup{
        font-weight:normal;
    }
    
    .delivery-head .hand-to-hand.right-side .text-pickup a{
        color: #f59f08;
    }
    
    .delivery-head .hand-to-hand.right-side .text-pickup a{
        color: #f59f08;
    }
    
    @media screen and (max-width:900px){

    .mobile-shops{
        margin-left:0 !important;
    }
    .delivery{
        padding-right: 15px !important;
        padding-left: 15px !important;   
    }
    
    .delivery-head {
        padding-bottom: 0;
        margin-bottom: 0;
    }
    .delivery-text{
        font-size: 14px !important;
    }
    .delivery-head p, .city-delivery p, .shop-availability p{
        font-size:11px !important;
    }
    .modal-desc, .availability-desc{
        display:none;
    }
    .select-for-mobile{
        padding-left:0 !important;
    }
    .modal-shops .modal-content{
        max-height:100%;
    }
    .delivery-head .hand-to-hand .text-pickup {
        width: 150px;
    }
}
    
    .shop-availability{
        max-height: 250px;
        overflow-y:auto;
    }
    .shop-availability .row{
        border-bottom: 1px solid skyblue;
        margin-left:0;
      
    }
    
    .shop-availability .row:nth-child(2n-1){
        background: rgb(245,159,8,0.1);
    }
    
    .shop-availability .row:hover{
        background: rgb(245,159,8,1);
        cursor: pointer
    }
    
    .shop-availability-status{
        color: green;
    }
    
    .dropdown > .itemsSidebar-products__title span {
        margin-left: 20px;
        color: #12733a;
        padding: 6px;
        cursor: pointer;
        transition: all ease 0.3s;
        float: right;
        margin-top: -10px;
    }
    

");
$this->registerJsFile("/js/jquery.session.js", ['depends' => ['app\assets\WebAsset']]);
//$this->registerJsFile("/js/bootstrap.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("@web/js/bootstrap-select.min.js",['depends' => 'yii\web\JqueryAsset']);
$this->registerJs("



function setCookie(cname, cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    var expires = 'expires='+d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
}

function getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

    $(document).ready(function(){
        $('.btn-vertical-slider').on('click', function () {
        
           var twoParent = $(this).parent().parent();
           var threeParent = $(this).parent().parent().parent();
           var firstNewPrice = parseFloat(twoParent.find('.item.active .shares-list-item__newprice').html().replace(/,/g,''));
           var firstOldPrice = parseFloat(twoParent.find('.item.active .shares-list-item__oldprice').html().replace(/,/g,''));
            twoParent.find('.item.active .complects-item').removeClass('in-cart');
            var newPrice = parseFloat(threeParent.find('.inbuy .shares-list-item__newprice').html().replace(/,/g,''));
            var oldPrice = parseFloat(threeParent.find('.inbuy .shares-list-item__oldprice').html().replace(/,/g,''));
            var newPriceVal = threeParent.find('.inbuy .shares-list-item__newprice');
            var oldPriceVal = threeParent.find('.inbuy .shares-list-item__oldprice');
           setTimeout(function(){
            var secondNewPrice = parseFloat(twoParent.find('.item.active .shares-list-item__newprice').html().replace(/,/g,''));
            var secondOldPrice = parseFloat(twoParent.find('.item.active .shares-list-item__oldprice').html().replace(/,/g,''));
            twoParent.find('.item.active .complects-item').addClass('in-cart');
            newPriceVal.text(String((newPrice - firstNewPrice + secondNewPrice).toFixed(2)).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1,')+ ' грн');
            oldPriceVal.text(String((oldPrice - firstOldPrice + secondOldPrice).toFixed(2)).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1,')+ ' грн');
           },700);
           
            if ($(this).attr('data-slide') == 'next') {
                $('#myCarousel').carousel('next');
            }
            if ($(this).attr('data-slide') == 'prev') {
                $('#myCarousel').carousel('prev');
            }
            

        });
    
        $('.item-main-left .count-rating-star').on('click', function(){
            $('#review-tab').click();
            $('html,body').animate({
              scrollTop: $('#review-tab').offset().top - 50
            }, 300);
            return false;
        });
        
        if (window.location.hash == '#review-tab') {
            $('#review-tab').click();
        }
        $('.similar-goods-slider-ar').on('click', function(){
			var l = parseFloat($('.alsobuyList').css('margin-left'));
			if (l>parseFloat($('.alsobuy_tab').width())-parseFloat($('.alsobuyList').width())) {l-=$('.alsobuyList-item').width();} else {l=0;}        
			$('.alsobuyList').css('margin-left',l+'px');
		});
		$('.alsobuyList').width(parseFloat($('.alsobuyList-item').width())*".count($model->alsobuyProducts)."+'px');
        $('.similar-goods-slider-al').on('click', function(){
			var l = parseFloat($('.alsobuyList').css('margin-left'));
			if (l<0) {l+=$('.alsobuyList-item').width();} else {l=parseFloat($('.alsobuy_tab').width())-parseFloat($('.alsobuyList').width());}
			$('.alsobuyList').css('margin-left',l+'px');		
		});
		$('.reviews-list-item-header__from, .glyphicon.glyphicon-comment').on('click', function() {
			$('#messagecomment'+$(this).attr('data-id')+' #reviewform-parent_id').val($(this).attr('data-id'));
			$('#messagecomment'+$(this).attr('data-id')).toggleClass('hidden');
		});
		if (parseFloat($('.alsobuyList').width())<parseFloat($('.alsobuy_tab').width())) {jQuery('.alsobuyList').css('margin','auto');jQuery('.alsobuyList').css('text-align','center');}
	
		
		$('.buycomplect').on('click', function(e) {
	
			if ((typeof getCookie('complects') !== 'undefined') && (getCookie('complects') !== '')) {
			
				var comp1 = getCookie('complects');
				
				var comp = comp1.split(',');
				if (!(inArray($(this).data('cid'), comp))) {
					var complects = comp1+','+$(this).data('cid');
				}else{
				    var complects = comp1;
				}
			} else {var complects = $(this).data('cid');}
			setCookie('complects', complects);	
					//alert($(this).data('cid'));
			$('.complectsslide[data-cid='+$(this).data('cid')+'] .complects-item.product.in-cart').each(function(){

				var form = $('<form></form>');
				var that = e;
				var attr = $(this).data('attr');
			
				var opt = $(this).data('opt');
				var prod = $(this).data('pid');
				$(form).append('<input name=\"amount\" value=\"1\">').append('<input name=\"purchaseType\" value=\"0\">').append('<input name=\"attrs[1]\" value=\"'+attr+'\">');
				$(form).attr('action','/internet-magazin/cart/add?product_id='+prod);
				$(form).attr('method','POST');
				credit_buy_submit(form);	
			});
	
			return false;
		});
		
		
		var elements = $('.modal-overlay, .modal-sertificate');

        $('a.btnflip .btnflip-item').click(function(){
            elements.addClass('active');
        });

        $('.close-modal, .modal-overlay').click(function(){
            elements.removeClass('active');
        });

		
		 var elementsShop = $('.modal-overlay-shop, .modal-shops');

        $('#buy-shop, #shop-stocks').click(function(){
            elementsShop.addClass('active');
        });

        $('.close-modal').click(function(){
            elementsShop.removeClass('active');
        });
        $('.modal-overlay-shop').click(function(e){
           if($(e.target).closest(\".modal-shops\").length==0) elementsShop.removeClass('active');
        });
        
        $('.shop-availability .row').click(function(){
        
            var address = $(this).find('.shop-address').html();
            var addressAvailability = $(this).find('.shop-availability-status').data('availability');
            $('.select-address').html(address);
            if(addressAvailability == 0){
            
                    $('.select-address-availability').text($('.help-status-red').text());
                    $('.select-address-availability').css('color','red');
                }else{
                if($(this).parent().hasClass('for-partner')){
                   $('.select-address-availability').text('Остаток: ' + $(this).find('.help-status-green').text()); 
                }else{
                    $('.select-address-availability').text($('.help-status-green').text());
                }
                    
                    $('.select-address-availability').css('color','green');
                }
            if(!$(this).parent().hasClass('for-partner')){
                saveShop();
            }
        });
        
        $('.selectpicker').change(function(){
            var address = $(this).find(':selected').html();
            var addressAvailability = $(this).find('option:selected').data('availability');
           
            if($(this).find(':selected').val() == 'default'){
                $('.select-address').text('Вы не выбрали магазин со списка');
                 $('.select-address-availability').text('');
            }else{
                $('.select-address').html(address);
               // alert($(this).val());
                $('.id-from-option').html($(this).val());
                if(addressAvailability == 0){
                    $('.select-address-availability').text($('.help-status-red').text());
                    $('.select-address-availability').css('color','red');
                }else{
                      if($(this).parent().hasClass('for-partner')){
                            $('.select-address-availability').text('Остаток: ' + addressAvailability); 
                      }else{
                            $('.select-address-availability').text($('.help-status-green').text());
                      }
                    $('.select-address-availability').css('color','green');
                }
                if(!$(this).parent().hasClass('for-partner')){
                    saveShop();
                }
            }
            
        });
        
        function saveShop(){
            var selectedShop = $('.select-address .shop-id').text();
            if(selectedShop == ''){
                var selectedShop = $('.id-from-option').text();
            }
            setCookie('shop', selectedShop);
            if(selectedShop == ''){
                $('.select-address').text('Вы не выбрали магазин со списка');
                $('.select-address').css({
                    'color': 'red'     
                });
            }else{
                elementsShop.removeClass('active');
            }
            }
       
		
    });
"); ?>
<?php /*


			if ($.session.get('complects') !== undefined) { var complects = $.session.get('complects')+',';}
			else {var complects = '';}
			$.session.set('complects', complects+$(this).data('cid'));


		$('#buycomplect1').on('click', function(e) {
			var form = $('#form');
			$('#purchaseType').val('0');
			e.preventDefault();
			credit_buy_submit(form);

			var form = $('<form></form>');
			var that = e;
			//var attrs = $(this).parent().find('.itemsList-item__attr')[0];
			//$(form).append('<input name=\"amount\" value=\"1\">').append('<input name=\"purchaseType\" value=\"0\">').append('<input name=\"'+$(attrs).attr('data-name')+'\" value=\"'+$(attrs).attr('data-value')+'\">');
			$(form).append('<input name=\"amount\" value=\"1\">').append('<input name=\"purchaseType\" value=\"0\">').append('<input name=\"'+$(that).attr('data-name')+'\" value=\"'+$(that).attr('data-price')+'\">');
			$(form).attr('action','/internet-magazin/cart/add?product_id='+$(that).attr('data-id'));
			$(form).attr('method','POST');
			credit_buy_submit(form);

			return false;
		}); */

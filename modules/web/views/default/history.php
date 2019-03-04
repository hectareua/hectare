<?php
use app\components\Url;
$this->title = Yii::t('web', 'История компании') . ' | Гектар';
$lang = Yii::$app->language;
if($lang == 'ru') {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'История компании') . '. Корпорация Гектар: история компании.']);
} else {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'История компании') . '. Корпорація Гектар: істориія компанії.']);
}

$separateFilelds = 1;
$this->registerJs('
(function() { var css = document.createElement("link"); css.href = "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"; css.rel = "stylesheet"; css.type = "text/css"; document.getElementsByTagName("head")[0].appendChild(css); })();
');
$this->registerCss('
.historypage  h2 {
	font-size:2rem !important;
    margin-bottom: 30px;
    /* margin-top: 50px;    
    border-top: 1px dashed lightgrey;
    padding-top: 30px; */
}
.historymenu {
	padding-top:70px;
}
.historyitemtitle {
	cursor:pointer;
	text-align:left;
	font-weight:bold;
    list-style: none;
    height: 60px;
    line-height: 60px;
    position: relative;	
}
.historyitemtitle.active {color:#f59f08;}
.historypage h2::before{
	content: "";
    background: url(/img/leaves.png) no-repeat;
    width: 27px;
    height: 36px;
    margin-left: -30px;
    position: absolute;
    display: inline-block;
}
.historypage ul {margin-left:20px;text-align:left;}
.historypage ul {    
	text-align: left;
    padding-left: 30px;
}
.historypage li{
    list-style-image: url(/img/leavess.png);
    line-height: 1.45;
}
.maintext{
    font-size: 120%;
    line-height: 1.4;
    margin: 10px 0;
}
.infblock {
    position: relative;
    display: table;
    float: none;
    clear: both;
    width: 90vw;
    margin-left: -60px;
}
.historyitemtext {
    width: 100%;
}
.assort {
    background: url(http://hectare.com.ua/img/2.jpg);
    text-align: right;
    display: block;
    padding: 10px;
}
.assortlist h3 {
	font-family: "Yanone Kaffeesatz", sans-serif;
	text-transform:uppercase;
	font-size:30px;
	color:#f59f08;
}
.ourpluses {
	background: url(http://hectare.com.ua/img/1.jpg);
    display: block;
    padding: 80px 20px;
    height: 615px;
}
.assortlist,.ourpluseslist {
    width: 350px;
    background: rgba(250, 250, 210, 0.76);
    border-radius: 10px;
    padding: 20px;
    display: block;
    margin: 10px;
    position: relative;
}
.historypage ul.ourpluseslist {
    margin: auto;
    font-size: 120%;
    padding: 10px 20px 10px 40px;
	width: 50vw;
}
.historypage div.assortlist{
	margin-left: calc(100% - 360px);
}
.historypage .ourpluseslist li {
    font-size: 120%;
    font-weight: bold;
}
.historypage ul.assortlist {
    text-align: left;
    border-left: 4px solid #f59f08;
    padding-left: 30px;
}
.missiontext {
    background: no-repeat url(/img/mission.png);
    padding-left: 200px;
    background-size: 150px 150px;
}
.garanteetext {
    background: no-repeat url(/img/garantee.jpg);
    padding-left: 200px;
    background-size: 100px 100px;
    height:100px;
}
.firsttext {
  /*  border-left:4px solid #f59f08; */
    border-right:4px solid #f59f08;
    padding-left: 20px;
    padding-right: 20px;
}
.garanteetext,.missiontext {
    border-right:4px solid #f59f08;
    padding-right: 20px;
}
.historyback{
    background: url(/img/history_back.jpg) no-repeat;
    width: 100%;
    min-height: 250px;
    color: white;
	background-size: cover;
}
.dbigtext{
    font-size: 2em;
    text-align:center;    
}
.bigtext {
    font-size: 6em;
    font-family: "Yanone Kaffeesatz", sans-serif;
    text-align:center;
	margin-top: .7em;
}
.historyitemtitle:hover::after {
    background: #f59f08;
}
.historyitemtitle:hover::after {
	width:100%;
}
.historyitemtitle:hover {
	color:white;
}
.historyitemtitle span{
    padding-left:7px;
}
.historyitemtitle span::before {
    background: url(/img/leavess.png) no-repeat;
    content:" ";
    width:15px;
    height:13px;
	display: inline-block;
}
.historymenu > div {
	-webkit-transition: all .1s ease-in-out;
	transition: all .1s ease-in-out;
}
.historymenu > div {
    border-right: 5px solid #f59f08;
}
.historymenu > div:nth-child(odd) {
    background:#fff;
}
.historymenu > div:nth-child(even) {
    background:#ededed;
}
.historymenu >div:nth-child(odd):hover, .historymenu >div:nth-child(even):hover {
    background: #fff;
    position: relative;
    z-index: 0;
}
.historymenu  >div:after {
    content: "";
    height: 100%;
    right: 0;
    top: 0;
    width: 0px;
    position: absolute;
    transition: all 0.3s ease 0s;
    -webkit-transition: all 0.3s ease 0s;
    z-index: -1;
}
.historymenu  >div:after {
    background: #f59f08;
}
.historymenu  >div:hover:after {
    width: 100%;
}
.historymenu  >div:hover:after {
    background: #f59f08;
}

@media screen and (min-width: 500px)  { 

.flowerblock {
  display: table;
 /*     float: none;
    clear: both; */
    width: 475px;
    height: 600px;
    position: relative;
    margin: auto;
}

.snipAnim8 {
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    align-items: center; 
    position: relative;   
    margin-top: 220px; 
    min-height: 1px;

}

.crcl_bg {
    width: 300px;
  /*  height: 300px;*/
    height: 10px;
    border-radius:50%;
    background: #fff;
    margin: 0 auto;
    position: absolute;
    left: 88px;
    top:0;
}
 
.crcl {
    width: 300px;
    height: 300px;
    height: 150px;
    margin: 0 auto;
   /* border-radius:50%;*/
   /* border:30px solid #a8bc4a;  */
    border-top-left-radius: 150px;  /* 100px of height + 10px of border */
    border-top-right-radius: 150px; /* 100px of height + 10px of border */
    border: 30px solid #86bf37;  
    border-bottom: 0;   
   /* position: relative;*/
    position: absolute;
    left: 87px;
    top: -150px;
    opacity: 0;
    z-index: 4;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation-play-state: paused;
    animation-play-state: paused; 
    -webkit-animation-name: anim5__fadeIn;
    animation-name: anim5__fadeIn;
    webkit-animation-delay: .2s;
    animation-delay: .2s;
    -webkit-animation-duration: .8s;
    animation-duration: .8s;
    -webkit-animation-timing-function: cubic-bezier(.4,.25,.3,1);
    animation-timing-function: cubic-bezier(.4,.25,.3,1);
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-play-state: inherit;
    animation-play-state: inherit;      
}
.crcl_bottom {
    width: 300px;
    height: 300px;
    height: 150px;
    margin: 0 auto;
   /* border-radius:50%;*/
   /* border:30px solid #a8bc4a;  */
    border-bottom-left-radius: 150px;  /* 100px of height + 10px of border */
    border-bottom-right-radius: 150px; /* 100px of height + 10px of border */
    border: 30px solid #9bd34e;  
    border-top: 0;   
    position: absolute;
    left: 87px;
    top: 0px;
    opacity: 0;
    z-index: 4;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation-play-state: paused;
    animation-play-state: paused; 
    -webkit-animation-name: anim5__fadeIn;
    animation-name: anim5__fadeIn;
    webkit-animation-delay: .2s;
    animation-delay: .2s;
    -webkit-animation-duration: .8s;
    animation-duration: .8s;
    -webkit-animation-timing-function: cubic-bezier(.4,.25,.3,1);
    animation-timing-function: cubic-bezier(.4,.25,.3,1);
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-play-state: inherit;
    animation-play-state: inherit;  
}
.half-circle {
    width: 200px;
    height: 100px; /* as the half of the width */
    background-color: gold;
    border-top-left-radius: 110px;  /* 100px of height + 10px of border */
    border-top-right-radius: 110px; /* 100px of height + 10px of border */
    border: 10px solid gray;
    border-bottom: 0;
}
.anim_lepestok {
    width: 80px;
    height: 86px;
    background: url(/web/img/lepestok.png) no-repeat center;
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 0;
    -webkit-animation-duration: .4s;
    animation-duration: .4s;
    -webkit-animation-timing-function: cubic-bezier(.4,.25,.3,1);
    animation-timing-function: cubic-bezier(.4,.25,.3,1);
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-play-state: inherit;
    animation-play-state: inherit;   
    cursor: pointer;  
}
.anim_lepestok_1 {
    -webkit-animation-name: anim_lepestok_1;
    animation-name: anim_lepestok_1;
    -webkit-animation-delay: 1s;
    animation-delay: 1s;   
}
.anim_lepestok_2 {
    -webkit-animation-name: anim_lepestok_2;
    animation-name: anim_lepestok_2;
    -webkit-animation-delay: 1.2s;
    animation-delay: 1.2s;
}

.anim_lepestok_3 {
    -webkit-animation-name: anim_lepestok_3;
    animation-name: anim_lepestok_3;
    -webkit-animation-delay: 1.4s;
    animation-delay: 1.4s;
}

.anim_lepestok_4 {
    -webkit-animation-name: anim_lepestok_4;
    animation-name: anim_lepestok_4;
    -webkit-animation-delay: 1.6s;
    animation-delay: 1.6s;
}
.anim_lepestok_5 {
    -webkit-animation-name: anim_lepestok_5;
    animation-name: anim_lepestok_5;
    webkit-animation-delay: 1.8s;
    animation-delay: 1.8s;
}

.anim_lepestok_6 {
    -webkit-animation-name: anim_lepestok_6;
    animation-name: anim_lepestok_6;
    webkit-animation-delay: 2s;
    animation-delay: 2s;
}
.anim_lepestok_7 {
    -webkit-animation-name: anim_lepestok_7;
    animation-name: anim_lepestok_7;
    webkit-animation-delay: 2.2s;
    animation-delay: 2.2s;
}
.anim_lepestok_8 {
    -webkit-animation-name: anim_lepestok_8;
    animation-name: anim_lepestok_8;
    webkit-animation-delay: 2.4s;
    animation-delay: 2.4s;
}
.anim_lepestok_9 {
    -webkit-animation-name: anim_lepestok_9;
    animation-name: anim_lepestok_9;
    webkit-animation-delay: 2.6s;
    animation-delay: 2.6s;
}
.anim_lepestok_10 {
    -webkit-animation-name: anim_lepestok_10;
    animation-name: anim_lepestok_10;
    webkit-animation-delay: 2.8s;
    animation-delay: 2.8s;
}
.anim_lepestok_11 {
    -webkit-animation-name: anim_lepestok_11;
    animation-name: anim_lepestok_11;
    webkit-animation-delay: 3s;
    animation-delay: 3s;
}
.anim_lepestok_12 {
    -webkit-animation-name: anim_lepestok_12;
    animation-name: anim_lepestok_12;
    webkit-animation-delay: 3.2s;
    animation-delay: 3.2s;
}

.snipAnim8 span.active,
.snipAnim8 span:hover {
   background: url(/web/img/lepestok1.png) no-repeat center;
}

.inn_crcl {
    display: inline-block;
    vertical-align: middle;
}
.inn_crcl {
    width: 244px;
    text-align: center;
    font: 400 normal 1.1em/1.7 "HelveticaNeueCyr-Roman", sans-serif;
   /* font: 400 normal 1.5625rem/40px "HelveticaNeueCyr-Roman", sans-serif; */
    color: #575757;
    background: rgba(255,255,255,.6);
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -123px;
    margin-top: -40px;
    z-index: 3;
    border-radius: 4px;
	padding: 0 5px;
}
.backs:before {
    content: "";
    width: 68px;
    height: 166px;
    background: url(https://www.eridon.ua/images/grass-gray.png) no-repeat center top;
    position: absolute;
    top: -148px;
    left: 50%;
    margin-left: -34px;
}
.span_460 {
    float: left;
    width: -webkit-calc(40% - 40px);
    width: -moz-calc(40% - 40px);
    width: calc(40% - 40px);
}
.page_perevagi .span_460 {
    width: 100%;
    max-width: 475px;
    margin: 0 auto;
    float: none;
    padding-bottom: 100px;
}
.outerIn {
    padding-bottom: 10px;
}
.expIn {
    margin: 0;
    padding: 0 0 0 50px;
    font: 400 normal .875rem/50px "HelveticaNeueCyr-Roman", sans-serif;
    border-top: 1px solid #ececec;
    border-bottom: 1px solid #ececec;
    position: relative;
    cursor: pointer;
}
.redIn:before,.orangeIn:before,.yellowIn:before,.greenIn:before,.blueIn:before {
    background-color: #f64f30;
    position: absolute;
    left: -18px;
    margin-top: 7px;
    transform: rotate(45deg);
    width: 35px;
    height: 35px;
    content: " ";
}
.expIn:before {
    font-family: "FontAwesome";
    content: "\f19c";
    font-size: 20px;
    text-align: center;
    color: white;
    position: absolute;
    left: -11px;
    top: -3px;
}
.orangeIn:before {
    background-color: #ff8400;
}
.orangeIn .expIn:before {
	content: "\f0e8";
}
.yellowIn:before {
    background-color: #ffc000;
}
.yellowIn .expIn:before {
    content: "\f0d1";
}
.greenIn:before {
	background-color: #86bf37;
}
.greenIn .expIn:before {
    content: "\f0d6";
}
.blueIn:before {
    background-color: #5fb5de;
}
.blueIn .expIn:before {
    content: "\f06b";
}
.expIn:after {
    content: "";
    width: 30px;
    height: 50px;
    background: url(https://www.eridon.ua/images/to_l.png) no-repeat center;
    position: absolute;
    right: -27px;
    top: 0;
}
.redIn h3 {
    color: #f64f30;
}
.orangeIn h3 {
    color: #ff8400;
}
.yellowIn h3 {
    color: #ffc000;
}
.greenIn h3 {
    color: #86bf37;
}
.blueIn h3 {
    color: #5fb5de;
}
.missionblock {
    margin-left: 10%;
}
.missionblock .redIn:before,.missionblock .orangeIn:before,.missionblock .yellowIn:before,.missionblock .greenIn:before,.missionblock .blueIn:before {
    content: initial;
}
.missionblock .expIn:before {
    position: absolute;
    margin-left: -13px;
    margin-top: 2px;
    background: url(http://hectare.com.ua/img/mission.png) no-repeat center;
    background-size: 52px 52px;
    width: 52px;
    height: 52px;
    content: " ";
}
.innerIn {
	display:none;
	transition: all 2s ease-out;
}
.active .innerIn {
	display:block;
}
.innerIn ul {
    margin: 0;
    padding: 0;
}
.innerIn li {
    list-style: none;
    font: 400 normal .875rem/1.2 "HelveticaNeueCyr-Roman", sans-serif;
    color: #000;
    padding: 0 0 0 30px;
    background: url(https://www.eridon.ua/images/bullet.png) no-repeat center left;
    margin: 10px 0 25px 0;
}
.backs {
    margin: 280px 0 5px 0;
    width: 100%;
    height: 5px;
    background: #ebebeb;
    position: relative;
}
.task_in:before {
    content: " 	";
    width: 12px;
    height: 12px;
    background: #86bf37;
    position: absolute;
    top: 4px;
    left: 0px;
    -webkit-transform: rotate(45deg);
    -webkit-transform-origin: center;
    transform: rotate(45deg);
}
.task p {
    margin: 0;
    padding: 0;
    color: #000;
    font: 400 normal .875rem/1.8 "HelveticaNeueCyr-Roman", sans-serif;
    text-align: justify;
}
.task .task_in {
    position: relative;
    padding-left: 25px;
    margin-bottom: 5px;
    line-height: 16px;
    top: -60px;
    color: #707070;
}
/*======lepestok======*/

@-webkit-keyframes anim_lepestok_1{
        0%{
            -webkit-transform:translate(-50%,-50%) rotate(-15deg);
            transform:translate(-50%,-50%) rotate(-15deg)
        }
        100%{
            -webkit-transform:translate(-112%,-261%) rotate(-15deg);
            transform:translate(-112%,-261%) rotate(-15deg)
        }
    }

@keyframes anim_lepestok_1{
        0%{
            -webkit-transform:translate(-50%,-50%) rotate(-15deg);
            transform:translate(-50%,-50%) rotate(-15deg)
        }
        100%{
            -webkit-transform:translate(-112%,-261%) rotate(-15deg);
            transform:translate(-112%,-261%) rotate(-15deg)
        }
    }
@-webkit-keyframes anim_lepestok_2{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(15deg);
            transform:translate(-50%,-50%) rotate(15deg)
        }
        100%{
            -webkit-transform:translate(13%,-260%) rotate(15deg);
            transform:translate(13%,-260%) rotate(15deg)
        }
    }
    

    @keyframes anim_lepestok_2{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(15deg);
            transform:translate(-50%,-50%) rotate(15deg)
        }
        100%{
            -webkit-transform:translate(13%,-260%) rotate(15deg);
            transform:translate(13%,-260%) rotate(15deg)
        }
    }
@-webkit-keyframes anim_lepestok_3{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(45deg);
            transform:translate(-50%,-50%) rotate(45deg)
        }
        100%{
            -webkit-transform:translate(116%,-203%) rotate(45deg);
            transform:translate(116%,-203%) rotate(45deg)
        }
    }
    @keyframes anim_lepestok_3{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(45deg);
            transform:translate(-50%,-50%) rotate(45deg)
        }
        100%{
            -webkit-transform:translate(116%,-203%) rotate(45deg);
            transform:translate(116%,-203%) rotate(45deg)
        }
    }
@-webkit-keyframes anim_lepestok_4{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(75deg);
            transform:translate(-50%,-50%) rotate(75deg)
        }
        100%{
            -webkit-transform:translate(175%,-109%) rotate(75deg);
            transform:translate(175%,-109%) rotate(75deg)
        }
}
@keyframes anim_lepestok_4{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(75deg);
            transform:translate(-50%,-50%) rotate(75deg)
        }
        100%{
            -webkit-transform:translate(175%,-109%) rotate(75deg);
            transform:translate(175%,-109%) rotate(75deg)
        }
}
@-webkit-keyframes anim_lepestok_5{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(104deg);
            transform:translate(-50%,-50%) rotate(104deg)
        }
        100%{
            -webkit-transform:translate(177%,2%) rotate(104deg);
            transform:translate(177%,2%) rotate(104deg)
        }
}
@keyframes anim_lepestok_5{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(104deg);
            transform:translate(-50%,-50%) rotate(104deg)
        }
        100%{
            -webkit-transform:translate(177%,2%) rotate(104deg);
            transform:translate(177%,2%) rotate(104deg)
        }
}
@-webkit-keyframes anim_lepestok_6{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(133deg);
            transform:translate(-50%,-50%) rotate(133deg)
        }
        100%{
            -webkit-transform:translate(120%,100%) rotate(133deg);
            transform:translate(120%,100%) rotate(133deg)
        }
}
@keyframes anim_lepestok_6{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(133deg);
            transform:translate(-50%,-50%) rotate(133deg)
        }
        100%{
            -webkit-transform:translate(120%,100%) rotate(133deg);
            transform:translate(120%,100%) rotate(133deg)
        }
}

@-webkit-keyframes anim_lepestok_7{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(163deg);
            transform:translate(-50%,-50%) rotate(163deg)
        }
        100%{
            -webkit-transform:translate(19%,159%) rotate(163deg);
            transform:translate(19%,159%) rotate(163deg)
        }
}
@keyframes anim_lepestok_7{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(163deg);
            transform:translate(-50%,-50%) rotate(163deg)
        }
        100%{
            -webkit-transform:translate(19%,159%) rotate(163deg);
            transform:translate(19%,159%) rotate(163deg)
        }
}

@-webkit-keyframes anim_lepestok_8{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(202deg);
            transform:translate(-50%,-50%) rotate(202deg)
        }
        100%{
            -webkit-transform:translate(-113%,156%) rotate(202deg);
            transform:translate(-113%,156%) rotate(202deg)
        }
}
@keyframes anim_lepestok_8{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(202deg);
            transform:translate(-50%,-50%) rotate(202deg)
        }
        100%{
            -webkit-transform:translate(-113%,156%) rotate(202deg);
            transform:translate(-113%,156%) rotate(202deg)
        }
}
@-webkit-keyframes anim_lepestok_9{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(225deg);
            transform:translate(-50%,-50%) rotate(225deg)
        }
        100%{
            -webkit-transform:translate(-216%,105%) rotate(225deg);
            transform:translate(-216%,105%) rotate(225deg)
        }
}
@keyframes anim_lepestok_9{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(225deg);
            transform:translate(-50%,-50%) rotate(225deg)
        }
        100%{
            -webkit-transform:translate(-216%,105%) rotate(225deg);
            transform:translate(-216%,105%) rotate(225deg)
        }
}
@-webkit-keyframes anim_lepestok_10{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(254deg);
            transform:translate(-50%,-50%) rotate(254deg)
        }
        100%{
            -webkit-transform:translate(-276%,9%) rotate(254deg);
            transform:translate(-276%,9%) rotate(254deg)
        }
}
@keyframes anim_lepestok_10{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(254deg);
            transform:translate(-50%,-50%) rotate(254deg)
        }
        100%{
            -webkit-transform:translate(-276%,9%) rotate(254deg);
            transform:translate(-276%,9%) rotate(254deg)
        }
}
@-webkit-keyframes anim_lepestok_11{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(284deg);
            transform:translate(-50%,-50%) rotate(284deg)
        }
        100%{
            -webkit-transform:translate(-278%,-102%) rotate(284deg);
            transform:translate(-278%,-102%) rotate(284deg)
        }
}
@keyframes anim_lepestok_11{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(284deg);
            transform:translate(-50%,-50%) rotate(284deg)
        }
        100%{
            -webkit-transform:translate(-278%,-102%) rotate(284deg);
            transform:translate(-278%,-102%) rotate(284deg)
        }
}
@-webkit-keyframes anim_lepestok_12{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(313deg);
            transform:translate(-50%,-50%) rotate(313deg)
        }
        100%{
            -webkit-transform:translate(-218%,-203%) rotate(313deg);
            transform:translate(-218%,-203%) rotate(313deg)
        }
}
@keyframes anim_lepestok_12{
    0%{
            -webkit-transform:translate(-50%,-50%) rotate(313deg);
            transform:translate(-50%,-50%) rotate(313deg)
        }
        100%{
            -webkit-transform:translate(-218%,-203%) rotate(313deg);
            transform:translate(-218%,-203%) rotate(313deg)
        }
}
@-webkit-keyframes anim5__fadeOut{0%{opacity:1}100%{opacity:0}}@keyframes anim5__fadeOut{0%{opacity:1}100%{opacity:0}}

@-webkit-keyframes anim5__fadeIn{0%{opacity:0}100%{opacity:1}}@keyframes anim5__fadeIn{0%{opacity:0}100%{opacity:1}}

@-webkit-keyframes anim5__login{0%{width:334px}100%{width:65px}}@keyframes anim5__login{0%{width:334px}100%{width:65px}}
@-webkit-keyframes anim5__content{0%{-webkit-transform:translateX(-50.5%);transform:translateX(-50.5%)}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes anim5__content{0%{-webkit-transform:translateX(-50.5%);transform:translateX(-50.5%)}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@-webkit-keyframes anim5__click{0%,100%{-webkit-transform:scale(1);transform:scale(1)}25%{-webkit-transform:scale(.8);transform:scale(.8)}75%{-webkit-transform:scale(1.1);transform:scale(1.1)}}@keyframes anim5__click{0%,100%{-webkit-transform:scale(1);transform:scale(1)}25%{-webkit-transform:scale(.8);transform:scale(.8)}75%{-webkit-transform:scale(1.1);transform:scale(1.1)}}

@-webkit-keyframes fadein{0%{opacity:0}100%{opacity:1}}@keyframes fadein{0%{opacity:0}100%{opacity:1}}

@-webkit-keyframes popin{0%{-webkit-transform:scale(0);transform:scale(0);opacity:0}85%{-webkit-transform:scale(1.05);transform:scale(1.05);opacity:1}100%{-webkit-transform:scale(1);transform:scale(1);opacity:1}}@keyframes popin{0%{-webkit-transform:scale(0);transform:scale(0);opacity:0}85%{-webkit-transform:scale(1.05);transform:scale(1.05);opacity:1}100%{-webkit-transform:scale(1);transform:scale(1);opacity:1}}
}

/*======end media anime========*/
@media (max-width: 400px) {
	.historymenu {
		padding-top:10px;
	}
	.firsttext {
		width:100%;
	}
	.historyback {display:none;}
	.garanteetext, .missiontext {
		padding-right: 10px;
		width:100%;
	}
	.missiontext {
		padding-left: 30px;
		background-size: 25px 25px;
	}	
	.historypage h2 {
		width:100%;
	}	
	.ourpluses {
		background:none;
		display: block;
		width:100%;
		height: auto;
		padding: 0;
	}
	.historypage ul.ourpluseslist {
		padding: 10px;
		width: 100%;
	}
	.garanteetext {
		padding-left: 55px;
		background-size: 50px 50px;
		height:auto;
	}	
	.assort {
		padding: 10px;
		width: 100%;
	}	
	.historypage div.assortlist{
		margin: 0;
		padding: 10px 5px;
		width:100%;
	}	
	.infblock {
		margin-left: -15px;
	}
	.historymenum {margin-bottom:15px;}
}
');

$this->registerJs("
	$('.historyitemtitle').on('click',function(){
		var id = $(this).data('id');
		$('.historyitemtitle').removeClass('active');
		$('.historyitemtitle[data-id='+id+']').addClass('active');
		$('.historymenuselect option[value='+id+']').addClass('active');
		$('.historyitemtext').addClass('hidden');
		$('.historyitemtext[data-id='+id+']').removeClass('hidden');
	});
	$('.historymenuselect').on('change',function(){
		var id = $('.historymenuselect').val();
		$('.historyitemtitle').removeClass('active');
		$('.historyitemtitle[data-id='+id+']').addClass('active');
		$('.historyitemtext').addClass('hidden');
		$('.historyitemtext[data-id='+id+']').removeClass('hidden');
	});
	$('.expIn').on('click',function(){
		$(this).parent().toggleClass('active');
	});
     $(document).ready(function() {
     if ($(window).width() >767) {
        (function manageAnims() {
            'use strict';
            var anims = document.querySelectorAll('.js-anim8');
            var buffer = false;
            var animsRun = 0;
            var checkAnims = (function () {
                var height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                for (var i = 0; i < anims.length; i++) {
                    var node = anims[i];
                    var rect = node.getBoundingClientRect();
                    var hasRun = anims[i].style.animationPlayState === 'running';
                    var isInView = rect.bottom < height && rect.top > 0;
                    if (!hasRun && isInView) {
                        node.style.animationPlayState = 'running';
                        animsRun++;
                    }
                }
                if (animsRun === anims.length) window.removeEventListener('scroll', requestBuffer);
                buffer = false;
            });
            var requestBuffer = (function () {
                if (!buffer) requestAnimationFrame(checkAnims);
                buffer = true;
            });
            window.addEventListener('scroll', requestBuffer);
        })();
        
     $('.tab-item5').not(':first').hide(); 
		$('.tab5').click(function(e) {
			var target = this;
			$(target).addClass('active').siblings('.active').removeClass('active');
			//$('.tab5').removeClass('active').eq($(this).index()).addClass('active');
			$('.tab-item5').hide().eq($(this).index()).fadeIn();       
			$('.tab-item5').removeClass('run_lep').eq($(this).index()).addClass('run_lep');      
		}).eq(0).addClass('active'); 
    }
});	
");
?>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed:400,500|Yanone+Kaffeesatz&amp;subset=cyrillic" rel="stylesheet">
<div class="wrapper historypage">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
    </ol>
    <div>
        <div style="text-align: center; margin:20px 0;">
            <?php if ($separateFilelds) { ?>
				<?php foreach ($history as $h): ?>   
					<?php
						$hh[] = $h->{'name_'.$lang};
						$ht[] = $h->{'text_'.$lang};
					?>
					<?php  ?>
					<?php /*         
					<div class="history__img" style="background-image:url(<?=$h->image->url?>)">
						<div class="col-sm-4 col-xs-12 history__name">
							<?=$h->{'name_'.$lang}?>
						</div>
						<div class="col-sm-8 col-xs-12 history__text">
							<?=$h->{'text_'.$lang}?>
						</div>
					</div> */ ?>
				<?php endforeach; ?>
				<div class="infblock">
					<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs historymenu">
						<?php foreach ($hh as $i=>$he) { ?>						
							<div data-id="<?php echo $i; ?>" class="historyitemtitle<?php echo ($i==0)?' active ':''?>"><span><?php echo $he; ?></span></div>
						<?php }?>
					</div>
					<div class="hidden-lg hidden-md hidden-sm col-xs-12 historymenum">
						<select class="historymenuselect form-control">
							<?php foreach ($hh as $i=>$he) { ?>						
								<option value="<?php echo $i; ?>" class="<?php echo ($i==0)?' active ':''?>"><?php echo $he; ?></option>
							<?php }?>
						</select>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 ">
						<?php foreach ($ht as $i=>$hte) { ?>
							<div data-id="<?php echo $i; ?>" class="historyitemtext history__img_sep <?php echo ($i==0)?'':' hidden '?>">
								<h2 style="font-size:2rem;"><?php echo $hh[$i]; ?></h2>								
								<div class=""><?php echo $hte; ?></div>
							</div>
						<?php }?>
					</div>
				</div>
			<?php } else { ?> 
				<?php foreach ($history as $h): ?>
					<div class="history__img_sep">
						<?php /* <img class="img-responsible" src="<?=$h->image->url?>" alt="<?=$h->{'name_'.$lang}?>" />   */ ?>
						<div class="text-left"><?=$h->{'text_'.$lang}?> </div>          
					</div>
				<?php endforeach; ?>                
            <?php } ?>
        </div>
    </div>
</div><?php

/* code for flower 

<div class="flowerblock">
	<div class="snipAnim8 js-anim8" style="animation-play-state: running;">    
		<span class="anim_lepestok anim_lepestok_1 tab5"></span>
		<span class="anim_lepestok anim_lepestok_2 tab5"></span>
		<span class="anim_lepestok anim_lepestok_3 tab5"></span>
		<span class="anim_lepestok anim_lepestok_4 tab5"></span>
		<span class="anim_lepestok anim_lepestok_5 tab5"></span>
		<span class="anim_lepestok anim_lepestok_6 tab5"></span>
		<span class="anim_lepestok anim_lepestok_7 tab5"></span>
		<span class="anim_lepestok anim_lepestok_8 tab5"></span>
		<span class="anim_lepestok anim_lepestok_9 tab5"></span>
		<span class="anim_lepestok anim_lepestok_10 tab5"></span>
		<span class="anim_lepestok anim_lepestok_11 tab5"></span>
		<span class="anim_lepestok anim_lepestok_12 tab5"></span>
		<div class="inn_crcl">
			<div class="tab-item5" style="display: none;">ціни на 20% нижчі за середньоринкові;</div>
			<div class="tab-item5" style="display: none;">бонуси для постійних клієнтів;</div>
			<div class="tab-item5" style="display: none;">безкоштовна доставка;</div>
			<div class="tab-item5" style="display: none;">вигідні оптові ціни;</div>
			<div class="tab-item5" style="display: none;">прийом замовлень і відправка день в день до 17.00;</div>
			<div class="tab-item5" style="display: none;">готівковий, безготівковий розрахунок;</div>
			<div class="tab-item5" style="display: none;">накладений платіж або передоплата на карту &laquo;Приватбанку&raquo;;</div>
			<div class="tab-item5" style="display: none;">швидка обробка та відправка замовлень зручною транспортною компанією.&nbsp;</div>
			<div class="tab-item5" style="display: none;">&nbsp;</div>
			<div class="tab-item5" style="display: none;">&nbsp;</div>
			<div class="tab-item5" style="display: none;">&nbsp;</div>
			<div class="tab-item5" style="display: none;">&nbsp;</div>
		</div>
		<div class="crcl_bg"></div>
		<div class="crcl"></div>
		<div class="crcl_bottom"></div> 
	</div>
	 
     <div class="backs"></div>
		<div class="task">
			<p class="task_in">Принципи</p>
			<p class="task_in">Iнструменти</p>
			<p><strong>Наша ціль</strong> – залишатись лідером ринку, забезпечуючи плідну та взаємовигідну <strong>співпрацю, що гарантує успіх</strong></p>
        </div>
	</div>	 
</div>
*/

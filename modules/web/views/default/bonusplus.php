<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">

<div class="container1">
    <div class="element shaped">

        <!--<div class="element2 ">te</div>-->
    </div>
    <!--<div class="element2 ">te</div>-->
    <div class="shape-content">

        <div class=" line ">
            <div class="first-line">
                <div class="number-box number-box-1">
                    <div class="text-box">
                        <p class="text-content"><?=$data['first-line']?></p>
                    </div>

                </div>
                <div class="first-list">
                    <?=$data['first-text']?>
<!--                    <ul>-->
<!--                        <p>Купуй товар:</p>-->
<!--                        <li><span class="list-item-new"></span>-->
<!--                            <p>На сайте</p></li>-->
<!--                        <li><span class="list-item-new list-item-new2"></span>-->
<!--                            <p>У мобiльному додатку</p></li>-->
<!--                        <li><span class="list-item-new"></span>-->
<!--                            <p>По телефону</p></li>-->
<!--                    </ul>-->
                </div>


                <div class="mob-bonus-block" style="  ">
                    <div class="">
                        <p class="mob-bonus-text" style="">
                           <?=$data['mob-bonus-text']?>
                        </p>
                        <div class="links-block">
                            <a href="https://itunes.apple.com/ua/app/%D0%BA%D0%BE%D1%80%D0%BF%D0%BE%D1%80%D0%B0%D1%86%D1%96%D1%8F-%D0%B3%D0%B5%D0%BA%D1%82%D0%B0%D1%80/id1267314950?l=ru&amp;mt=8"
                               class="mob-links-item mob-links-item1 ">

                            </a>
                            <a href="https://play.google.com/store/apps/details?id=ua.com.hectarenn"
                               class="mob-links-item mob-links-item2">

                            </a>

                        </div>
                    </div>

                </div>

                <div class="number-box  mob-add" style="">
                    <div class="text-box">
                        <p class="text-content"><?=$data['mob-bonus-title']?></p>


                    </div>

                </div>


            </div>
        </div>

        <div class=" line ">
            <div class="second-line">
                <div class="number-box number-box-2">
                    <div class="text-box">
                        <p class="text-content"><?=$data['second-line']?></p>
                    </div>

                </div>
                <div class="first-list second-list">
                    <?=$data['second-text']?>
<!--                    <ul>-->
<!--                        <p>Отримуй 1% бонусів від свого замовлення-->
<!--                            на свою карту. 1 бонус = 1 гривні.</p>-->
<!--                        <li><span class="list-item-new"></span>-->
<!--                            <p>-->
<!--                                На сайті та у мобільному додатку Компанії Гектар Ви можете-->
<!--                                зручно оформити замовлення та повернути % своїх коштів-->
<!--                                у вигляді бонусів.-->
<!--                            </p>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="list-item-new list-item-new2"></span>-->
<!--                            <p>-->
<!--                                Номер мобільного телефону з якого буде зроблено замовлення-->
<!--                                автоматично стає № вашої карти.-->
<!--                            </p>-->
<!--                        </li>-->
<!--                        <li><span class="list-item-new"></span>-->
<!--                            <p>-->
<!--                                Перевірити свої бонуси ви можете в особистому кабінеті через-->
<!--                                мобільний додаток та ПК-->
<!--                            </p>-->
<!--                        </li>-->
<!--                    </ul>-->
                </div>
            </div>
        </div>


        <div class=" line ">
            <div class="third-line">
                <div class="number-box number-box-3">
                    <div class="text-box">
                        <p class="text-content">
                            <?=$data['third-line']?>
                        </p>
                    </div>

                </div>
                <div class="first-list second-list">
                    <?=$data['third-text']?>
<!--                    <ul>-->
<!--                        <p class="third-text">-->
<!--                            Усі власники Бонус карти можуть витратити-->
<!--                            свої бонуси на безкоштовну доставку-->
<!--                            та знижку на замовлення.-->
<!--                        </p>-->
<!---->
<!--                        <a href="#" class="checkBonus-btn">-->
<!--                            Перевірити бонуси-->
<!--                        </a>-->

<!--                    </ul>-->
                </div>
            </div>
        </div>
        <div class=" line ">
            <div class="four-line">
                <p class="four-text">
                    <?=$data['four-text']?>
                </p>
                <ul class="social-list">
                    <li><a href="https://www.facebook.com/hectare.com.ua/" class="socialBonusLink socialBonusLink1"></a>
                    </li>
                    <li><a href="http://www.thepictaram.club/instagram/hectare.ua"
                           class="socialBonusLink socialBonusLink2"></a></li>
                    <li><a href="https://www.youtube.com/channel/UClDBb2LZS_ydbqe3i1S5gNg"
                           class="socialBonusLink socialBonusLink3"> </a></li>
                    <li><a href="https://plus.google.com/u/0/117035932073520023091"
                           class="socialBonusLink socialBonusLink4"></a></li>
                </ul>
            </div>
        </div>

    </div>
    <!--    <div class="element2 ">te</div>-->

</div>

<div class="bonus-footer">
    <div class="container">
        <div class="col-md-4">
            <div class="bonus-footer-item">
                <p><?= Yii::t('web', 'Напиши письмо:') ?></p>
				<?php foreach($data['email'] as $key=>$email): ?>
				<p><?=$email->c_body?></p>
                <!-- <p>hectare.ua@gmail.com</p> -->
				<?php if($key==0) break; ?>
				<?php endforeach ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bonus-footer-item ">
                <div class="question-block">
				    <p><?= Yii::t('web', 'Есть вопросы') ?></p>
                   <!-- <p>Маєш питання</p> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bonus-footer-item">
                <p><?= Yii::t('web', 'Позвони по телефону:') ?></p>
				<?php foreach($data['telefone'] as $key=>$telefone): ?>
				<a href=""><?=$telefone->c_body?></a>
                <?php if($key==2) break; ?>
				
				<?php endforeach ?>
              <!--  <a href="">+38 (096) 733 73 30</a>

                <a href="">+38 (099) 733 73 30</a>

                <a href="">+38 (093) 733 73 30</a> -->
				
            </div>
        </div>
    </div>
</div>


<style>

.third-text{
    padding-top: 50px;
}
    body {
           background-color: #F5F5F5;
           color: #555;
           font-size: 1.1em;
           font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
       }

    .bonus-footer {
        background: url("../img/bonusplus/footersBonus-bg.jpg");
        min-height: 300px;
        background-position: center;
        -webkit-background-size: cover;
        background-size: cover;
        padding-top: 100px;
    }

    .bonus-footer-item p {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 24px;
        color: #ffffff;
    }

    .bonus-footer-item a {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 24px;
        color: #ffffff;
        display: block;
        margin-bottom: 15px;
    }

    .bonus-footer-item a:hover {
        text-decoration: none;
        color: #ffffff;
    }

    .question-block {
        display: inline-block;
        width: 180px;
        height: 204px;
        background: url("../img/bonusplus/q.png");
        -webkit-background-size: cover;
        background-size: cover;
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
        margin-top: -38px;
    }

    .question-block p {
        position: absolute;
        bottom: -17px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 36px;
        text-transform: uppercase;
        color: #ffffff;
        line-height: 40px;
    }

    .container1 {

        background-color: white;
        overflow: hidden;
        height: 136vh;
        width: 100%
    }

    .element {
        width: 51%;
        height: 100%;
        float: left;
        background: url("../img/bonusplus/bonus-left_bg.jpg");
        -webkit-background-size: cover;
        background-size: cover;
        clip-path: polygon(0 0, 11% 0, 95% 100%, 0% 100%);
        -webkit-clip-path: polygon(0 0, 12% 0, 45% 100%, 0% 100%);
        -webkit-shape-outside: polygon(0 0, 12% 0, 45% 100%, 0% 100%) border-box;
        shape-outside: polygon(0 0, 12% 0, 45% 100%, 0% 100%) border-box;
        -webkit-shape-margin: 20px;
        shape-margin: 20px;
    }

    .shape-content {

        position: relative;
        background: url("../img/bonusplus/center.png");
        -webkit-background-size: 55% 55%;
        background-size: 55%;
        height: 100%;
        background-position: 91% 71%;
        background-repeat: no-repeat;
    }

    .shape-content:after {
        content: '';
        width: 29%;
        height: 81%;
        /* margin: 15px; */

        position: absolute;
        right: 0;
        float: right;
        top: 0;
        background: url("../img/bonusplus/bonus-left_bg.jpg");
        -webkit-background-size: cover;
        background-size: cover;
        clip-path: polygon(0 0, 100% 0, 99% 100%, 69% 75%);
        -webkit-clip-path: polygon(50% 0%, 100% 89%, 100% 0);
        -webkit-shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;
        shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;
        -webkit-shape-margin: 20px;
        shape-margin: 20px;
    }

    .element2 {
        width: 49%;
        height: 92%;
        /* margin: 15px; */
        position: absolute;
        right: 0;
        float: right;
        top: 0;
        background: #000;
        -webkit-background-size: cover;
        background-size: cover;
        -webkit-clip-path: polygon(50% 0%, 100% 89%, 100% 0);
        -webkit-shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;
        shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;
        -webkit-shape-margin: 20px;
        shape-margin: 20px;
    }

    .first-line {
        padding-right: 26%;
        padding-top: 110px;
    }

    .second-line {
        padding-top: 110px;
        padding-right: 8%;
    }

    .third-line {
        padding-top: 110px;
        padding-right: 8%;
    }

    .four-line {
        padding-top: 110px;
        padding-right: 0px;
    }

    .number-box, .text-box {
        display: inline-block;
        width: 180px;
        height: 204px;

    }

    .text-box {
        position: relative;
    }

    .text-content {
        position: absolute;
        bottom: -17px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 36px;
        text-transform: uppercase;
        color: #66221f;
        line-height: 40px;
    }

    .number-box-1 {
        background: url("../img/bonusplus/1.png");
        -webkit-background-size: cover;
        background-size: cover;
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
    }

    .number-box-1:after {
        content: '';
        display: inline-block;
        background: url(../img/bonusplus/card-icon.png);
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        height: 87px;
        width: 102px;
        position: absolute;
        right: -60px;
        top: 0px;
    }

    .number-box-2 {
        background: url("../img/bonusplus/2.png");
        -webkit-background-size: cover;
        background-size: cover;
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
    }

    .number-box-2:after {
        content: '';
        display: inline-block;
        background: url(../img/bonusplus/piggy-bank.png);
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        height: 87px;
        width: 102px;
        position: absolute;
        right: -60px;
        top: 0px;
    }

    .number-box-3 {
        background: url("../img/bonusplus/3.png");
        -webkit-background-size: cover;
        background-size: cover;
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
    }

    .number-box-3:after {
        content: '';
        display: inline-block;
        background: url(../img/bonusplus/voucher.png);
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        height: 87px;
        width: 102px;
        position: absolute;
        right: -60px;
        top: 0px;
    }

    .first-list {
        display: inline-block;
        margin-left: 90px;
        position: absolute;
    }

    .first-list  p {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 24px;
        text-transform: uppercase;
    }

    .first-list ul li {
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 600;*/
        /*font-size:14px;*/
        /*text-decoration: none;*/
        list-style: none;
        /*background: url(../img/bonusplus/wheat-icon.png) no-repeat left center;*/
        /*width: 130px;*/
        /*margin-bottom: 3px;*/
        /*margin-left: 76px;*/

    }

    .first-list ul li p {
        display: inline-block;
        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
        font-size: 14px;
        text-decoration: none;
        list-style: none;
        /*background: url(../img/bonusplus/wheat-icon.png) no-repeat left center;*/
        width: 130px;
        margin-bottom: 3px;
        margin-left: 5px;
        text-transform: none;
        vertical-align: middle;

    }

    .list-item-new {
        width: 20px;
        height: 23px;
        background: url(../img/bonusplus/wheat-icon.png);
        display: inline-block;
        background-repeat: no-repeat;
        margin-left: 76px;
        vertical-align: middle;
    }

    .list-item-new2 {
        height: 35px;

        display: inline-block;
        vertical-align: middle;
    }

    /*.first-list ul li:before{*/
    /*content: '';*/
    /*width: 20px;*/
    /*height: 20px;*/
    /*background: url(../img/bonusplus/wheat-icon.png);*/
    /*display: inline-block;*/
    /*background-repeat: no-repeat;*/
    /*}*/
    .mob-add {
        display: inline-block;
        float: right;
        background: url("../img/bonusplus/!.png");
        -webkit-background-size: cover;
        background-size: cover;
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
    }

    .mob-add:after {
        content: '';
        display: inline-block;
        background: url(../img/bonusplus/mobile-icon.png);
        -webkit-background-size: contain;
        background-size: contain;
        background-repeat: no-repeat;
        height: 87px;
        width: 102px;
        position: absolute;
        right: -60px;
        top: 0px;
    }

    .toPositionList {
        float: right;
        margin-right: 11%;
    }

    .toPositionList > .first-list {
        margin-left: 121px;
    }

    .mob-bonus-block > p{
        width: 180px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
        font-size: 14px;
        text-decoration: none;
        margin-bottom: 58px;
    }

    .mob-bonus-block:before {
        content: '';
        background: url(../img/bonusplus/wheat-icon.png);
        width: 20px;
        height: 25px;
        display: inline-block;
        float: initial;
        position: absolute;
        left: -27px;
        top: 24px;
        background-repeat: no-repeat;

    }

    .mob-bonus-block {
        float: right;
        position: absolute;
        right: 10%;
        top: 136px;
        z-index:3
    ;
    }

    .mob-links-item {

        display: inline-block;
        width: 132px;
        height: 40px;
        margin-right: 10px;

    }

    .mob-links-item1 {
        background: url(../img/bonusplus/AppStore.png);

        -webkit-background-size: contain;

        background-size: contain;
        background-repeat: no-repeat;
    }

    .mob-links-item2 {
        background: url(../img/bonusplus/google-play.png);

        -webkit-background-size: contain;

        background-size: contain;
        background-repeat: no-repeat;
    }

    .second-list {
        width: 49%;
    }

    .second-list ul li p {
        width: 79% !important;
        margin-bottom: 8px;
    }

    .checkBonus-btn {
        -webkit-border-radius: 30px;
        border-radius: 30px;
        background-color: rgb(245, 159, 8);
        max-width: -webkit-max-content;
        max-width: -moz-max-content;
        max-width: max-content;
        /* height: 81px; */
        display: block;
        z-index: 48;
        margin: 34px auto;
        padding: 18px 62px;
        text-align: center;
        color: #fff;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 14px;

    }

    .mob-add {
        float: right;
        margin-right: 143px;
        margin-top: -7px;
    }

    /*.four-text p {*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 24px;*/
        /*text-transform: uppercase;*/
        /*width: 75%;*/
        /*margin-bottom: 35px;*/
    /*} */
.four-line p {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 24px;
        text-transform: uppercase;
        width: 75%;
        margin-bottom: 35px;
    }

    .social-list li {
        display: inline-block;
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .socialBonusLink {
        display: block;
        width: 50px;
        height: 50px;
        background: url("../img/bonusplus/instagram-logo.png");
        -webkit-background-size: cover;
        background-size: cover;

    }

    .socialBonusLink:hover {
        -webkit-filter: grayscale(1);
        filter: grayscale(1);
    }

    .socialBonusLink1 {
        background: url("../img/bonusplus/facebook-logo-button.png");
        -webkit-background-size: cover;
        background-size: cover;
    }

    .socialBonusLink2 {
        background: url("../img/bonusplus/instagram-logo.png");
        -webkit-background-size: cover;
        background-size: cover;
    }

    .socialBonusLink3 {
        background: url("../img/bonusplus/youtube-symbol.png");
        -webkit-background-size: cover;
        background-size: cover;
    }

    .socialBonusLink4 {
        background: url("../img/bonusplus/google-plus-logo-button.png");
        -webkit-background-size: cover;
        background-size: cover;
    }

    /*.socialBonusLink{*/
    /*width: 50px;*/
    /*height: 50px;*/
    /**/

    /*}*/
    @media all and (min-width: 1560px) {
        .container1 {
            background-color: white;
            overflow: hidden;
            height: 161vh;
        }

        .element {
            width: 80%;
            height: 100%;
        }

        .shape-content:after {
            content: '';
            width: 54%;
        }

        .mob-add {
            float: right;
            margin-right: -1px;
            position: absolute;
            right: 38%;
            margin-top: -5px;
        }

        .mob-bonus-block {
            float: right;
            position: absolute;
            right: 14%;
            top: 146px;
            z-index: 3;
        }
        .third-line > .second-list {
            width: 35%;
        }
        checkBonus-btn {

            margin: 54px auto;
        }
        .second-list ul li p {
            width: 57% !important;
            margin-bottom: 8px;
        }
        /*.mob-add {*/
        /*float: right;*/
        /*margin-right: 229px;*/
        /*margin-top: -31px;*/
        /*}*/
        /*.mob-bonus-block {*/
        /*float: right;*/
        /*position: absolute;*/
        /*right: 14%;*/
        /*top: 94px;*/
        /*z-index: 999;*/
        /*}*/
    }

    @media all and (min-width: 1770px) {
        .container1 {
            background-color: white;
            overflow: hidden;
            height: 135vh;
        }

        .number-box-1 {

            margin-left: 23px;
        }

        .second-list {
            width: 46%;
        }

        .element {
            -webkit-background-size: contain;
            background-size: contain;
        }
    }

    @media all and (max-width: 1430px) {
        .first-line {
            padding-right: 24%;
        }

        .mob-bonus-block {
            float: right;
            position: absolute;
            right: 9%;
            top: 121px;
        }

        .mob-add {
            float: right;
            margin-right: 143px;
            margin-top: -7px;
        }

    }

    @media all and (max-height: 950px) {
        .container1 {
            background-color: white;
            overflow: hidden;
            height: 156vh;
        }
    }

    @media all and (max-height: 800px) {
        .container1 {
            background-color: white;
            overflow: hidden;
            height: 162vh;
        }

        .first-line {

            padding-top: 60px;
        }

        .second-line {
            padding-top: 60px;
        }

        .third-line {
            padding-top: 60px;
        }

        .four-line {
            padding-top: 60px;
        }
        .mob-bonus-block {
         
            top: 51px;
        }

    }
@media all and (max-height:700px) {
    .four-line {
        padding-top: 20px;
    }
    .four-line p {

        margin-bottom: 18px;
    }
}
@media all and (max-height:600px) {
    .four-line {
        padding-top: 5px;
    }
    .four-line p {

        margin-bottom: 5px;
    }
}
    @media all and (max-width: 1320px) {
        .first-line {
            padding-right: 20%;
        }

        .first-list {
            display: inline-block;
            margin-left: 65px;
        }

        .text-content {

            font-size: 26px
        }

        .mob-add:after {
            right: -36px;
        }

        .mob-bonus-block {
            float: right;
            position: absolute;
            right: 5%;
        }
    }

    @media all and (max-width: 1024px) {
        .number-box, .text-box {
            display: inline-block;
            width: 152px;
            height: 142px;
        }

        .first-list ul p {

            font-size: 19px;
        }

        .list-item-new {

            margin-left: 3px;
        }

        .first-line {
            padding-right: 193px;
        }

        .mob-bonus-block {
            float: right;
            position: absolute;
            right: 1%;
            top: 88px;
        }

        .mob-add:after {
            right: -36px;
            top: -23px;
        }

        .second-line {
            padding-top: 110px;
            padding-right: 8%;
            margin-bottom: 100px;
        }

        .second-list ul li p {
            width: 87% !important;
            margin-bottom: 8px;
        }
    }

    @media all and (max-width: 1023px) {
        .container1 {

            background-color: white;
            overflow: hidden;
            height: 100% !important;
            width: 100%;
            padding: 15px;
        }

        .element {
            display: none;
        }

        .shape-content {

        }

        .shape-content:after {
            display: none;
        }

        .first-list {
            display: inline-block;
            margin-left: 65px;
            float: left;
            position: relative;
        }

        .number-box, .text-box {
            display: inline-block;
            width: 152px;
            float: left;
            height: 142px;
        }

        .mob-bonus-block {
            float: left;
            position: initial;
            right: auto;
            top: auto;
            margin-bottom: 59px;
        }

        .first-line {
            padding-right: 0;
            min-height: 453px;
            margin-bottom: 108px;
            padding-top: 32px;
        }

        .second-line {
            padding-top: 2px;
            padding-right: 0;
        }

        .mob-bonus-block > p{
            width: 180px;
            margin: 40px auto;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            margin-bottom: 33px;
        }

        .second-line > .first-list {
            display: inline-block;
            margin-left: 0;
            float: left;
            width: 100%;
            position: relative;
            margin-bottom: 40px;
            margin-top: 40px;
        }

        .third-line > .first-list {
            display: inline-block;
            margin-left: 0;
            float: left;
            width: 100%;
            position: relative;
            margin-bottom: 0px;
            margin-top: 40px;
        }

        .four-line {
            padding-top: 0px;
            padding-right: 0px;
            margin: 46px;
            display: inline-block;
        }

        .bonus-footer {

            padding-top: 50px;
        }

        .question-block {

            margin: 20px;
        }
        .third-text{
            padding-top: 0px;
        }

        .number-box-2:after {

            right: -56px;
            top: -21px;
        }
        .number-box, .text-box {

            margin-bottom: 38px;
        }
    }

    @media all and (max-width: 500px) {
        .first-list ul p {
            font-size: 17px;
            /*margin-top: -20px;*/
        }
        .container {
            padding-right: 0;
            padding-left: 0;
        }
        .footer{
            margin-right: -15px;
            margin-left: 0;
        }
        .container , .page,  .bonuspage{
            padding-left: -1px;
        }
        body.container {
            width: auto;
        }
        /*.four-text p {*/
            /*font-family: 'Open Sans', sans-serif;*/
            /*font-weight: 700;*/
            /*font-size: 17px;*/
            /*text-transform: uppercase;*/
            /*width: 100%;*/
            /*margin-bottom: 35px;*/
        /*}*/
        .four-text p {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 17px;
            text-transform: uppercase;
            width: 100%;
            margin-bottom: 35px;
        }

        .social-list li {

            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .socialBonusLink {
            display: block;
            width: 50px;
            height: 50px;
        }

        .question-block p {

            font-weight: 700;
            font-size: 27px;
        }
        .four-line {

            margin: 15px;

        }
        .first-list p {

            font-size: 19px;

        }
        .four-line p {

            font-size: 19px;
        }

    }

    @-moz-document url-prefix()
    {
        .element {
            width: 10%;
            height: 100%;}
        .shape-content::after {
            content: '';
            width: 10%;
            height:100%;
        }
        .number-box, .text-box {

            margin-left: 15px;
        }
        .four-line {

            margin-left: 12%;
        }
    }
    /*@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {*/
        /*.element {*/
            /*width: 10%;*/
            /*height: 100%;}*/
        /*.shape-content::after {*/
            /*content: '';*/
            /*width: 10%;*/
            /*height:100%;*/
        /*}*/
        /*.number-box, .text-box {*/

            /*margin-left: 15px;*/
        /*}*/
        /*.four-line {*/

            /*margin-left: 12%;*/
        /*}*/
    /*}*/
    @supports (-ms-ime-align:auto) {
        .element {
            width: 10%;
            height: 100%;}
        .shape-content::after {
            content: '';
            width: 10%;
            height:100%;
        }
        .number-box, .text-box {

            margin-left: 15px;
        }
        .four-line {

            margin-left: 12%;
        }
        /*@media all and (min-width:1560px)*/
        .mob-bonus-block {
            float: right;
            position: absolute;
            right: 12%;
            top: 90px;
            z-index: 3;
        }

    }
    /*body {*/
        /*background-color: #F5F5F5;*/
        /*color: #555;*/
        /*font-size: 1.1em;*/
        /*font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;*/
    /*}*/

    /*.bonus-footer {*/
        /*background: url("../img/bonusplus/footersBonus-bg.jpg");*/
        /*min-height: 300px;*/
        /*background-position: center;*/
        /*background-size: cover;*/
        /*padding-top: 100px;*/
    /*}*/

    /*.bonus-footer-item p {*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 24px;*/
        /*color: #ffffff;*/
    /*}*/

    /*.bonus-footer-item a {*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 24px;*/
        /*color: #ffffff;*/
        /*display: block;*/
        /*margin-bottom: 15px;*/
    /*}*/

    /*.bonus-footer-item a:hover {*/
        /*text-decoration: none;*/
        /*color: #ffffff;*/
    /*}*/

    /*.question-block {*/
        /*display: inline-block;*/
        /*width: 180px;*/
        /*height: 204px;*/
        /*background: url("../img/bonusplus/q.png");*/
        /*background-size: cover;*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*position: relative;*/
        /*margin-top: -38px;*/
    /*}*/

    /*.question-block p {*/
        /*position: absolute;*/
        /*bottom: -17px;*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 36px;*/
        /*text-transform: uppercase;*/
        /*color: #ffffff;*/
        /*line-height: 40px;*/
    /*}*/

    /*.container1 {*/

        /*background-color: white;*/
        /*overflow: hidden;*/
        /*height: 136vh;*/
        /*width: 100%*/
    /*}*/

    /*.element {*/
        /*width: 51%;*/
        /*height: 100%;*/
        /*float: left;*/
        /*background: url("../img/bonusplus/bonus-left_bg.jpg");*/
        /*background-size: cover;*/
        /*-webkit-clip-path: polygon(0 0, 12% 0, 45% 100%, 0% 100%);*/
        /*-webkit-shape-outside: polygon(0 0, 12% 0, 45% 100%, 0% 100%) border-box;*/
        /*shape-outside: polygon(0 0, 12% 0, 45% 100%, 0% 100%) border-box;*/
        /*-webkit-shape-margin: 20px;*/
        /*shape-margin: 20px;*/
    /*}*/

    /*.shape-content {*/

        /*position: relative;*/
        /*background: url("../img/bonusplus/center.png");*/
        /*background-size: 55%;*/
        /*height: 100%;*/
        /*background-position: 91% 71%;*/
        /*background-repeat: no-repeat;*/
    /*}*/

    /*.shape-content:after {*/
        /*content: '';*/
        /*width: 29%;*/
        /*height: 81%;*/
        /*!* margin: 15px; *!*/

        /*position: absolute;*/
        /*right: 0;*/
        /*float: right;*/
        /*top: 0;*/
        /*background: url("../img/bonusplus/bonus-left_bg.jpg");*/
        /*background-size: cover;*/
        /*-webkit-clip-path: polygon(50% 0%, 100% 89%, 100% 0);*/
        /*-webkit-shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;*/
        /*shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;*/
        /*-webkit-shape-margin: 20px;*/
        /*shape-margin: 20px;*/
    /*}*/

    /*.element2 {*/
        /*width: 49%;*/
        /*height: 92%;*/
        /*!* margin: 15px; *!*/
        /*position: absolute;*/
        /*right: 0;*/
        /*float: right;*/
        /*top: 0;*/
        /*background: #000;*/
        /*background-size: cover;*/
        /*-webkit-clip-path: polygon(50% 0%, 100% 89%, 100% 0);*/
        /*-webkit-shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;*/
        /*shape-outside: polygon(50% 0%, 100% 89%, 100% 0) border-box;*/
        /*-webkit-shape-margin: 20px;*/
        /*shape-margin: 20px;*/
    /*}*/

    /*.first-line {*/
        /*padding-right: 26%;*/
        /*padding-top: 110px;*/
    /*}*/

    /*.second-line {*/
        /*padding-top: 110px;*/
        /*padding-right: 8%;*/
    /*}*/

    /*.third-line {*/
        /*padding-top: 110px;*/
        /*padding-right: 8%;*/
    /*}*/

    /*.four-line {*/
        /*padding-top: 110px;*/
        /*padding-right: 0px;*/
    /*}*/

    /*.number-box, .text-box {*/
        /*display: inline-block;*/
        /*width: 180px;*/
        /*height: 204px;*/

    /*}*/

    /*.text-box {*/
        /*position: relative;*/
    /*}*/

    /*.text-content {*/
        /*position: absolute;*/
        /*bottom: -17px;*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 36px;*/
        /*text-transform: uppercase;*/
        /*color: #66221f;*/
        /*line-height: 40px;*/
    /*}*/

    /*.number-box-1 {*/
        /*background: url("../img/bonusplus/1.png");*/
        /*background-size: cover;*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*position: relative;*/
    /*}*/

    /*.number-box-1:after {*/
        /*content: '';*/
        /*display: inline-block;*/
        /*background: url(../img/bonusplus/card-icon.png);*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*height: 87px;*/
        /*width: 102px;*/
        /*position: absolute;*/
        /*right: -60px;*/
        /*top: 0px;*/
    /*}*/

    /*.number-box-2 {*/
        /*background: url("../img/bonusplus/2.png");*/
        /*background-size: cover;*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*position: relative;*/
    /*}*/

    /*.number-box-2:after {*/
        /*content: '';*/
        /*display: inline-block;*/
        /*background: url(../img/bonusplus/piggy-bank.png);*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*height: 87px;*/
        /*width: 102px;*/
        /*position: absolute;*/
        /*right: -60px;*/
        /*top: 0px;*/
    /*}*/

    /*.number-box-3 {*/
        /*background: url("../img/bonusplus/3.png");*/
        /*background-size: cover;*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*position: relative;*/
    /*}*/

    /*.number-box-3:after {*/
        /*content: '';*/
        /*display: inline-block;*/
        /*background: url(../img/bonusplus/voucher.png);*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*height: 87px;*/
        /*width: 102px;*/
        /*position: absolute;*/
        /*right: -60px;*/
        /*top: 0px;*/
    /*}*/

    /*.first-list {*/
        /*display: inline-block;*/
        /*margin-left: 90px;*/
        /*position: absolute;*/
    /*}*/

    /*.first-list ul p {*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 24px;*/
        /*text-transform: uppercase;*/
    /*}*/

    /*.first-list ul li {*/
        /*!*font-family: 'Open Sans', sans-serif;*!*/
        /*!*font-weight: 600;*!*/
        /*!*font-size:14px;*!*/
        /*!*text-decoration: none;*!*/
        /*list-style: none;*/
        /*!*background: url(../img/bonusplus/wheat-icon.png) no-repeat left center;*!*/
        /*!*width: 130px;*!*/
        /*!*margin-bottom: 3px;*!*/
        /*!*margin-left: 76px;*!*/

    /*}*/

    /*.first-list ul li p {*/
        /*display: inline-block;*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 400;*/
        /*font-size: 14px;*/
        /*text-decoration: none;*/
        /*list-style: none;*/
        /*!*background: url(../img/bonusplus/wheat-icon.png) no-repeat left center;*!*/
        /*width: 130px;*/
        /*margin-bottom: 3px;*/
        /*margin-left: 5px;*/
        /*text-transform: none;*/
        /*vertical-align: middle;*/

    /*}*/

    /*.list-item-new {*/
        /*width: 20px;*/
        /*height: 23px;*/
        /*background: url(../img/bonusplus/wheat-icon.png);*/
        /*display: inline-block;*/
        /*background-repeat: no-repeat;*/
        /*margin-left: 76px;*/
        /*vertical-align: middle;*/
    /*}*/

    /*.list-item-new2 {*/
        /*height: 35px;*/

        /*display: inline-block;*/
        /*vertical-align: middle;*/
    /*}*/

    /*!*.first-list ul li:before{*!*/
    /*!*content: '';*!*/
    /*!*width: 20px;*!*/
    /*!*height: 20px;*!*/
    /*!*background: url(../img/bonusplus/wheat-icon.png);*!*/
    /*!*display: inline-block;*!*/
    /*!*background-repeat: no-repeat;*!*/
    /*!*}*!*/
    /*.mob-add {*/
        /*display: inline-block;*/
        /*float: right;*/
        /*background: url("../img/bonusplus/!.png");*/
        /*background-size: cover;*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*position: relative;*/
    /*}*/

    /*.mob-add:after {*/
        /*content: '';*/
        /*display: inline-block;*/
        /*background: url(../img/bonusplus/mobile-icon.png);*/
        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
        /*height: 87px;*/
        /*width: 102px;*/
        /*position: absolute;*/
        /*right: -60px;*/
        /*top: 0px;*/
    /*}*/

    /*.toPositionList {*/
        /*float: right;*/
        /*margin-right: 11%;*/
    /*}*/

    /*.toPositionList > .first-list {*/
        /*margin-left: 121px;*/
    /*}*/

    /*.mob-bonus-text {*/
        /*width: 180px;*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 400;*/
        /*font-size: 14px;*/
        /*text-decoration: none;*/
        /*margin-bottom: 58px;*/
    /*}*/

    /*.mob-bonus-text:before {*/
        /*content: '';*/
        /*background: url(../img/bonusplus/wheat-icon.png);*/
        /*width: 20px;*/
        /*height: 20px;*/
        /*display: inline-block;*/
        /*float: initial;*/
        /*position: absolute;*/
        /*left: -27px;*/
        /*top: 24px;*/
        /*background-repeat: no-repeat;*/

    /*}*/

    /*.mob-bonus-block {*/
        /*float: right;*/
        /*position: absolute;*/
        /*right: 10%;*/
        /*top: 136px;*/
        /*z-index:3*/
    /*;*/
    /*}*/

    /*.mob-links-item {*/

        /*display: inline-block;*/
        /*width: 132px;*/
        /*height: 40px;*/
        /*margin-right: 10px;*/

    /*}*/

    /*.mob-links-item1 {*/
        /*background: url(../img/bonusplus/AppStore.png);*/

        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
    /*}*/

    /*.mob-links-item2 {*/
        /*background: url(../img/bonusplus/google-play.png);*/

        /*background-size: contain;*/
        /*background-repeat: no-repeat;*/
    /*}*/

    /*.second-list {*/
        /*width: 49%;*/
    /*}*/

    /*.second-list ul li p {*/
        /*width: 79% !important;*/
        /*margin-bottom: 8px;*/
    /*}*/

    /*.checkBonus-btn {*/
        /*border-radius: 30px;*/
        /*background-color: rgb(245, 159, 8);*/
        /*max-width: max-content;*/
        /*!* height: 81px; *!*/
        /*display: block;*/
        /*z-index: 48;*/
        /*margin: 34px auto;*/
        /*padding: 18px 62px;*/
        /*text-align: center;*/
        /*color: #fff;*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 14px;*/

    /*}*/

    /*.mob-add {*/
        /*float: right;*/
        /*margin-right: 143px;*/
        /*margin-top: -7px;*/
    /*}*/

    /*.four-text {*/
        /*font-family: 'Open Sans', sans-serif;*/
        /*font-weight: 700;*/
        /*font-size: 24px;*/
        /*text-transform: uppercase;*/
        /*width: 75%;*/
        /*margin-bottom: 35px;*/
    /*}*/

    /*.social-list li {*/
        /*display: inline-block;*/
        /*width: 100px;*/
        /*height: 100px;*/
        /*margin-right: 10px;*/
    /*}*/

    /*.socialBonusLink {*/
        /*display: block;*/
        /*width: 100px;*/
        /*height: 100px;*/
        /*background: url("../img/bonusplus/instagram-logo.png");*/
        /*background-size: cover;*/

    /*}*/

    /*.socialBonusLink:hover {*/
        /*filter: grayscale(1);*/
    /*}*/

    /*.socialBonusLink1 {*/
        /*background: url("../img/bonusplus/facebook-logo-button.png");*/
        /*background-size: cover;*/
    /*}*/

    /*.socialBonusLink2 {*/
        /*background: url("../img/bonusplus/instagram-logo.png");*/
        /*background-size: cover;*/
    /*}*/

    /*.socialBonusLink3 {*/
        /*background: url("../img/bonusplus/youtube-symbol.png");*/
        /*background-size: cover;*/
    /*}*/

    /*.socialBonusLink4 {*/
        /*background: url("../img/bonusplus/google-plus-logo-button.png");*/
        /*background-size: cover;*/
    /*}*/

    /*!*.socialBonusLink{*!*/
    /*!*width: 50px;*!*/
    /*!*height: 50px;*!*/
    /*!**!*/

    /*!*}*!*/
    /*@media all and (min-width: 1560px) {*/
        /*.container1 {*/
            /*background-color: white;*/
            /*overflow: hidden;*/
            /*height: 161vh;*/
        /*}*/

        /*.element {*/
            /*width: 80%;*/
            /*height: 100%;*/
        /*}*/

        /*.shape-content:after {*/
            /*content: '';*/
            /*width: 54%;*/
        /*}*/

        /*.mob-add {*/
            /*float: right;*/
            /*margin-right: -1px;*/
            /*position: absolute;*/
            /*right: 38%;*/
            /*margin-top: -5px;*/
        /*}*/

        /*.mob-bonus-block {*/
            /*float: right;*/
            /*position: absolute;*/
            /*right: 19%;*/
            /*top: 146px;*/
            /*z-index: 3;*/
        /*}*/
        /*.third-line > .second-list {*/
            /*width: 35%;*/
        /*}*/
        /*checkBonus-btn {*/

            /*margin: 54px auto;*/
        /*}*/
        /*.second-list ul li p {*/
            /*width: 57% !important;*/
            /*margin-bottom: 8px;*/
        /*}*/
        /*!*.mob-add {*!*/
        /*!*float: right;*!*/
        /*!*margin-right: 229px;*!*/
        /*!*margin-top: -31px;*!*/
        /*!*}*!*/
        /*!*.mob-bonus-block {*!*/
        /*!*float: right;*!*/
        /*!*position: absolute;*!*/
        /*!*right: 14%;*!*/
        /*!*top: 94px;*!*/
        /*!*z-index: 999;*!*/
        /*!*}*!*/
    /*}*/

    /*@media all and (min-width: 1770px) {*/
        /*.container1 {*/
            /*background-color: white;*/
            /*overflow: hidden;*/
            /*height: 135vh;*/
        /*}*/

        /*.number-box-1 {*/

            /*margin-left: 23px;*/
        /*}*/

        /*.second-list {*/
            /*width: 46%;*/
        /*}*/

        /*.element {*/
            /*background-size: contain;*/
        /*}*/
    /*}*/

    /*@media all and (max-width: 1430px) {*/
        /*.first-line {*/
            /*padding-right: 24%;*/
        /*}*/

        /*.mob-bonus-block {*/
            /*float: right;*/
            /*position: absolute;*/
            /*right: 9%;*/
            /*top: 121px;*/
        /*}*/

        /*.mob-add {*/
            /*float: right;*/
            /*margin-right: 143px;*/
            /*margin-top: -7px;*/
        /*}*/

    /*}*/

    /*@media all and (max-height: 950px) {*/
        /*.container1 {*/
            /*background-color: white;*/
            /*overflow: hidden;*/
            /*height: 156vh;*/
        /*}*/
    /*}*/

    /*@media all and (max-height: 800px) {*/
        /*.container1 {*/
            /*background-color: white;*/
            /*overflow: hidden;*/
            /*height: 162vh;*/
        /*}*/

        /*.first-line {*/

            /*padding-top: 60px;*/
        /*}*/

        /*.second-line {*/
            /*padding-top: 60px;*/
        /*}*/

        /*.third-line {*/
            /*padding-top: 60px;*/
        /*}*/

        /*.four-line {*/
            /*padding-top: 60px;*/
        /*}*/
    /*}*/

    /*@media all and (max-width: 1320px) {*/
        /*.first-line {*/
            /*padding-right: 20%;*/
        /*}*/

        /*.first-list {*/
            /*display: inline-block;*/
            /*margin-left: 65px;*/
        /*}*/

        /*.text-content {*/

            /*font-size: 26px*/
        /*}*/

        /*.mob-add:after {*/
            /*right: -36px;*/
        /*}*/

        /*.mob-bonus-block {*/
            /*float: right;*/
            /*position: absolute;*/
            /*right: 5%;*/
        /*}*/
    /*}*/

    /*@media all and (max-width: 1024px) {*/
        /*.number-box, .text-box {*/
            /*display: inline-block;*/
            /*width: 152px;*/
            /*height: 142px;*/
        /*}*/

        /*.first-list ul p {*/

            /*font-size: 19px;*/
        /*}*/

        /*.list-item-new {*/

            /*margin-left: 3px;*/
        /*}*/

        /*.first-line {*/
            /*padding-right: 193px;*/
        /*}*/

        /*.mob-bonus-block {*/
            /*float: right;*/
            /*position: absolute;*/
            /*right: 1%;*/
            /*top: 88px;*/
        /*}*/

        /*.mob-add:after {*/
            /*right: -36px;*/
            /*top: -23px;*/
        /*}*/

        /*.second-line {*/
            /*padding-top: 110px;*/
            /*padding-right: 8%;*/
            /*margin-bottom: 100px;*/
        /*}*/

        /*.second-list ul li p {*/
            /*width: 87% !important;*/
            /*margin-bottom: 8px;*/
        /*}*/
    /*}*/

    /*@media all and (max-width: 1023px) {*/
        /*.container1 {*/

            /*background-color: white;*/
            /*overflow: hidden;*/
            /*height: 100% !important;*/
            /*width: 100%;*/
            /*padding: 15px;*/
        /*}*/

        /*.element {*/
            /*display: none;*/
        /*}*/

        /*.shape-content {*/

        /*}*/

        /*.shape-content:after {*/
            /*display: none;*/
        /*}*/

        /*.first-list {*/
            /*display: inline-block;*/
            /*margin-left: 65px;*/
            /*float: left;*/
            /*position: relative;*/
        /*}*/

        /*.number-box, .text-box {*/
            /*display: inline-block;*/
            /*width: 152px;*/
            /*float: left;*/
            /*height: 142px;*/
        /*}*/

        /*.mob-bonus-block {*/
            /*float: left;*/
            /*position: initial;*/
            /*right: auto;*/
            /*top: auto;*/
            /*margin-bottom: 59px;*/
        /*}*/

        /*.first-line {*/
            /*padding-right: 0;*/
            /*min-height: 453px;*/
            /*margin-bottom: 108px;*/
            /*padding-top: 32px;*/
        /*}*/

        /*.second-line {*/
            /*padding-top: 2px;*/
            /*padding-right: 0;*/
        /*}*/

        /*.mob-bonus-text {*/
            /*width: 100%;*/
            /*margin: 40px auto;*/
            /*font-family: 'Open Sans', sans-serif;*/
            /*font-weight: 700;*/
            /*font-size: 14px;*/
            /*text-decoration: none;*/
            /*margin-bottom: 33px;*/
        /*}*/

        /*.second-line > .first-list {*/
            /*display: inline-block;*/
            /*margin-left: 0;*/
            /*float: left;*/
            /*width: 100%;*/
            /*position: relative;*/
            /*margin-bottom: 40px;*/
            /*margin-top: 40px;*/
        /*}*/

        /*.third-line > .first-list {*/
            /*display: inline-block;*/
            /*margin-left: 0;*/
            /*float: left;*/
            /*width: 100%;*/
            /*position: relative;*/
            /*margin-bottom: 0px;*/
            /*margin-top: 40px;*/
        /*}*/

        /*.four-line {*/
            /*padding-top: 0px;*/
            /*padding-right: 0px;*/
            /*margin: 46px;*/
            /*display: inline-block;*/
        /*}*/

        /*.bonus-footer {*/

            /*padding-top: 50px;*/
        /*}*/

        /*.question-block {*/

            /*margin: 20px;*/
        /*}*/
    /*}*/

    /*@media all and (max-width: 500px) {*/
        /*.first-list ul p {*/
            /*font-size: 17px;*/
        /*}*/

        /*.four-text {*/
            /*font-family: 'Open Sans', sans-serif;*/
            /*font-weight: 700;*/
            /*font-size: 17px;*/
            /*text-transform: uppercase;*/
            /*width: 100%;*/
            /*margin-bottom: 35px;*/
        /*}*/

        /*.social-list li {*/

            /*width: 50px;*/
            /*height: 50px;*/
            /*margin-right: 10px;*/
        /*}*/

        /*.socialBonusLink {*/
            /*display: block;*/
            /*width: 50px;*/
            /*height: 50px;*/
        /*}*/

        /*.question-block p {*/

            /*font-weight: 700;*/
            /*font-size: 27px;*/
        /*}*/
    /*}*/


</style>

<script>

</script>
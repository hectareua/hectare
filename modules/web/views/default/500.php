<?php
use app\components\Url;
use yii\widgets\LinkPager;
$this->title = Yii::t('web', 'Ошибка 500');
?>
<style>
    .error {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -150.5px;
        margin-left: -275.5px;
    }
    .error h1{
        color: #841313;
        text-align: center;
        font-size: 32px;
    }
    .error a{
        display: block;
        text-decoration: none;
        font-size: 22px;
        color: #8e0000;
        text-align: center;
        font-weight: 600;
    }
    /* 26.12 */
    .contacts-error{
        text-align: center;
    }
    .contacts-error p {
        font-size: 20px;
        color: #8e0000;
        text-align: center;
        margin-top: 30px;
    }
</style>
<div class="wrapper">
    <div class="error">
        <h1>Извините, произошла ошибка сервера</h1>
        <a href="/">Вернуться на главную страницу </a>
        <a href="#">Обновить страницу</a>
        <div class="contacts-error">
            <p>+38 (099) 733 73 30</p>
            <p>+38 (096) 733 73 30</p>
        </div>
    </div>
</div>
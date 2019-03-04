<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap clearfix">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            (
                '<li>'
                . Html::beginForm(['default/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Вийти (' . Yii::$app->user->identity->login . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>



    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => Yii::t('yii', 'Гектар'),
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

    </div>
    <div class="col-lg-2">

        <?= SideNav::widget([
            'type' => SideNav::TYPE_DEFAULT,

            'options'=>['containerOptions'=>['style'=>['width'=>'100', 'margin'=>'0', 'pading'=>'0'],],],
            'heading' => 'Адміністрація',
            'items' =>[
                ['label' => "Користувачі", 'url' => Url::to(['user/index'])],
				['label' => "Права груп користувачів", 'url' => Url::to(['client-type/index'])],
                ['label' => "Менеджери", 'url' => Url::to(['manager/index'])],
                ['label' => "Товари", 'url' => Url::to(['product/index'])],
                ['label' => "Норми", 'url' => Url::to(['norm/index'])],
                ['label' => "Фільтри", 'url' => Url::to(['filter/index'])],
                ['label' => "Форми", 'url' => Url::to(['forms/index'])],
                ['label' => "Категорії", 'url' => Url::to(['category/index'])],
                ['label' => "Замовлення", 'url' => Url::to(['order/index'])],
                ['label' => "Новини", 'url' => Url::to(['news/index'])],
                ['label' => "Статті", 'url' => Url::to(['article/index'])],
                ['label' => "Форум", 'url' => Url::to(['forum/index'])],
                ['label' => "Країни", 'url' => Url::to(['country/index'])],
                ['label' => "Валюти", 'url' => Url::to(['currency/index'])],
                ['label' => "Відгуки", 'url' => Url::to(['review/index'])],
                ['label' => "Виробники", 'url' => Url::to(['manufacturer/index'])],
                ['label' => "Системи сплати", 'url' => Url::to(['payment-system/index'])],
                ['label' => "Інформація сайту", 'url' => Url::to(['site-info/index'])],
                ['label' => "Слайди", 'url' => Url::to(['slider/index'])],
                ['label' => "Партнери", 'url' => Url::to(['partners/index'])],
                ['label' => "Сертифікати", 'url' => Url::to(['certificates/index'])],
                ['label' => "Бонуси", 'url' => Url::to(['bonuses/index'])],
                ['label' => "Регіональні представники", 'url' => Url::to(['representatives/index'])],
                ['label' => "Seo tags", 'url' => Url::to(['seo-url/index'])],
                ['label' => "Проблеми", 'url' => Url::to(['problems/index'])],
                ['label' => "Рослини", 'url' => Url::to(['plants/index'])],
                ['label' => "Фази", 'url' => Url::to(['phases/index'])],
                ['label' => "Помічник", 'url' => Url::to(['cure/index'])],
                ['label' => "Історія", 'url' => Url::to(['history/index'])],
                ['label' => "Співпраця з нами", 'url' => Url::to(['cooperation/index'])],
                ['label' => "Иніціювати комплект", 'url' => Url::to(['complects-product/index'])],
                ['label' => "Кредити", 'url' => Url::to(['credit/index'])],
				['label' => "Контакты", 'url' => Url::to(['contacts/index'])],
				['label' => "Економте з нами", 'url' => Url::to(['save-with-us/index'])],
				['label' => "Гектар INFO", 'url' => Url::to(['info-tabs-content/index'])],
				['label' => "XML Rozetka", 'url' => Url::to(['product/export-rozetka'])],
				['label' => "Голосування", 'url' => Url::to(['department-rating/index'])],
				['label' => "План продаж", 'url' => Url::to(['sale-plan/index'])],
				['label' => "Бонусы", 'url' => Url::to(['client-type-bonus/index'])],
				['label' => "Бонусний товар", 'url' => Url::to(['product-bonus/index'])],
                ['label' => "Бонусні замовлення", 'url' => Url::to(['order-bonus/index'])],
            ],
        ]) ?>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-8">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?=Yii::$app->name?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
use app\components\Url;
$lang = Yii::$app->language;
$langsign = (Yii::$app->language=='ru')?'/ru':'';
$this->title = $infocity[$lang]['seoTitle'];
$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', $infocity[$lang]['description'])], 'description');
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::t('web', $infocity[$lang]['keywords'])], 'keywords');

?>

    <div class="wrapper">
        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">

            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a itemprop="item" href="<?=$langsign?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1"></li>

            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=$langsign?>/internet-magazin"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2"></li>
            
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?php echo $infocity[$lang]['title']; ?></span><meta itemprop="position" content="3"></li>

        </ol>
        <div class="catalog">
            <h1 class="catalog__title"><?php echo $this->params['seoH1'] ?: $infocity[$lang]['title']; ?></h1>
            <ul class="catalog-list">
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/gerbitsidi" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17ec59fb.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/gerbitsidi" class="catalog-list-item__title"><span><?=Yii::t('city', 'Гербициды')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/fungitsidi" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17eeca6e.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/fungitsidi" class="catalog-list-item__title"><span><?=Yii::t('city', 'Фунгициды')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/insektitsidi" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17f1d1d8.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/insektitsidi" class="catalog-list-item__title"><span><?=Yii::t('city', 'Инсектициды')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/protrujniki" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17f419f7.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/protrujniki" class="catalog-list-item__title"><span><?=Yii::t('city', 'Протравители')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/rodentitsidi" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17f65d4b.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/rodentitsidi" class="catalog-list-item__title"><span><?=Yii::t('city', 'Родентициды')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/fumiganti" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17f89d8a.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/fumiganti" class="catalog-list-item__title"><span><?=Yii::t('city', 'Фумиганты для зерна')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/regulyatori-rostu" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17fade2a.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/regulyatori-rostu" class="catalog-list-item__title"><span><?=Yii::t('city', 'Регуляторы роста')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/dopomizhni-rechovini" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b17fd23be.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/dopomizhni-rechovini" class="catalog-list-item__title"><span><?=Yii::t('city', 'Вспомогательные вещества')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/desikanti" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/57f3b18003380.jpg&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/desikanti" class="catalog-list-item__title"><span><?=Yii::t('city', 'Десиканты')?></span></a>
                </li>
                <li class="catalog-list-item subcategories-list-item">
                <a href="<?=$langsign?>/internet-magazin/118" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/58d2859d938a4.gif&quot;); height: 296.1px;"> </a>
                <a href="<?=$langsign?>/internet-magazin/118" class="catalog-list-item__title"><span><?=Yii::t('city', 'Инокулянты')?></span></a>
                </li>
                </ul>
                <div class="dynamic_content"><?php echo $this->params['seoText'] ?: $infocity[$lang]['content']; ?>
                </div>
            </div>
        <div class="space"></div>
    </div>


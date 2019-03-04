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

            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a itemprop="item" href="/ru"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1"></li>

            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href="/ru/internet-magazin"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2"></li>
            
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?php echo $infocity[$lang]['title']; ?></span><meta itemprop="position" content="3"></li>

        </ol>
        <div class="catalog">
            <h1 class="catalog__title"><?php echo $this->params['seoH1'] ?: $infocity[$lang]['title']; ?></h1>
             <ul class="catalog-list">
                                            <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/23" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585be45d2c119.png&quot;); height: 296.1px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/23" class="catalog-list-item__title"><span><?=Yii::t('city', 'Микроудобрения')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/22" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585be44035834.jpg&quot;); height: 296.1px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/22" class="catalog-list-item__title"><span><?=Yii::t('city', 'Минеральные удобрения')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/24" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585be470dd279.jpg&quot;); height: 296.1px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/24" class="catalog-list-item__title"><span><?=Yii::t('city', 'Стимуляторы роста')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/27" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585be4a3a7a65.png&quot;); height: 296.1px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/27" class="catalog-list-item__title"><span><?=Yii::t('city', 'Грунты')?></span></a>
                    </li>
             </ul>
              <div class="dynamic_content"><?php echo $this->params['seoText'] ?: $infocity[$lang]['content']; ?>
              </div>
        </div>
        <div class="space"></div>
    </div>


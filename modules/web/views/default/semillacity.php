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
                        <a href="<?=$langsign?>/internet-magazin/93" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585bc27e84d6a.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/93" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена пшеницы')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/semena-podsolnechnika" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585bcfe7419ef.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/semena-podsolnechnika" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена подсолнечника')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/17" class="catalog-list-item__image" style="background-image: url(&quot;http://hectare.com.ua/upload/585bcffba3c79.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/17" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена кукурузы')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/94" class="catalog-list-item__image" style="background-image: url(&quot;http://www.pitaniedetey.ru/wp-content/uploads/2016/08/Rastenie-Raps.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/94" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена рапса')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/95" class="catalog-list-item__image" style="background-image: url(&quot;https://s-media-cache-ak0.pinimg.com/originals/9b/7e/8e/9b7e8e4ce7ada1001318c1f43abb1b40.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/95" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена ячменя')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/117" class="catalog-list-item__image" style="background-image: url(&quot;http://domguru.com/upload/medialibrary/085/10_1_.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/117" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена сои')?></span></a>
                    </li>
                                                        <li class="catalog-list-item subcategories-list-item">
                        <a href="<?=$langsign?>/internet-magazin/123" class="catalog-list-item__image" style="background-image: url(&quot;http://poradumo.com.ua/wp-content/uploads/2016/02/a33c355ffb31a17ea4455fb4b3b00d1f.jpg&quot;); height: 297.51px;"> </a>
                        <a href="<?=$langsign?>/internet-magazin/123" class="catalog-list-item__title"><span><?=Yii::t('city', 'Семена льна')?></span></a>
                    </li>
                </ul>
                <div class="dynamic_content"><?php echo $this->params['seoText'] ?: $infocity[$lang]['content']; ?>
                </div>
            </div>
        <div class="space"></div>
    </div>


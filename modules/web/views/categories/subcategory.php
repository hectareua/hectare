<style>
.dynamic_content.city {
    line-height: 2;
    }
    .dynamic_content.city a {
        color: #00733a;
        cursor: pointer;
    }
</style>
<?php
use app\components\Url;
$this->title = $category->seoTitle?$category->seoTitle:$category->name;
if (!empty($category->seoDescription)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Большой выбор удобрений, семян и средств защиты ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
}
if ($category->seoKeywords){
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
}

?>
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

        <li itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=$category->name?></span><meta itemprop="position" content="4" /></li>

    </ol>
    <div class="catalog">
        <h1 class="catalog__title"><?= $this->params['seoH1'] ?: ($category->seoHeader? $category->seoHeader : $category->name) ?></h1>
        <ul class="catalog-list">
            <?php foreach ($models as $model): ?>
            <?php if(count($model->categories) > 0 || count($model->products) > 0) : ?>
                <li class="catalog-list-item subcategories-list-item">
                    <a href="<?=Url::toCategory($model)?>" class="catalog-list-item__image" style="background-image:url('<?=$model->image->url?>')"> </a>
                    <a href="<?=Url::toCategory($model)?>" class="catalog-list-item__title"><span><?=$model->name?></span></a>
                </li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="dynamic_content"><?=$this->params['seoText'] ?: $category->description?></div>
    </div>

    <?php if( $model->parent_id == 1) { ?>
        <div class="dynamic_content city" style="padding-bottom: 10px;">

        <?php if(Yii::$app->language == 'ru') { ?>

            <span style="font-weight: bold;"> Средства защиты в городах Украины: </span>

            <a href="/ru/zasobi-zakhistu-roslin-kharkov">Харьков, </a>
            <a href="/ru/zasobi-zakhistu-roslin-dnepr">Днепр, </a>
            <a href="/ru/zasobi-zakhistu-roslin-zaporozhye">Запорожье, </a>
            <a href="/ru/zasobi-zakhistu-roslin-kherson">Херсон, </a>
            <a href="/ru/zasobi-zakhistu-roslin-vinnitsa">Винница, </a>
            <a href="/ru/zasobi-zakhistu-roslin-krivoyrog">Кривой рог, </a>
            <a href="/ru/zasobi-zakhistu-roslin-sumy">Сумы, </a>
            <a href="/ru/zasobi-zakhistu-roslin-khmelnitskiy">Хмельницкий, </a>
            <a href="/ru/zasobi-zakhistu-roslin-poltava">Полтава, </a>
            <a href="/ru/zasobi-zakhistu-roslin-rovno">Ровно, </a>
            <a href="/ru/zasobi-zakhistu-roslin-melitopol">Мелитополь, </a>
            <a href="/ru/zasobi-zakhistu-roslin-zhitomir">Житомир, </a>
            <a href="/ru/zasobi-zakhistu-roslin-lvov">Львов, </a>
            <a href="/ru/zasobi-zakhistu-roslin-chernigov">Чернигов, </a>
            <a href="/ru/zasobi-zakhistu-roslin-cherkassy">Черкассы, </a>
            <a href="/ru/zasobi-zakhistu-roslin-mariupol">Мариуполь, </a>
            <a href="/ru/zasobi-zakhistu-roslin-kremenchug">Кременчуг, </a>
            <a href="/ru/zasobi-zakhistu-roslin-aleksandriya">Александрия, </a>
            <a href="/ru/zasobi-zakhistu-roslin-pavlograd">Павлоград, </a>
            <a href="/ru/zasobi-zakhistu-roslin-brovary">Бровары, </a>
            <a href="/ru/zasobi-zakhistu-roslin-ternopol">Тернополь, </a>
            <a href="/ru/zasobi-zakhistu-roslin-chernovtsy">Черновцы, </a>
            <a href="/ru/zasobi-zakhistu-roslin-nikopol">Никополь, </a>
            <a href="/ru/zasobi-zakhistu-roslin-kamenskoye">Каменское, </a>
            <a href="/ru/zasobi-zakhistu-roslin-kropivnitskiy">Кропивницкий </a>

        <?php } else { ?>

            <span style="font-weight: bold;">Засоби захисту в містах України: </span>

            <a href="/zasobi-zakhistu-roslin-kharkov">Харків, </a>
            <a href="/zasobi-zakhistu-roslin-dnepr">Дніпро, </a>
            <a href="/zasobi-zakhistu-roslin-zaporozhye">Запоріжжя, </a>
            <a href="/zasobi-zakhistu-roslin-kherson">Херсон, </a>
            <a href="/zasobi-zakhistu-roslin-vinnitsa">Вінниця, </a>
            <a href="/zasobi-zakhistu-roslin-krivoyrog">Кривий ріг, </a>
            <a href="/zasobi-zakhistu-roslin-sumy">Суми, </a>
            <a href="/zasobi-zakhistu-roslin-khmelnitskiy">Хмельницький, </a>
            <a href="/zasobi-zakhistu-roslin-poltava">Полтава, </a>
            <a href="/zasobi-zakhistu-roslin-rovno">Рівне, </a>
            <a href="/zasobi-zakhistu-roslin-melitopol">Мелітополь, </a>
            <a href="/zasobi-zakhistu-roslin-zhitomir">Житомир, </a>
            <a href="/zasobi-zakhistu-roslin-lvov">Львів, </a>
            <a href="/zasobi-zakhistu-roslin-chernigov">Чернігів, </a>
            <a href="/zasobi-zakhistu-roslin-cherkassy">Черкаси, </a>
            <a href="/zasobi-zakhistu-roslin-mariupol">Маріуполь, </a>
            <a href="/zasobi-zakhistu-roslin-kremenchug">Кременчук, </a>
            <a href="/zasobi-zakhistu-roslin-aleksandriya">Олександрія, </a>
            <a href="/zasobi-zakhistu-roslin-pavlograd">Павлоград, </a>
            <a href="/zasobi-zakhistu-roslin-brovary">Бровари, </a>
            <a href="/zasobi-zakhistu-roslin-ternopol">Тернопіль, </a>
            <a href="/zasobi-zakhistu-roslin-chernovtsy">Чернівці, </a>
            <a href="/zasobi-zakhistu-roslin-nikopol">Нікополь, </a>
            <a href="/zasobi-zakhistu-roslin-kamenskoye">Кам'янське, </a>
            <a href="/zasobi-zakhistu-roslin-kropivnitskiy">Кропивницький </a>
        <?php } ?>
        </div>
    <?php } ?>

    <?php if( $model->parent_id == 3 ) { ?>
        <div class="dynamic_content city" style="padding-bottom: 10px;">

        <?php if(Yii::$app->language == 'ru') { ?>

            <span style="font-weight: bold;"> Средства удобрений в городах Украины: </span>

           <a href="/ru/dobriva-kharkov">Харьков, </a>
            <a href="/ru/dobriva-dnepr">Днепр, </a>
            <a href="/ru/dobriva-zaporozhye">Запорожье, </a>
            <a href="/ru/dobriva-kherson">Херсон, </a>
            <a href="/ru/dobriva-vinnitsa">Винница, </a>
            <a href="/ru/dobriva-krivoyrog">Кривой рог, </a>
            <a href="/ru/dobriva-sumy">Сумы, </a>
            <a href="/ru/dobriva-khmelnitskiy">Хмельницкий, </a>
            <a href="/ru/dobriva-poltava">Полтава, </a>
            <a href="/ru/dobriva-rovno">Ровно, </a>
            <a href="/ru/dobriva-melitopol">Мелитополь, </a>
            <a href="/ru/dobriva-zhitomir">Житомир, </a>
            <a href="/ru/dobriva-lvov">Львов, </a>
            <a href="/ru/dobriva-chernigov">Чернигов, </a>
            <a href="/ru/dobriva-cherkassy">Черкассы, </a>
            <a href="/ru/dobriva-mariupol">Мариуполь, </a>
            <a href="/ru/dobriva-kremenchug">Кременчуг, </a>
            <a href="/ru/dobriva-aleksandriya">Александрия, </a>
            <a href="/ru/dobriva-pavlograd">Павлоград, </a>
            <a href="/ru/dobriva-brovary">Бровары, </a>
            <a href="/ru/dobriva-ternopol">Тернополь, </a>
            <a href="/ru/dobriva-chernovtsy">Черновцы, </a>
            <a href="/ru/dobriva-nikopol">Никополь, </a>
            <a href="/ru/dobriva-kamenskoye">Каменское, </a>
            <a href="/ru/dobriva-kropivnitskiy">Кропивницкий </a>

        <?php } else { ?>

            <span style="font-weight: bold;">Засоби добрив в містах України: </span>

            <a href="/dobriva-kharkov">Харків, </a>
            <a href="/dobriva-dnepr">Дніпро, </a>
            <a href="/dobriva-zaporozhye">Запоріжжя, </a>
            <a href="/dobriva-kherson">Херсон, </a>
            <a href="/dobriva-vinnitsa">Вінниця, </a>
            <a href="/dobriva-krivoyrog">Кривий ріг, </a>
            <a href="/dobriva-sumy">Суми, </a>
            <a href="/dobriva-khmelnitskiy">Хмельницький, </a>
            <a href="/dobriva-poltava">Полтава, </a>
            <a href="/dobriva-rovno">Рівне, </a>
            <a href="/dobriva-melitopol">Мелітополь, </a>
            <a href="/dobriva-zhitomir">Житомир, </a>
            <a href="/dobriva-lvov">Львів, </a>
            <a href="/dobriva-chernigov">Чернігів, </a>
            <a href="/dobriva-cherkassy">Черкаси, </a>
            <a href="/dobriva-mariupol">Маріуполь, </a>
            <a href="/dobriva-kremenchug">Кременчук, </a>
            <a href="/dobriva-aleksandriya">Олександрія, </a>
            <a href="/dobriva-pavlograd">Павлоград, </a>
            <a href="/dobriva-brovary">Бровари, </a>
            <a href="/dobriva-ternopol">Тернопіль, </a>
            <a href="/dobriva-chernovtsy">Чернівці, </a>
            <a href="/dobriva-nikopol">Нікополь, </a>
            <a href="/dobriva-kamenskoye">Кам'янське, </a>
            <a href="/dobriva-kropivnitskiy">Кропивницький </a>
        <?php } ?>
        </div>
    <?php } ?>

    <?php if( $model->parent_id == 2 ) { ?>
        <div class="dynamic_content city" style="padding-bottom: 10px;">

        <?php if(Yii::$app->language == 'ru') { ?>

            <span style="font-weight: bold;"> Семена в городах Украины: </span>

            <a href="/ru/nasinnya-kharkov">Харьков, </a>
            <a href="/ru/nasinnya-dnepr">Днепр, </a>
            <a href="/ru/nasinnya-zaporozhye">Запорожье, </a>
            <a href="/ru/nasinnya-kherson">Херсон, </a>
            <a href="/ru/nasinnya-vinnitsa">Винница, </a>
            <a href="/ru/nasinnya-krivoyrog">Кривой рог, </a>
            <a href="/ru/nasinnya-sumy">Сумы, </a>
            <a href="/ru/nasinnya-khmelnitskiy">Хмельницкий, </a>
            <a href="/ru/nasinnya-poltava">Полтава, </a>
            <a href="/ru/nasinnya-rovno">Ровно, </a>
            <a href="/ru/nasinnya-melitopol">Мелитополь, </a>
            <a href="/ru/nasinnya-zhitomir">Житомир, </a>
            <a href="/ru/nasinnya-lvov">Львов, </a>
            <a href="/ru/nasinnya-chernigov">Чернигов, </a>
            <a href="/ru/nasinnya-cherkassy">Черкассы, </a>
            <a href="/ru/nasinnya-mariupol">Мариуполь, </a>
            <a href="/ru/nasinnya-kremenchug">Кременчуг, </a>
            <a href="/ru/nasinnya-aleksandriya">Александрия, </a>
            <a href="/ru/nasinnya-pavlograd">Павлоград, </a>
            <a href="/ru/nasinnya-brovary">Бровары, </a>
            <a href="/ru/nasinnya-ternopol">Тернополь, </a>
            <a href="/ru/nasinnya-chernovtsy">Черновцы, </a>
            <a href="/ru/nasinnya-nikopol">Никополь, </a>
            <a href="/ru/nasinnya-kamenskoye">Каменское, </a>
            <a href="/ru/nasinnya-kropivnitskiy">Кропивницкий </a>

        <?php } else { ?>

            <span style="font-weight: bold;">НАСІННЯ в містах України: </span>

            <a href="/nasinnya-kharkov">Харків, </a>
            <a href="/nasinnya-dnepr">Дніпро, </a>
            <a href="/nasinnya-zaporozhye">Запоріжжя, </a>
            <a href="/nasinnya-kherson">Херсон, </a>
            <a href="/nasinnya-vinnitsa">Вінниця, </a>
            <a href="/nasinnya-krivoyrog">Кривий ріг, </a>
            <a href="/nasinnya-sumy">Суми, </a>
            <a href="/nasinnya-khmelnitskiy">Хмельницький, </a>
            <a href="/nasinnya-poltava">Полтава, </a>
            <a href="/nasinnya-rovno">Рівне, </a>
            <a href="/nasinnya-melitopol">Мелітополь, </a>
            <a href="/nasinnya-zhitomir">Житомир, </a>
            <a href="/nasinnya-lvov">Львів, </a>
            <a href="/nasinnya-chernigov">Чернігів, </a>
            <a href="/nasinnya-cherkassy">Черкаси, </a>
            <a href="/nasinnya-mariupol">Маріуполь, </a>
            <a href="/nasinnya-kremenchug">Кременчук, </a>
            <a href="/nasinnya-aleksandriya">Олександрія, </a>
            <a href="/nasinnya-pavlograd">Павлоград, </a>
            <a href="/nasinnya-brovary">Бровари, </a>
            <a href="/nasinnya-ternopol">Тернопіль, </a>
            <a href="/nasinnya-chernovtsy">Чернівці, </a>
            <a href="/nasinnya-nikopol">Нікополь, </a>
            <a href="/nasinnya-kamenskoye">Кам'янське, </a>
            <a href="/nasinnya-kropivnitskiy">Кропивницький </a>
        <?php } ?>
        </div>
    <?php } ?>

<!--    --><?php //if( $model->parent_id == 26 ) { ?>
<!--        <div class="dynamic_content city" style="padding-bottom: 10px;">-->
<!---->
<!--            --><?php //if(Yii::$app->language == 'ru') { ?>
<!---->
<!--                <span style="font-weight: bold;"> Садово-огородный инвентарь в городах Украины: </span>-->
<!---->
<!--                <a href="/ru/sad-ogorod-kharkov">Харьков, </a>-->
<!--                <a href="/ru/sad-ogorod-dnepr">Днепр, </a>-->
<!--                <a href="/ru/sad-ogorod-zaporozhye">Запорожье, </a>-->
<!--                <a href="/ru/sad-ogorod-kherson">Херсон, </a>-->
<!--                <a href="/ru/sad-ogorod-vinnitsa">Винница, </a>-->
<!--                <a href="/ru/sad-ogorod-krivoyrog">Кривой рог, </a>-->
<!--                <a href="/ru/sad-ogorod-sumy">Сумы, </a>-->
<!--                <a href="/ru/sad-ogorod-khmelnitskiy">Хмельницкий, </a>-->
<!--                <a href="/ru/sad-ogorod-poltava">Полтава, </a>-->
<!--                <a href="/ru/sad-ogorod-rovno">Ровно, </a>-->
<!--                <a href="/ru/sad-ogorod-melitopol">Мелитополь, </a>-->
<!--                <a href="/ru/sad-ogorod-zhitomir">Житомир, </a>-->
<!--                <a href="/ru/sad-ogorod-lvov">Львов, </a>-->
<!--                <a href="/ru/sad-ogorod-chernigov">Чернигов, </a>-->
<!--                <a href="/ru/sad-ogorod-cherkassy">Черкассы, </a>-->
<!--                <a href="/ru/sad-ogorod-mariupol">Мариуполь, </a>-->
<!--                <a href="/ru/sad-ogorod-kremenchug">Кременчуг, </a>-->
<!--                <a href="/ru/sad-ogorod-aleksandriya">Александрия, </a>-->
<!--                <a href="/ru/sad-ogorod-pavlograd">Павлоград, </a>-->
<!--                <a href="/ru/sad-ogorod-brovary">Бровары, </a>-->
<!--                <a href="/ru/sad-ogorod-ternopol">Тернополь, </a>-->
<!--                <a href="/ru/sad-ogorod-chernovtsy">Черновцы, </a>-->
<!--                <a href="/ru/sad-ogorod-nikopol">Никополь, </a>-->
<!--                <a href="/ru/sad-ogorod-kamenskoye">Каменское, </a>-->
<!--                <a href="/ru/sad-ogorod-kropivnitskiy">Кропивницкий </a>-->
<!---->
<!--            --><?php //} else { ?>
<!---->
<!--                <span style="font-weight: bold;">Садово-городній інвентар в містах України: </span>-->
<!---->
<!--                <a href="/sad-ogorod-kharkov">Харків, </a>-->
<!--                <a href="/sad-ogorod-dnepr">Дніпро, </a>-->
<!--                <a href="/sad-ogorod-zaporozhye">Запоріжжя, </a>-->
<!--                <a href="/sad-ogorod-kherson">Херсон, </a>-->
<!--                <a href="/sad-ogorod-vinnitsa">Вінниця, </a>-->
<!--                <a href="/sad-ogorod-krivoyrog">Кривий ріг, </a>-->
<!--                <a href="/sad-ogorod-sumy">Суми, </a>-->
<!--                <a href="/sad-ogorod-khmelnitskiy">Хмельницький, </a>-->
<!--                <a href="/sad-ogorod-poltava">Полтава, </a>-->
<!--                <a href="/sad-ogorod-rovno">Рівне, </a>-->
<!--                <a href="/sad-ogorod-melitopol">Мелітополь, </a>-->
<!--                <a href="/sad-ogorod-zhitomir">Житомир, </a>-->
<!--                <a href="/sad-ogorod-lvov">Львів, </a>-->
<!--                <a href="/sad-ogorod-chernigov">Чернігів, </a>-->
<!--                <a href="/sad-ogorod-cherkassy">Черкаси, </a>-->
<!--                <a href="/sad-ogorod-mariupol">Маріуполь, </a>-->
<!--                <a href="/sad-ogorod-kremenchug">Кременчук, </a>-->
<!--                <a href="/sad-ogorod-aleksandriya">Олександрія, </a>-->
<!--                <a href="/sad-ogorod-pavlograd">Павлоград, </a>-->
<!--                <a href="/sad-ogorod-brovary">Бровари, </a>-->
<!--                <a href="/sad-ogorod-ternopol">Тернопіль, </a>-->
<!--                <a href="/sad-ogorod-chernovtsy">Чернівці, </a>-->
<!--                <a href="/sad-ogorod-nikopol">Нікополь, </a>-->
<!--                <a href="/sad-ogorod-kamenskoye">Кам'янське, </a>-->
<!--                <a href="/sad-ogorod-kropivnitskiy">Кропивницький </a>-->
<!--            --><?php //} ?>
<!--        </div>-->
<!--    --><?php //} ?>

    <div class="space"></div>
</div>

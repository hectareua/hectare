<?php
use app\components\Url;
use app\helpers\Helper;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

$lang = Yii::$app->language;

if ($lang=='ru') {
	$this->title = Yii::t('web', 'Лечебные препараты для растений в Николаеве, Киеве, Одессе, Украине | Гектар');
	$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Лечебные препараты для растений недорого. ✔Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
} else {
	$this->title = Yii::t('web', 'Лікувальні засоби для рослин в Миколаєві, Києві, Одесі, Україні | Гектар');
	$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Лікувальні засоби для рослин недорого. ✔Великий вибір ✔ Гарантія якості ✔ Краща ціна ✔ Швидка доставка по Україні ☎ (067) 559-84-93')], 'description');
}

$suff = ''; if ($lang=='uk') {$suff='_uk';}

function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
	    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>
	    <li class="breadcrumbs__item" itemprop="itemListElement" itemscopeitemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/cure'])?>"> <span itemprop="name"><?=Yii::t('web', 'Лечебные препараты для растений')?></span> </a> <meta itemprop="position" content="3" /></li>
    </ol>
    <h1 class="items__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Лечебные препараты для растений')?></h1>
   <?php /* <h4 class="items__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Извините, страница находится в разработке!')?></h4> */ ?>

	<?= app\components\FilterCure\Filter::widget([
		'plants' => $plants,
		'phases' => $phases,
		'problems' => $problems,
		'products' => $products,
		'images' => $images,
		'cure_id' => $cure_id,
		'cure' => $cure,
		'manufacture' => $manufacture
	]) ?>
	<div class="clearfix"></div>
    <div class="space"></div>
    
</div>
<?php
?>



<?php
use app\components\Url;

use yii\widgets\LinkPager;

$lang = Yii::$app->language;

$sdesclabel = 'seo_description_'.$lang;
$desclabel = 'description_'.$lang;
$headerlabel = 'seo_header_'.$lang;
$stitlelabel = 'seo_title_'.$lang;
$skeylabel = 'seo_keywords_'.$lang;

if (!empty($manufacturer->$sdesclabel)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $manufacturer->$sdesclabel], 'description');
} else {
	if ($lang=='ru') {
		$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Товары торговой марки '. $manufacturer->name .' недорого. ✔Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
	} else {
		$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Товари торгової марки '. $manufacturer->name .' недорого. ✔Великий вибір ✔ Гарантія якості ✔ Краща ціна ✔ Швидка доставка по Україні ☎ (067) 559-84-93')], 'description');
	}
}

if (!empty($manufacturer->$headerlabel)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $manufacturer->$headerlabel], 'description');
} else {
	if ($lang=='ru') {
		$this->title = Yii::t('web', 'Товары '. $manufacturer->name .' купить оптом / розницу в Николаеве, Одессе, Киеве, Украине | Гектар');
	} else {
		$this->title = Yii::t('web', 'Товари '. $manufacturer->name .' купити оптом / роздріб в Миколаєві, Одесі, Києві, Україні | Гектар');		
	}
}

if (isset($manufacturer->$skeylabel)) { $this->registerMetaTag(['name' => 'keywords', 'content' => $manufacturer->$skeylabel], 'keywords');}

?>
<div class="items">
	<div class="wrapper">
		<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
				<li itemprop="itemListElement" itemscope
			 itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope
		 itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>      
			 
				<li class="breadcrumbs__item" itemprop="itemListElement" itemscope
			 itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/brands'])?>"> <span itemprop="name"><?=Yii::t('web', 'Производители')?></span>  » </a> <meta itemprop="position" content="3" /></li>
			 
				<li class="breadcrumbs__item" itemprop="itemListElement" itemscope
			 itemtype="http://schema.org/ListItem" ><a itemprop="item" href="/internet-magazin/brand/<?=$manufacturer->slug?>"> <span itemprop="name"><?=$manufacturer->name?></span> </a> <meta itemprop="position" content="4" /></li>

		</ol>

		<h1 class="items__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Товары').'&nbsp;'. (($manufacturer->name=='-')?(Yii::t('web', 'без производителя')):$manufacturer->name); ?></h1>

        <div class="itemsSidebar">
            <?php if ($categories): ?>
               <div class="itemsSidebar-products">
					<div class="itemsSidebar-products__title"><?=Yii::t('web', 'Категории')?></div>
					<ul class="itemsSidebar-products-list">
						<?php foreach ($categories as $category): ?>
								<li class="itemsSidebar-products-list__item itemSidebar-category-list active" data-cid="<?=$category['id']?>"><?=$category['name_'. Yii::$app->language]?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php $this->registerJs("
					$(document).ready(function(){
						$(document).on('click','.itemSidebar-category-list.active',function(){
							$('.itemsList-item').not('.itemsList-item[data-cid='+$(this).attr('data-cid')+']').addClass('hiddenitem');
							$('.itemSidebar-category-list').not(this).removeClass('active').addClass('notactive');
						});
						$(document).on('click','.itemSidebar-category-list.notactive',function(){
							$('.itemsList-item[data-cid='+$(this).attr('data-cid')+']').removeClass('hiddenitem');
							$(this).removeClass('notactive').addClass('active');
						});
					});
				"); ?>
            <?php endif;  ?>

			<?php /* if (count($manufacturer) > 0) : ?>    
				<div class="itemsSidebar-producers">
					<div class="itemsSidebar-producers__title"><?=Yii::t('web', 'Производители')?></div>
					<ul class="itemsSidebar-producers-list">
						<?php foreach ($manufacturer as $manufacturer): ?>
						<?php if ($manufacturer->name!='.') { ?>
							<li class="itemsSidebar-producers-list-item">
								<a href="">
									<label class="itemsSidebar-producers-list-item__label">
										<span class="manufacturer_select">
										<?=$manufacturer->name?>
										</span>
									</label>  
								</a>
								
							</li>
						<?php } endforeach; ?>
						<?php $this->registerJs("
							$(document).ready(function(){
								$('.manufacturer_select').change(function(){
									location = $(this).data('href');
								});
							});
						"); ?>
					</ul>
				</div>
			<?php endif; */ ?>
		</div>
    <?php /*    <ul class="itemsList">
            <?php foreach ($models as $model): ?>
                <li class="itemsList-item">
                    <a href="/internet-magazin/product/view/<?=$model['category_id']?>/<?=$model['slug']?$model['slug']:$model['id']?>" style="height:180px;" class="catalog-list-item__image"><?php if ($model['image']['url']) { ?><img src="<?=$model['image']['url']?>" style="height:180px;max-width:220px"> <?php } ?></a>
                    <a href="/internet-magazin/product/view/<?=$model['category_id']?>/<?=$model['slug']?$model['slug']:$model['id']?>" class="catalog-list-item__title"><span><?=$model['name_ru']?></span></a>              
                </li>
            <?php endforeach; ?>
        </ul> */ ?>

        <ul class="itemsList">
            <?php foreach ($models as $model): 
				$model['price'] = $model['price'] * $currency[$model['currency_id']]['rate'];
             ?><li class="itemsList-item" data-cid="<?=$model['category_id']?>">
                    <a href="<?=Url::toProduct($model)?>" class="itemsList-item__img" style="background-image:url('<?=$model['image']?$model['image']['url']:null?>')"></a>
                    <div class="itemsList-item__title"><a href="<?=Url::toProduct($model)?>"><?=$model['name']?></a></div>
                    <div class="itemsList-item__price"><?=number_format($model->currencyPriceForAttribute, 2)?> грн <?php if (!$model['ykazatel'] == '0' && !$model['ykazatel'] == ''): ?> / <?=$model['ykazatel'];?><?php endif; ?></div>
                    <div class="itemsList-item__more more-btn-refresh"><a href="<?=Url::toProduct($model)?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
                </li><?php endforeach; ?>
        </ul>


	</div>
	
	<div class="description"><?php echo $manufacturer->$desclabel; ?></div>	
</div>

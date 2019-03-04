<?php
use app\components\Url;

use yii\widgets\LinkPager;

$lang = Yii::$app->language;

if ($lang=='ru') {
	$this->title = Yii::t('web', 'Товары по брендам в Николаеве, Киеве, Одессе, Украине | Гектар');
	$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Товары популярных торговых марок недорого. ✔Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
} else {
	$this->title = Yii::t('web', 'Товари по виробникам в Миколаєві, Києві, Одесі, Україні | Гектар');
	$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Товари популярних торгових марок недорого. ✔Великий вибір ✔ Гарантія якості ✔ Краща ціна ✔ Швидка доставка по Україні ☎ (067) 559-84-93')], 'description');
}

function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}
$this->registerJs("
	var maxHeight = 0;
	window.onload = function() { 
		jQuery('.catalog-list-item').each(function(){
		  if ( jQuery(this).height() > maxHeight ) 
		  {
			maxHeight = $(this).height();
		  }
		});
		 
		jQuery('.catalog-list-item').height(maxHeight);	
	}
	jQuery(document).on('click','.alfaitem',function(){
		jQuery('.catalog-list-item').removeClass('hide');
		jQuery('.alfaitem').removeClass('text-bold');
		jQuery(this).addClass('text-bold');
		var that = jQuery(this).text();
		jQuery('.catalog-list-item div').each(function(){
			if (jQuery(this).text().charAt(0)!=that.toUpperCase()) {jQuery(this).parent().addClass('hide');}
		});
	});
	
	jQuery(document).on('click','.alfaitem1',function(){
		jQuery('.catalog-list-item').removeClass('hide');
		jQuery('.alfaitem').removeClass('text-bold');
	});
");
$this->registerCss("
.catalog-list-item {
    display: inline-flex !important;
    text-align: center;
}
.catalog-list-item div {
    display: block;
    height:26px;
    text-align: center;
	margin: auto;
}
.alfa,.beta {margin:10px auto;text-align: center;width: 80%;display: block; font-size: 20px;}
.alfaitem,.alfaitem1 {
	text-transform:uppercase;
    padding: 5px 3px;
    cursor: pointer;
    display: inline-flex;	
}
");
?>

<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
     itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>      
         
            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/brands'])?>"> <span itemprop="name"><?=Yii::t('web', 'Производители')?></span> </a> <meta itemprop="position" content="3" /></li>

    </ol>
    
    <h1 class="items__title"><?= $this->params['seoH1'] ?: Yii::t('web', 'Производители')?></h1>
    
  <?php  /*  <div class="alfa">
		<span class="alfaitem1">#</span>
		<?php  /* foreach(range('a','z') as $a) {
			echo '<span class="alfaitem">',$a,'</span>';
		} 
		?>
    </div>
     */ ?>
    <div class="beta">
		<span class="alfaitem1">#</span>
		<?php 
		if ($lang=='ru') {	
			for ($i = 224; $i <= 255; $i++) {
				echo '<span class="alfaitem">',iconv('CP1251', 'UTF-8', chr($i)),'</span>';
			}
		} else {
			$ar = 'АБВГҐДЕЄЖЗИІЇЙКЛМНОПРСТУФХЦЧШЩЮЯ';
			for ($i = 0; $i < mb_strlen($ar); $i++) {
				echo '<span class="alfaitem">',mb_substr($ar,$i,1),'</span>';
			}			
		}
		?>
    </div>
    
    <div class="catalog">
        <!-- <div class="catalog__title"><?=Yii::t('web', 'Интернет-магазин')?></div>   -->
        <ul class="catalog-list brandslist">
		<?php
			$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
			$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
			$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
			$Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
			$webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
            $las = $iPad || $iPhone || $iPod || $Android || $webOS;
		?>
				
            <?php foreach ($manufacturers as $mod):?>
				<?php if ($mod->name!='-') { ?>
                    <a itemprop="item" href="/internet-magazin/brand/<?=$mod->slug?>">
						<li class="catalog-list-item" itemprop="name">
                         <div><?php echo ($mod->name=='-')?(mb_ucfirst(Yii::t('web', 'без производителя'),'UTF-8')):$mod->name; ?><?php /* echo (((mb_strlen($mod->name)<17) && (!$las))?(' '.str_repeat('&nbsp;', 30 - mb_strlen($mod->name))):''); */ ?></div>   <?php /* =Url::to(['categories/brand/'. $mod->slug]) */ ?>
						</li>
                    </a>
                 <?php } ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="space"></div>

</div>

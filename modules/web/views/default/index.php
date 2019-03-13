<?php
	use app\components\Url;
	use app\helpers\Helper;

	$this->title = Yii::t('web', 'Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь');
	$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'Большой выбор семян, удобрений и средст защиты ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
?>
<div class="main">

	<!--slider-->
	<div class="slider" id="slider">
		<?php foreach ($this->context->getSlides() as $slide): ?>
			<div class="slider-item">
				<?php /* if ($slide->link): ?><a href="<?=$slide->link?>" class="slider-item__link"><?php endif; ?>
                    <div class="slider-item__img" style="background-image:url('<?=$slide->image->url?>')"></div><div class="slider-item__description"><?=$slide->description?></div>
                <?php if ($slide->link): ?></a><?php endif; */ ?>
				<?php if ($slide->link): ?><a href="<?=$slide->link?>" class="slider-item__link"><?php endif; ?>
					<div class="slider-item__img slider-desktop">
						<!-- <img class="img-responsive b-lazy"  src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?/*=$slide->image->url*/?>" alt="<?/*=$slide->description*/?>" />-->
						<img class="img-responsive" src="<?=Helper::thumbnail($slide->imageDesk, 1920, 655) ?>" alt="<?=$slide->description?>" />
					</div>
					<div class="slider-item__img slider-mobile">
						<!-- <img class="img-responsive b-lazy"  src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?/*=$slide->image->url*/?>" alt="<?/*=$slide->description*/?>" />-->
						<img class="img-responsive" src="<?=Helper::thumbnail($slide->image, 1920, 655) ?>" alt="<?=$slide->description?>" />
					</div>
					<div class="slider-item__description"><?=$slide->description?></div>
					<?php if ($slide->link): ?></a><?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="mobile-category">
		<div class="items">
<!--			<h2 class="title-category">Категории</h2>-->
			<div class="row">
				<div class="col-md-3 col-xs-3 col-sm-3">
					<a href="/internet-magazin/zasobi-zakhistu-roslin">
						<div class="item-category">
							<div class="img">
								<img src="https://hectare.com.ua/upload/59b8e90f3faad.png" alt="">
							</div>
							<div class="text">
								<?= Yii::t('web','Средства защиты растений') ?>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-xs-3 col-sm-3">
					<a href="/internet-magazin/dobriva">
						<div class="item-category">
							<div class="img">
								<img src="https://hectare.com.ua/upload/592ecc8694195.jpeg" alt="">
							</div>
							<div class="text">
								<?= Yii::t('web','Удобрения') ?>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-xs-3 col-sm-3">
					<a href="/internet-magazin/nasinnya">
						<div class="item-category">
							<div class="img">
								<img src="https://hectare.com.ua/upload/592ecabbed420.jpg" alt="">
							</div>
							<div class="text">
								<?= Yii::t('web','Семена') ?>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 col-xs-3 col-sm-3">
					<a href="/internet-magazin/26">
						<div class="item-category">
							<div class="img">
								<img src="https://hectare.com.ua/upload/58e75a88a56dc.png" alt="">
							</div>
							<div class="text">
								<?= Yii::t('web','Сад та город') ?>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<ul class="header-bottom-menu catalog" id="desktop-category">
		<li class="header-bottom-menu__item header-bottom-menu__item__main "><a href="<?= Url::to(['default/index']) ?>"><?= Yii::t('web', 'Главная') ?></a></li>
		<!--<li class="header-bottom-menu__item"><a href="--><?//=Url::to(['categories/index'])?><!--">--><?//=Yii::t('web', 'Интернет-магазин')?><!--</a></li>-->
		<!--<li class="header-bottom-menu__item"><a href="--><?//=Url::to(['news/index'])?><!--">--><?//=Yii::t('web', 'Новости')?><!--</a></li>-->
		<!--<li class="header-bottom-menu__item"><a href="--><?//=Url::to(['default/partners'])?><!--">--><?//=Yii::t('web', 'Партнеры')?><!--</a></li>-->
		<?php foreach ($this->params['parentCategories'] as $parentCategory) : ?>
			<li class="header-bottom-menu__item"><a href="<?= Url::toCategory($parentCategory) ?>"><?= $parentCategory->name ?></a>
				<?php if ($parentCategory->categories != null) : ?>
					<div class="header-bottom-menu-list">
						<ul class="header-bottom-menu-list-ul">
							<?php foreach ($parentCategory->categories as $subCategory) : ?>
								<?php if (count($subCategory->categories) > 0 || count($subCategory->products) > 0) : ?>
									<li class="header-bottom-menu-list-ul-item">
										<a href="<?= Url::toCategory($subCategory) ?>">
											<div>
												<div class="header-bottom-menu-list-ul-item__image" style="background-image: url('<?= $subCategory->image->url ?>')"></div>
												<div class="header-bottom-menu-list-ul-item-block"><p><?= $subCategory->name ?></p></div>
											</div>
										</a>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
		<!--                    <li class="header-bottom-menu__item"><a href="--><?//=Url::to(['default/about'])?><!--">--><?//=Yii::t('web', 'О компании')?><!--</a></li>-->
		<!--                    <li class="header-bottom-menu__item"><a href="--><?//=Url::to(['default/contact'])?><!--">--><?//=Yii::t('web', 'Контакты')?><!--</a></li>-->
	</ul>


	<!--shares-block-->
	<div class="shares">
		<div class="wrapper">
			<ul class="sharesBlock-list">
				<li class="sharesBlock-list-item">
					<div class="shares__title"><a href="/discounts"><?=Yii::t('web', 'Акционные товары')?></a></div>
					<!--<div class="shares__title"><a href="/black-friday"><?//=Yii::t('web', 'BLACK FRIDAY')?></a></div> -->
					<?=$this->render('/partial/_sale', compact('saleProducts')); ?>
				</li>
				<?//=$this->render('/partial/_black_friday', compact('blackFridayProducts')); ?>
				<li class="sharesBlock-list-item">
					<div class="shares__title"><a href="/top-sales"><?=Yii::t('web', 'Топ продаж')?></a></div>
					<?= $this->render('/partial/_top', compact('topProducts')); ?>
				</li>
				<li class="sharesBlock-list-item">
					<div class="shares__title"><a href="/best-price"><?=Yii::t('web', 'Лучшая цена')?></a></div>
					<?= $this->render('/partial/_best', compact('bestPriceProducts')); ?>
				</li>
				<!--            --><?//= $this->render('/partial/_only', compact('saleProducts')) ?>
			</ul>
		</div>
	</div>
	<?php if ($this->context->siteInfo->front_video_url): ?>
		<div class="videoBlock">
			<div class="wrapper">
				<iframe width="854" height="480" src="<?=$this->context->siteInfo->front_video_url?>" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	<?php endif; ?>
	<!--about block-->
	<div class="aboutBlock">
		<div class="wrapper" id="flex-wr">
			<div class="aboutBlock-main">
				<div class="aboutBlock-main__title"><a href="pro-kompaniyu" title="<?=Yii::t('web', 'О компании')?>"><?=Yii::t('web', 'О компании')?></a></div>
				<div class="aboutBlock-main__text"><?=$this->context->siteInfo->aboutUsTextFront?></div>
			</div>
			<div class="aboutBlock__image">
				<div class="aboutBlock__image-item"><a href="<?= Url::to(['categories/brands']) ?>" class="a-sm-rel a-sm-rel--two"></a></div>
				<div class="aboutBlock__image-item"><a href="<?= Url::to(['default/shop']) ?>" class="a-sm-rel a-sm-rel--three"></a></div>
				<div class="aboutBlock__image-item"><a href="<?= Url::to(['categories/cure']) ?>" class="a-sm-rel a-sm-rel--four"></a></div>
				<div class="aboutBlock__image-item"><a href="<?= Url::to(['info/index']) ?>"></a></div>
			</div>
		</div>
	</div>
	<!--news-block-->
	<div class="newsBlock">
		<div class="wrapper">
			<div class="newsBlock__title"><a href="info" title="<?=Yii::t('web', 'Новости')?>"><?=Yii::t('web', 'Новости')?></a></div>
			<ul class="newsBlock-list">
				<?php foreach ($news as $newsItem): ?>
					<?php //$url = Url::toNews($newsItem); ?>
					<?php
					$url = Url::to(['info/view', 'info_tabs_id' => $newsItem->id]);
					$lang = Yii::$app->language;
					?>
					<li class="newsBlock-list-item" data-href="<?=$url?>" onclick="javascript:document.location.href='<?=$url?>'">
						<div class="newsBlock-list-item__title"><a href="<?=$url?>"><?=$newsItem->{'header_'.$lang}?></a></div>
						<div class="newsBlock-list-item__img" style="background-image:url('<?=$newsItem->image->url?>')"></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

	<!-- sertificate-block-->
	<div class="sertBlock" style="overflow: hidden;position: relative">
		<div class="wrapper">
			<div class="title"><a href="/partneri"><?=Yii::t('web', 'Сертификаты')?></a></div>
			<div class="sertficateSlider " id="lightgallery">
				<?php foreach ($certificates as $certificate): ?>

					<!--                    <a class="sert_item" href="--><?//=$certificate->image->url?><!--">-->
					<!--                        <img src="--><?//=$certificate->image->url?><!--">-->
					<!--                    </a>-->

					<a class="  sert__item "  data-fancybox="gallery" href="<?=$certificate->image->url?>"><img src="<?=$certificate->image->url?>"></a>
					<!--               <a class="test-popup-link sert__item "  href="--><?//=$certificate->image->url?><!--"><img src="--><?//=$certificate->image->url?><!--"></a>-->
					<!--               <a class="sert__item test-popup-link" href="--><?//=$certificate->image->url?><!--"><img src="--><?//=$certificate->image->url?><!--"></a>-->
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<!--    partner-block-->
	<div class="partnerBlock">
		<div class="wrapper">
			<div class="title"><a href="/partneri"><?=Yii::t('web', 'Партнеры')?></a></div>
			<div class="partnerSlider">
				<?php foreach ($partners as $partner): ?>
					<div class="partners__item"><img src="<?=$partner->image->url?>"></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<style>
	.mfp-img{
		max-height: 300px;
	}
</style>
</div>
<div class="plashka">
	<div>
		<a href="" class="footer-logoBlock__site"></a>
		<div class="h2"> Для просмотра сайта на мобильном устройстве, скачайте наше приложение:</div>
		<a href="<?=$this->context->siteInfo->google_play_link?>" class="footer-logoBlock__gPlay plashka-link"></a>
		<a href="<?=$this->context->siteInfo->app_store_link?>" class="footer-logoBlock__appStore plashka-link"></a>
		<a href="#" id="web-view">Перейти на сайт</a>

	</div>

</div>
<?php /*
<script>
    function approx() {
        if (jQuery(window).width()<600) {
            jQuery(".header-bottom-menu").css({'top':jQuery("#slider").height()+jQuery(".header-bottom").height(), 'bottom':'inherit'});
            }
    }
    window.onload = function() {
        approx();
        jQuery(window).on("resize",function() {document.location.reload();});
        }
</script>
*/ ?>
<?= (new \app\components\DimanycMarcetingScript\Marketing()) -> runScript('','main',''); ?>


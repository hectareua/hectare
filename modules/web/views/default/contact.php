<?php
use app\components\Url;
$this->title = Yii::t('web', 'Контакты') . ' | Гектар';
$lang = Yii::$app->language;
if(Yii::$app->language == 'ru') {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'Контакты') . '. Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.']);
} else {
    $this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('web', 'Контакты') . '. Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.']);
}

$this->registerCss("#map-canvas {
position: relative;
display: block;
height: 75vh;
}
.regrow {border-bottom: 1px solid brown;display:flex;    border-bottom: 1px solid black;
    display: flex;
    border-right: 1px solid black;
    background: #fdfdfd;
    border-left: 1px solid black;}
.regrow > div {display: block;padding: 10px;}
.reghead {font-family:'OpenSans Regular', sans-serif;color: #66221f;    background: #f59f14;font-weight:bold;border-top: 1px solid brown;margin-top:30px;color: #fff;}
@media screen and (max-width:400px){
	.regrow {display:inline-block;}	
}
");
?>
<div class="contacts hide">
    <div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


<!--        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope-->
<!--     itemtype="http://schema.org/ListItem"><span itemprop="name">--><?//=Yii::t('web', 'Контакты')?><!--</span> <meta itemprop="position" content="2" /></li>-->
    </ol>
        <div class="contacts__title"><?=Yii::t('web', 'Контакты')?></div>
        <ul class="contacts-list">
            <li class="contacts-list-item">
                <div class="contacts-list-item__img contacts-list-item__img_tel"></div>
                <div class="contacts-list-item__text"><?=$this->context->siteInfo->contacts_cell_phone?><br><?=$this->context->siteInfo->contacts_cell_phone_2?><br><?=$this->context->siteInfo->contacts_cell_phone_3?><br><?=$this->context->siteInfo->contacts_cell_phone_4?></div>
            </li>
            <li class="contacts-list-item">
                <div class="contacts-list-item__img contacts-list-item__img_email"></div>
                <div class="contacts-list-item__text "><?=$this->context->siteInfo->contacts_email?></div>
            </li>
            <li class="contacts-list-item">
                <div class="contacts-list-item__img contacts-list-item__img_sk"></div>
                <div class="contacts-list-item__text"><?=$this->context->siteInfo->contacts_skype?></div>
            </li>
            <li class="contacts-list-item">
                <div class="contacts-list-item__img contacts-list-item__img_adr"></div>
                <div class="contacts-list-item__text"><?=$this->context->siteInfo->contactsAddress?></div>
            </li>
        </ul>
      <?php /*  <iframe src="<?=$this->context->siteInfo->map_url?>"  height="440" frameborder="0" style="border:0" allowfullscreen></iframe> */ ?>

		<!-- <div id="map-canvas"/></div>	 -->



	<?php /* <div class="regional-contacts-table">
			<h2><?=Yii::t('web', 'Региональные представители')?></h2>
		<ul>
			<li>Україна,м. Миколаїв, вул. Троїцька, 238/5</li>
        <?php foreach ($representatives as $representative): ?>
			<li><span><?=$representative->name?></li>
		<?php endforeach; ?>
		</ul>
	</div>	 */ ?>
        <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>
        <?php if ($representatives): ?>
            <!--<div class="contacts-table">
                <div class="contacts-table__title"><?=Yii::t('web', 'Контакты')?></div>
                <div class="contacts-table-header">
                    <?php /* <div class="contacts-table-header__region" ><?=Yii::t('web', 'Регион')?></div> */ ?>
                    <div class="contacts-table-header__address"><?=Yii::t('web', 'Адрес')?></div>
                    <div class="contacts-table-header__tel"><?=Yii::t('web', 'телефон')?></div>
                    <?php /* <div class="contacts-table-header__email"><?=Yii::t('web', 'E-mail')?></div> */ ?>
                    <div class="contacts-table-header__face"><?=Yii::t('web', 'Наименование')?></div>
                    <div class="contacts-table-header__schedule"><?=Yii::t('web', 'График работы')?></div>
                </div>
                <?php foreach ($representatives as $representative): ?>
                    <div class="contacts-table-item">
                       <?php /*  <div class="contacts-table-item__region"><span><?=$representative->region?></span></div> */ ?>
                        <div class="contacts-table-item__address"><span><?=$representative->{'address'.$suff}?></span></div>
                        <div class="contacts-table-item__tel"><span><?=nl2br($representative->phones)?></span></div>
                       <?php /*  <div class="contacts-table-item__email"><span><?=$representative->email?></span></div> */ ?>
                        <div class="contacts-table-item__face"><?=Yii::t('web',$representative->{'name'.$suff})?></div>
                        <div class="contacts-table-item__schedule"><?=$representative->schedule?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            -->
		<?php endif; ?>
    </div>
</div>


<style>
    /*.contacts-table__title{*/
        /*margin-bottom: 10px;*/
    /*}*/
    /*.table-100-width{*/
        /*width: 100%;*/
        /*background: #eae8e9;*/

    /*}*/
    /*.table-100-width p{*/
     /*font-size: 16px;*/
        /*padding-bottom: 10px;*/
        /*font-family: "OpenSans", sans-serif;*/
        /*font-weight: 800;*/
        /*text-align: center;*/
    /*}*/
</style>

        <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>
        <?php if ($representatives): ?>
        <div class="contacts-table__title"><?=Yii::t('web', 'Контакты')?></div>
          <div class="container">
              <div class="col-md-8 col-md-offset-2">
                        <div class="table-100-width table-middle-margin">
                           <p class="table-row-name">
                               <?=Yii::t('web', 'Прием заявок осуществляется по телефонам')?> :
                               
                           </p>
                        </div>
                        <div class="table-100-width">
                             <div class="table-2-part leftPart">
                                 <span class="left-text1">
                                      <?=Yii::t('web', 'По Украине')?> : 
                                 </span>
                             </div>
                              <div class="table-2-part RightPart">
                                 <ul class="table-phones-list">
                                     <li class="phone-items "><a class="kievstar" href="telto:<?=str_replace(['(',')',' '], '', $phones[0]->c_body)?>"><?=$phones[0]->c_body?></a></li>
                                     <li class="phone-items "><a class="wodafone" href="telto:<?=str_replace(['(',')',' '], '', $phones[1]->c_body)?>"><?=$phones[1]->c_body?></a></li>
                                     <li class="phone-items "><a class="life" href="telto:<?=str_replace(['(',')',' '], '', $phones[2]->c_body)?>"><?=$phones[2]->c_body?></a></li>
                                     <li class="phone-items"><a class="st-phone" href="telto:<?=str_replace(['(',')',' '], '', $phones[3]->c_body)?>"><?=$phones[3]->c_body?></a></li>
                                 </ul>
                             </div>
                        </div>
                  <div class="table-100-width table-middle-margin">
                      <p class="table-row-name " >
                          <?=Yii::t('web', 'Интернет магазин')?> :
                      </p>
                  </div>
                  <div class="table-100-width">
                      <div class="table-2-part leftPart">
                          <span class="left-text">
                              <?=Yii::t('web', 'График работы')?> :

                          </span> <br/> <br/><br/>
                          <span class="left-text mob-visible">
                             <p>Пн-Пт: 8:00-18:00</p>
							 <p>Сб: 9:00-14:00</p>
                             <p><?=Yii::t('web', 'Вс')?> : <?=Yii::t('web', 'Выходной')?></p>
                          </span>

                          <span class="left-text">
                                 <?=Yii::t('web', 'Жалобы и предложения отправляйте на e-mail')?> :

                          </span>

                      </div>
                      <div class="table-2-part RightPart">
                          <ul class="table-contact-list">
                              <li class="time-items mob-hidden"> <p>Пн-Пт: 8:00-18:00</p></li>
							  <li class="time-items mob-hidden"><p>Сб : 9:00-14:00</p></li>
                              <li class="time-items mob-hidden"><p><?=Yii::t('web', 'Вс')?> : <?=Yii::t('web', 'Выходной')?></p></li>
                              <li class="time-items"><a href="mailto:<?=$email[0]->c_body?>"> <?=$email[0]->c_body?></a></li>

                          </ul>
                      </div>
                  </div>

                  
                  <div class="table-100-width table-100-width-thin-margin" >
                      <p class="table-row-name">
                          <?=Yii::t('web', 'График работы АгроМаркетов')?> :
                         
                      </p>
                  </div>
                  <div class="table-100-width table-100-middle-header">
                      <div class="table-3-part table-3-part-padding1">
                         <p>
                             <?=Yii::t('web', 'Адрес')?>
                         </p>
                          <span class="left-text mob-visible mob-margin">
                            <?=Yii::t('web', 'г.Вознесенск')?>,
                              <?=Yii::t('web', 'ул.Октябрьской революции')?>
                              , 273 б
                          </span>
                      </div>
                      <div class="table-3-part table-3-part-padding2">
                          <p>
                              <?=Yii::t('web', 'График работы')?>
                          </p>
                          <span class="left-text mob-visible mob-margin">
                              <p>Пн-Пт: 8:00 - 17:00</p>
                             <p>Сб-Нд: 8:00 - 15:00</p>
                          </span>
                      </div>
                      <div class="table-3-part table-3-part-padding3">
                          <p>
                              <?=Yii::t('web', 'Контакты')?>
                          </p>
                          <span class="left-text mob-visible mob-margin">
                             <a style="" href="">+38(067)558-77-14</a>
                          </span>
                      </div>
                  </div>
                  <div class="table-100-width table-100-width-thin-margin mob-hidden">
                      <div class="table-3-part table-3-part-padding table-3-part-padding1 text-left">
                          <p class="table3-text mob-hidden">
                              <?=Yii::t('web', 'г.Вознесенск')?>,
                              
                          </p>
                          <p class="table3-text mob-hidden ">
                              <?=Yii::t('web', 'ул.Октябрьской революции')?>
                              , 273 б
                          </p>
                      </div>
                      <div class="table-3-part table-3-part-padding table-3-part-padding2 mob-hidden" style="vertical-align: top;">
                          <p>Пн-Пт: 8:00 - 17:00</p>
                          <p>Сб-Нд: 8:00 - 15:00</p>
                      </div>
                      <div class="table-3-part table-3-part-padding table-3-part-padding3 " id="floatContact">
                          <p class="middle-text" style="; padding-right: 10px"><a style="" href="telto:<?=str_replace(['(',')',' '], '', $phones[6]->c_body)?>"><?=$phones[6]->c_body?></a></p>
                      </div>
					  <div class="table-100-link-wrapper">
						  <a class="table-100-width-link" href="https://hectare.com.ua/ru/shop" >
							  <?=Yii::t('web', 'Посмотреть все АгроМаркеты')?>
						  </a>
					  </div>
                  </div>

                  <div class="table-100-width table-middle-margin">
                      <p class="table-row-name">
                          <?=Yii::t('web', 'Заказы, безналичные документы для юридических лиц')?>
                           :
                      </p>
                  </div>
                  <div class="table-100-width">
                      <div class="table-2-part leftPart">
                          <span class="left-text">
                                  <?=Yii::t('web', 'Бухгалтерия')?>
                            :
                          </span>
                      </div>
                      <div class="table-2-part RightPart">
                          <ul class="table-contact-list">
                              <li class="time-items"><a href="mailto:<?=$email[1]->c_body?>"> <?=$email[1]->c_body?></a></li>

                          </ul>
                      </div>
                  </div>


                  <div class="table-100-width table-middle-margin">
                      <p class="table-row-name">
                          <?=Yii::t('web', 'Розничная сеть "Гектар"')?>

                      </p>
                  </div>
                  <div class="table-100-width">
                      <div class="table-2-part leftPart">
                          <span class="left-text">
                               <?=Yii::t('web', 'Отдел маркетинга "Гектар"')?>
                             :
                          </span>
                      </div>
                      <div class="table-2-part RightPart">
                          <ul class="table-contact-list">
                              <li class="time-items"><a href="mailto:<?=$email[2]->c_body?>"><?=$email[2]->c_body?></a></li>

                          </ul>
                      </div>
                  </div>


                  <div class="table-100-width table-middle-margin">
                      <p class="table-row-name">
                          <?=Yii::t('web', 'Отдел подбора персонала и открытые вакансии')?>


                      </p>
                  </div>
                  <div class="table-100-width">
                      <div class="table-2-part leftPart">
                          <span class="left-text">
                                  <?=Yii::t('web', 'Служба персонала')?>
                              :
                          </span>
                      </div>
                      <div class="table-2-part RightPart">
                          <ul class="table-contact-list">
                              <li class="time-items"><a href="mailto:<?=$email[3]->c_body?>"><?=$email[3]->c_body?></a></li>

                          </ul>
                      </div>
                  </div>


                  <div class="table-100-width table-middle-margin">
                      <p class="table-row-name">
                          <?=Yii::t('web', 'Отдел по работе с корпоративными клиентами')?>

                      </p>
                  </div>
                  <div class="table-100-width">
                      <div class="table-2-part leftPart">
                          <span class="left-text">
                                <?=Yii::t('web', 'По Украине')?> :
                          </span>
                      </div>
                      <div class="table-2-part RightPart">
                          <ul class="table-contact-list">
                              <li class="time-items"><a href="telto:<?=str_replace(['(',')',' '], '', $phones[4]->c_body)?>"><?=$phones[4]->c_body?></a></li>
                              <li class="time-items"><a href="telto:<?=str_replace(['(',')',' '], '', $phones[5]->c_body)?>"><?=$phones[5]->c_body?></a></li>

                          </ul>
                      </div>
                  </div>

              </div>

<!--            <div class="col-lg-1 col-xs-1"></div>-->
<!--            <div class="col-lg-10 col-xs-12">-->
<!--				<div class="regrow reghead">-->
<!--					<div class="col-lg-6 col-xs-12">-->
<!--						--><?//=Yii::t('web', 'Адрес')?>
<!--					</div>-->
<!--					<div class="col-lg-3 col-xs-12">-->
<!--						--><?//=Yii::t('web', 'Наименование')?>
<!--					</div>-->
<!--					<div class="col-lg-3 col-xs-12">-->
<!--						--><?//=Yii::t('web', 'График работы')?>
<!--					</div>-->
<!--						<div class="col-lg-3 col-xs-12">-->
<!--						--><?//=Yii::t('web', 'Телефон')?>
<!--					</div>-->
<!--				</div>-->
<!--				--><?php //foreach ($representatives as $representative): ?>
<!--                --><?php //if (!isset($current)){ ?>
<!--                    <div class="regrow sepLine"> --><?//=$representative->{'region'.$suff}?><!-- </div>-->
<!--                --><?php //}  ?>
<!--                --><?php //if (isset($current) && $current != $representative->region_ru){?>
<!--                        <div class="regrow sepLine"> --><?//=$representative->{'region'.$suff}?><!-- </div>-->
<!--                --><?php //} ?>
<!--				<div class="regrow">-->
<!--					<div class="col-lg-6 col-xs-12">-->
<!--						--><?//=$representative->{'address'.$suff}?>
<!--					</div>-->
<!--					<div class="col-lg-3 col-xs-12">-->
<!--						--><?//=Yii::t('web',$representative->{'name'.$suff})?>
<!--					</div>-->
<!--					<div class="col-lg-3 col-xs-12">-->
<!--						--><?//=$representative->schedule?>
<!--					</div>-->
<!--					<div class="col-lg-3 col-xs-12">-->
<!--						--><?php //echo($representative->phones); ?>
<!--					</div>-->
<!--				</div>-->
<!--                --><?php //$current = $representative->region_ru; ?>
<!--				--><?php //endforeach; ?>
<!--			</div>-->
<!--			<div class="col-lg-1 col-xs-1"></div>-->
		</div>	
		<?php endif; ?>
<div class="space"></div>

<?php
$rep = '[["", \'\']';

foreach ($representatives as $representative) {
	$rep .=',["<span style=\'font-size: 25px;font-weight: bold;display: block;padding-bottom: 20px;\'>'.$representative->{$lang=='uk'?'name_'.$lang:'name'}.'</span>", "<span style=\'\'>'.$representative->{$lang=='uk'?'address_'.$lang:'address'}."</span><br><span><b style='text-align: left;width: 100%;display: block;padding-top:10px;    padding-left: 19px;'>".$representative->schedule."</b></span><br><b style='float: left;font-size: 24px;text-align: center;width: 100%;'>".$representative->phones."</b>".'","'.$representative->image->url.'","'.$representative->region.'"]';
}
$rep .=']';
?>

<?php
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyBPMXb_QZsP1P30OO6LDDuF8IVUsWYFcwc&sensor=true");
/*$this->registerJs("
		function initialize() {
		var mapOptions = {
		  center: new google.maps.LatLng(48.75000000,32.51977539),
		  zoom: 6,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		  
		function geocodeAddress(info, geocoder, resultsMap) {
			geocoder.geocode({'address': info[3]}, function(results, status) {
			  if (status === 'OK') {
				// resultsMap.setCenter(results[0].geometry.location);
				infowindow = new google.maps.InfoWindow({ content:'<div class=\"text-center\"><img style=\"height:250px;\" src=\"'+info[2]+'\" />'+'<div>'+info[0]+'</div><div>'+info[1]+'</div></div>'});
				var marker = new google.maps.Marker({
				  map: resultsMap,
				  position: results[0].geometry.location,
					icon: 'http://hectare.com.ua/images/logoico.svg',
					title:info[0] 
				});
				rrr(marker,infowindow);
			  } else {
				alert('Geocode was not successful for the following reason: ' + status);
			  }
			});
		}
		  

		var infos =".$rep.";

		var infowindow = [];
		var marker=[];
		var geocoder = new google.maps.Geocoder();

		for (var i = 0; i < infos.length; i++) {
		var info = infos[i];
		if (info[3]) geocodeAddress(info, geocoder, map); 
		}

		function rrr(mar,inf) {
			google.maps.event.addListener(mar, 'click', function() {inf.open(mar.get('map'), mar);});
		}

		}

      google.maps.event.addDomListener(window, 'load', initialize);
    ");
*/
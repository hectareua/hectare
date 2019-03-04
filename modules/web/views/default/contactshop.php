<?php
use app\components\Url;
$this->title = Yii::t('web', 'Адреса магазинов') . ' | Гектар';
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
.regrow {border-bottom: 1px solid brown;display:flex;}
.regrow > div {display: block;padding: 10px;}
.reghead {font-family:'OpenSans Regular', sans-serif;color: #66221f;font-weight:bold;border-top: 1px solid brown;margin-top:30px;}
@media screen and (max-width:400px){
	.regrow {display:inline-block;}	
	.btn-region .col-xs-12 {padding-right:0 !important;}	
}
.btn-info{
    background-color:#f59f08 !important;
}
.btn-region .col-xs-12 {padding-left:0 !important;}	
.btn-info:hover, .btn-info.active, .btn-info:active, .open > .dropdown-toggle.btn-info{
    background-color:#00733a !important;
}

.dropdown-menu > .active > a, .dropdown-menu > .active > a:focus, .dropdown-menu > .active > a:hover{
    background-color:#00733a !important;
}
.dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
    background-color:#f59f08 !important;
    color: #fff !important;
}
.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:active, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover {
    color: #fff;
}
.btn-region .btn-group{
    width:100% !important;
}

#map-canvas{
    margin-right: -15px;
    margin-left: -15px;
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

$this->registerCssFile("@web/css/bootstrap-select.min.css");
?>
<div class="contacts">
    <div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


<!--        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope-->
<!--     itemtype="http://schema.org/ListItem"><span itemprop="name">--><?//=Yii::t('web', 'Контакты')?><!--</span> <meta itemprop="position" content="2" /></li>-->
    </ol>
        <div class="contacts__title" style="margin-bottom: 40px"><?=Yii::t('web', 'Адреса магазинов')?></div>


        <?php  $suff = '_ru'; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>

        <div class="btn-region row" style="width: 100%; margin-left: 0; margin-right: 0">
            <div class="col-md-3 col-xs-12 text-center">
            <select class="selectpicker first-select" data-style="btn-info" data-live-search="true" data-none-results-text="<?=Yii::t('web','Не удалось найти область: ')?>{0}">
                <option value="default" selected="selected"><?=Yii::t('web',"Все области")?></option>
                <?php foreach ($representativeRegions as $representativeRegion):?>

                    <option><?=$representativeRegion['region'.$suff]?></option>
                <?php endforeach;?>
            </select>
            </div>
            <div class="col-md-3 col-xs-12 text-center">
            <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>
            <select class="selectpicker second-select" data-size="7" data-style="btn-info" data-live-search="true" data-none-results-text="<?=Yii::t('web','Не удалось найти н.п.: ')?>{0}">
                <option value="default" selected="selected"><?=Yii::t('web',"Все населенные пункты")?></option>
                <?php foreach ($representatives as $representative):?>

                    <option><?=$representative->{'address'.$suff}?></option>
                <?php endforeach;?>
            </select>
            </div>

<!--        --><?php //foreach ($representativeRegions as $representativeRegion):?>
<!---->
<!--            <a href="javascript:;" class="representative btn">--><?//=$representativeRegion['region'.$suff]?><!--</a>-->
<!--        --><?php //endforeach;?>

        </div>
<!--         <ul class="contacts-list">
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
        </ul> -->
      <?php /*  <iframe src="<?=$this->context->siteInfo->map_url?>"  height="440" frameborder="0" style="border:0" allowfullscreen></iframe> */ ?>

    </div>
</div>

		<div id="map-canvas"/></div>	
 
 

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
                <div class="contacts-table__title"><?=Yii::t('web', 'Региональные представительства')?></div>
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




        <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>
        <?php if ($representatives): ?>
        <div class="contacts-table__title"><?=Yii::t('web', 'Региональные представительства')?></div>
          <div class="container">
            <div class="col-lg-1 col-xs-1"></div>
            <div class="col-lg-10 col-xs-10">
				<div class="regrow reghead">
					<div class="col-lg-6 col-xs-12">
						<?=Yii::t('web', 'Адрес')?>
					</div>
					<div class="col-lg-3 col-xs-12">
						<?=Yii::t('web', 'Наименование')?>
					</div>
					<div class="col-lg-3 col-xs-12">
						<?=Yii::t('web', 'График работы')?>
					</div>
						<div class="col-lg-3 col-xs-12">
						<?=Yii::t('web', 'Телефон')?>
					</div>
				</div>
                <div class="reprow">
                    <?php foreach ($representatives as $representative): ?>
                    <div class="regrow">
                        <div class="col-lg-6 col-xs-12">
                            <?=$representative->{'address'.$suff}?>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <?=Yii::t('web',$representative->{'name'.$suff})?>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <?=$representative->schedule?>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <?php echo($representative->phones); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
			</div>
			<div class="col-lg-1 col-xs-1"></div>
		</div>
		<?php endif; ?>
<div class="space"></div>

<?php
$rep = '[["", \'\']';
$suff = '_ru'; if(Yii::$app->language == 'uk') { $suff = '_uk';};
foreach ($representatives as $representative) {
	$rep .=',["<span style=\'font-size: 25px;font-weight: bold;display: block;padding-bottom: 20px;\'>'.$representative->{$lang=='uk'?'name_'.$lang:'name'}.'</span>", "<span style=\'\'>'.$representative->{$lang=='uk'?'address_'.$lang:'address'}."</span><br><span><b style='text-align: left;width: 100%;display: block;padding-top:10px;    padding-left: 19px;'>".$representative->schedule."</b></span><br><b style='float: left;font-size: 24px;text-align: center;width: 100%;'>".$representative->phones."</b>".'","'.$representative->image->url.'","'.$representative->region.'","'.$representative['region'.$suff].'","'.$representative->{$lang=='uk'?'address_'.$lang:'address'}.'","'.$representative->longitude.'","'.$representative->latitude.'"]';
}
$rep .=']';
?>


<?php
$repTable = '[["", \'\']';
$suff = '_ru'; if(Yii::$app->language == 'uk') { $suff = '_uk';};
foreach ($representatives as $representative) {
    $repTable .=',["'.$representative->{$lang=='uk'?'name_'.$lang:'name'}.'", "'.$representative->{$lang=='uk'?'address_'.$lang:'address'}.'","'.$representative->schedule.'","'.$representative->phones.'","'.$representative['region'.$suff].'"]';
}
$repTable .=']';
?>

<?php
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyBPMXb_QZsP1P30OO6LDDuF8IVUsWYFcwc");
//$this->registerJsFile("@web/js/bootstrap.min.js", ['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile("@web/js/bootstrap-select.min.js",['depends' => 'yii\web\JqueryAsset']);


$this->registerJs("
var cycle=1;
var timeout1=0;
var timeout2=0;
var i=1;
var regionAll_uk = 'Всі області';
var regionAll_ru = 'Все области';
var cityAll_uk = 'Всі населені пункти';
var cityAll_ru = 'Все населенные пункты';
var dataa=[];

		function initialize() {
		var mapOptions = {
		  center: new google.maps.LatLng(48.75000000,32.51977539),
		  zoom: 6,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		  
		function geocodeAddress(info, resultsMap) {
		
		infowindow = new google.maps.InfoWindow({ content:'<div class=\"text-center\"><img style=\"height:250px;\" src=\"'+info[2]+'\" />'+'<div>'+info[0]+'</div><div>'+info[1]+'</div></div>'});
		    
		 var marker = new google.maps.Marker({
		        map: resultsMap,	        
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(info[6], info[7]),
                icon: 'http://hectare.com.ua/images/logoico.svg',
                title:info[3]
            });
		
		rrr(marker,infowindow);
		markerArray(marker);
		
		
//			geocoder.geocode({'address': info[3]}, function(results, status) {
//			
//			  if (status === 'OK') {
//				// sleep(2000);
//				infowindow = new google.maps.InfoWindow({ content:'<div class=\"text-center\"><img style=\"height:250px;\" src=\"'+info[2]+'\" />'+'<div>'+info[0]+'</div><div>'+info[1]+'</div></div>'});
//				
//				var marker = new google.maps.Marker({
//				  map: resultsMap,
//				  
//				//  animation: google.maps.Animation.DROP,
//				  position: results[0].geometry.location,
//					icon: 'http://hectare.com.ua/images/logoico.svg',
//					//title:info[0] 
//					title:info[3]
//				});
//			   //  resultsMap.setCenter(results[0].geometry.location);
//				rrr(marker,infowindow);
//				markerArray(marker);
//				
//			  } 
//			  else if(status==='OVER_QUERY_LIMIT'){
//			//  sleep(3000);
//			sleep(300);
//			 timeout2 = setTimeout(function(){geocodeAddress(info, geocoder, resultsMap);},100);  
//			  
////			    cycle--;
////		        timer();
//		
//			  }else{
//			  alert('Geocode was not successful for the following reason: ' + status);
//			  }
				 
			  
			//});
		}

        var region = null;	
		var infos =".$rep."; 
		var infowindow = [];
		var markers=[];
		//var geocoder = new google.maps.Geocoder();
        

        $('.bootstrap-select select').change(function(){

            i=infos.length;

            region = $(this).parent().find('button').text().replace(/^\s*/,'').replace(/\s*$/,'');
            var rep = ".$repTable.";
            var data='';
            
            dataa=[];
            var allData='';
            map.setZoom(6);
            
             for(var i=1; i < rep.length; i++){
                
                if(rep[i][4] == region){
                            dataa.push([i, rep[i][1]]);
                            data += 
                            '<div class=\'regrow\'>'+
                               '<div class=\"col-lg-6 col-xs-12\">'+
                                    rep[i][1]+
                                '</div>'+
                                 '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][0]+
                                '</div>'+
                                 '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][2]+
                                '</div>'+
                                '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][3]+
                                '</div>'+
                            '</div>'
                }else if(rep[i][1].replace(/^\s*/,'').replace(/\s*$/,'') == region){
                
                            data += 
                            '<div class=\'regrow\'>'+
                               '<div class=\"col-lg-6 col-xs-12\">'+
                                    rep[i][1]+
                                '</div>'+
                                 '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][0]+
                                '</div>'+
                                 '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][2]+
                                '</div>'+
                                '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][3]+
                                '</div>'+
                            '</div>'
                }
                
             }
            $('.reprow').html(data);
               
            
            for (var i = 0; i < markers.length; i++) {
                
                markers[i].setMap(null);
            }
            
           
            for (var i = 1; i < infos.length; i++) {        
                var info = infos[i];
              //  alert(info[5]);
                //console.log(info[4] == region);
                if (info[3] && info[4].replace(/^\s*/,'').replace(/\s*$/,'') == region) {
                    geocodeAddress(info, map);
                }
                if(region.replace(/^\s*/,'').replace(/\s*$/,'')==regionAll_uk || regionAll_ru == region.replace(/^\s*/,'').replace(/\s*$/,'') ||
                region.replace(/^\s*/,'').replace(/\s*$/,'')==cityAll_uk || cityAll_ru == region.replace(/^\s*/,'').replace(/\s*$/,'')){
                    getI();
                    showAll();
                    for(var i=1; i < rep.length; i++){
                     allData += 
                            '<div class=\'regrow\'>'+
                               '<div class=\"col-lg-6 col-xs-12\">'+
                                    rep[i][1]+
                                '</div>'+
                                 '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][0]+
                                '</div>'+
                                 '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][2]+
                                '</div>'+
                                '<div class=\"col-lg-3 col-xs-12\">'+
                                    rep[i][3]+
                                '</div>'+
                            '</div>'
                    }
                     $('.reprow').html(allData);
                    break;
                }
                 if(info[5].replace(/^\s*/,'').replace(/\s*$/,'') == region){
                    geocodeAddress(info, map);

                }
               // location.reload();		
            }
        });

        function markerArray(mark){
		    markers.push(mark);
		}


        
    function getI(){
        i=1;
    }   
    $('.selectpicker.first-select').change(function(){
    
        if($(this).find(':selected').val() != 'default'){
            var secondSelector = '<option value=\"default\" selected=\"selected\">'+$('.selectpicker.second-select').find(':nth-child(1)').text()+'</option>';
            $('.btn-region .selectpicker.second-select').val('default');
         $('.btn-region .selectpicker.second-select').selectpicker('refresh');
         for(var i=0; i < dataa.length; i++){
           secondSelector += '<option>'+ dataa[i][1] + '</option>';
         }
         $('.selectpicker.second-select').html(secondSelector);
         $('.btn-region .selectpicker.second-select').selectpicker('refresh');
  
           }else{
                       $('.btn-region .selectpicker.second-select').val('default');
                        $('.btn-region .selectpicker.second-select').selectpicker('refresh');
           }
    });
    $('.selectpicker.second-select').change(function(){

        //    $('.btn-region .selectpicker.first-select').val('default');
         //  $('.btn-region .selectpicker.first-select').selectpicker('refresh');
    });
       
        
     
    function showAll(){
        
	    for (i; i < infos.length;i++) {	    
		    var info = infos[i];
		   	if (info[3]) {
		        geocodeAddress(info, map);
		    }
        }
    }
    showAll();
    
    function clearSelectPicker(){
            $('.btn-region .selectpicker.second-select').val('default');
            $('.btn-region .selectpicker.second-select').selectpicker('refresh');
            $('.btn-region .selectpicker.first-select').val('default');
            $('.btn-region .selectpicker.first-select').selectpicker('refresh');
    }
    clearSelectPicker();

        var prev_infowindow =false; //флаг предыдущего infoWindow
        
		function rrr(mar,inf) {
			google.maps.event.addListener(mar, 'click', function() {
			    
			   if( prev_infowindow ) {
                    prev_infowindow.close();
                }
                prev_infowindow = inf;
                map.setZoom(7);
                map.panTo(mar.position);
			    inf.open(map, mar);
			
			});	
		}
//        $(document).mouseup(function (e){ // событие клика по веб-документу
//       
//		var div = $(\".gm-style-iw\").parent(); // тут указываем ID элемента
//		
//		if (div.is(e.target) // если клик был не по нашему блоку
//		    ) { // и не по его дочерним элементам
//			prev_infowindow.close(); // скрываем его
//			alert(div.html());
//		}
//	});
}

      google.maps.event.addDomListener(window, 'load', initialize);
    ");

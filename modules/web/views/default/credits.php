<?php
use app\components\Url;
use app\models\Credit;
use yii\helpers\Html;

$this->title = Yii::t('web', 'Кредитование');
$lang='';
if(Yii::$app->language == 'uk') {$lang='_uk';}else{$lang='_ru';}
?>
<div class="credits">
    <div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

    </ol>
    <?php 

      $credit = new Credit;

    ?>

<!--        <div class="delivery__title">--><?//=Yii::t('web', 'Кредитование')?><!--</div>-->
        <?php if(Yii::$app->language == 'ru'): ?>
        <div class="img-credit">
            <?=Html::img('@web/upload/kredit_ru.jpg', ['style' => 'width:100%'])?>
        </div>
        <?php else: ?>
            <?=Html::img('@web/upload/kredit_ua.jpg', ['style' => 'width:100%'])?>
        <?php endif;?>
        <h2><?=Yii::t('web', ' ')?></h2>

        <ul class="nav nav-tabs bank" style="border-bottom: 4px solid #c65220">
          <?php foreach ($credit->find()->where(['parent_id'=>'0'])->asArray()->all() as $key => $value) { ?>
          <li class="<?=$key<=0?'active':'' ?>"><a data-toggle="tab" href="#bank<?=$value['id']; ?>"><img src="<?=$value['img']; ?>" style="    width: 100px;"></a></li>
         <?php  } ?>
          
        </ul>

<div class="tab-content bank">

  <?php foreach ($credit->find()->where(['parent_id'=>'0'])->all() as $key => $value) { ?>
        <div id="bank<?=$value['id']; ?>" class="tab-pane bank fade <?=$key<=0?'in active':'' ?>">
        <h3><?=$value['name'.$lang]; ?></h3>
        <p><?=$value['desk'.$lang]; ?></p>



        <div class="service">

            <ul class="nav nav-tabs">
        <?php 

          $r = $credit->find()->where(['parent_id'=>$value->id])->all();
           foreach ($r as $key => $value) { ?>
             <li class="<?=$key<=0?'active':'' ?>"><a data-toggle="tab" href="#bank-service-<?=$value['id']; ?>"><?=$value['name'.$lang]; ?></a></li>
           <?php }
        ?>
      </ul>

<div class="tab-content bank-service">
        
        <?php 

          // $r = $credit->find()->where(['parent_id'=>$value->id])->all();
        $i = 0;
           foreach ($r as $key => $value) {?>
             <div id="bank-service-<?=$value['id']; ?>" class="tab-pane bank-service fade <?=$i<=0?'in active':'' ?>">
                <h3 class="title-credit"><?=$value['name'.$lang]; ?></h3>
                <p><?=$value['desk'.$lang]; ?></p>


               <div align="left" id="cor5" class="sidebarForm">
                       <h4 class="text-center">Калькулятор кредита</h4>
                       <form action="#" method="post" id="calculator">

                           <label><?=Yii::t('web', 'Сумма кредита')?>: <font color="#FF0000" style="vertical-align: middle;">*</font></label>
                           <div class="input" id="cor5">
                               <input name="summaCredit" value="" id="posName" type="text">
                           </div>

                           <label><?=Yii::t('web', 'Ставка % в месяц')?>: <font color="#FF0000" style="vertical-align: middle;">*</font></label>
                           <div class="input" id="cor5">
                               <input name="procent" value="<?=number_format($value['credit_percent'], 2, '.', '')?>" id="posEmail" type="text" readonly>
                           </div>

                           <label><?=Yii::t('web','Период выплат (месяцев)')?>:</label><br>
                           <div class="select1" id="cor5">
                               <select name="year" >
                                   <?php for($i=split('-',$value['period'])[0];$i<=split('-',$value['period'])[1];$i++):?>
                                        <option value="<?=$i?>"><?=$i?></option>
                                  <?php endfor;?>
                               </select>
                           </div>
                           <p id="error" style="display: none"><?= Yii::t('web','Ошибка! Форма заполненна не корректно!')?></p>


                           <button type="button" class="send4"><?=Yii::t('web','Посчитать')?></button>
                       </form>

                       <hr style="margin: 5px 8px 0 8px; height:1px; background-color:#666; width:95%;">
                       <h4 class="calculation-credit"><?=Yii::t('web','Итог расчёта')?>:</h4>
                       <table width="420" border="0" cellspacing="0" cellpadding="0">
                           <tbody>
                           <tr class="agro-cube">
                               <td colspan="2" width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','С 1-го по 6-ой месяц включительно оплачиваються только %')?>:</span></td>

                           </tr>
                           <tr class="agro-cube">
                               <td width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','Ежемесячный платёж')?>:</span></td>
                               <td style="vertical-align: middle"><span class="a1" style="font: 12px Verdana;">0</span></td>
                           </tr>
                           <tr class="agro-cube">
                               <td colspan="2" width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','С 7-го по 12-й месяц оплачиваеться % и кредит')?>:</span></td>
                           </tr>
                           <tr>
                               <td width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','Ежемесячный платёж')?>:</span></td>
                               <td style="vertical-align: middle"><span class="h1" style="font: 12px Verdana;">0</span></td>
                           </tr>
                           <tr>
                               <td width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','Количество платежей')?>:</span></td>
                               <td style="vertical-align: middle"><span class="h2" style="font: 12px Verdana;">0</span></td>
                           </tr>
                           <tr>
                               <td width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','Всего заплатите')?>:</span></td>
                               <td style="vertical-align: middle"><span class="h3" style="font: 12px Verdana;">0</span></td>
                           </tr>
                           <tr>
                               <td width="165" height="20" style="position:relative;"><span style="font: 12px Verdana; position:absolute; top:2px; left:10px;"><?=Yii::t('web','Переплата по кредиту')?>:</span></td>
                               <td style="vertical-align: middle"><span class="h4" style="font: 12px Verdana;">0</span></td>
                           </tr>
                           </tbody></table><br>
                   <hr style="margin: 5px 8px 0 8px; height:1px; background-color:#666; width:95%;">
                   <h4>
                       <p><?=Yii::t('web','Приведенные платежи являются приблизительными.')?></p>
                       <p><?=Yii::t('web','Мы не гарантируем, что условия банков будут отвечать параметрам, рассчитанным в калькуляторе.')?></p>
<!--                       <p>--><?//=Yii::t('web','За более подробной информацией обращайтесь по телефону: +38 (067) 445-40-87.')?><!--</p>-->
                   </h4>
                   </div>
             </div>
           <?php $i++;}
        ?>

</div>





      </div>
          <!-- <li class="<?=$key<=0?'active':'' ?>"><a data-toggle="tab" href="#home"><img src="<?=$value['img']; ?>" style="    width: 100px;"></a></li> -->
  </div>
  <?php  } ?>




 
</div>


        <div  style="display: none;" class="delivery-list">
			<?php //$this->context->siteInfo->{'credits'.$lang}?>
        </div>



    </div>



</div>
<div class="space"></div>


<style>
  
  blockquote {

}
.service ul {
    border-bottom: 1px solid #ddd;
  }
.service li {
  list-style-type: none;

}
.service li a {
      color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

  .sidebarForm {
      background: #f6f6f6;
      box-shadow: 0 0 5px #ccc;
      -webkit-box-shadow: 0 0 5px #ccc;
      -moz-box-shadow: 0 0 5px #ccc;
      width: 420px;
  }

  #cor5 {
      border-radius: 5px;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
  }

  .sidebarForm h4 {
      font: 14px Verdana;
      color: #333333;
      text-align: left;
      padding: 10px 10px 10px 10px;
      margin: 0px;
  }

  .sidebarForm label {
      font: 12px Verdana;
      color: #333;
      padding: 10px;
  }

  .sidebarForm .input {
      width: 179px;
      height: 20px;
      overflow: hidden;
      background: white;
      border: solid 1px #DFE2E5;
      margin: 5px 0 10px 10px;
      box-shadow: 0 0 5px #ccc;
      -webkit-box-shadow: 0 0 5px #ccc;
      -moz-box-shadow: 0 0 5px #ccc;
  }

  .sidebarForm .input input {
      width: 174px;
      height: 26px;
      background: white;
      margin: -3px 0 0 -5px;
      padding: 0px 8px;
      border: none;
      background: transparent;
  }

  .sidebarForm .select1 {
      width: 100px;
      height: 20px;
      float: left;
      overflow: hidden;
      background: white;
      border: solid 1px #DFE2E5;
      margin: 5px 7px 10px 10px;
      box-shadow: 0 0 5px #ccc;
      -webkit-box-shadow: 0 0 5px #ccc;
      -moz-box-shadow: 0 0 5px #ccc;
  }

  .sidebarForm .select1 select {
      width: 100px;
      height: 26px;
      background: white;
      margin: -3px 0 0 -5px;
      padding: 0px 8px;
      border: none;
      background: transparent;
  }

  .sidebarForm .select2 {
      width: 100px;
      height: 20px;
      overflow: hidden;
      background: white;
      border: solid 1px #DFE2E5;
      margin: 5px 0 10px 10px;
      box-shadow: 0 0 5px #ccc;
      -webkit-box-shadow: 0 0 5px #ccc;
      -moz-box-shadow: 0 0 5px #ccc;
  }

  .sidebarForm .select2 select {
      width: 110px;
      height: 26px;
      background: white;
      margin: -3px 0 0 -5px;
      padding: 0px 8px;
      border: none;
      background: transparent;
  }

  .sidebarForm button {
      border: 2px #ccc solid;
      width: 150px;
      height: 25px;
      font: 12px Verdana;
      font-weight: 700;
      color: #FFFFFF;
      background-color: #f59f08;
      padding-bottom: 2px;
      margin: 5px 0 15px 135px;
  }

  .sidebarForm button:hover {
      background-color: #00733a;
  }
  
  @media screen and (max-width:600px){
      .sidebarForm, .sidebarForm table{
          width:100%;
      }
      .sidebarForm table tr:first-child{
          height:30px;
      }
  }

</style>
<?php

$script = <<< JS


$(document).ready(function() {
// калькулятор кредита................................./
var Ld = "<img src='load.gif' alt='' />";
var error = "<span style='font-size: 11px; font-weight: 100;'><font color='#ff0000'>"+$('#error').text()+"</font>";
$(".agro-cube").css({"display":"none"});
var erForm = "";
$(".service a").click(function() {
 if($(this).text().indexOf('АгроКУБ') < 1){
     $(".agro-cube").css({"display":"none"});
 }else if($(this).text().indexOf('АгроКУБ') > 1) {
     $(".agro-cube").css({"display":""});
 }
});

$(".send4").click(function(){
    
        var elem = $(this).parent();
   		var agro_cub = elem.parent().parent().find('.title-credit').text();
		elem.parent().find(".h1").html(Ld).show();
		elem.parent().find(".h2").html(Ld).show();
		elem.parent().find(".h3").html(Ld).show();
		elem.parent().find(".h4").html(Ld).show();

		var amount = Number(elem.find("input[name='summaCredit']").val());
        var interest = Number(elem.find("input[name='procent']").val()/100);

		var yearCredit = elem.find("select[name='year']").val();
		var month = elem.find("select[name='month']").val();
		
		var Valjuta = elem.find("select[name='posValjuta']").val();
		var time = Number(yearCredit);
		/*alert(time);*/
		
		function calculatePayment(elem) {
		    if(interest==0 && agro_cub.indexOf('АгроКУБ') < 1){
		            
		       		elem.parent().find(".h1").text((amount/yearCredit).toFixed(2));
		            elem.parent().find(".h2").text(time);
		            elem.parent().find(".h3").text(amount.toFixed(2));
		            elem.parent().find(".h4").text(Number('0.00').toFixed(2)); 
		            
		    }else if(agro_cub.indexOf('АгроКУБ') > 1){
		        
		        var rate = (amount*interest);
		        var rate2 = ((amount/6) + rate);
                var summaVsego = (rate * time/2) + (rate2 * time/2);
                var pereplata = summaVsego - amount;
                elem.parent().find(".a1").text(rate.toFixed(2));
                elem.parent().find(".h1").text(rate2.toFixed(2));
                elem.parent().find(".h2").text(time);
                elem.parent().find(".h3").text(summaVsego.toFixed(2));
                elem.parent().find(".h4").text(pereplata.toFixed(2));
		    }else{
		        // var rate = amount * (Number(interest) * Math.pow(1 + Number(interest), time)) / (Math.pow(1 + Number(interest), time) - 1);
		        
		        var rate = (amount/time) + (amount*interest);
                var summaVsego = rate * time;
                var pereplata = summaVsego - amount;
                elem.parent().find(".h1").text(rate.toFixed(2));
                elem.parent().find(".h2").text(time);
                elem.parent().find(".h3").text(summaVsego.toFixed(2));
                elem.parent().find(".h4").text(pereplata.toFixed(2));
                
		    }
		
		}

if (amount == "") {erForm = "yes";}
if (interest == -1) {erForm = "yes";}
if (yearCredit == "0" && month == "0") {erForm = "yes";}

if (erForm == "") { calculatePayment(elem); } else {
elem.parent().find(".h1").html(error);
elem.parent().find(".h2").html(error);
elem.parent().find(".h3").html(error);
elem.parent().find(".h4").html(error); 
erForm = "";}
		return false;
});

});


 $(document).ready(function(){

  console.log(1);

  $(".credits .service ul li a").click(function(){


    $(this).parent().parent().find("li").removeClass("in");
    $(this).parent().parent().find("li").removeClass("active");


    $(this).parent().addClass("active");
    $(this).parent().addClass("in");


    $(this).parent().parent().parent().find(".bank-service").removeClass("active");
     $(this).parent().parent().parent().find(".bank-service").removeClass("in")

    // $(".tab-content.bank-service .tab-pane.bank-service").removeClass("active");
    //  $(".tab-content.bank-service .tab-pane.bank-service").removeClass("in");

    console.log($(this).attr("href"));

    $(".tab-content "+$(this).attr("href")).addClass("in");
    $(".tab-content "+$(this).attr("href")).addClass("active");


    // alert(1);

      return false;
  });

  $(".credits ul.nav.nav-tabs.bank li a").click(function(){

    $(".credits ul.nav.nav-tabs.bank li").removeClass("in");
    $(".credits ul.nav.nav-tabs.bank li").removeClass("active");

    $(this).parent().addClass("active");
    $(this).parent().addClass("in");

    $(".tab-content.bank .tab-pane.bank").removeClass("active");
     $(".tab-content.bank .tab-pane.bank").removeClass("in");

    console.log($(this).attr("href"));

    $(".tab-content.bank "+$(this).attr("href")).addClass("in");
    $(".tab-content.bank "+$(this).attr("href")).addClass("active");


    // alert(1);

      return false;
  });



 });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>
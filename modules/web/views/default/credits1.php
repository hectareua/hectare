<?php
use app\components\Url;
use app\models\Credit;
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

        <div class="delivery__title"><?=Yii::t('web', 'Кредитование')?></div>
        <h2><?=Yii::t('web', ' ')?></h2>

        <ul class="nav nav-tabs bank">
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
        <h3><?=$value['name'.$lang]; ?></h3>
        <p><?=$value['desk'.$lang]; ?></p>

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



</style>
<?php

$script = <<< JS
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
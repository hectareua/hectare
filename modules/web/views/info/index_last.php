<?php


use yii\helpers\Url;

$this->title = Yii::t('web', 'Гектар ИНФО');
$this->registerMetaTag(['name' => 'yandex', 'content' => 'noindex, follow']);
$this->registerCssFile("/css/info.css", ['depends' => ['app\assets\WebAsset']]);

if (Yii::$app->language == 'uk') {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->title . ' . Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.'], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->title . ' . Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.'], 'description');
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <p class="interview-header"><?= Yii::$app->language == 'uk' ? $tabsContent[0]->infoTabs->name_uk : $tabsContent[0]->infoTabs->name_ru?></p>
        </div>
    </div>
</div>
<div class="infblock">
    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs historymenu">
        <?php foreach ($tabs as $tab): ?>
            <div  class="historyitemtitle <?= $tab->id == $info_id ? 'active':'' ?>">
                <a href="<?=Url::to('@web/info/'.$tab->id)?>"><span><?= Yii::$app->language == 'uk' ? $tab->name_uk : $tab->name_ru?></span></a>
            </div>
        <?php endforeach;?>
    </div>
    <div class="hidden-lg hidden-md hidden-sm col-xs-12 historymenum">
        <select class="historymenuselect form-control" onchange="window.location.href=this.options[this.selectedIndex].value">
        <?php foreach ($tabs as $tab): ?>
            <option <?= $tab->id == $info_id ? 'selected':'' ?> value="<?=Url::to('@web/info/'.$tab->id)?>"><?= Yii::$app->language == 'uk' ? $tab->name_uk : $tab->name_ru?></option>
        <?php endforeach;?>
        </select>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 info-content">

        <div class="historyitemtext history__img_sep">

                <?php foreach ($numbers as $num):?>

                    <div class="row">

                        <h3 class="issue"><?=Yii::t('web', 'Выпуск')?> <?=$num->number?>.</h3>
                        <?php $count=0; foreach ($tabsContent as $tabContent):?>
                            <?php  if($tabContent->number == $num->number):?>

                                <div class="col-md-4 info-wrapper books">
                                    <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <span class="views-count"><?=$tabContent->views?></span></span>
                                        <a href="<?=Url::to('@web/info/view/'.$tabContent->id)?>" <?php if($info_id == 1) echo 'style=max-height:unset;'?> data-book-id="<?=$tabContent->id?>" data-id="<?=$tabContent->id?>" class="info-img thumbnail">
                                            <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                        </a>
                                    <div class="issue-info">
                                        <!--                                        <a href="#" data-book-id="--><?//=$tabContent->id?><!--" data-id="--><?//=$tabContent->id?><!--" class="--><?//= $tabContent->pdf_url ? 'thumbnail':''?><!--">-->
                                        <a href="<?=Url::to('@web/info/view/'.$tabContent->id)?>"><h4 class="issue-header"><?=Yii::$app->language == 'uk' ? $tabContent->header_uk: $tabContent->header_ru?></h4></a>
                                        <!--                                       </a> -->
                                        <p class="issue-desc"><?=Yii::$app->language == 'uk' ? $tabContent->desc_uk: $tabContent->desc_ru?></p>
                                        <p class="issue-author"><?=Yii::$app->language == 'uk' ? $tabContent->author_uk: $tabContent->author_ru?></p>
										<div class="fb-share-button" style="float: right" data-href="<?=Url::to('@web/info/view/'.$tabContent->id) ?>" data-layout="button" data-size="small" data-mobile-iframe="true">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++;?>
                                <?php if($count % 3 ===0):?>
                                    <div class="clearfix"></div>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>

                <?php endforeach;?>

        </div>
    </div>
</div>

<?php
    $this->registerJsFile("/js/info.js", ['depends' => ['app\assets\WebAsset']]);
	$lang = Yii::$app->language=='uk'?'uk_UA':'ru_RU';
    $this->registerJs("
    $(document).ready(function(){

            $('.dynamic_content').copyright({extratxt: 'Источник: %source%', sourcetxt: '".$_SERVER['HTTP_HOST']."'});
            $('.language_picker').change(function(){
                location = $(this).find(':selected').data('href');
            });
            
});

(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                 if (d.getElementById(id)) return;
                 js = d.createElement(s); js.id = id;
                 js.src = 'https://connect.facebook.net/".$lang."/sdk.js#xfbml=1&version=v3.2&autoLogAppEvents=1';
                 fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
    
");
?>
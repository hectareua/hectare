<?php


use yii\helpers\Url;

$language = Yii::$app->language == 'uk' ? 'uk':'ru';
$this->title = Yii::t('web', 'Гектар ИНФО | ').$tabsContent[0]->{header.'_'.$language};
$this->registerMetaTag(['name' => 'yandex', 'content' => 'noindex, follow']);
$this->registerCssFile("/css/info.css", ['depends' => ['app\assets\WebAsset']]);
$this->registerCssFile("/css/info-book/lightbox.css", ['depends' => ['app\assets\WebAsset']]);
$this->registerMetaTag(['name' => 'description', 'content' => $tabsContent[0]->{desc.'_'.$language}], 'description');

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
                <div  class="historyitemtitle <?= $tab->id == $tabsContent[0]->infoTabs->id ? 'active':'' ?>">
                    <a href="<?=Url::to('@web/info/'.$tab->id)?>"><span><?= Yii::$app->language == 'uk' ? $tab->name_uk : $tab->name_ru?></span></a>
                </div>
            <?php endforeach;?>
        </div>
        <div class="hidden-lg hidden-md hidden-sm col-xs-12 historymenum">
            <select class="historymenuselect form-control" onchange="window.location.href=this.options[this.selectedIndex].value">
                <?php foreach ($tabs as $tab): ?>
                    <option <?= $tab->id == $tabsContent[0]->infoTabs->id ? 'selected':'' ?> value="<?=Url::to('@web/info/'.$tab->id)?>"><?= Yii::$app->language == 'uk' ? $tab->name_uk : $tab->name_ru?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 info-content">

            <div class="historyitemtext history__img_sep">

                <?php
                foreach ($tabsContent as $tabContent) {
                    if ($tabContent->pdf_url) {
                        $books .= "
                     " . $tabContent->id . ": {
                     pdf: '" . Url::to('@web/' . $tabContent->pdf_url) . "',
                        propertiesCallback: function(props) {
                        props.page.depth /= 3;
                        return props;
                     },
                                            controlsProps: {
                                                scale:{
                                                   levels: 4,
                                                },
                                                
                                               actions:{
                                                cmdSinglePage:{
                                                    activeForMobile:true,
                                                },
                                                cmdZoomIn: {
                                                    type: 'dblclick',
                                                    code:0,
                                                },
                                                
                                               
                                                
                                              }
                                            },
                                            
                                            template: {
                                              html: '" . Url::to('@web/templates/default-book-view.html') . "',
                                              styles: [
                                                '" . Url::to('@web/css/info-book/black-book-view.css') . "'
                                              ],
                                              links: [{
                                                rel: 'stylesheet',
                                                href: '" . Url::to('@web/css/info-book/font-awesome.min.css') . "'
                                              }],
                                              script: '" . Url::to('@web/js/info-book/default-book-view.js') . "',
                                              sounds: {
                                                startFlip: 'sounds/start-flip.mp3',
                                                endFlip: 'sounds/end-flip.mp3'
                                              }
                                              },
                                              styleClb: styleClb
                                            },
                                    ";
                    }
                }
                ?>

                <?php foreach ($numbers as $num):?>

                    <div class="row one-issue">

                        <h3 class="issue"><?=Yii::t('web', 'Выпуск')?> <?=$num->number?>.</h3>
                        <?php $count=0; foreach ($tabsContent as $tabContent):?>
                            <?php  if($tabContent->number == $num->number):?>

                                <div class="info-wrapper books">
									<div class="share-block">
										<span class="views" style="display: inline-block;"><span class="glyphicon glyphicon-eye-open"></span> <span class="views-count"><?=$tabContent->views?></span></span>
										<div class="fb-share-button" style="float: right" data-href="<?=Url::canonical(true) ?>" data-layout="button" data-size="small" data-mobile-iframe="true">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                            </a>
                                        </div>
									</div>
                                    <?php if($tabContent->pdf_url):?>
                                        <a href="#" data-book-id="<?=$tabContent->id?>" data-id="<?=$tabContent->id?>" class="info-img thumbnail col-md-4">
                                            <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                        </a>
                                    <?php else: ?>
                                        <?php $i=1; foreach($tabContent->images as $image): ?>
                                            <p data-id="<?=$tabContent->id?>" class="info-img col-md-4" data-fancybox="gallery<?=$tabContent->id?>" rel="group<?=$tabContent->id?>">
                                                <?php if($i==1):?>
                                                    <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                                <?php endif;?>
                                            </p>

                                            <?php $i++; endforeach;?>
                                    <?php endif;?>
                                    <div class="issue-info">
                                        <!--                                        <a href="#" data-book-id="--><?//=$tabContent->id?><!--" data-id="--><?//=$tabContent->id?><!--" class="--><?//= $tabContent->pdf_url ? 'thumbnail':''?><!--">-->
                                        <h4 class="issue-header"><?=Yii::$app->language == 'uk' ? $tabContent->header_uk: $tabContent->header_ru?></h4>
                                        <!--                                       </a> -->
                                        <p class="issue-desc"><?=Yii::$app->language == 'uk' ? $tabContent->text_uk: $tabContent->text_ru?></p>
                                        <p class="issue-author"><?=Yii::$app->language == 'uk' ? $tabContent->author_uk: $tabContent->author_ru?></p>
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
	<div id="fb-root"></div>
<?php
$this->registerJsFile("/js/info.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/html2canvas.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/three.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/pdf.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/3dflipbook.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/lightbox.js", ['depends' => ['app\assets\WebAsset']]);
$lang = Yii::$app->language=='uk'?'uk_UA':'ru_RU';
$this->registerCss("

");

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
        js.src = 'https://connect.facebook.net/".$lang."/sdk.js#xfbml=1&version=v3.2';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.jQuery(function() {
        var $ = window.jQuery;
                   
        var styleClb = function() {
          $('.fb3d-modal').removeClass('light').addClass('dark');
        }, booksOptions = {
            ".$books."
        };

        var instance = {
          scene: undefined,
          options: undefined,
          node: $('.fb3d-modal .mount-container')
        };

        var modal = $('.fb3d-modal');
        modal.on('fb3d.modal.hide', function() {
          instance.scene.dispose();
        });
        modal.on('fb3d.modal.show', function() {
          instance.scene = instance.node.FlipBook(instance.options);
          instance.options.styleClb();
        });
        $('.books').find('.thumbnail').click(function(e) {
          var target = $(e.target);
          while(target[0] && !target.attr('data-book-id')) {
            target = $(target[0].parentNode);
          }
          if(target[0]) {
            instance.options = booksOptions[target.attr('data-book-id')];
            $('.fb3d-modal').fb3dModal('show');
          }
        });

      });
    
    ");
?>
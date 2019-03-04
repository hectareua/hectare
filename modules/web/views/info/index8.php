<?php


use yii\helpers\Url;

$this->title = Yii::t('web', 'Гектар ИНФО');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
$this->registerCssFile("/css/info.css", ['depends' => ['app\assets\WebAsset']]);
$this->registerCssFile("/css/info-book/lightbox.css", ['depends' => ['app\assets\WebAsset']]);
?>

<div class="hectare-info">
    <div class="hectare-info-header">
        <a href="/" class="main-page">
            <span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span> <?=Yii::t('web','На главную')?>
        </a>
        <select class="header-top-languagePicker language_picker">
            <option value="ru" <?= Yii::$app->language == 'ru' ? 'selected' : '' ?> data-href="<?= Url::current(['language' => 'ru']) ?>">Рус</option>
            <option value="uk" <?= Yii::$app->language == 'uk' ? 'selected' : '' ?> data-href="<?= Url::current(['language' => 'uk']) ?>">Укр</option>
        </select>
        <div class="contacts-social">
            <?php if ($this->context->siteInfo->yt_link): ?>
                <a href="<?= $this->context->siteInfo->yt_link ?>" class="contacts-social__item contacts-social__item_yt">
                    <i class="fa fa-youtube-square" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->vk_link): ?>
                <a href="<?= $this->context->siteInfo->vk_link ?>" class="contacts-social__item contacts-social__item_vk">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->fb_link): ?>
                <a href="<?= $this->context->siteInfo->fb_link ?>" class="contacts-social__item contacts-social__item_fb">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->ok_link): ?>
                <a href="<?= $this->context->siteInfo->ok_link ?>" class="contacts-social__item contacts-social__item_ok">
                    <i class="fa fa-odnoklassniki-square" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php if ($this->context->siteInfo->gp_link): ?>
                <a href="<?= $this->context->siteInfo->gp_link ?>" class="contacts-social__item contacts-social__item_gp">
                    <i class="fa fa-google-plus-official " aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <p class="interview-header"><?= Yii::$app->language == 'uk' ? $tabs[0]->name_uk : $tabs[0]->name_ru?></p>
        </div>
    </div>
</div>
<div class="infblock">
    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs historymenu">
        <?php foreach ($tabs as $tab): ?>
            <div data-id="<?= $tab->id ?>" class="historyitemtitle <?= $tab->id == 1 ? 'active':'' ?>">
                <span><?= Yii::$app->language == 'uk' ? $tab->name_uk : $tab->name_ru?></span>
            </div>
        <?php endforeach;?>
    </div>
    <div class="hidden-lg hidden-md hidden-sm col-xs-12 historymenum">
        <select class="historymenuselect form-control">
        <?php foreach ($tabs as $tab): ?>
            <option <?= $tab->id == 1 ? 'selected':'' ?> value="<?= $tab->id ?>"><?= Yii::$app->language == 'uk' ? $tab->name_uk : $tab->name_ru?></option>
        <?php endforeach;?>
        </select>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 info-content">
        <?php $books = ''; foreach ($tabs as $tab):?>
        <div data-id="<?=$tab->id?>" class="historyitemtext history__img_sep <?= $tab->id==1 ? 'active':'hidden'?>">

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

            <?php if($tab->id == 1):?>
                <?php foreach ($numbers as $num):?>

                    <div class="row">

                        <h3 class="issue"><?=Yii::t('web', 'Выпуск')?> <?=$num->number?>.</h3>
                        <?php $count=0; foreach ($tabsContent as $tabContent):?>
                            <?php  if($tabContent->number == $num->number && $tabContent->info_tabs_id == $tab->id):?>

                                <div class="col-md-4 info-wrapper books">
                                    <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <span class="views-count"><?=$tabContent->views?></span></span>
                                    <?php if($tabContent->pdf_url):?>
                                        <a href="#" data-book-id="<?=$tabContent->id?>" data-id="<?=$tabContent->id?>" class="info-img thumbnail">
                                            <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                        </a>
                                    <?php else: ?>
                                        <?php $i=1; foreach($tabContent->images as $image): ?>
                                            <a data-id="<?=$tabContent->id?>" class="info-img" data-fancybox="gallery<?=$tabContent->id?>" href="<?=$image->url?>" rel="group<?=$tabContent->id?>">
                                                <?php if($i==1):?>
                                                    <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                                <?php endif;?>
                                            </a>

                                            <?php $i++; endforeach;?>
                                    <?php endif;?>
                                    <div class="issue-info">
                                        <!--                                        <a href="#" data-book-id="--><?//=$tabContent->id?><!--" data-id="--><?//=$tabContent->id?><!--" class="--><?//= $tabContent->pdf_url ? 'thumbnail':''?><!--">-->
                                        <h4 class="issue-header"><?=Yii::$app->language == 'uk' ? $tabContent->header_uk: $tabContent->header_ru?></h4>
                                        <!--                                       </a> -->
                                        <p class="issue-desc"><?=Yii::$app->language == 'uk' ? $tabContent->desc_uk: $tabContent->desc_ru?></p>
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
            <?php endif;?>


            <?php if($tab->id == 2):?>
                <?php foreach ($numbers as $num):?>

                    <div class="row">
                        <h3 class="issue"><?=Yii::t('web', 'Выпуск')?> <?=$num->number?>.</h3>
                        <?php $count=0; foreach ($tabsContent as $tabContent):?>
                            <?php  if($tabContent->number == $num->number && $tabContent->info_tabs_id == $tab->id):?>


                                <div class="col-md-4 info-wrapper books">
                                    <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <span class="views-count"><?=$tabContent->views?></span></span>
                                    <?php if($tabContent->pdf_url):?>
                                        <a href="#" data-book-id="<?=$tabContent->id?>" data-id="<?=$tabContent->id?>" class="info-img thumbnail">
                                            <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                        </a>
                                    <?php else: ?>
                                        <?php $i=1; foreach($tabContent->images as $image): ?>
                                        <a data-id="<?=$tabContent->id?>" class="info-img" data-fancybox="gallery<?=$tabContent->id?>" href="<?=$image->url?>" rel="group<?=$tabContent->id?>">
                                            <?php if($i==1):?>
                                                <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                            <?php endif;?>
                                        </a>

                                        <?php $i++; endforeach;?>
                                    <?php endif;?>
                                    <div class="issue-info">
<!--                                        <a href="#" data-book-id="--><?//=$tabContent->id?><!--" data-id="--><?//=$tabContent->id?><!--" class="--><?//= $tabContent->pdf_url ? 'thumbnail':''?><!--">-->
                                    <h4 class="issue-header"><?=Yii::$app->language == 'uk' ? $tabContent->header_uk: $tabContent->header_ru?></h4>
<!--                                       </a> -->
                                        <p class="issue-desc"><?=Yii::$app->language == 'uk' ? $tabContent->desc_uk: $tabContent->desc_ru?></p>
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
            <?php endif;?>

            <?php if($tab->id == 3):?>
                <?php foreach ($numbers as $num):?>

                    <div class="row">
                        <h3 class="issue"><?=Yii::t('web', 'Выпуск')?> <?=$num->number?>.</h3>
                        <?php $count=0; foreach ($tabsContent as $tabContent):?>
                            <?php  if($tabContent->number == $num->number && $tabContent->info_tabs_id == $tab->id):?>

                                <div class="col-md-4 info-wrapper books">
                                    <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <span class="views-count"><?=$tabContent->views?></span></span>
                                    <?php if($tabContent->pdf_url):?>
                                        <a href="#" data-book-id="<?=$tabContent->id?>" data-id="<?=$tabContent->id?>" class="info-img thumbnail">
                                            <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                        </a>
                                    <?php else: ?>
                                        <?php $i=1; foreach($tabContent->images as $image): ?>
                                            <a data-id="<?=$tabContent->id?>" class="info-img" data-fancybox="gallery<?=$tabContent->id?>" href="<?=$image->url?>" rel="group<?=$tabContent->id?>">
                                                <?php if($i==1):?>
                                                    <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                                <?php endif;?>
                                            </a>

                                            <?php $i++; endforeach;?>
                                    <?php endif;?>
                                    <div class="issue-info">
                                        <!--                                        <a href="#" data-book-id="--><?//=$tabContent->id?><!--" data-id="--><?//=$tabContent->id?><!--" class="--><?//= $tabContent->pdf_url ? 'thumbnail':''?><!--">-->
                                        <h4 class="issue-header"><?=Yii::$app->language == 'uk' ? $tabContent->header_uk: $tabContent->header_ru?></h4>
                                        <!--                                       </a> -->
                                        <p class="issue-desc"><?=Yii::$app->language == 'uk' ? $tabContent->desc_uk: $tabContent->desc_ru?></p>
                                        <p class="issue-author"><?=Yii::$app->language == 'uk' ? $tabContent->author_uk: $tabContent->author_ru?></p>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <?php $count++;?>
                    <?php if($count % 3 ===0):?>
                        <div class="clearfix"></div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>

            <?php if($tab->id == 4):?>
                <?php foreach ($numbers as $num):?>

                    <div class="row">

                        <h3 class="issue"><?=Yii::t('web', 'Выпуск')?> <?php echo $num->number; $last=$num->number?>.</h3>

                        <?php $count=0; foreach ($tabsContent as $tabContent):?>
                            <?php  if($tabContent->number == $num->number && $tabContent->info_tabs_id == $tab->id):?>

                                <div class="col-md-4 info-wrapper books">
                                    <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <span class="views-count"><?=$tabContent->views?></span></span>
                                    <?php if($tabContent->pdf_url):?>
                                        <a href="#" data-book-id="<?=$tabContent->id?>" data-id="<?=$tabContent->id?>" class="info-img thumbnail">
                                            <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                        </a>
                                    <?php else: ?>
                                        <?php $i=1; foreach($tabContent->images as $image): ?>
                                            <a data-id="<?=$tabContent->id?>" class="info-img" data-fancybox="gallery<?=$tabContent->id?>" href="<?=$image->url?>" rel="group<?=$tabContent->id?>">
                                                <?php if($i==1):?>
                                                    <img src="<?=$tabContent->image->url?>" alt="Фото випуску" />
                                                <?php endif;?>
                                            </a>

                                            <?php $i++; endforeach;?>
                                    <?php endif;?>
                                    <div class="issue-info">
                                        <!--                                        <a href="#" data-book-id="--><?//=$tabContent->id?><!--" data-id="--><?//=$tabContent->id?><!--" class="--><?//= $tabContent->pdf_url ? 'thumbnail':''?><!--">-->
                                        <h4 class="issue-header"><?=Yii::$app->language == 'uk' ? $tabContent->header_uk: $tabContent->header_ru?></h4>
                                        <!--                                       </a> -->
                                        <p class="issue-desc"><?=Yii::$app->language == 'uk' ? $tabContent->desc_uk: $tabContent->desc_ru?></p>
                                        <p class="issue-author"><?=Yii::$app->language == 'uk' ? $tabContent->author_uk: $tabContent->author_ru?></p>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <?php $count++;?>
                    <?php if($count % 3 ===0):?>
                        <div class="clearfix"></div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>

        </div>
        <?php endforeach;?>
    </div>
</div>
<footer class="footer">
    <div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Copyright © <?= date('Y') ?> <?= Yii::t('web', '«Гектар» является зарегистрированной торговой маркой. Все права защищены.') ?></div>
</footer>
<?php
    $this->registerJsFile("/js/info.js", ['depends' => ['app\assets\WebAsset']]);
    $this->registerJsFile("/js/info-book/html2canvas.min.js", ['depends' => ['app\assets\WebAsset']]);
    $this->registerJsFile("/js/info-book/three.min.js", ['depends' => ['app\assets\WebAsset']]);
    $this->registerJsFile("/js/info-book/pdf.min.js", ['depends' => ['app\assets\WebAsset']]);
    $this->registerJsFile("/js/info-book/3dflipbook.js", ['depends' => ['app\assets\WebAsset']]);
    $this->registerJsFile("/js/info-book/lightbox.js", ['depends' => ['app\assets\WebAsset']]);


    $this->registerJs("
    $(document).ready(function(){

            $('.dynamic_content').copyright({extratxt: 'Источник: %source%', sourcetxt: '".$_SERVER['HTTP_HOST']."'});
            $('.language_picker').change(function(){
                location = $(this).find(':selected').data('href');
            });
            
});

    

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
<?php


use yii\helpers\Url;
$language = Yii::$app->language == 'uk' ? 'uk':'ru';
$this->title = Yii::t('web', 'Гектар ИНФО | ').$tabsContent->{header.'_'.$language};
//$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);

$this->registerMetaTag(['name' => 'description', 'content' => $tabsContent->{desc.'_'.$language}], 'description');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'article']);
$this->registerMetaTag(['property' => 'og:title', 'content' => Yii::t('web', 'Гектар ИНФО | ').$tabsContent->{header.'_'.$language}]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $tabsContent->desc_uk]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::base(true).Url::current()]);
$this->registerMetaTag(['property' => 'og:image', 'content' => $tabsContent->image->url]);
$this->registerCssFile("/css/info-book/lightbox.css", ['depends' => ['app\assets\WebAsset']]);
?>

<?php
    if ($tabsContent->pdf_url) {
        $books = "
                     " . $tabsContent->id . ": {
                     pdf: '" . Url::to('@web/' . $tabsContent->pdf_url) . "',
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
                                              
                                              },
                                              styleClb: styleClb
                                            },
                                    ";
}
?>

<div class="video-inside_page big_video">
    <?php if($tabsContent->pdf_url):?>
        <div class="container text-center">
            <button data-book-id="<?=$tabsContent->id?>" data-id="<?=$tabsContent->id?>" class="btn btn-success books" style="font-family: GothamProBold; background-color: #212121;">Версія у вигляді журналу</button>
            <a href="<?=Url::to('@web/' . $tabsContent->pdf_url)?>" target="_blank" class="btn btn-success" style="background-color: #212121;">Переглянути просту версію</a>
        </div>
    <?php endif;?>
    <section class="top_news_small">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="news_box">
                        <div class="b_photo">
                            <?php if(!$tabsContent->video):?>
                            <img alt="img" src="<?=$tabsContent->image->url?>">
                            <?php else:?>
                            <?=$tabsContent->video?>
                            <?php endif;?>
                        </div>
                        <h1 class="news_title"><?=$tabsContent->header_uk?></h1>
                        <span class="date"><?=date('d.m.Y', strtotime($tabsContent->publishing_date))?></span>
                        <span class="author"><?=$tabsContent->author_uk?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section>
    <section class="bgwhite">
        <div class="container">
            <div class="row">
                <ul class="list soc_list soc_list_black">
                    <li class="facebook social-share" id="facebook">
                        <a class="pointer"></a>
                    </li>
                    <li class="google social-share" id="google">
                        <a class="pointer"></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="bgwhite single-page-content">
        <article class="article">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <?=$tabsContent->text_uk?>
                    </div>
                </div>
            </div>
        </article>
        <div style="display:none"><?=$tabsContent->author_uk?></div>
    </section>



    <div class="mobileMenu-bg"></div>
</section>

<progress class="readingProgressbar" data-height="5" data-position="bottom" data-custom-position="" data-foreground="#ffcc00" data-background="#0a0000" value="0" max="14722" style="background-color: rgb(10, 0, 0); color: rgb(255, 204, 0); height: 5px; top: auto; bottom: 0px; position: fixed; display: block;"></progress>
<?php
$this->registerJsFile("/js/info-book/html2canvas.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/three.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/pdf.min.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/3dflipbook.js", ['depends' => ['app\assets\WebAsset']]);
$this->registerJsFile("/js/info-book/lightbox.js", ['depends' => ['app\assets\WebAsset']]);
if ($tabsContent->pdf_url) {
    $this->registerJs("

    window.jQuery(function() {
        var $ = window.jQuery;
                   
        var styleClb = function() {
          $('.fb3d-modal').removeClass('light').addClass('dark');
        }, booksOptions = {
            " . $books . "
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
        $('.books').click(function(e) {
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
}
?>
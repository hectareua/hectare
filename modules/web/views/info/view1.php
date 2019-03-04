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

?>
<div class="video-inside_page big_video">
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
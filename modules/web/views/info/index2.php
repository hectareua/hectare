<?php


use \app\components\Url;

$this->title = Yii::t('web', 'Гектар ИНФО');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
//$this->registerCssFile("/css/info.css", ['depends' => ['app\assets\WebAsset']]);

if (Yii::$app->language == 'uk') {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->title . ' . Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.'], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->title . ' . Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.'], 'description');
}
?>

    <?php if($slides):?>
    <section>
        <div class="advanced-slider big people-slider glossy-square-gray webkit" style="">

            <ul class="slides">
                <?php foreach ($slides as $slide):?>
                <li class="slide" style="">
                    <i class="bg"></i>
                    <img class="image" src="<?=$slide->image->url?>" alt="" style="">
                    <div class="layer black" data-horizontal="0" data-position="bottomLeft" data-vertical="0" data-transition="up" data-delay="200" style="left: 158px; bottom: 0px; opacity: 1;">
                        <div class="people-name"><a href="<?=$slide->link_uk?>"><?=$slide->title_uk?></a></div>
                        <div class="people-desc"><?=$slide->desc_uk?></div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </section>
    <?php endif;?>
    <?php if($issues):?>
    <section class="section-white fourCol">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($issues[0]->infoTabs)?>">Випуски</a></h2>
                    <!--<div class="list_filter">
                        <a class="active">нові</a>
                        <a href="#">популярні</a>
                        <a href="#">усі</a>
                    </div>-->
                </div>
            </div>
            <div class="row">
                <?php foreach ($issues as $issue):?>
                <div class="col-3">
                    <div class="news_box">
                        <a class="b_photo" href="<?=Url::toInfoView($issue)?>">
                            <img src="<?=$issue->image->url?>" class="attachment-thumb-interview size-thumb-interview wp-post-image" alt="">                        <i class="bg"></i>
                            <div class="text_tip">
                                <span class="views_icon"><?=$issue->views?></span>
                                <span class="time_icon"><?=date('d.m.Y',strtotime($issue->publishing_date))?></span>
                            </div>
                        </a>
                        <h2 class="news_title"><a href="<?=Url::toInfoView($issue)?>"><?=$issue->header_uk?></a></h2>
                        <div class="news_desc"><p><?=$issue->desc_uk?></p>
                        </div>
                        <span class="author"><?=$issue->author_uk?></span>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <?php endif;?>
    <?php if($advertising[0]->text_uk):?>
        <section class="subscribe" style="">
            <div class="subscribe_title"><?=$advertising[0]->text_uk?></div>
        </section>
    <?php endif;?>
    <?php if($interviews):?>
    <section class="section-white fourCol">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($interviews[0]->infoTabs)?>">Інтерв’ю</a></h2>
                    <!--<div class="list_filter">
                        <a class="active">нові</a>
                        <a href="#">популярні</a>
                        <a href="#">усі</a>
                    </div>-->
                </div>
            </div>
            <div class="row">
                <?php foreach ($interviews as $interview):?>
                <div class="col-3">
                    <div class="news_box">
                        <a class="b_photo" href="<?=Url::toInfoView($interview)?>">
                            <img src="<?=$interview->image->url?>" class="attachment-thumb-interview size-thumb-interview wp-post-image" alt="">                        <i class="bg"></i>
                            <div class="text_tip">
                                <span class="views_icon"><?=$interview->views?></span>
<!--                                <span class="time_icon">5</span>-->
                            </div>
                        </a>
                        <h2 class="news_title"><a href="<?=Url::toInfoView($interview)?>"><?=$interview->header_uk?></a></h2>
                        <div class="news_desc"><p><?=$interview->desc_uk?></p>
                        </div>
                        <span class="author"><?=$interview->author_uk?></span>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <?php endif;?>

    <?php if($reportages):?>
    <section class="section-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($reportages[0]->infoTabs)?>">Репортажі</a></h2>
                    <!--<div class="list_filter">
                        <a class="active">нові</a>
                        <a href="#">популярні</a>
                        <a href="#">усі</a>
                    </div>-->
                </div>
            </div>
            <div class="big_padding inline_news_list">
                <div class="row">
                    <?php foreach ($reportages as $reportage):?>
                    <div class="col-4">
                        <div class="news_box">
                            <a class="b_photo" href="<?=Url::toInfoView($reportage)?>">
                                <img src="<?=$reportage->image->url?>" class="attachment-thumb-reportages size-thumb-reportages wp-post-image" alt="">                        <i class="bg"></i>
                                <div class="text_tip">
                                    <span class="views_icon"><?=$reportage->views?></span>
<!--                                    <span class="time_icon">5</span>-->
                                </div>
                            </a>
                            <h2 class="news_title"><a href="<?=Url::toInfoView($reportage)?>"><?=$reportage->header_uk?></a></h2>
                            <div class="news_desc"><p><?=$reportage->desc_uk?></p>
                            </div>
                            <span class="date"><?=date('d.m.Y',strtotime($reportage->publishing_date))?></span>
                            <span class="author"><?=$reportage->author_uk?></span>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;?>
    <?php if($articles):?>
    <section class="section-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($articles[0]->infoTabs)?>">Статті</a></h2>
                    <!--<div class="list_filter">
                        <a class="active">нові</a>
                        <a href="#">популярні</a>
                        <a href="#">усі</a>
                    </div>-->
                </div>
            </div>
            <div class="big_padding inline_news_list">
                <div class="row">
                    <?php foreach ($articles as $article):?>
                        <div class="col-4">
                            <div class="news_box">
                                <a class="b_photo" href="<?=Url::toInfoView($article)?>">
                                    <img src="<?=$article->image->url?>" class="attachment-thumb-reportages size-thumb-reportages wp-post-image" alt="">                        <i class="bg"></i>
                                    <div class="text_tip">
                                        <span class="views_icon"><?=$article->views?></span>
<!--                                        <span class="time_icon">5</span>-->
                                    </div>
                                </a>
                                <h2 class="news_title"><a href="<?=Url::toInfoView($article)?>"><?=$article->header_uk?></a></h2>
                                <div class="news_desc"><p><?=$article->desc_uk?></p>
                                </div>
                                <span class="date"><?=date('d.m.Y',strtotime($article->publishing_date))?></span>
                                <span class="author"><?=$article->author_uk?></span>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;?>
    <?php if($advertising[1]->text_uk):?>
    <section class="banner">
        <div class="fullScreenBackground" style="background-color: #cc66cc;">
            <div class="container">
                <?= $advertising[1]->text_uk?>
            </div>
        </div>
    </section>
    <?php endif;?>
    <?php if($specialProjects):?>
    <section class="section-white no_p">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($specialProjects[0]->infoTabs)?>">Спецпроекти</a></h2>
                </div>
            </div>
            <div class="video_block">
                <div class="row">
                    <div class="col-8">
                        <div class="news_box">
                            <a class="b_photo video-img" href="<?=Url::toInfoView($specialProjects[0])?>">
                                <img alt="img" src="<?=$specialProjects[0]->image->url?>">
                                <i class="bg"></i>
                                <i class="play_icon big"></i>
                                <div class="text_tip">
                                    <span class="author"><?=$specialProjects[0]->author_uk?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php array_shift($specialProjects)?>
                    <div class="col-4">
                        <div class="row">
                            <?php foreach ($specialProjects as $specialProject):?>
                            <div class="col-12">
                                <div class="news_box">
                                    <a class="b_photo video-img-small" href="<?=Url::toInfoView($specialProject)?>">
                                        <img alt="img" src="<?=$specialProject->image->url?>">
                                        <i class="bg"></i>
                                        <i class="play_icon"></i>
                                        <div class="text_tip">
                                            <span class="author"><?=$specialProject->author_uk?></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif;?>

    <?php if($about):?>
    <section class="section-white fourCol">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($about[0]->infoTabs)?>">Про нас</a></h2>
                </div>
            </div>
            <div class="tenQuestions">
                <div class="row">
                    <?php foreach ($about as $item):?>
                    <div class="col-3">
                        <div class="news_box best">
                            <a class="b_photo" href="<?=Url::toInfoView($item)?>" style="background-image: url('<?=$item->image->url?>')">
                                <i class="bg"></i>
                                <div class="text_tip">
                                    <h2 class="news_title"><?=$item->header_uk?></h2>
                                    <div class="news_desc"><p><?=$item->desc_uk?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;?>


    <?php if($blog):?>
    <section class="section-white no_p_b fourCol">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><a class="block-title" href="<?=Url::toInfo($blog[0]->infoTabs)?>">Блог</a></h2>
                </div>
            </div>
            <div class="row">
                <?php foreach ($blog as $item):?>
                <div class="col-3">
                    <div class="news_box columns_box">
                        <a class="b_photo" href="<?=Url::toInfoView($item)?>">
                            <img src="<?=$item->image->url?>" class="attachment-thumb-columns size-thumb-columns wp-post-image" alt="">                        <i class="bg" style="background-color: "></i>
                            <div class="columns_box_top">
                                <div class="columns_box_author"><?=$item->author_uk?></div>
                                <div class="columns_box_author_role"></div>
                            </div>
                            <div class="text_tip">
                                <h2 class="news_title"><?= $item->header_uk?></h2>
                                <div class="news_desc"><p><?=$item->desc_uk?></p>
                                </div>
                                <span class="date"><?=date('d.m.Y', strtotime($item->publishing_date))?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <?php endif;?>

    <?php if($advertising[1]->text_uk):?>
    <section class="banner">
        <div class="fullScreenBackground" style="background-color: #ffcc00;">
            <div class="container">
                <?= $advertising[2]->text_uk?>
            </div>
        </div>
    </section>
    <?php endif;?>

    <section class="banner crowd-donate">
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="advanced-slider shop-slider">
                        <ul class="slides">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
  //  $this->registerJsFile("/js/info.js", ['depends' => ['app\assets\WebAsset']]);
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
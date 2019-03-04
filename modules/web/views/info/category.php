<?php
/**
 * Created by PhpStorm.
 * User: royk09
 * Date: 10.12.2018
 * Time: 0:31
 */

use \app\components\Url;

$this->title = Yii::t('web', 'Гектар ИНФО').' | '.$category->name_uk;
//$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
//$this->registerCssFile("/css/info.css", ['depends' => ['app\assets\WebAsset']]);

if (Yii::$app->language == 'uk') {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->title . ' . Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.'], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => $this->title . ' . Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.'], 'description');
}
?>

<div class="interview_page rubric_page">
    <section id="rubric_list" class="section-white fourCol rubric_list"
             style="background-image: url('<?=$tabsContent[0]->infoTabs->image->url?>');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="block-title"><?=$category->name_uk?></h2>
                </div>
            </div>
            <?php if($tabsContent):?>
            <div id="ajax-load-more" class="ajax-load-more-wrap infinite fading-blocks alm-0" data-id="0" data-canonical-url="" data-slug="">
                <div class="alm-listing alm-ajax">
                    <div class="alm-reveal" style="">
                        <?php foreach ($tabsContent as $item):?>
                        <div class="col-3 tall">
                            <div class="news_box">
                                <a class="b_photo" href="<?=Url::toInfoView($item)?>">
                                    <img src="<?=$item->imageTwo->url?$item->imageTwo->url:$item->image->url?>"
                                         class="attachment-thumb-interview size-thumb-interview wp-post-image" alt=""><i class="bg"></i>
                                    <div class="text_tip">
                                        <span class="views_icon"><?=$item->views?></span>
                                        <span class="time_icon"><?=date('d.m.Y', strtotime($item->publishing_date))?></span>
                                    </div>
                                </a>
                                <div class="b_text">
                                    <h2 class="news_title"><a href="<?=Url::toInfoView($item)?>"><?=$item->header_uk?></a></h2>
                                    <div class="news_desc">
                                        <?=$item->desc_uk?>
                                    </div>
                                    <span class="author"><?=$item->author_uk?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </section>
</div>
</div>
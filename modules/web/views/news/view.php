<?php
use app\components\Url;
if ($model->seoTitle) {
    $this->title = $model->seoTitle;
} else {
    $this->title = Yii::t('web', 'news-seo-meta-template-title', ['name' => $model->title]);
}
if ($model->seoDescription) {
    $this->registerMetaTag(['name' => 'description', 'content' => $model->seoDescription], 'description');
} else {
    $this->registerMetaTag(['name' => 'description', 'content' => Yii::t('web', 'news-seo-meta-template-description', ['name' => $model->title])], 'description');
}
if ($model->seoKeywords) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $model->seoKeywords], 'keywords');
} else {
    $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::t('web', 'news-seo-meta-template-keywords', ['name' => $model->title])], 'keywords');
}
?>
<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>

        <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><a itemprop="item" href="<?=Url::to(['news/index'])?>"><span itemprop="name"><?=Yii::t('web', 'Новости')?></span> </a><meta itemprop="position" content="2" /></li>


<!--        <li itemprop="itemListElement" itemscope-->
<!--         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name">--><!--</span><meta itemprop="position" content="3" /></li>-->
    </ol>
    <h1><?= $this->params['seoH1'] ?: $model->title ?></h1>
    <div class="dynamic_content"><?=$this->params['seoText'] ?: $model->text?></div>
   
    <?php 
		if ($_GET['news_id']==82)
		{ 
	?>
			<div class="newvideo">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/5CqJNMMiWoc" frameborder="0" allowfullscreen></iframe>
			</div>
		<?php  }
    ?>
    <?php 
		if ($_GET['news_id']==83)
		{ 
	?>
			<div class="newvideo">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/ii_68CYJRPM" frameborder="0" allowfullscreen></iframe>
			</div>
		<?php  }
    ?>
    <?php 
		if ($_GET['news_id']==84)
		{ 
	?>
			<div class="newvideo">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/amZrF3lD0EE" frameborder="0" allowfullscreen></iframe>
			</div>
		<?php  }
    ?>
</div>

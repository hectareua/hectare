<?php
use yii\helpers\Html;
use app\components\Url as CUrl;
use yii\helpers\Url;

/* @var $pages array */
/* @var $news array */
/* @var $articles array */
/* @var $manufacturers array */
/* @var $categories array */

$this->title = Yii::t('web', 'Карта сайта');
$this->registerCss('
.sitemap ul ul{
    margin-left: 25px;
}
');
?>
<div class="wrapper sitemap">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <li itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
    </ol>
    <h1 style="font-size:2rem;"><?=$this->params['seoH1'] ?: Yii::t('web', 'Карта сайта')?></h1>
    <nav class="wSitemap">
        <ul>
        <?php if (count($pages)): ?>
            <?php foreach ($pages as $page): ?>
                <li><?= Html::a($page['title'], $page['url']); ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (count($news)): ?>
            <li>
                <?php $n = array_shift($news); ?>
                <?= Html::a($n['title'], $n['url']); ?>
                <?php if (count($news)): ?>
                    <ul>
                        <?php foreach ($news as $n): ?>
                            <li><?= Html::a($n['title'], $n['url']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>
        <?php if (count($articles)): ?>
            <li>
                <?php $article = array_shift($articles); ?>
                <?= Html::a($article['title'], $article['url']); ?>
                <?php if (count($articles)): ?>
                    <ul>
                        <?php foreach ($articles as $article): ?>
                            <li><?= Html::a($article['title'], $article['url']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>
        <?php if (count($manufacturers)): ?>
            <li>
                <?php $manufacturer = array_shift($manufacturers); ?>
                <?= Html::a($manufacturer['title'], $manufacturer['url']); ?>
                <?php if (count($manufacturers)): ?>
                    <ul>
                        <?php foreach ($manufacturers as $manufacturer): ?>
                            <li><?= Html::a($manufacturer['title'], $manufacturer['url']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>
        <?php if (count($categories)): ?>
            <li>
                <?php $category = array_shift($categories); ?>
                <?= Html::a($category['title'], $category['url']); ?>
                <ul>
                    <?php foreach ($this->params['parentCategories'] as $parentCategory) : ?>
                        <?php /* @var $parentCategory \app\models\Category */ ?>
                        <li>
                            <?= Html::a($parentCategory->name, CUrl::toCategory($parentCategory)); ?>
                            <?php if ($parentCategory->categories != null) : ?>
                                <ul>
                                    <?php foreach ($parentCategory->categories as $subCategory) : ?>
                                        <?php if (count($subCategory->categories) > 0 || count($subCategory->products) > 0) : ?>
                                            <li><?= Html::a($subCategory->name, CUrl::toCategory($subCategory)); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
    </nav>
</div>
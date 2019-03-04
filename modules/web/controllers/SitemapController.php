<?php

namespace app\modules\web\controllers;

use app\models\Article;
use Yii;
use yii\helpers\Url;
use app\models\Category;
use app\models\Product;
use app\models\Manufacturer;
use app\models\News;
use app\models\Page;
use app\models\SiteInfo;

class SitemapController extends Controller
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';


    public function beforeAction($action)
    {

        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')
            ->orderBy(['order' => SORT_ASC])
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;

        return parent::beforeAction($action);
    }

    public function actionHtml()
    {
        $pages = [
            [
                'url' => Url::to(['/web/default/index'], true),
                'title' => Yii::t('web', 'Главная'),
            ],[
                'url' => Url::to(['/web/default/about'], true),
                'title' => Yii::t('web', 'О компании'),
            ],[
                'url' => Url::to(['/web/default/contact'], true),
                'title' => Yii::t('web', 'Контакты'),
            ],[
                'url' => Url::to(['/web/default/delivery'], true),
                'title' => Yii::t('web', 'Доставка'),
            ],[
                'url' => Url::to(['/web/reviews/index'], true),
                'title' => Yii::t('web', 'Отзывы'),
            ],[
                'url' => Url::to(['/web/default/partners'], true),
                'title' => Yii::t('web', 'Партнеры'),
            ],[
                'url' => Url::to(['/web/user/index'], true),
                'title' => Yii::t('web', 'Личный кабинет'),
            ]
        ];

        $news = [[
            'url' => Url::to(['/web/news/index'], true),
            'title' => Yii::t('web', 'Новости'),
        ]];

        /* @var $newsList News[] */
        $newsList = News::findPublishedNews()->orderBy('publishing_since DESC')->all();
        foreach ($newsList as $n) {
            $news[] = [
                'url' => Url::to(['/web/news/view', 'news_id' => $n->slug?:$n->id], true),
                'title' => $n->{'title_'.Yii::$app->language},
            ];
        }

        $articles = [[
            'url' => Url::to(['/web/articles/index'], true),
            'title' => Yii::t('web', 'Статьи'),
        ]];

        /* @var $articlesList Article[] */
        $articlesList = Article::findPublishedArticles()->orderBy('publishing_since DESC')->all();
        foreach ($articlesList as $article) {
            $articles[] = [
                'url' => Url::to(['/web/articles/view', 'article_id' => $article->slug?:$article->id], true),
                'title' => $article->{'title_'.Yii::$app->language},
            ];
        }

        $manufacturers = [];
        //$manufacturers = [[
        //    'url' => Url::to(['/web/categories/brands'], true),
        //    'title' => Yii::t('web', 'Производители'),
        //]];

        ///* @var $manufacturersList Manufacturer[] */
        //$manufacturersList = Manufacturer::find()->orderBy('name')->all();
        //foreach ($manufacturersList as $manufacturer) {
        //    $manufacturers[] = [
        //        'url' => Url::to(['/web/categories/brand', 'brand_id' => $manufacturer->slug?:$manufacturer->id], true),
        //        'title' => $manufacturer->name,
        //    ];
        //}

        $categories = [
            'root' => [
                'url' => Url::to(['/web/categories/index'], true),
                'title' => Yii::t('web', 'Каталог товаров'),
            ],
        ];

        return $this->render('html', compact('pages', 'news', 'articles', 'manufacturers', 'categories'));

    }

    public function actionXml()
    {
        header("Content-type: text/xml");

        $its = [];
        $items = [];

        $itemsp = [];
        $its = Article::findPublishedArticles()
            ->asArray()
            ->all();

        foreach ($its as $p) {
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . Url::to(['/web/articles/view', 'article_id' => $p['slug']?:$p['id']]);
            $itemsp['models'][] = $p;
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/ru' . Url::to(['/web/articles/view', 'article_id' => $p['slug']?:$p['id']]);;
            $itemsp['models'][] = $p;
        }
        $itemsp['changefreq'] = self::MONTHLY;
        $itemsp['priority'] = 0.5;

        $items = array_merge($items, [$itemsp]);

//-------------------------------------------------------
        $itemsp = [];
        $its = News::findPublishedNews()
            ->asArray()
            ->all();

        foreach ($its as $p) {
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . Url::to(['/web/news/view', 'news_id' => $p['slug']?:$p['id']]);
            $itemsp['models'][] = $p;
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/ru' . Url::to(['/web/news/view', 'news_id' => $p['slug']?:$p['id']]);;
            $itemsp['models'][] = $p;
        }
        $itemsp['changefreq'] = self::MONTHLY;
        $itemsp['priority'] = 0.5;

        $items = array_merge($items, [$itemsp]);
//-------------------------------------------------------
//        $itemsp = [];
//        $its = Manufacturer::find()
//            ->asArray()
//            ->all();
//
//        foreach ($its as $p) {
//            $p['url'] = 'http://' . $_SERVER['HTTP_HOST'] . Url::to(['/web/categories/brand', 'brand_id' => $p['slug']?:$p['id']]);
//            $itemsp['models'][] = $p;
//            $p['url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/ru' . Url::to(['/web/categories/brand', 'brand_id' => $p['slug']?:$p['id']]);
//            $itemsp['models'][] = $p;
//        }
//        $itemsp['changefreq'] = self::MONTHLY;
//        $itemsp['priority'] = 0.5;
//
//        $items = array_merge($items, [$itemsp]);
//-------------------------------------------------------
        $itemsp = [];
        $its = Category::find()
            ->asArray()
            ->all();

        foreach ($its as $p) {
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/internet-magazin/' . (($p['slug']) ? ($p['slug']) : ($p['id']));
            $itemsp['models'][] = $p;
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/ru/internet-magazin/' . (($p['slug']) ? ($p['slug']) : ($p['id']));
            $itemsp['models'][] = $p;
        }
        $itemsp['changefreq'] = self::MONTHLY;
        $itemsp['priority'] = 0.8;

        $items = array_merge($items, [$itemsp]);
//-------------------------------------------------------
        $itemsp = [];

        $its = Product::find()
            ->select('`product`.`id` as pid,`product`.`slug` as pslug,`product`.`category_id` as cid,`c`.`slug` as cslug')
            ->leftJoin('`category` c', '`c`.`id` = `product`.`category_id`')
            ->asArray()
            ->all();


        foreach ($its as $p) {
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/internet-magazin/product/view/' . (($p['cslug']) ? ($p['cslug']) : ($p['cid'])) . '/' . (($p['pslug']) ? ($p['pslug']) : ($p['pid']));
            $itemsp['models'][] = $p;
            $p['url'] = 'https://' . $_SERVER['HTTP_HOST'] . '/ru/internet-magazin/product/view/' . (($p['cslug']) ? ($p['cslug']) : ($p['cid'])) . '/' . (($p['pslug']) ? ($p['pslug']) : ($p['pid']));
            $itemsp['models'][] = $p;
        }
        $itemsp['changefreq'] = self::MONTHLY;
        $itemsp['priority'] = 0.5;

        $items = array_merge($items, [$itemsp]);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $pages = [
            'https://' . $_SERVER['HTTP_HOST'] . '/' => ['1.0', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/' => ['1.0', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/pro-kompaniyu' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/pro-kompaniyu' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/kontakti' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/kontakti' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/dostavka-ta-oplata' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/dostavka-ta-oplata' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/vidguki' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/vidguki' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/internet-magazin/cart/view' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/internet-magazin/cart/view' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/partneri' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/partneri' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/web/default/bonus' => ['0.8', self::DAILY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/web/default/bonus' => ['0.8', self::DAILY],
            'https://' . $_SERVER['HTTP_HOST'] . '/osobistij-kabinet' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/osobistij-kabinet' => ['0.8', self::MONTHLY],
            'https://' . $_SERVER['HTTP_HOST'] . '/novini' => ['0.9', self::DAILY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/novini' => ['0.9', self::DAILY],
            'https://' . $_SERVER['HTTP_HOST'] . '/articles' => ['0.9', self::DAILY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/articles' => ['0.9', self::DAILY],
			'https://' . $_SERVER['HTTP_HOST'] . '/info' => ['0.9', self::DAILY],
            'https://' . $_SERVER['HTTP_HOST'] . '/ru/info' => ['0.9', self::DAILY],
        ];

        foreach ($pages as $url => $fq) {
            $xml .= '
        <url>
           <loc>' . $url . '</loc>
           <lastmod>' . date(DATE_W3C) . '</lastmod>'.
                // <changefreq>' . $fq[0] . '</changefreq>
                // <priority>' . $fq[1] . '</priority>
                '</url>';
        }

        foreach ($items as $item) {
            foreach ($item['models'] as $model) {
                $xml .= '
            <url>
                <loc>' . $model['url'] . '</loc>
                <lastmod>' . date(DATE_W3C) . '</lastmod>'.
                    // <changefreq>' . $item['changefreq'] . '</changefreq>
                    // <priority>' . $item['priority'] . '</priority>
                    '</url>';
            }
        }

        $xml .= '
    </urlset>';
        die($xml);
    }
}

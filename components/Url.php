<?php
namespace app\components;

class Url extends \yii\helpers\Url
{
    public static function toCategory($category, $manufacturer_ids = [], $filter_ids = [])
    {
        // if ($category->slug)
        // {
        if(count($manufacturer_ids) && count($filter_ids)) { 
            return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'manufacturer_ids' => implode(',', $manufacturer_ids), 'filter_ids' => implode(',', $filter_ids)]);
        } elseif(count($filter_ids)) {
            return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'filter_ids' => implode(',', $filter_ids)]);
        } elseif(count($manufacturer_ids)) {
            return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'manufacturer_ids' => implode(',', $manufacturer_ids)]);
        } else {
            return static::to(['products/index', 'category_id' => $category->slug?$category->slug:$category->id]);
        }
// }
        // if ($category->categories)
        //     return static::to(['categories/subcategory', 'category_id' => $category->slug?:$category->id]);
        // else
        //     return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'manufacturer_ids' => implode(',', $manufacturer_ids)]);
    }

    public static function toPage($category, $manufacturer_ids = [], $filter_ids = [])
    {
 
        if(count($manufacturer_ids) && count($filter_ids)) { 
            return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'manufacturer_ids' => implode(',', $manufacturer_ids), 'filter_ids' => implode(',', $filter_ids)]);
        } elseif(count($filter_ids)) {
            return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'filter_ids' => implode(',', $filter_ids)]);
        } elseif(count($manufacturer_ids)) {
            return static::to(['products/index', 'category_id' => $category->slug?:$category->id, 'manufacturer_ids' => implode(',', $manufacturer_ids)]);
        } else {
            return static::to(['products/index', 'category_id' => $category->slug?$category->slug:$category->id]);
        }
    }

    public static function toProduct($product)
    {
        $category = $product->category;
        return static::to(['products/view', 'category_id' => $category->slug?:$category->id, 'product_id' => $product->slug?:$product->id]);
    }

    public static function toForum($forum)
    {
        if ($forum->slug)
            return static::to(['forum/view', 'forum_id' => $forum->slug]);
        return static::to(['forum/view', 'forum_id' => $forum->id]);
    }
	
	public static function toInfo($tab)
    {
        if ($tab->slug)
            return static::to(['info/category', 'id' => $tab->slug]);
        return static::to(['info/category', 'id' => $tab->id]);
    }

    public static function toInfoView($tabContent)
    {
        $category = $tabContent->infoTabs;
        return static::to(['info/view', 'id' => $category->slug?:$category->id, 'article_id' => $tabContent->id]);
    }

    public static function toNews($news)
    {
        if ($news->slug) 
            return static::to(['news/view', 'news_id' => $news->slug]);
        return static::to(['news/view', 'news_id' => $news->id]);
    }

    public static function toArticle($article)
    {
        if ($article->slug)
            return static::to(['articles/view', 'article_id' => $article->slug]);
        return static::to(['articles/view', 'article_id' => $article->id]);
    }
	
	     public static function toStock($category_id, $manufacturer_ids = [], $filter_ids = [])
    {
        if(count($manufacturer_ids) && count($filter_ids)) {
            return static::to(['user/index', 'category_id' => $category_id, 'manufacturer_ids' => implode(',', $manufacturer_ids), 'filter_ids' => implode(',', $filter_ids)]);
        } elseif(count($filter_ids)) {
            return static::to(['user/index', 'category_id' => $category_id, 'filter_ids' => implode(',', $filter_ids)]);
        } elseif(count($manufacturer_ids)) {
            return static::to(['user/index', 'category_id' => $category_id, 'manufacturer_ids' => implode(',', $manufacturer_ids)]);
        } else {
            return static::to(['user/index', 'category_id' => $category_id]);
        }

    }
}

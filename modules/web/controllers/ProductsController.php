<?php
namespace app\modules\web\controllers;

use app\models\Representative;
use app\models\Stock;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\Sort;
use app\models\Category;
use app\models\Country;
use app\models\Product;
use app\models\Manufacturer;
use app\models\Review;
use app\models\Normy;
use app\models\Plants;
use app\models\Maincharact;
use app\models\Complects;
use app\models\User;
use app\models\ComplectsProduct;
use app\models\AttributeValue;
use app\models\ProductPricesEnquiry;
use app\modules\web\models\ProductQuestionForm;
use app\modules\web\models\ReviewForm;
use app\models\Filter;
use app\models\FilterToProduct;
use yii\db\Query;
use yii\db\Expression;


class ProductsController extends Controller
{


	public function behaviors(){
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index'
                    //,'view'
                ],
                'lastModified' => function ($action, $params) {
                        if ($this->action->id == 'index') {
                            $q = new \yii\db\Query();
                            return strtotime($q->from('product')->max('updated_at'));
                        }
                        else{
                        $q = new \yii\db\Query();
                              $post = Product::findOne(\Yii::$app->request->get('product_id'));


                           return strtotime($post->updated_at);

                        }

                },
    //            'etagSeed' => function ($action, $params) {
    //                return // generate etag seed here
    //            }
            ],
        ];
    }

    public function beforeAction($action) {
        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')->orderBy('order')
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;
        return parent::beforeAction($action);
    }

    public function actionIndex($category_id, $manufacturer_ids="", $filter_ids="")
    {
        $manufacturer_ids = array_filter(explode(",", $manufacturer_ids), function($i){return !!$i;});
        if($category_id !== strtolower($category_id)) {
            //return $this->redirect(Url::current(['category_id' => strtolower($category_id)]), 301);
            throw new \yii\web\NotFoundHttpException();
        }
        $category = Category::findOne(['slug' => $category_id]);
        if (!$category)
            $category = Category::findOne($category_id);
        if (!$category) {
            throw new \yii\web\NotFoundHttpException();
        }

        if ($category->categories)
            return Yii::$app->runAction('web/categories/subcategory', compact('category_id'));
        $models = $category->getProducts();
        $models_own= clone $models;
        $t = $models->createCommand()->rawSql;

        $manufacturers = [];
        // смотрим есть ли фильры
        if ($manufacturer_ids)
            $models->where(['manufacturer_id' => $manufacturer_ids]);
        if(strlen($filter_ids) > 0)
        {
            $filter_ids = array_filter(explode(",", $filter_ids), function($i){return (bool)$i;});
            $items = Filter::find()->where(['id' => $filter_ids])->with(['filterToProducts'])->asArray()->all();
            $items = ArrayHelper::getColumn($items, 'filterToProducts');
            $ids = [];
            foreach ($items as $item) {
                foreach($item as $itemOne) {
                    $ids[] = $itemOne['product_id'];
                }
            }
            // добавляем к модели условие на выборку
            $models->andWhere(['id' => $ids]);
        } else {
            $filter_ids = [];
        }
        // и только тут ее копируем
        $productManufacturers = clone $models;
        $productManufacturers = $productManufacturers
            ->select(['manufacturer_id', 'COUNT(1) as cnt'])
            ->groupBy(['manufacturer_id'])
            ->asArray()
            ->all();

        $_manufacturers = Manufacturer::find()->where(['id' => array_column($productManufacturers, 'manufacturer_id')])->all();
        foreach ($_manufacturers as $manufacturer)
            $manufacturers[$manufacturer->id] = ['manufacturer' => $manufacturer, 'checked' => false];
        foreach ($productManufacturers as $productManufacturer)
            if ($productManufacturer['manufacturer_id'])
                $manufacturers[$productManufacturer['manufacturer_id']]['count'] = $productManufacturer['cnt'];
        foreach ($manufacturer_ids as $manufacturer_id)
            if (isset($manufacturers[$manufacturer_id])) {
                $manufacturers[$manufacturer_id]['checked'] = true;
            } else {
                throw new \yii\web\NotFoundHttpException();
            }

        $pageFilters = [];
        $parentFilters = Filter::find()->where(['filter_id' => null])->with(['filters', 'filters.products' => function($query) use ($category, $manufacturer_ids) {
            $query->andWhere(['category_id' => $category->id]);
            if ($manufacturer_ids) {
                $query->andWhere(['manufacturer_id' => $manufacturer_ids]);
            }
        }])->all();
        $parentFilters = ArrayHelper::index($parentFilters, 'id');
        foreach ($parentFilters as $key => $parentFilter ) {
            foreach ($parentFilter->filters as $childFilter) {
                if(count($childFilter->products) > 0)
                    $pageFilters[$parentFilter->name][$childFilter->id] = [
                        'filter' => $childFilter,
                        'count' => count($childFilter->products),
                        'checked' => false,
                    ];
            }
        }
        $count = $models->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 16, 'defaultPageSize' => 16]);
        $label_topsale = Yii::$app->language == 'uk' ? 'Топ продаж':'Топ продаж';
        $label_price = Yii::$app->language == 'uk' ? 'По ціні':'По цене';
        $label_order = Yii::$app->language == 'uk' ? 'По рейтингу':'По рейтингу';
        $label_super = Yii::$app->language == 'uk' ? 'Краща ціна':'Лучшая цена';
        $label_sale = Yii::$app->language == 'uk' ? 'Акційні':'Акционные';
        $sort = new Sort([
            'attributes' => [
                'topsale' => [
                    'asc' => ['topsale' => SORT_ASC],
                    'desc' => ['topsale' => SORT_DESC],
                    'label' => $label_topsale,
                ],
                'price' => [
                    'desc' => ['price' => SORT_DESC],
                    'asc' => ['price' => SORT_ASC],
                    'label' => $label_price,
                ],
                'order' => [

                    'asc' => ['cont' => SORT_DESC],
                    'desc' => ['cont' => SORT_DESC],
                    'default' => ['cont' => SORT_DESC],
                    'label' => $label_order,

                ],
                'super' => [
                    'asc' => ['super' => SORT_ASC],
                    'desc' => ['super' => SORT_DESC],
                    'label' => $label_super
                ],
                'sale' => [
                    'asc' => ['is_on_sale' => SORT_ASC],
                    'desc' => ['is_on_sale' => SORT_DESC],
                    'label' => $label_sale
                ]
            ],
        ]);
        $numberPages = $pagination->getPageCount();
        if($numberPages ==  0) {
            $numberPages = 1;
        }
        $page = \Yii::$app->request->get('page', 1);

        $sortBy = array();
        if (empty($sort->orders)){
            $sortBy['order'] = SORT_ASC;
        }else{
            $sortBy = $sort->orders;
        }

        $subQuery=Product::find()
            ->select([ "COUNT(*) as cont","product.id as prod_id"])
            ->join('LEFT JOIN','review', 'product.id = review.product_id')
            ->where(['is_visible' => 1])
            ->groupBy("product.id");


        $models = $models->orderBy($sortBy)
            ->select(["T.cont as cont","product.*"])
            ->leftJoin(['T' => $subQuery], 'T.prod_id = product.id')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->all();



        $attrs = $category->getAttributesInPrice($models);
        $categories = [];
        if ($category->parent)
            $categories = $category->parent->categories;
        $parents = [];
        $parent = $category;
        while ($parent = $parent->parent)
            array_unshift($parents, $parent);
        foreach ($manufacturers as $manufacturer) {
            $manufacturer_id = $manufacturer['manufacturer']->id;
            $_manufacturer_ids[$manufacturer_id] = $manufacturer_ids;
            if (in_array($manufacturer_id, $_manufacturer_ids[$manufacturer_id] )){
                $_manufacturer_ids[$manufacturer_id]  = array_filter($_manufacturer_ids[$manufacturer_id] , function($i)use($manufacturer_id){return $manufacturer_id != $i;});
            } else {
                $_manufacturer_ids[$manufacturer_id][] = $manufacturer_id;
            }
        }
        $seotitle = false;
        $seoheader = false;
        $seodesc = false;
        if (Yii::$app->language == 'uk') {
            $manufacturerDesc = [];
            $manufacturerTitle = [];
            $manufacturerH = [];
            $manufacturerKeywords = [];
            $manufacturerDescriptionFull = [];
            $manufacturerSeotitles = [];
            $manufacturerSeoheaders = [];
            $manufacturerSeodesc = [];
            foreach ($manufacturer_ids as $id) {
                $manufacturerObj = Product::find()
                    ->where(['manufacturer_id' => $id])
                    ->one()
                    ->getManufacturer()
                    ->one();
                if($manufacturerObj->seo_title_uk != null) {
                    $manufacturerSeodesc[] = $manufacturerObj->seo_description_uk;
                    $seodesc = true;
                } else {
                    $manufacturerDesc[] = $manufacturerObj->name;
                }
                if($manufacturerObj->seo_title_uk != null) {
                    $manufacturerSeotitles[] = $manufacturerObj->seo_title_uk;
                    $seotitle = true;
                } else {
                    $manufacturerTitle[] = $manufacturerObj->name;
                }
                if($manufacturerObj->seo_header_uk != null) {
                    $manufacturerSeoheaders[] = $manufacturerObj->seo_header_uk;
                    $seoheader = true;
                } else {
                    $manufacturerH[] = $manufacturerObj->name;
                }
                $manufacturerKeywords[] = $manufacturerObj->seo_keywords_uk !=null ? $manufacturerObj->seo_keywords_uk : null;
                if($manufacturerObj->description_uk) $manufacturerDescriptionFull[] = $manufacturerObj->description_uk;
            }
            $manufacturerDesc = implode(', ', $manufacturerSeodesc) . ' ' . implode(', ', $manufacturerDesc);
            $manufacturerTitle = implode(', ', $manufacturerSeotitles) . ' ' . implode(', ', $manufacturerTitle);
            $manufacturerH = implode(', ', $manufacturerSeoheaders) . ' ' . implode(', ', $manufacturerH);
            $manufacturerKeywords = implode(', ', $manufacturerKeywords);

            $filterDesc = [];
            $filterTitle = [];
            $filterH = [];
            $filterKeywords = [];
            $filterDescriptionFull = [];
            $filterSeotitles = [];
            $filterSeoheaders = [];
            $filterSeodesc = [];
            $manyFilters = Filter::find()->where(['id' => $filter_ids])->all();
            if(count($manyFilters) != count($filter_ids)) {
                throw new \yii\web\NotFoundHttpException();
            }
            foreach ($manyFilters as $filterObj) {
                if(!isset($filterObj)) {
                    throw new \yii\web\NotFoundHttpException();
                }
                if($filterObj->seo_description_uk != null) {
                    $filterSeodesc[] = $filterObj->seo_description_uk;
                    $seodesc = true;
                } else {
                    $filterDesc[] = $filterObj->name_uk;
                }
                if($filterObj->seo_title_uk != null) {
                    $filterSeotitles[] = $filterObj->seo_title_uk;
                    $seotitle = true;
                } else {
                    $filterTitle[] = $filterObj->name_uk;
                }
                if($filterObj->seo_header_uk != null) {
                    $filterSeoheaders[] = $filterObj->seo_header_uk;
                    $seoheader = true;
                } else {
                    $filterH[] = $filterObj->name_uk;
                }

                $filterKeywords[] = $filterObj->seo_keywords_uk !=null ? $filterObj->seo_keywords_uk : null;
                if($filterObj->description_uk) $filterDescriptionFull[] = $filterObj->description_uk;
            }
            $filterDesc = implode(', ', $filterSeodesc) . ' ' . implode(', ', $filterDesc);
            $filterTitle = implode(', ', $filterSeotitles) . ' ' . implode(', ', $filterTitle);
            $filterH = implode(', ', $filterSeoheaders) . ' ' . implode(', ', $filterH);
            $filterKeywords = implode(', ', $filterKeywords);
        } else {
            $manufacturerDesc = [];
            $manufacturerTitle = [];
            $manufacturerH = [];
            $manufacturerKeywords = [];
            $manufacturerDescriptionFull = [];
            $manufacturerSeotitles = [];
            $manufacturerSeoheaders = [];
            $manufacturerSeodesc = [];
            foreach ($manufacturer_ids as $id) {
                $manufacturerObj = Product::find()
                    ->where(['manufacturer_id' => $id])
                    ->one()
                    ->getManufacturer()
                    ->one();
                if($manufacturerObj->seo_title_ru != null) {
                    $manufacturerSeodesc[] = $manufacturerObj->seo_description_ru;
                    $seodesc = true;
                } else {
                    $manufacturerDesc[] = $manufacturerObj->name;
                }
                if($manufacturerObj->seo_title_ru != null) {
                    $manufacturerSeotitles[] = $manufacturerObj->seo_title_ru;
                    $seotitle = true;
                } else {
                    $manufacturerTitle[] = $manufacturerObj->name;
                }

                if($manufacturerObj->seo_header_ru != null) {
                    $manufacturerSeoheaders[] = $manufacturerObj->seo_header_ru;
                    $seoheader = true;
                } else {
                    $manufacturerH[] = $manufacturerObj->name;
                }
                $manufacturerKeywords[] = $manufacturerObj->seo_keywords_ru !=null ? $manufacturerObj->seo_keywords_ru : null;
                if ($manufacturerObj->description_ru) $manufacturerDescriptionFull[] = $manufacturerObj->description_ru;
            }
            $manufacturerDesc = implode(', ', $manufacturerSeodesc) . ' ' . implode(', ', $manufacturerDesc);
            $manufacturerTitle = implode(', ', $manufacturerSeotitles) . ' ' . implode(', ', $manufacturerTitle);
            $manufacturerH = implode(', ', $manufacturerSeoheaders) . ' ' . implode(', ', $manufacturerH);
            $manufacturerKeywords = implode(', ', $manufacturerKeywords);

            $filterDesc = [];
            $filterTitle = [];
            $filterH = [];
            $filterKeywords = [];
            $filterDescriptionFull = [];
            $filterSeotitles = [];
            $filterSeoheaders = [];
            $filterSeodesc = [];
            $manyFilters = Filter::find()->where(['id' => $filter_ids])->all();
            if(count($manyFilters) != count($filter_ids)) {
                throw new \yii\web\NotFoundHttpException();
            }
            foreach ($manyFilters as $filterObj) {
                if(!isset($filterObj)) {
                    throw new \yii\web\NotFoundHttpException();
                }
                if($filterObj->seo_description_ru != null) {
                    $filterSeodesc[] = $filterObj->seo_description_ru;
                    $seodesc = true;
                } else {
                    $filterDesc[] = $filterObj->name_ru;
                }
                if($filterObj->seo_title_ru != null) {
                    $filterSeotitles[] = $filterObj->seo_title_ru;
                    $seotitle = true;
                } else {
                    $filterTitle[] = $filterObj->name_ru;
                }
                if($filterObj->seo_header_ru != null) {
                    $filterSeoheaders[] = $filterObj->seo_header_ru;
                    $seoheader = true;
                } else {
                    $filterH[] = $filterObj->name_ru;
                }

                $filterKeywords[] = $filterObj->seo_keywords_ru !=null ? $filterObj->seo_keywords_ru : null;
                if($filterObj->description_ru) $filterDescriptionFull[] = $filterObj->description_ru;
            }
            $filterDesc = implode(', ', $filterSeodesc) . ' ' . implode(', ', $filterDesc);
            $filterTitle = implode(', ', $filterSeotitles) . ' ' . implode(', ', $filterTitle);
            $filterH = implode(', ', $filterSeoheaders) . ' ' . implode(', ', $filterH);
            $filterKeywords = implode(', ', $filterKeywords);
        }


        if($page > $numberPages || $page == 0) {
            throw new \yii\web\NotFoundHttpException();
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_ajax_products', compact('models'));
        }

        return $this->render('index', compact('models', 'category', 'count', 'parents', 'pagination', 'categories', 'manufacturers', 'manufacturer_ids',
            'pageFilters', 'filter_ids', '_manufacturer_ids', 'page', 'manufacturerDesc', 'manufacturerTitle', 'manufacturerH',
            'manufacturerKeywords', 'filterDesc', 'filterTitle', 'filterH', 'filterKeywords','filterDescriptionFull', 'manufacturerDescriptionFull','numberPages',
            'seotitle', 'seoheader', 'seodesc','attrs','sort'));
    }

    public function actionView($product_id)
    {
		$this->enableCsrfValidation = false;
        if((\Yii::$app->request->isPost) && (!isset(Yii::$app->request->post()['chk']))) {
            $secret = '6LdHFxIUAAAAAKxvXOogBoI8TfGCh_npL59nwM2p';
            $captcha = trim( \Yii::$app->request->post('g-recaptcha-response') );
            $ip = \Yii::$app->request->userIP;
            $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$captcha}&remoteip={$ip}";
            $options=array(
                'ssl'=>array(
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                ),
            );
            $context = stream_context_create( $options );
            $res=json_decode( file_get_contents( $url, FILE_TEXT, $context ) );
            if( $res->success ){

            } else {
                die('Вы робот :(');
            }
        }

        $model = Product::findOne(['slug' => $product_id]);
        if (!$model)
            $model = Product::findOne($product_id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        if (!Yii::$app->session['lastViewedProductIds'])
            Yii::$app->session['lastViewedProductIds'] = [];
        $lastViewedProductIds = Yii::$app->session['lastViewedProductIds'];
        if (in_array($model->id, $lastViewedProductIds))
            $lastViewedProductIds = array_values(array_filter($lastViewedProductIds, function($id)use($model){return $id != $model->id;}));
        $lastViewedProductIds[] = $model->id;
        if (count($lastViewedProductIds) > 10)
            array_shift($lastViewedProductIds);
        Yii::$app->session['lastViewedProductIds'] = $lastViewedProductIds;

        $lastViewedProducts = [];
        $_products = Product::find()->where(['id' => $lastViewedProductIds])->with(['reviews' => function($query) {
            $query->andWhere(['is_visible' => 1]);
        }])->all();
        $products = [];
        foreach ($_products as $product)
            $products[$product->id] = $product;
        foreach ($lastViewedProductIds as $_product_id)
            if ($_product_id != $model->id)
                $lastViewedProducts[$_product_id] = $products[$_product_id];
        $lastViewedProducts = array_reverse($lastViewedProducts);

        $manufacter = Manufacturer::findOne(['id' => $model->manufacturer_id]);

        $review = new ReviewForm();
        $review->rating = 5;
        if ($review->load(Yii::$app->request->post())){
            $review->product_id = $model->id;
            $review->phone = \app\helpers\PhoneDigits::get($review->phone);
    		$review->posted_at = new \yii\db\Expression('NOW()');
    		$review->is_visible = (int)!Yii::$app->params['review.shouldBeModerated'];
            if (!Yii::$app->user->isGuest)
                $review->user_id = Yii::$app->user->identity->id;
    		if ($review->save()){
                $user_manufacter = User::findOne([
                    'ctype' => 2,
                    'ctypeid' => $manufacter->id
                ]);
                Yii::$app->mailer->compose()
                    ->setFrom('info@hectare.com.ua')
                    ->setTo($user_manufacter->email)
                    ->setSubject('Відгук на сайті Гектар')
                    ->setTextBody("На ваш товар '{$model->name_uk}' було залишено відгук на сайті https://hectare.com.ua.")
                    ->setHtmlBody("На ваш товар <b>'{$model->name_uk}'</b> було залишено відгук на сайті https://hectare.com.ua.")
                    ->send();
                return $this->refresh();
    		}
        }

        $question = new ProductQuestionForm();
        if ($question->load(Yii::$app->request->post()))
        {
            $question->product_id = $model->id;
            $question->asked_at = new \yii\db\Expression('NOW()');
            if (!Yii::$app->user->isGuest) {
                $question->user_id = Yii::$app->user->identity->id;
            }
            if ($question->save())
            {
                $question->trigger(ProductQuestionForm::EVENT_ON_CREATE);
                $question = new ProductQuestionForm();
            }
        }

        $enquiry = new ProductPricesEnquiry();
        if ($enquiry->load(Yii::$app->request->post()))
        {
            $enquiry->product_id = $model->id;
            $enquiry->asked_at = new \yii\db\Expression('NOW()');
            if (!Yii::$app->user->isGuest)
                $enquiry->user_id = Yii::$app->user->identity->id;
            if ($enquiry->save())
            {
                $enquiry->trigger(ProductPricesEnquiry::EVENT_ON_CREATE);
                $enquiry = new ProductPricesEnquiry();
            }
        }

        $country = Country::find()->all();

        $attributes = [];
        foreach ($model->attributeValues as $av){
            array_push($attributes,$av->id);
        }
		
        $stocksByShops = Stock::find()
            ->select(['stock.*','sum(franch) franch', 'sum(main) main'])
            ->joinWith(['stock1c'])
            ->where(['AND', ['in','stock.avid', $attributes], (['OR', ['>','stock.franch', '0'], ['>','stock.main', '0']])])
            ->andWhere(['not', ['stock1c.representative_id' => null]])
            ->groupBy(['avid','product_id','stock1c.representative_id'])
            ->orderBy(['franch' => SORT_DESC, 'main' => SORT_DESC])
            ->all();
        $stocksByShops2 = [];
        foreach ($stocksByShops as $stocksByShop){
            array_push($stocksByShops2, $stocksByShop->stock1c->representative_id);
        }

        $shops = Representative::find()->where(['not in','id', $stocksByShops2])->all();

        $reviews = Review::find()->where([
            'product_id' => $model->id,
            'is_visible' => true,
            'parent_id' => null
        ])->all();
        $maincharact = Maincharact::find()->where([
            'product_id' => $model->id
        ])->all();

        $_prod = Product::find()->all();
        $_attribval = AttributeValue::find()->all();
		$complectsall = ComplectsProduct::find()->where(['productid' => $model->id])->all();
        $complects1 = array();
        $complects = array();
        foreach ($complectsall as $c) {
			$complects1[] = $c['complectid'];
		}
		$complects1 = array_unique($complects1);
        foreach ($complects1 as $c) {
			$pack = ComplectsProduct::find()->where(['complectid' => $c])->all();
			$packproducts = array();
			foreach ($pack as $p) {
				$packproducts[] = array(
					'id'=>$p['complectid'],
				//	'product'=>$_prod[$p['productid']],
					'product'=>$p->product,
				//	'attribute'=>$_attribval[$p['attributeid']],
					'attribute'=>$p->attributeValue,
					'discount'=>$p['discount'],
                    'slider'=>$p['is_slider'],
				);
			}
			$complects[] = array(
				'id'=>$c,
				'products'=>$packproducts
			);
		}

        $norm = Normy::find()->where([
            'product_id' => $model->id
        ])->all();
		$plants1 = Plants::find()->all();
		$plants = array();
		foreach($plants1 as $p) {
			$plants[$p['id']] = $p;
		}
        $categories = [];
        if ($model->category->parent)
            $categories = $model->category->parent->categories;
        $parents = [];
        $parent = $model->category;
        while ($parent = $parent->parent)
            array_unshift($parents, $parent);

        return $this->render('view', compact('model', 'categories','country','complects', 'parents', 'lastViewedProducts', 'review', 'reviews', 'maincharact', 'norm', 'plants', 'question', 'enquiry', 'manufacter','shops', 'stocksByShops'));
    }

    public function actionSearch($searchString = "", $searchPage = true)
    {

        $searchString = trim($searchString);
        $searchStringTranslated = $this->kbLat2Cyr(trim($searchString));
        if (!$searchString)
            return [];

        $searchParts = explode(' ', $searchString);
        $searchTranslatedParts = explode(' ', $searchStringTranslated);
        $conditions = ['or'];

        $conditionId = ['or'];
        $conditionNameUk = ['or'];
        $conditionNameRu = ['or'];
        $conditionDv = ['or'];
        $conditionDvUk = ['or'];

        $conditionIdLang = ['and'];
        $conditionDvLang = ['and'];
        $conditionDvUkLang = ['and'];
        $conditionNameUkLang = ['and'];
        $conditionNameRuLang = ['and'];

        foreach ($searchParts as $p) {
            $conditionIdLang[] = ['like', 'id', $p];
            $conditionDvLang[]  = ['like', 'dv', $p];
            $conditionDvUkLang[]  = ['like', 'dv_uk', $p];
            $conditionNameUkLang[] = ['like', 'name_uk', $p];
            $conditionNameRuLang[] = ['like', 'name_ru', $p];
        }

        $conditionId[] = $conditionIdLang;
         $conditionDv[] = $conditionDvLang;
         $conditionDvUk[] = $conditionDvUkLang;
        $conditionNameUk[] = $conditionNameUkLang;
        $conditionNameRu[] = $conditionNameRuLang;

        $conditionIdLang = ['and'];
        $conditionDvLang = ['and'];
        $conditionDvUkLang = ['and'];
        $conditionNameUkLang = ['and'];
        $conditionNameRuLang = ['and'];

        foreach ($searchTranslatedParts as $p) {
            $conditionIdLang[] = ['like', 'id', $p];
            $conditionDvLang[] = ['like', 'dv', $p];
             $conditionDvUkLang[] = ['like', 'dv_uk', $p];
            $conditionNameUkLang[] = ['like', 'name_uk', $p];
            $conditionNameRuLang[] = ['like', 'name_ru', $p];
        }

        $conditionId[] = $conditionIdLang;
        $conditionDv[] = $conditionDvLang;
        $conditionDvUk[] = $conditionDvUkLang;
        $conditionNameUk[] = $conditionNameUkLang;
        $conditionNameRu[] = $conditionNameRuLang;

        $conditions[] = $conditionId;
        $conditions[] = $conditionDv;
        $conditions[] = $conditionDvUk;
        $conditions[] = $conditionNameUk;
        $conditions[] = $conditionNameRu;

        /*
        [
        return \yii\helpers\ArrayHelper::toArray(Product::find()->where([
            'or',
            ['like', 'id', $searchString],
            ['like', 'name_uk', $searchString],
            ['like', 'name_ru', $searchString]
        ]
         */

        $searchPage = (bool)$searchPage;

        if (!$searchPage) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\helpers\ArrayHelper::toArray(Product::find()->where($conditions)
                    ->limit(5)
                    ->all(), [
                    'app\models\Product' => [
                        'id',
                        'name',
                        'url' => function($product) {
                                return \app\components\Url::toProduct($product);
                            }
                    ]
                ]);
        } else {

            $models = Product::find()->where($conditions);
            $pagination = new Pagination(['totalCount' => $models->count(), 'pageSize' => 16, 'defaultPageSize' => 16]);
            $numberPages = $pagination->getPageCount();

            if($numberPages ==  0) {
                $numberPages = 1;
            }

            $page = \Yii::$app->request->get('page', 1);
            $models = $models->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('order asc')
                ->with(['reviews' => function($query) {
                    $query->andWhere(['is_visible' => 1]);
                }])
                ->all();

            if($page > $numberPages || $page == 0) {
                throw new \yii\web\NotFoundHttpException();
            }
            return $this->render('search_page', compact('models','pagination', 'page'));
        }
    }

	public function actionSearchpage($searchString = "")
    {

        $searchString = $_GET['sear'];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $searchString = trim($searchString);
        $searchStringTranslated = $this->kbLat2Cyr(trim($searchString));
        if (!$searchString)
            return [];

        $searchParts = explode(' ', $searchString);
        $searchTranslatedParts = explode(' ', $searchStringTranslated);
        $conditions = ['or'];

        $conditionId = ['or'];
        $conditionNameUk = ['or'];
        $conditionNameRu = ['or'];
        $conditionDv = ['or'];
        $conditionDvUk = ['or'];

        $conditionIdLang = ['and'];
        $conditionDvLang = ['and'];
        $conditionDvUkLang = ['and'];
        $conditionNameUkLang = ['and'];
        $conditionNameRuLang = ['and'];

        foreach ($searchParts as $p) {
            $conditionIdLang[] = ['like', 'id', $p];
            $conditionDvLang[]  = ['like', 'dv', $p];
            $conditionDvUkLang[]  = ['like', 'dv_uk', $p];
            $conditionNameUkLang[] = ['like', 'name_uk', $p];
            $conditionNameRuLang[] = ['like', 'name_ru', $p];
        }

        $conditionId[] = $conditionIdLang;
         $conditionDv[] = $conditionDvLang;
         $conditionDvUk[] = $conditionDvUkLang;
        $conditionNameUk[] = $conditionNameUkLang;
        $conditionNameRu[] = $conditionNameRuLang;

        $conditionIdLang = ['and'];
        $conditionDvLang = ['and'];
        $conditionDvUkLang = ['and'];
        $conditionNameUkLang = ['and'];
        $conditionNameRuLang = ['and'];

        foreach ($searchTranslatedParts as $p) {
            $conditionIdLang[] = ['like', 'id', $p];
            $conditionDvLang[] = ['like', 'dv', $p];
             $conditionDvUkLang[] = ['like', 'dv_uk', $p];
            $conditionNameUkLang[] = ['like', 'name_uk', $p];
            $conditionNameRuLang[] = ['like', 'name_ru', $p];
        }

        $conditionId[] = $conditionIdLang;
        $conditionDv[] = $conditionDvLang;
        $conditionDvUk[] = $conditionDvUkLang;
        $conditionNameUk[] = $conditionNameUkLang;
        $conditionNameRu[] = $conditionNameRuLang;

        $conditions[] = $conditionId;
        $conditions[] = $conditionDv;
        $conditions[] = $conditionDvUk;
        $conditions[] = $conditionNameUk;
        $conditions[] = $conditionNameRu;

        /*
        [
        return \yii\helpers\ArrayHelper::toArray(Product::find()->where([
            'or',
            ['like', 'id', $searchString],
            ['like', 'name_uk', $searchString],
            ['like', 'name_ru', $searchString]
        ]
         */
     /*   return \yii\helpers\ArrayHelper::toArray(Product::find()->where($conditions)
        ->limit(5)
        ->all(), [
        'app\models\Product' => [
            'id',
                'name',
                'url' => function($product) {
                    return \app\components\Url::toProduct($product);
                }
            ]
        ]);*/

        return $this->render('search', [
            'title' => 'All Prices',

        ]);

    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    private function kbLat2Cyr($string)
    {
        $search = array(
            "q","w","e","r","t","y","u","i","o","p","[","]",
            "a","s","d","f","g","h","j","k","l",";","'",
            "z","x","c","v","b","n","m",",",".",
            "`",
        );
        $replace = array(
            "й","ц","у","к","е","н","г","ш","щ","з","х","ъ",
            "ф","ы","в","а","п","р","о","л","д","ж","э",
            "я","ч","с","м","и","т","ь","б","ю",
            "ё",
        );

        return str_replace($search, $replace, mb_strtolower($string, 'UTF-8'));
    }

    public function actionSales($filter = null)
    {
	    // select * from product LEFT JOIN Manufacturer M on product.manufacturer_id = M.id where discount=1 or is_sale=1;
        // забрать товары с акцией и товары производителей с акцией
		if(isset($filter) && !empty($filter)) {
			if($filter == 'is_on_sale'){
				//$models = Product::find()->select(['product.*'])->addSelect([new Expression('sum(if(stock.stockid = 7 or stock.stockid = 8 or stock.stockid = 29,ifnull(stock.main,0),0)) as stock_sum')])
				$models = Product::find()->select(['product.*'])->addSelect([new Expression('ifnull(sum(stock.main),0) as stock_sum')])
				->leftJoin('manufacturer', '`manufacturer`.`id` = `product`.`manufacturer_id`')
				->leftJoin('stock', 'stock.product_id = product.id')
				->andWhere(['!=','manufacturer.discount',''])->orWhere(['is_on_sale'=>true])/*->andWhere(['in','stock.stockid',['7','8','29']])*/
				->groupBy('product.id');
				$isSale = true;
			}else{
				if($filter == 'b_friday') $isSale = true;
                $models = Product::find()->where([$filter => true]);
            }
		}
	   // if(isset($filter) && !empty($filter)) {
	   //       if($filter == 'is_on_sale'){
    //             $models->joinWith(['manufacturer' => function($query) { $query->orWhere(['!=','manufacturer.discount', '']);}]);
    //         }else{
    //             $models->where([$filter => true]);
    //         }
    //     }

        $models->with(['reviews' => function($query) {
            $query->andWhere(['is_visible' => 1]);
        }]);
        // get product manufacturers
        $manufacturers = $this->salesManufacturer($models);
        // get product categories
        $categories = $this->salesCategories($models);

	    $pagination = new Pagination(['totalCount' => $models->count(), 'pageSize' => 16, 'defaultPageSize' => 16]);

	    $numberPages = $pagination->getPageCount();
	    if($numberPages ==  0) {
		    $numberPages = 1;
	    }
	    $page = \Yii::$app->request->get('page', 1);
	    $models = $models->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('order asc') //->orderBy('super desc,topsale desc,order asc')
            ->with(['reviews' => function($query) { $query->andWhere(['is_visible' => 1]);}])
            ->all();

	    if($page > $numberPages || $page == 0) {
		    throw new \yii\web\NotFoundHttpException();
	    }

        $seotitle = true;
        $seoheader = false;
        $seodesc = false;

	    return $this->render('with_label', compact('models', 'category', 'parents', 'pagination', 'categories', 'manufacturers', 'manufacturer_ids',
		    'pageFilters', 'filter_ids', '_manufacturer_ids', 'page', 'manufacturerDesc', 'manufacturerTitle', 'manufacturerH',
		    'manufacturerKeywords', 'filterDesc', 'filterTitle', 'filterH', 'filterKeywords','filterDescriptionFull', 'manufacturerDescriptionFull','numberPages',
		    'seotitle', 'seoheader', 'seodesc','attrs', 'isSale'));
    }

    private function salesManufacturer($items) {

        $productManufacturers = clone $items;
        $productManufacturers = $productManufacturers
            ->select(['manufacturer_id', 'COUNT(1) as cnt'])
            ->groupBy(['manufacturer_id'])
            ->asArray()
            ->all();

        $_manufacturers = Manufacturer::find()->where(['id' => array_column($productManufacturers, 'manufacturer_id')])->all();

        $manufacturers = null;
        // generate manufacturers list
        foreach ($_manufacturers as $manufacturer) {
            $manufacturers[$manufacturer->id] = ['manufacturer' => $manufacturer, 'checked' => false];
        }
        // count manufacturers elements
        foreach ($productManufacturers as $productManufacturer) {
            if($productManufacturer['manufacturer_id']) {
                $manufacturers[$productManufacturer['manufacturer_id']]['count'] = (int)$productManufacturer['cnt'];
            }
        }

        return $manufacturers;
    }

    private function salesCategories($items) {
	    $productCategories = clone $items;
	    $productCategories = $productCategories
            ->select(['category_id', 'COUNT(1) as cnt'])
            ->groupBy(['category_id'])
            ->asArray()
            ->all();

        $_categories = Category::find()->where(['id' => array_column($productCategories, 'category_id')])->all();

        $categories = null;
        // generate manufacturers list
        foreach ($_categories as $category) {
            $categories[$category->id] = ['category' => $category, 'checked' => false];
        }
        // count manufacturers elements
        foreach ($productCategories as $productCategory) {
            if($productCategory['category_id']) {
                $categories[$productCategory['category_id']]['count'] = (int)$productCategory['cnt'];
            }
        }

        return $categories;
    }

    public function replyComments($arr, $review,$manufacter, $model){
        if (is_array($arr)){}
        foreach ($arr as $reply){
            echo $this->renderAjax('reply',compact('reply', 'review','manufacter','model'));
            self::replyComments($reply->replies, $review, $manufacter,$model);
        }
    }
	
	    public function actionSuggestedProductsByShops($product_id, $shop_id){
        $stocksByShops = Stock::find()
            ->select(['product_id','sum(franch) franch', 'sum(main) main'])
            ->where(['OR', ['>','stock.franch', '0'], ['>','stock.main', '0']])
            ->andWhere(['in','stockid', (new Query())->select('id')->from('stock1c')->where (['representative_id'=>$shop_id])])
            ->andWhere(['in','product_id', (new Query())->select('suggestion_id')->from('suggestion')->where (['product_id'=>$product_id])])
            ->groupBy(['product_id'])
           // ->asArray()
            ->all();
        $data = [];
        foreach ($stocksByShops as $stocksByShop){
            array_push($data, $stocksByShop['product_id']);
        }
        $models = Product::find()->where(['in','id', $data])->all();
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_ajax_suggestion', compact('models'));
       }

      //  print_r($models) ;
    }
	
	public function actionFoundCheaper(){
        if(Yii::$app->request->isAjax){
            $urlCheaper = Yii::$app->request->post('url_cheaper');
            $numberCheaper = Yii::$app->request->post('number_cheaper_product');
            $nameCheaper = Yii::$app->request->post('cheaper_click_name');
            if($urlCheaper =='' || $numberCheaper == '' || $nameCheaper ==''){
                return false;
            }else{
                $mail = new Product();
                if($mail->sendFoundCheaperMail($urlCheaper,$numberCheaper,$nameCheaper))
                return true;
            }

        }
       // return true;
    }
	
}


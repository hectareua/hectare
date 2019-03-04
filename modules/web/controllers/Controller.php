<?php
namespace app\modules\web\controllers;

use app\models\SeoUrl;
use Yii;
use app\models\Product;
use app\models\Category;
use app\models\CartItem;
use app\models\Slide;
use app\models\SiteInfo;
use app\modules\web\models\CallRequestForm;
use yii\console\Exception;
use yii\db\Expression;

class Controller extends \yii\web\Controller
{
    private $_siteInfo = null;

    public function beforeAction($action)
    {
        if (
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) != '/' &&
            rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') != parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
        ) {
            $to = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)) {
                $to .= '?' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
            }
            header('Location: ' . $to, true, 301);
            die;
        }
        /* @var $seo SeoUrl */
        if ($seo = SeoUrl::getCurrent()) {
            $this->view->params['seoTitle'] = $seo->title;
            $this->view->params['seoH1'] = $seo->h1;
            $this->view->params['seoKeywords'] = $seo->keywords;
            $this->view->params['seoDescription'] = $seo->description;
            $this->view->params['seoText'] = $seo->text;
        } else {
            $this->view->params['seoTitle'] = '';
            $this->view->params['seoH1'] = '';
            $this->view->params['seoKeywords'] = '';
            $this->view->params['seoDescription'] = '';
            $this->view->params['seoText'] = '';
        }
        return parent::beforeAction($action);
    }

    public function getCartTotalAmount()
    {
        $amount = 0;
        $cart = $this->_loadCart();
        foreach ($cart as $cartItem) {
            $amount += $cartItem->amount;
        }
        return $amount;
    }
	
	    public function getCartTotalSum()
    {
        $totalPrice = 0;
        $cart = $this->_loadCart();
        foreach ($cart as $cartItem) {
            $totalPrice += $cartItem->totalPrice;
        }
        return $totalPrice;
    }

    public function getFooterCategories()
    {
        return Category::find()->where(['parent_id' => 1])->all();
    }

    public function getSlides()
    {
        return Slide::find()->orderBy('id DESC')->all();
    }

    public function getSiteInfo()
    {
        if (!$this->_siteInfo)
            $this->_siteInfo = SiteInfo::loadData();
        return $this->_siteInfo;
    }

    public function getCallRequest()
    {
        return new CallRequestForm();
    }

    protected function _loadSaleProductsModels()
    {
		return Product::find()->select(['product.*'])->addSelect([new Expression('ifnull(sum(stock.main),0) as stock_sum')])
		//Product::find()->select(['product.*'])->addSelect([new Expression('sum(if(stock.stockid = 7 or stock.stockid = 8 or stock.stockid = 29,ifnull(stock.main,0),0)) as stock_sum')])
            ->leftJoin('stock', 'stock.product_id = product.id')
            ->with(['reviews' => function($query) {
                $query->andWhere(['is_visible' => 1]);
            }])
            ->andWhere(['is_on_sale'=>true])/*->andWhere(['in','stock.stockid',['7','8','29']])*/
            ->groupBy('product.id')
            ->all();
		
        /*return Product::find()
            ->where(['is_on_sale' => true])
            ->with(['reviews' => function($query) {
                $query->andWhere(['is_visible' => 1]);
            }])
            ->all();*/
    }

    protected function _saveCart($cart)
    {
        foreach ($cart as $i => $cartItem)
        {
            $cart[$i] = $cartItem->attributes;
        }
        Yii::$app->session['cart'] = $cart;
    }

    protected function _loadCart()
    {
        $cart = Yii::$app->session['cart'] ?: [];

        foreach ($cart as $i => $cartItemData)
            $cart[$i] = new CartItem($cartItemData);
        return $cart;
    }
    
    protected function _savePurchaseType($purchaseType)
    {
        Yii::$app->session['purchaseType'] = $purchaseType;
    }

    protected function _loadPurchaseType()
    {
        $purchaseType = Yii::$app->session['purchaseType'];
        return $purchaseType;       
    }
    protected function _saveBillingPhone($billingPhone)
    {
        Yii::$app->session['billingPhone'] = $billingPhone;
    }

    protected function _loadBillingPhone()
    {
        $billingPhone = Yii::$app->session['billingPhone'];
        return $billingPhone;
    }

    protected function _saveOrderId($orderId)
    {
        Yii::$app->session['orderId'] = $orderId;
    }

    protected function _loadOrderId()
    {
        $orderId = Yii::$app->session['orderId'];
        return $orderId;
    }

    protected function _saveTotalPrice($totalPrice)
    {
        Yii::$app->session['totalPrice'] = $totalPrice;
    }

    protected function _loadTotalPrice()
    {
        $orderId = Yii::$app->session['totalPrice'];
        return $orderId;
    }
}

<?php
namespace app\modules\web\controllers;

use Yii;
use app\models\InfoTabsContent;
use app\models\News;
use app\models\SiteInfo;
use app\models\Partner;
use app\models\Certificate;
use app\models\History;
use app\models\Image;
use app\models\Bonuse;
use app\models\Cooperation;
use app\models\Representative;
use app\modules\web\models\CallRequestForm;
use app\modules\web\models\CallbackRequestForm;
use app\models\Category;
use app\models\Product;
use app\modules\admin\models\Contacts;
use app\modules\admin\models\SaveWithUsForm;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
 //            'error' => [
 //                'class' => 'yii\web\ErrorAction',
 //            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ]
        ];
    }
    
    public function beforeAction($action) {
        
        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')
            ->orderBy(['order' => SORT_ASC])
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;
        
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $saleProducts = $this->_loadSaleProductsModels();
        $topProducts = $this->_loadTopSaleProductsModels();
        $bestPriceProducts = $this->_loadBestPriceProductsModels();
		$blackFridayProducts = $this->_loadBlackFridayModels();
        $partners = Partner::find()->all();
        $certificates = Certificate::find()->all();

        /*$news = News::findPublishedNews()
            ->orderBy('publishing_since DESC')
            ->limit(5)
            ->all();*/
		$news = InfoTabsContent::find()
            ->where(['main_visible' => 1])
            ->orderBy('publishing_date DESC')
            ->limit(5)
            ->all();	
        return $this->render('index', compact('saleProducts', 'news', 'topProducts', 'bestPriceProducts','partners','certificates','blackFridayProducts'));
    }


	protected function _loadTopSaleProductsModels()
	{
		return Product::find()
		              ->where(['topsale' => true])
		              ->with(['reviews' => function($query) {
			              $query->andWhere(['is_visible' => 1]);
		              }])
					  ->limit(10)
		              ->all();
	}
	
	protected function _loadBlackFridayModels()
	{
		return Product::find()
		              ->where(['b_friday' => true])
		              ->with(['reviews' => function($query) {
			              $query->andWhere(['is_visible' => 1]);
		              }])
                      ->limit(10)
		              ->all();
	}

	protected function _loadBestPriceProductsModels()
	{
		return Product::find()
		              ->where(['super' => true])
		              ->with(['reviews' => function($query) {
			              $query->andWhere(['is_visible' => 1]);
		              }])
					  ->limit(10)
		              ->all();
	}

    public function actionDelivery()
    {
        return $this->render('delivery');
    }

    public function actionCredits()
    {
        return $this->render('credits');
    }

    public function actionPartners()
    {
        $partners = Partner::find()->all();
        return $this->render('partners', compact('partners'));
    }

    public function actionHistory()
    {
        $history = History::find()->all();
        return $this->render('history', compact('history'));
    }

    public function actionCooperation()
    {
        $cooperation = Cooperation::find()->one();

        return $this->render('cooperation', compact(['cooperation']));
    }
    
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        //_d($exception);
        if ($exception->statusCode == 404) {
            $response = Yii::$app->response;
            $response->headers->add("Status", 404);
            $saleProducts = $this->_loadSaleProductsModels();
            return $this->render('error', compact('saleProducts', 'exception'));
        }
        if ($exception !== null) {
            $response = Yii::$app->response;
            $response->headers->add("Status", 500);
        }
        $this->layout = 'error';
            return $this->render('500', ['exception' => $exception]);
    }
    
    public function actionError505()
    {
        $response = Yii::$app->response;
        
        $response->headers->add("Status", 500);
        $response->content = $this->render('500');
        return $this->render('500');
    }
    
 
    public function actionAbout()
    {
        $info = SiteInfo::loadData();
        return $this->render('about', compact('info'));
    }

    public function actionBonus()
    {
        $info = SiteInfo::loadData();
        return $this->render('bonus', compact('info'));
    }

    public function actionBonusplus()
    {
        $bonuse_info = Bonuse::find()->one();
        $lang = Yii::$app->language;
        $data = array();

        if ($lang == 'uk'){
            $data['first-line'] = $bonuse_info['one_title_uk'];
            $data['first-text'] = $bonuse_info['one_content_uk'];
            $data['mob-bonus-title'] = $bonuse_info['mob_text_title_uk'];
            $data['mob-bonus-text'] = $bonuse_info['mob_text_uk'];
            $data['second-line'] = $bonuse_info['two_title_uk'];
            $data['second-text'] = $bonuse_info['two_content_uk'];
            $data['third-line'] = $bonuse_info['three_title_uk'];
            $data['third-text'] = $bonuse_info['three_content_uk'];
            $data['four-text'] = $bonuse_info['four_content_uk'];
        }else{
            $data['first-line'] = $bonuse_info['one_title_ru'];
            $data['first-text'] = $bonuse_info['one_content_ru'];
            $data['mob-bonus-title'] = $bonuse_info['mob_text_title_ru'];
            $data['mob-bonus-text'] = $bonuse_info['mob_text_ru'];
            $data['second-line'] = $bonuse_info['two_title_ru'];
            $data['second-text'] = $bonuse_info['two_content_ru'];
            $data['third-line'] = $bonuse_info['three_title_ru'];
            $data['third-text'] = $bonuse_info['three_content_ru'];
            $data['four-text'] = $bonuse_info['four_content_ru'];
        }

		$data['email']=Contacts::find()->where(['c_type'=>1,'c_approved'=>1,'c_deleted'=>0])->orderBy('c_rating')->all();
		$data['telefone']=Contacts::find()->where(['c_type'=>0,'c_approved'=>1,'c_deleted'=>0])->orderBy('c_rating')->all();
		
		
        return $this->render('bonusplus', compact('data'));
    }

    public function actionShop()
    {
        $representatives = Representative::find()->all();
        $representativeRegions = Representative::find()->select(['region_ru','region_uk'])->groupBy(['region_ru','region_uk'])->all();

        return $this->render('contactshop', compact('representatives', 'representativeRegions'));
    }

    public function actionContact()
    {
        $representatives = Representative::find()->orderBy(['region_ru'=>SORT_ASC])->all();
        $email = Contacts::find()->where(['c_type'=>1,'c_approved'=>1,'c_deleted'=>0])->orderBy('c_rating')->all();
        $phones = Contacts::find()->where(['c_type'=>0,'c_approved'=>1,'c_deleted'=>0])->orderBy('c_rating')->all();
//        echo '<pre>';
//        print_r($email);
//        echo '</pre>';
//        die;
        return $this->render('contact', compact('representatives', 'email', 'phones'));
    }

    public function actionCall()
    {
        if(\Yii::$app->request->isPost) {
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
                die();
            }
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $callRequest = new CallRequestForm();
        if ($callRequest->load(Yii::$app->request->post()))
        {
            $callRequest->requested_at = new \yii\db\Expression('NOW()');
            if (!Yii::$app->user->isGuest)
                $callRequest->user_id = Yii::$app->user->identity->id;
            if ($callRequest->save())
            {
                $callRequest->trigger(CallRequestForm::EVENT_ON_CREATE);
                return 'ok';
            }
            else
            {
                return \yii\widgets\ActiveForm::validate($callRequest);
            }
        }
    }

    public function actionCallback()
    {
		if(\Yii::$app->request->isPost) {
			$options=array(
				'ssl'=>array(
					'verify_peer'       => false,
					'verify_peer_name'  => false,
				),
			);
			$context = stream_context_create( $options );
		}
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $callbackRequest = new CallbackRequestForm();
        if ($callbackRequest->load(Yii::$app->request->post()))
        {
            $callbackRequest->requested_at = new \yii\db\Expression('NOW()');
            if (!Yii::$app->user->isGuest)
                $callbackRequest->user_id = Yii::$app->user->identity->id;
            if ($callbackRequest->save())
            {
                $callbackRequest->trigger(CallbackRequestForm::EVENT_ON_CREATE);
                return 'ok';
            }
            else
            {
                return \yii\widgets\ActiveForm::validate($callbackRequest);
            }
        }
    }

    public function actionShieldcity($city_id)
    {
        $info = SiteInfo::loadData();
        $infocity = SiteInfo::loadDataCity($city_id);
        $infocity = $infocity['shield'];
        return $this->render('shieldcity', compact('info','infocity','city_id'));
    }

    public function actionGroundcity($city_id)
    {
        $info = SiteInfo::loadData();
        $infocity = SiteInfo::loadDataCity($city_id);
        $infocity = $infocity['ground'];
        return $this->render('groundcity', compact('info','infocity','city_id'));
    }

    public function actionSemillacity($city_id)
    {
        $info = SiteInfo::loadData();
        $infocity = SiteInfo::loadDataCity($city_id);
        $infocity = $infocity['semilla'];
        return $this->render('semillacity', compact('info','infocity','city_id'));
    }
	
	public function actionSaveWithUs()
    {
        $saveWithUs = SaveWithUsForm::find()->all();
        return $this->render('save-with-us', compact('saveWithUs'));
    }
    
    // test pushes

    public function actionPush()
    {

        return $this->renderPartial('push');
    }

}

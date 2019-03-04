<?php
namespace app\modules\web\controllers;

use Yii;
use app\models\News;
use app\models\Category;
use yii\data\Pagination;

class NewsController extends Controller
{
    public function behaviors(){
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index','view'],
                'lastModified' => function ($action, $params) {
                        if ($this->action->id == 'index') {
                            $q = new \yii\db\Query();
                            return strtotime($q->from('news')->max('updated_at'));
                        }
                        else{
                        
                              $post = News::findOne(\Yii::$app->request->get('news_id'));

                              
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
    
    public function actionIndex()
    {
        $models = News::findPublishedNews()
            ->orderBy('publishing_since DESC');

        $pagination = new Pagination(['totalCount' => $models->count(), 'pageSize' => 5, 'defaultPageSize' => 5, 'forcePageParam' =>false]);
        $numberPages = $pagination->getPageCount();
        $page = \Yii::$app->request->get('page', 1);
        
        $models = $models->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        $numberPages = $pagination->getPageCount();
        if($numberPages ==  0) {
            $numberPages = 1;
        }
        if($page > $numberPages || $page == 0) {
            throw new \yii\web\NotFoundHttpException();
        }
        return $this->render('index', compact('models', 'pagination', 'page', 'numberPages'));
    }

    public function actionView($news_id)
    {
        $pathInfo = Yii::$app->request->pathInfo;
        $model = News::findOne(['slug' => $news_id]);
        if (!$model)
            $model = News::findOne($news_id);

        $listForRedirects = [
            '/karbamid-kupit' => '/103-karbamid-kupit',
            '/102-kupit-karbamid' => '/103-karbamid-kupit',
            '/ukravit-2' => '/105-ukravit-2',
            '/104-ukravit' => '/105-ukravit-2',
            '/pestitsidyi-ukraine' => '/107-pestitsidyi-ukraine',
            '/106-pestitsidyi-v-ukraine' => '/107-pestitsidyi-ukraine',
            '/selitra-2' => '/109-selitra-2',
            '/108-selitra' => '/109-selitra-2',
            '/z-dnem-nezalezhnosti-ukrajini' => '/114-z-dnem-nezalezhnosti-ukrajini',
            '/115-s-dnem-nezavisimosti-ukrainy' => '/114-z-dnem-nezalezhnosti-ukrajini',
            '/shkoda-i-korist-gerbitsidiv' => '/16-vred-i-polza-gerbicidov',
            '/zastosuvannya-gerbicidiv-u-gorodi' => '/18-primenenie-gerbitsidov-v-ogorode',
            '/vidi-i-diya-insektitsidiv' => '/24-vidy-i-dejstvie-insektitsidov',
            '/rodentitsidi-prekrasni-zasobi-u-borotbi-z-grizunami' => '/32-rodentitsidy-prekrasnye-sredstva-v-borbe-s-gryzunami',
            '/rodentitsidi-nadijnij-zakhist-dlya-posiviv-derev-chagarnikiv' => '/34-rodentitsidy-nadezhnaya-zashchita-dlya-posevov-derevev-kustarnikov',
            '/zastosuvannya-fumigantiv' => '/36-primenenie-fumigantov',
            '/navishcho-potribni-regulyatori-rostu-roslin' => '/46-zachem-nuzhny-regulyatory-rosta-rastenij',
            '/desikanti-pomichniki-agrariya-u-zbori-vrozhayu' => '/52-desikanty-pomoshchniki-agrariya-v-sbore-urozhaya',
            '/borotba-z-bur-yanami-robota-dlya-gerbitsidiv' => '/56-borba-s-sornyakami-rabota-dlya-gerbitsidov',
            '/zasobi-zakhistu-roslin' => '/58-sredstva-zashchity-rastenij',
            '/suchasni-zasobi-zakhistu-roslin' => '/60-sovremennye-sredstva-zashchity-rastenij',
            '/gerbicid-evrolajting' => '/66-evrolajting-gerbicid-2',
            '/raundap-gerbicid' => '/67-gerbicid-raundap',
            '/granstar-gerbicid' => '/69-gerbicid-granstar',
            '/gerbicid-dlja-sonjashnika' => '/71-gerbicid-dlja-podsolnuha',
            '/gerbicidi-dlja-kukurudzi' => '/73-gerbicidy-dlja-kukuruzy',
            '/gerbicidi-sucilnoi-dii' => '/75-gerbicidy-sploshnogo-dejstvija',
            '/gruntovi-gerbicidi' => '/77-pochvennye-gerbicidy',
            '/ukravit-gerbicidy' => '/80-ukravit-gerbicidy',
            '/79-gerbicidy-ukravit' => '/80-ukravit-gerbicidy',
            '/matador-protruynik' => '/86-matador-protruynik',
            '/85-matador-protravitel' => '/86-matador-protruynik',
            '/sidoprid-protruynik' => '/88-sidoprid-protruynik',
            '/87-sidoprid-protravitel' => '/88-sidoprid-protruynik',
            '/fungitsidyi-dlya-vinogradu' => '/91-fungitsidyi-dlya-vinogradu',
            '/90-fungitsidyi-dlya-vinograda' => '/91-fungitsidyi-dlya-vinogradu',
            '/fungitsid-na-zernovyi' => '/93-fungitsid-na-zernovyi',
            '/92-fungitsid-na-zernovyie' => '/93-fungitsid-na-zernovyi',
            '/selfos-fumigant' => '/95-selfos-fumigant',
            '/94-fumigant-selfos' => '/95-selfos-fumigant',
            '/hlorpirivit-insektitsid' => '/97-hlorpirivit-insektitsid',
            '/96-insektitsid-hlorpirivit' => '/97-hlorpirivit-insektitsid',
            '/insektitsid-fas' => '/99-insektitsid-fas',
            '/98-fas-insektitsid' => '/99-insektitsid-fas',
            '/81-protravitel-zernovyh' => '/protrujniki-nasinnja',
            '/83-protravitel-reksil-ultra' => '/protrujnik-reksil-ultra'
        ];
        foreach($listForRedirects as $old => $new) {
            if (!empty($pathInfo) && strpos($pathInfo, $old))
                return $this->redirect('/' . str_replace($old, $new, $pathInfo), 301);
        }

        if (!$model)
            throw new \yii\web\NotFoundHttpException();

        return $this->render('view', compact('model'));
    }
    
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }
}

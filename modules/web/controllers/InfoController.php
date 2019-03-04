<?php
namespace app\modules\web\controllers;

use app\models\Advertising;
use app\models\InfoSlider;
use app\models\InfoTabs;
use app\models\InfoTabsContent;
use app\modules\web\models\PartnerForm;
use Yii;

class InfoController extends Controller{
    public $layout = 'info';

    public function beforeAction($action) {
        $tabs = InfoTabs::find()->all();
        $this->view->params['tabs'] = $tabs;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $issues = InfoTabsContent::find()->where(['info_tabs_id' => 1])->orderBy('publishing_date DESC')->limit(4)->all();
        $interviews = InfoTabsContent::find()->where(['info_tabs_id' => 2])->orderBy('publishing_date DESC')->limit(4)->all();
        $reportages = InfoTabsContent::find()->where(['info_tabs_id' => 3])->orderBy('publishing_date DESC')->limit(6)->all();
        $articles = InfoTabsContent::find()->where(['info_tabs_id' => 4])->orderBy('publishing_date DESC')->limit(6)->all();
        $specialProjects = InfoTabsContent::find()->where(['info_tabs_id' => 5])->orderBy('publishing_date DESC')->limit(3)->all();
        $about = InfoTabsContent::find()->where(['info_tabs_id' => 6])->orderBy('publishing_date DESC')->limit(4)->all();
        $blog = InfoTabsContent::find()->where(['info_tabs_id' => 7])->orderBy('publishing_date DESC')->limit(4)->all();
        $slides = InfoSlider::find()->orderBy('id DESC')->all();
        $advertising = Advertising::find()->limit(3)->all();
        //$numbers = InfoTabsContent::find()->select('number')->distinct()->where(['info_tabs_id'=> $info_id])->orderBy('number DESC')->all();
        //$countNumbers = InfoTabsContent::find()->select(['number', 'count(number) as issue'])->groupBy('number')->all();
       return $this->render('index', compact('issues', 'interviews','reportages','articles','specialProjects','about','blog','tabsContent', 'slides','advertising'));
    }

    public function actionCategory($id){

        $category = InfoTabs::findOne(['slug' => $id]);
        if (!$category)
            $category = InfoTabs::findOne($id);
        if (!$category) {
            throw new \yii\web\NotFoundHttpException();
        }

        $tabsContent = InfoTabsContent::find()->where(['info_tabs_id' => $category->id])->orderBy('publishing_date DESC')->all();
        //$numbers = InfoTabsContent::find()->select('number')->distinct()->where(['info_tabs_id'=> $info_id])->orderBy('number DESC')->all();
        //$countNumbers = InfoTabsContent::find()->select(['number', 'count(number) as issue'])->groupBy('number')->all();
        return $this->render('category', compact('tabs','category', 'tabsContent', 'info_id'));
    }

    public function actionAddViews($infoTabsId){
        $id = $infoTabsId;
        $oneInfoTab = InfoTabsContent::find()->where(['id' => $id])->one();
        //$views = $oneInfoTab->views+1;
        $oneInfoTab->updateCounters(['views' => 1]);;
        return true;
    }

    public function actionView($article_id){
        $tabs = InfoTabs::find()->all();
        $this->actionAddViews($article_id);
        $tabsContent = InfoTabsContent::find()->where(['id'=>$article_id])->one();
        //$numbers = InfoTabsContent::find()->select('number')->distinct()->where(['id'=> $article_id])->orderBy('number DESC')->all();
        //$countNumbers = InfoTabsContent::find()->select(['number', 'count(number) as issue'])->groupBy('number')->all();
        return $this->render('view', compact('tabs','numbers', 'tabsContent'));
    }
}
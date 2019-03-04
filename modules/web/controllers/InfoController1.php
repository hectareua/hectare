<?php
namespace app\modules\web\controllers;

use app\models\InfoTabs;
use app\models\InfoTabsContent;
use Yii;

class InfoController extends Controller{
    public $layout = 'info';

    public function actionIndex($info_id=1){
        $tabs = InfoTabs::find()->all();
        $tabsContent = InfoTabsContent::find()->where(['info_tabs_id'=> $info_id])->all();
        $numbers = InfoTabsContent::find()->select('number')->distinct()->where(['info_tabs_id'=> $info_id])->orderBy('number DESC')->all();
        //$countNumbers = InfoTabsContent::find()->select(['number', 'count(number) as issue'])->groupBy('number')->all();
       return $this->render('index', compact('tabs','numbers', 'tabsContent', 'info_id'));
    }

    public function actionAddViews($infoTabsId){
        $id = $infoTabsId;
        $oneInfoTab = InfoTabsContent::find()->where(['id' => $id])->one();
        //$views = $oneInfoTab->views+1;
        $oneInfoTab->updateCounters(['views' => 1]);;
        return true;
    }

    public function actionView($info_tabs_id){
		 $this->actionAddViews($info_tabs_id);
        $tabs = InfoTabs::find()->all();
        $tabsContent = InfoTabsContent::find()->where(['id'=>$info_tabs_id])->all();
        $numbers = InfoTabsContent::find()->select('number')->distinct()->where(['id'=> $info_tabs_id])->orderBy('number DESC')->all();
        //$countNumbers = InfoTabsContent::find()->select(['number', 'count(number) as issue'])->groupBy('number')->all();
        return $this->render('view', compact('tabs','numbers', 'tabsContent'));
    }
}
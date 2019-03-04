<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SiteInfo;
use app\modules\admin\models\ContactSearch;
use yii\web\NotFoundHttpException;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class SiteInfoController extends Controller
{

    /**
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
       return $this->render('index', [
            'model' => SiteInfo::loadData(),
        ]);
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = SiteInfo::loadData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
}

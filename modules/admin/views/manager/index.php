<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджери';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <p>
        <?= Html::a('Додати менеджера', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Додати нагороди', ['manager-trophy/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Призначити нагороду', ['manager-trophy-relation/index'], ['class' => 'btn btn-default']) ?>
		<?= Html::a('План на менеджера', ['manager-sale-plan/index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'last_name',
            'phone',
            'job',
            'bd',
            'carma',
            'manager_type',
            // 'image.url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

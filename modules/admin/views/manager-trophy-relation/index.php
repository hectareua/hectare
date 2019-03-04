<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ManagerTrophyRelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Призначити нагороду';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-trophy-relation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Призначити нагороду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'manager_id', 'value'=>'manager.name'],
            ['attribute'=>'manager_trophy_id', 'value'=>'managerTrophy.desc_uk'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

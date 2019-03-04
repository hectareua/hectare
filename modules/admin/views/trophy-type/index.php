<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TrophyTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тип нагороди';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophy-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати тип нагороди', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_uk',
            'name_ru',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

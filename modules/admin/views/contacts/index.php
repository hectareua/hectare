<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Cоздать контакты ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'c_id',
            'c_name',
            'c_approved',
            'c_rating',
			'c_type',
            'c_body:ntext',
            // 'c_created',
            // 'c_amended',
            // 'c_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

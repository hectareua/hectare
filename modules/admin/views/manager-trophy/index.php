<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ManagerTrophySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Нагороди менеджерів';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-trophy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати нагороду', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Тип нагороди', ['trophy-type/index'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desc_uk',
            'desc_ru',
            [
                'attribute' => 'image.url',
                'label' => 'Картинка',
                'format' => ['image', ['width' => '90px']],
                'contentOptions'=>['style'=>'max-width: 100px;']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ClientTypeBonusRelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бонус закріплений за менеджером';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-bonus-rel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Закріпити бонус за менеджером', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ctypeBonus.name_bonus_uk',
            'user.client.BillingFullName',
            [
                'attribute' => 'confirm',
                'filter' => [
                    '1' => 'Так',
                    '0' => 'Ні'
                ],

                'value' => function ($model) {
                    $type = [
                        '1' => 'Так',
                        '0' => 'Hi'
                    ];
                    return $type[$model->confirm];
                }
            ],
            'created_at',

            'show_ones',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

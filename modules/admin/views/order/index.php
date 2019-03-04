<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            // 'client_id',
            ['attribute'=>'payment_system_id', 'value'=>'paymentSystem.name_uk'],
            ['attribute'=>'status_id', 'value'=>'status.name_uk'],
            'ordered_at',
            //['attribute'=>'is_one_c_order', 'value'=>'is_one_c_order'],
            [
                'label' => '1C order',
                'attribute' => 'is_one_c_order',
                'filter' => [
                    '1' => 'Так',
                    '0' => 'Ні'
                ],

                'value' => function ($model) {
                        $type = [
                            '1' => 'Так',
                            '0' => 'Hi'
                        ];
                        return $type[$model->is_one_c_order];
                    }
            ],
            //'is_one_c_order',
            //'billing_city',
            // 'billing_region',
            // 'billing_phone',
            // 'billing_email:email',
            // 'delivery_fullname',
            // 'delivery_address',
            // 'delivery_city',
            // 'delivery_region',
            // 'delivery_country_id',
            // 'delivery_phone',
            // 'comment:ntext',



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

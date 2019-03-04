<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductPricesEnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Питання про партнерьскі ціни';
$this->params['breadcrumbs'][] = ['label' => 'Форми', 'url' => ['forms/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'product_name', 'value'=>'product.name_uk'],
            ['attribute'=>'user_name', 'value'=>'user.login'],
            'name',
            'email:email',
            'asked_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>
</div>

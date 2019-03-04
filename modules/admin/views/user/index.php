<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити користувача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'login',
            'client.billing_first_name',
            'client.billing_last_name',
            'client.billing_phone',
            // 'password_hash',
            // 'auth_key',
            // 'password_reset_token',
            'email:email',
            // 'is_admin',
            // 'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

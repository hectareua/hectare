<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ClientTypeBonusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бонуси';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-bonus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати бонус', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Закріплені бонуси за менеджерами', ['client-type-bonus-rel/index'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_bonus_uk',
            'clientType.name_uk',
            'manufacturer.name',
            'bonus_one',
            'bonus_all',
            'date_from',
            // 'date_to',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

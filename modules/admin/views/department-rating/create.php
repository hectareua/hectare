<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentRating */

$this->title = 'Додати голос';
$this->params['breadcrumbs'][] = ['label' => 'Рейтинг голосування', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

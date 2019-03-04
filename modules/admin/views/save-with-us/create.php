<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SaveWithUs */

$this->title = 'Строрити сторінку';
$this->params['breadcrumbs'][] = ['label' => 'Економте з нами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="save-with-us-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

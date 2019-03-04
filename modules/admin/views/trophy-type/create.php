<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrophyType */

$this->title = 'Додати тип нагороди';
$this->params['breadcrumbs'][] = ['label' => 'Тип нагороди', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trophy-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

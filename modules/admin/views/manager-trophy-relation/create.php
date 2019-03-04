<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophyRelation */

$this->title = 'Додати';
$this->params['breadcrumbs'][] = ['label' => 'Призначити нагороду', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-trophy-relation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'manager' => $manager,
        'trophy' => $trophy
    ]) ?>

</div>

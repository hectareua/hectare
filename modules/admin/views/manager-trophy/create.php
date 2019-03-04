<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ManagerTrophy */

$this->title = 'Додати нагороду';
$this->params['breadcrumbs'][] = ['label' => 'Нагороди менеджерів', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-trophy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'trophyType' => $trophyType,
    ]) ?>

</div>

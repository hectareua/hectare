<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FieldOption */

$this->title = 'Додати варіант';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => 'Поля', 'url' => ['field/index']];
$this->params['breadcrumbs'][] = ['label' => 'Варіанти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fields' => $fields,
    ]) ?>

</div>

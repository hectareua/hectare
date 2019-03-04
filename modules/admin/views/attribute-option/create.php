<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AttributeOption */

$this->title = 'Додати варіант';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибути', 'url' => ['attribute/index']];
$this->params['breadcrumbs'][] = ['label' => 'Варіанти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>

</div>

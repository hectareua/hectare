<?php

use yii\helpers\Html;



$this->title = 'Додати випуск';
$this->params['breadcrumbs'][] = ['label' => 'Гектар INFO', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'infoTabs' => $infoTabs,
    ]) ?>

</div>

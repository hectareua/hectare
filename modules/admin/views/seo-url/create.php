<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SeoUrl */

$this->title = 'Create Seo Url';
$this->params['breadcrumbs'][] = ['label' => 'Seo Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-url-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

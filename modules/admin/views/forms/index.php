<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\sidenav\SideNav;

/* @var $this yii\web\View */
/* @var $model app\models\UserReview */

$this->title = "Форми";
$this->params['breadcrumbs'][] = $this->title;
?>

<?= SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,

    'options'=>['containerOptions'=>['style'=>['width'=>'100', 'margin'=>'0', 'pading'=>'0'],],],
    'heading' => 'Форми',
    'items' => $forms,
]) ?>

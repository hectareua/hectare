<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ForumMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'forum_id')->dropdownList($model->getAllforums()) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

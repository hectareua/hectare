<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="review-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'product.name_uk',
            'user.login',
            // 'is_visible',
            'name',
            'phone',
            'email:email',
            'text:ntext',
            'posted_at',
            'rating'
        ],
    ]) ?>
</div>
<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_visible')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

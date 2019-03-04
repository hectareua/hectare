<?php
use app\components\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$this->title = $model->seoTitle?$model->seoTitle:$model->name;
if ($model->seoDescription)
    $this->registerMetaTag(['name' => 'description', 'content' => $model->seoDescription], 'description');
if ($model->seoKeywords)
    $this->registerMetaTag(['name' => 'keywords', 'content' => $model->seoKeywords], 'keywords');
?>
<div class="wrapper">
    <ol class="breadcrumbs">
        <li class="breadcrumbs__item"><a href="<?=Url::to(['default/index'])?>"><?=Yii::t('web', 'Главная')?> » </a></li>
        <li class="breadcrumbs__item"><a href="<?=Url::to(['forum/index'])?>"><?=Yii::t('web', 'Форум')?> » </a></li>
        <li class="breadcrumbs__item"><?=$model->name?></li>
    </ol>
    <div class="news">
        <div class="news-list">
            <div class="news-list-item">
                <div class="news-list-item__title"><?=$model->name?></div>
                <?php if ($model->image): ?>
                    <div class="news-list-item__img" style="background-image: url(<?=$model->image->url?>)"></div>
                <?php endif; ?>
                <div class="news-list-item__content"><?=$model->text?></div>
            </div>
        </div>
    </div>
    <div class="forum-new">
        <h2 class="forum-new__title"><?=Yii::t('web', 'Комментарии')?></h2>
        <ul class="forum-new-list">
            <?php foreach($model->forumMessages as $i => $forumMessage): ?>
                <li class="forum-new-list-item">
                    <div class="forum-new-list-item-header">
                        <div class="forum-new-list-item-header__id">#<?=$i+1?></div>
                        <div class="forum-new-list-item-header__from"><?=$forumMessage->user->name?></div>
                        <div class="forum-new-list-item-header__date"><?=$forumMessage->created_at?></div>
                    </div>
                    <div class="forum-new-list-item__content"><?=$forumMessage->text?></div>
                    <!-- <div class="forum-new-list-item__rate">+1</div> -->
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- <div class="forum-new__more">Показать еще</div> -->

        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="comment">
                <?php $form = ActiveForm::begin() ?>
                    <h2 class="comment__title"><?=Yii::t('web', 'Добавить комментарий')?></h2>
                    <?=$form->field($message, 'text')->label(false)->error(false)->textArea(['class' => 'comment__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
                    <input type="submit" class="comment__submit" value="<?=Yii::t('web', 'Отправить')?>">
                <?php ActiveForm::end() ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="space"></div>



</div>

<h1>Нове повідомлення на форумі</h1>

<?php if ($model->forum): ?>
    <div>Тема: <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/web/forum/view', 'forum_id' => $model->forum->id]);?>">
        <?=$model->forum->name?>
    </a></div>
<?php endif; ?>
<div>Ім'я: <?=$model->user->name?></div>
<div>Повідомлення: <?=$model->text?></div>

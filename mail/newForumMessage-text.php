Нове повідомлення на форумі

<?php if ($model->forum): ?>
Тема: <?=$model->forum->name?>
URL: <?=Yii::$app->urlManager->createAbsoluteUrl(['/web/forum/view', 'forum_id' => $model->forum->id]);?>
<?php endif; ?>

Ім'я: <?=$model->user->name?>

Повідомлення: <?=$model->text?>

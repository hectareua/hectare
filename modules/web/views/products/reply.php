<?php
use yii\widgets\ActiveForm;
use app\models\User;
?>
<div class="reviews-list-item__content_reply" data-uid="<?=$reply->user_id ?>">
    <?php if ($reply->user_id<3) { ?>
        <div class="rewiewlabel"><?=$reply->name;?></div>
    <?php }; if (User::findOne(['id' => $reply->user_id])->ctype == 2 && User::findOne(['id' => $reply->user_id])->ctypeid == $model->manufacturer_id){ ?>
        <img src="<?=$manufacter->logo?>" alt="logo" style="width: 90px; "/>
        <?=$reply->name;?>
    <?php } ?>
    <br/>
    <?=$reply->text?><br/>
    <span class="like-span">
            <span class="reply-comment" data-id="<?=$reply->id ?>" style="font-size: 12px; cursor: pointer">
                <img src="/img/reply.png" style="width: 14px; height: 14px">
                <?=Yii::t('web', 'Ответить')?> </span>
            <i id="like<?=$reply->id ?>" data-type="1" data-id="<?=$reply->id ?>" class="glyphicon glyphicon-thumbs-up"></i>
            <div class="like-value" id="like<?=$reply->id ?>-bs3"><?=count($reply->likes) ?></div>
            <i id="dislike<?=$reply->id ?>" data-type="0" data-id="<?=$reply->id ?>" class="glyphicon glyphicon-thumbs-down"></i>
            <div class="like-value" id="dislike<?=$reply->id ?>-bs3"><?=count($reply->dislikes) ?></div>
    </span>
    <div class="messagecomment hidden"  id="messagecomment<?=$reply->id ?>">
        <?php $form = ActiveForm::begin() ?>
        <?php if (Yii::$app->user->identity->ctypeid == $model->manufacturer_id){?>
            <img src="<?=$manufacter->logo?>" alt="logo" style="width: 90px; height: 15px"/>
            <?=$form->field($review, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя'), 'value' => $manufacter->name]) ?>
        <?php }else{ ?>
            <?=$form->field($review, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
        <?php } ?>
        <?=$form->field($review, 'parent_id')->label(false)->error(false)->input('hidden', ['class' => 'message__input', 'required'=>'', 'style'=>'display:none']) ?>
        <!-- <?=$form->field($review, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>-->
        <?=$form->field($review, 'phone', ['inputOptions' => ['id' => 'phone_id']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999',])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'style'=>'display:none', 'value'=>'+38(111)11-11-111', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
        <?=$form->field($review, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
        <input type="hidden" name="chk" id="chk" value="chk">
        <div class="text-center btnsblock">
            <input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <input type="button" class="message_cancel" value="<?=Yii::t('web', 'Отменить')?>">
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
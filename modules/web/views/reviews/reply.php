<?php
use yii\widgets\ActiveForm;
?>
<div class="reviews-list-item__content_reply" data-uid="<?=$reply->user_id ?>" data-cid="<?= $reply->user_id ?>" data-ctid="<?= (($reply->user->ctype==2)&&($reply->user->ctypeid))?($reply->user->ctypeid):''?>" style="<?= (($reply->user->ctype==2)&&($reply->user->ctypeid))?('background:url('.$reply->user->manufacturer->logo.') no-repeat 10px 50%;background-size: 49px; padding-left:65px'):''?>">
    <?php if ($reply->user_id<3 && $reply->user_id !='') { ?>
        <div class="rewiewlabel"><?=Yii::t('web', 'Гектар')?></div>
    <?php }else{ ?>
        <div class="rewiewlabel"><?=$reply->name?></div>
    <?php } ?>
    <?=$reply->text?>
    <br/>
    <span class="reply-comment" data-id="<?=$reply->id ?>" style="font-size: 12px; cursor: pointer">
                            <img src="/img/reply.png" style="width: 14px; height: 14px">
        <?=Yii::t('web', 'Ответить')?> </span>
    <span class="toRight">
    <i id="like<?=$reply->id ?>" data-type="1" data-id="<?=$reply->id ?>" class="glyphicon glyphicon-thumbs-up"></i>
        <div class="like-value" id="like<?=$reply->id ?>-bs3"><?=$reply->likes == null ? 0:$reply->likes ?></div>
    <i id="dislike<?=$reply->id ?>" data-type="0" data-id="<?=$reply->id ?>" class="glyphicon glyphicon-thumbs-down"></i>
    <div class="like-value" id="dislike<?=$reply->id ?>-bs3"><?=$reply->dislikes == null ? 0:$reply->dislikes ?></div>
    </span>
</div>
    <div class="messagecomment hidden"  id="messagecomment<?=$reply->id ?>">
        <?php $form = ActiveForm::begin() ?>
        <?php if (Yii::$app->user->identity->ctype == 2){?>
            <img src="<?=$manufacter->logo?>" alt="logo" style="width: 90px; height: 15px"/>
            <?=$form->field($model, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя'), 'value' => $manufacter->name]) ?>
        <?php }else{ ?>
            <?=$form->field($model, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
        <?php } ?>
        <?=$form->field($model, 'parent_id')->label(false)->error(false)->input('hidden', ['class' => 'message__input', 'required'=>'', 'style'=>'display:none']) ?>
        <!-- <?=$form->field($model, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>-->
        <?=$form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'style'=>'display:none', 'value'=>'+38(111)11-11-111', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
        <?=$form->field($model, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
        <input type="hidden" name="chk" id="chk" value="chk">
        <div class="text-center btnsblock">
            <input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <input type="button" class="message_cancel" value="<?=Yii::t('web', 'Отменить')?>">
        </div>
        <?php ActiveForm::end() ?>

    </div>
</div>
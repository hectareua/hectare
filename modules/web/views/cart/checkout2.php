<?php
use app\components\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$this->title = Yii::t('web', 'Оформление заказа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
$this->registerJsFile('@web/js/jquery.maskedinput.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/bootstrap.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/bootstrap.min.css');
$this->registerCss("
a.orderForm-main__submit:hover {
color:#fff;
cursor:pointer;
}

.bank_image {
    height: 40px;
    width: 40px;
    border-radius: 5px;
    background-size: cover;
    background-position: 50%;
    top: 0;
    left: 0;
    margin-right: 5px;
    float:left;
}

table.table.table-bordered.table-credits td {
    border-left: 0;
    border-right: 0;
}
table.table.table-bordered.table-credits th {
    border-left: 0;
    border-right: 0;
}


.table-credits > thead > tr > th{
  border-bottom-width: 1px;
  text-align: center;
}
.table-credits > tbody > tr > td{
  vertical-align: middle;
  text-align: center;
}
.table-credits > thead > tr > th > i.fa{
  margin: 0 5px 0 0;
}
.table-credits > tbody > tr > td.credit-name{
  text-align: left;
    min-width: 185px;
}

.table-credits {
border:none;
border-collapse: collapse;
margin:0 auto;
}

.table-credits td {
border-left: 1px solid #000;
border-right: 1px solid #000;
}

.table-credits td:first-child {
border-left: none;
}

.table-responsive{
    overflow-y: hidden;
    overflow-x: hidden;
}

.table-credits td:last-child {
border-right: none;
}
");
$this->registerJs('

$("#order-delivery_phone").mask("+38(999) 999-9999");

$("#orderForm").on("submit",function( e ) {

if($("#makeOrder").attr("data-id")) {
   e.preventDefault();
};

});


$("#makeOrder").on("click", function() {
   var id = $(this).attr("data-id");
   $("#paymentMethod").val(id);
    console.log($("#orderForm"));
    var fullname = $.trim($("#order-delivery_fullname").val());
    var phone = $.trim($("#order-delivery_phone").val());
    var city = $.trim($("#order-delivery_city").val());
    if ((fullname != "" )&&(phone != ""))&&(city != "")) {

        form = $("#orderForm");
        if(form.find(".has-error").length) {
            return false;
        }

        $.ajax({
            url: form.attr("action"),
            type: "post",
            data: form.serialize(),
            success: function(data) {
                console.log(data);

                //$("#pay_parts_form").submit();
                if ((fullname != "" )&&(phone != ""))&&(city != "")) {
                    document.getElementById("payments").submit();
                }
            }
        });

   }
   //return false;
});

//$("form#payments").attr("action", $("form#payments").attr("action") +"/"+ "pay-parts");

/*$("input[name=\"Order[payment_system_id]\"]").change(function() {
    if(this.checked) {
     var action = $("form#payments").attr("action");
     $("form#payments").attr("action", action +"/"+ $(this).attr("data-method"));
        console.log($(this).attr("data-method"));
    }
});*/

$("#payments").submit(function( event ) {
console.log("hello_3");
event.preventDefault();
});



');
?>

<div class="order" ng-app>
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
                itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
                itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Оформление заказа')?></span> <meta itemprop="position" content="1" /> </li>


        </ol>
        <div class="order__title"><?=Yii::t('web', 'Оформление заказа')?></div>
        <?php if (Yii::$app->user->isGuest): ?>
            <?php $form = ActiveForm::begin(['action' => ['user/login', 'returnUrl' => Url::current()], 'options' => ['class' => 'order-login']]) ?>
            <div class="order-login__text"><?=Yii::t('web', 'Вход')?></div>
            <?=$form->field($loginForm, 'username')->label(false)->error(false)->input('text', ['class' => 'order-login__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Логин')])?>
            <?=$form->field($loginForm, 'password')->label(false)->error(false)->input('password', ['class' => 'order-login__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Пароль')])?>
            <input type="submit" class="order-login__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end() ?>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'orderForm', 'id' => 'orderForm']]); ?>
        <div class="orderForm-sidebar">
            <div class="orderForm-sidebar__title"><?=Yii::t('web', 'Данные по доставке')?></div>
            <div class="orderForm-sidebar__error">
                <?php if ($errors = $model->getErrors()): ?>
                    <?php foreach ($errors as $error): ?>
                        <?=$error[0]?><br>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($errors = $userForm->getErrors()): ?>
                    <?php foreach ($errors as $error): ?>
                        <?=$error[0]?><br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?=$form->field($model, 'delivery_fullname')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'ФИО').'*', 'required' => ''])?>
            <?=$form->field($model, 'delivery_phone')->label(false)->error(false)->input('tel', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
            <?=$form->field($model, 'delivery_city')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Город').'*', 'required' => ''])?>
            <?=$form->field($model, 'delivery_address')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Адрес')])?>
            <?php if (Yii::$app->user->isGuest): ?>
                <div class="orderForm-sidebar-item">
                    <input ng-init="show_registration = !!<?=(int)$register?>" ng-model="show_registration" value="1" name="register" type="checkbox" class="orderForm-sidebar__checkbox" id="orderForm-sidebar__checkbox"><label for="orderForm-sidebar__checkbox" class="orderForm-sidebar__label">Зарегистрироваться</label>
                </div>
                <div class="orderForm-sidebar__additional" ng-if="show_registration">
                    <?=$form->field($userForm, 'login')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Логин').'*', 'required' => ''])?>
                    <?=$form->field($userForm, 'passwordValue')->label(false)->error(false)->input('password', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Пароль').'*', 'required' => ''])?>
                    <?=$form->field($userForm, 'passwordConfirmation')->label(false)->error(false)->input('password', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Подтвердить пароль').'*', 'required' => ''])?>
                </div>
            <?php endif; ?>

            <?php if ($purchaseType == 0): ?>
                <div class="orderForm-sidebar__title"><?=Yii::t('web', 'Способ оплаты')?></div>
            <?php endif; ?>

            <ul class="orderForm-sidebar-radiobuttonList">
                <?php foreach ($paymentSystems as $paymentSystem): ?>
                    <?php if (($paymentSystem->type == 1 )&&($purchaseType == 0)): ?>
                        <ul class="orderForm-sidebar-radiobuttonList">
                            <li class="orderForm-sidebar-radiobuttonList-item">
                                <input required type="radio" name="Order[payment_system_id]" id="payment_method_<?=$paymentSystem->id?>" value="<?=$paymentSystem->id?>" <?=($paymentSystem->id==$model->payment_system_id)?'checked':''?> class="orderForm-sidebar-radiobuttonList-item__radio">
                                <label for="payment_method_<?=$paymentSystem->id?>" class="orderForm-sidebar-radiobuttonList-item__label"><?=$paymentSystem->name?></label>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (($paymentSystem->type == 0 )&&($purchaseType == 1)): ?>
                        <input type="hidden" name="Order[payment_system_id]" id="paymentMethod" value="">
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div><div
            class="orderForm-main">
            <div class="orderForm-main__title"><?=Yii::t('web', 'Информация о заказе')?></div>
            <div class="orderForm-main-itemList">
                <div class="orderForm-main-itemList-header">
                    <div class="orderForm-main-itemList-header__photo"><?=Yii::t('web', 'фото')?></div><div
                        class="orderForm-main-itemList-header__name"><?=Yii::t('web', 'наименование')?></div><div
                        class="orderForm-main-itemList-header__quantity"><?=Yii::t('web', 'количество')?></div><div
                        class="orderForm-main-itemList-header__price"><?=Yii::t('web', 'сумма')?></div>
                </div>
                <?php foreach ($cart as $cartItem): ?>
                    <div class="orderForm-main-itemList-item">
                        <div class="orderForm-main-itemList-item__photo" style="background-image: url(<?=$cartItem->product->image->url?>)"></div><div
                            class="orderForm-main-itemList-item__name">
                            <!-- Арт: <?=$cartItem->product_id?> <br> -->
                            <?=$cartItem->product->name?>
                            <?php foreach ($cartItem->attributeValues as $attributeValue): ?>
                                <br><?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                            <?php endforeach; ?>
                        </div><div
                            class="orderForm-main-itemList-item__quantity"><?=$cartItem->amount?></div><div
                            class="orderForm-main-itemList-item__price"><?=number_format($cartItem->totalPrice, 2)?> грн.</div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="orderForm-main__totalPrice"><?=Yii::t('web', 'К оплате')?> <span><?=number_format($totalPrice, 2)?></span> грн</div>
            <div class="orderForm-main__title"><?=Yii::t('web', 'Комментарии')?></div>
            <?=$form->field($model, 'comment')->label(false)->error(false)->textArea(['class' => 'orderForm-main__textarea'])?>

            <?php if ($purchaseType == 0): ?>
                <input type="submit" class="orderForm-main__submit" value="<?=Yii::t('web', 'Оформить заказ')?>" onclick="yaCounter44862661.reachGoal('oformit_pokupku'); return true;">
            <?php endif; ?>
            <?php if ($purchaseType == 1): ?>
                <a  style="text-align:center; padding-top:20px; text-decoration:none;" class="orderForm-main__submit" data-toggle="modal" data-target="#myModal"><?= Yii::t('web','Выбрать банк') ?></a>
            <?php endif; ?>
        </div>
        <?php ActiveForm::end(); ?>

        <!-- Modal -->
        <div class="modal fade" style="position:fixed; overflow-y:hidden; width:53rem; height:22rem;" id="myModal" role="dialog">
            <div class="modal-dialog" style="margin-top: 0px; display:table; height: 100%; width: 100%;">

                <!-- Modal content-->
                <div class="modal-header">
                    <div class="modal__title">Оплата</div>
                    <div class="modal__close"></div>
                    <div class="modal__close" data-dismiss="modal"></div>
                </div>
                <div id="myModalNew" name="dialog"></div>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered table-credits">
                    <thead>
                    <tr>
                        <th class="credit-name">
                            Банк
                        </th>
                        <th class="credit-term">
                            <i class="fa fa-clock-o" aria-hidden="true"></i><?= Yii::t('web','Виды кредита') ?>
                        </th>
                        <th class="credit-first-payment">
                            <?= Yii::t('web','Первый взнос') ?>
                        </th>
                        <th class="credit-grace-period">
                            <?= Yii::t('web','Льготный период') ?>
                        </th>
                        <th class="credit-monthly-payment">
                            <?= Yii::t('web','Ежемес. Платеж') ?>
                        </th>
                        <th class="credit-types-credit">
                            <div class="row" style="width:200px;" >
                            <div class="col-sm-6"><?= Yii::t('web','Срок, мес.') ?></div>
                            <div class="col-sm-6"></div>
                           </div>
                        </th>

                    </tr>
                    </thead><!-- /.thead -->
                    <tbody>
                    <?php foreach ($paymentSystems as $paymentSystem): ?>
                        <?php if (($paymentSystem->type == 0 )&&($purchaseType == 1)): ?>
                            <tr>

                                <td class="credit-name">
                                    <div class="bank_image" style="background-image: url('<?= $paymentSystem->logo; ?>')"></div>
                                    <div class="name dotdotdot" style="word-wrap: break-word;"><?= $paymentSystem->name; ?></div>
                                </td>

                                <td class="credit">
                                    <?= $paymentSystem->description; ?>
                                </td>
                                <td class="credit">
                                    <?php if (!$paymentSystem->down_payment): ?>
                                        <?=Yii::t('web', 'Нет')?>
                                    <?php else: ?>
                                        <?= $paymentSystem->down_payment; ?>
                                    <?php endif; ?>

                                </td>
                                <td class="credit">
                                    <?php if (!$paymentSystem->grace_period): ?>
                                        ---
                                    <?php else: ?>
                                        <?= $paymentSystem->grace_period; ?>
                                    <?php endif; ?>

                                </td>
                                <td class="credit">
                                   <output style="display: inline;" name="part" id="PartId"><?=round(($totalPrice*100)/5)/100?></output>&nbsp;грн
                                </td>

                                <td class="credit">
                                    <form id="payments" action="<?=Url::to(['cart/'.$paymentSystem->method])?>"  method="POST" accept-charset="UTF-8">
                                        <div class="col-sm-5">
                                            <input type="hidden" name="amount" id="AmountId" value="<?=$totalPrice?>">
                                            <select name="PartsCountInput" id="PartsCountInputId"  onchange="$('#PartsCountOutputId').val($(this).val());  $('#PartId').val(Math.round(100*$('#AmountId').val()/$(this).val())/100);">
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5" selected="selected">5</option>
                                                <option value="6">6</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="12">12</option>
                                                <option value="14">14</option>
                                                <option value="16">16</option>
                                                <option value="18">18</option>
                                                <option value="24">24</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <button  id="makeOrder"  data-id=<?= $paymentSystem->id;?> form="orderForm" type="submit" class="btn btn-default"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?= Yii::t('web','Купить') ?></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody><!-- /.tbody -->
                </table><!-- /.table -->
            </div>

            </div>
        </div>
    </div>
</div>
</div>

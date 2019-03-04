<?php
use app\models\Order;

?>
<p>&nbsp;</p>
<div dir="ltr"><br />
    <div class="gmail_quote">
        <div>
            <table style="line-height: 100%;" border="0" width="794px" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                <tr valign="top">
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr class="m_4680003158654335374bg_gray" >
                    <td colspan="2">
                        <h3 style="background-color:#dddddd; font-size:16px; padding-bottom:2px;">Замовлення на поставку</h3>
                    </td>
                </tr>
                <tr>
                    <td style="height:10px; font-size:1px;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="50%">Номер замовлення:</td>
                    <td width="50%"><?= $model->id?></td>
                </tr>
                <tr>
                    <td>Дата замовлення:</td>
                    <td><?= date('m.d.Y', strtotime(Order::findOne($model->id)->ordered_at))?></td>
                 </tr>
                <tr>
                    <td>Статус замовлення:</td>
                    <td>Hе підтвердженний</td>
                </tr>
                <tr>
                    <td style="height: 10px; font-size:1px;">&nbsp;</td>
                </tr>
                <tr class="m_4680003158654335374bg_gray">
                    <td colspan="2" width="50%">
                        <h3 style="background-color:#dddddd; font-size:16px; padding-bottom: 2px;">Інформація про клієнта</h3>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top:10px;" width="50%">
                        <table style="line-height: 100%;" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td colspan="2"><strong>Рахунок</strong></td>
                            </tr>
                            <tr>
                                <td width="100">Повне Ім'я(П.І.П.):</td>
                                <td><?=$model->billing_fullname?></td>
                            </tr>
                            <tr>
                                <td>Місто:</td>
                                <td><?=$model->billing_city?></td>
                            </tr>
                            <tr>
                                <td>Область:</td>
                                <td><?=$model->billing_region?></td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td><?=$model->billing_phone?></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td><a href="mailto:<?=$model->billing_email?>"><?=$model->billing_email?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;" width="50%">
                        <table style="line-height: 100%;" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td colspan="2"><strong>Адреса доставки</strong></td>
                            </tr>
                            <tr>
                                <td width="100">Повне ім'я (П.І.П.)</td>
                                <td><?= $model->delivery_fullname?></td>
                            </tr>
                            <tr>
                                <td>Вулиця/Номер будинку:</td>
                                <td><?= $model->delivery_address?></td>
                            </tr>
                            <tr>
                                <td>Місто:</td>
                                <td><?= $model->delivery_city?></td>
                            </tr>
                            <tr>
                                <td>Область:</td>
                                <td><?=$model->delivery_region?></td>
                            </tr>
                            <tr>
                                <td>Країна:</td>
                                <td><?=$model->delivery_country_id?></td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td><?=$model->delivery_phone?></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="m_4680003158654335374bg_gray" colspan="2">
                        <h3 style="background-color:#dddddd;  font-size:16px; padding-bottom: 2px;" >Товари</h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px; padding-top: 10px;" colspan="2">
                        <table class="m_4680003158654335374table_items" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td style="vertical-align: top; padding-bottom: 5px; font-size: 1px;" colspan="5">&nbsp;</td>
                            </tr>
                            <tr class="m_4680003158654335374bold" >
                                <td style="padding-left: 10px; padding-bottom: 5px; border-top:1px solid #dddddd; border-bottom:1px solid #dddddd;" width="45%">Назва</td>
                                <td style="padding-bottom: 5px; border-top:1px solid #dddddd; border-bottom:1px solid #dddddd;" width="15%">Код товару</td>
                                <td style="padding-bottom: 5px; border-top:1px solid #dddddd; border-bottom:1px solid #dddddd;" width="10%">Кількість</td>
                                <td style="padding-bottom: 5px; border-top:1px solid #dddddd; border-bottom:1px solid #dddddd;" width="15%">&nbsp;Ціна за одиницю</td>
                                <td style="padding-bottom: 5px; border-top:1px solid #dddddd; border-bottom:1px solid #dddddd;" width="15%">&nbsp;Сума</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-bottom: 10px; font-size: 1px;" colspan="5">&nbsp;</td>
                            </tr>
                            <?php foreach($model->orderProducts as $orderProduct): ?>
                            <tr class="m_4680003158654335374vertical">
                                <td>

                                    <div class="m_4680003158654335374jshop_cart_attribute"><?=$orderProduct->product->name?>
                                            <?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
                                                <?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                                            <?php endforeach; ?>
                                    </div>
                                </td>
                                <td><?= $orderProduct->product->id ?></td>
                                <td><?=$orderProduct->amount?></td>
                                <td><?=number_format($orderProduct->product->orderPrice($orderProduct->amount)/$orderProduct->amount, 2)?> грн.</td>
                                <td><?=number_format($orderProduct->product->orderPrice($orderProduct->amount), 2)?> грн.</td>
                            </tr>
                            <?php endforeach; ?>

                            <tr>
                                <td style="vertical-align: top; padding-bottom: 10px; font-size: 1px;" colspan="5">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding-right: 15px;  border-top:1px solid #dddddd;" colspan="4" align="right"><strong>Всього до сплати:</strong></td>
                                <td class="m_4680003158654335374price" style="border-top:1px solid #dddddd;"><strong><?=number_format($model->price, 2)?> грн</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="m_4680003158654335374bg_gray">
        <td>
             <strong>Інформація про платіж:&nbsp;</strong><?=$model->paymentSystem->name?></div>
        </td>
        <td>
            <?php if ($model->comment): ?>
                <div>Коментар: <?=$model->comment?></div>
            <?php endif; ?>
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['admin/order/view/', 'id' => $model->id])?>">Переглянути</a
        </td>
        <td valign="top">
            <div style="font-size: 11px;">&nbsp;</div>
        </td>
        </tr>
        <tr>
            <td style="height: 5px; font-size: 1px;">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
        </tr>
        </tbody>
        </table>
    </div>
</div>
</div>




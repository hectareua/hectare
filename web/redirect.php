<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require(__DIR__ . '/../vendor/autoload.php');

use PayParts\PayParts;

session_start();

$pp = new PayParts('4AAD1369CF734B64B70F', '75bef16bfdce4d0e9c0ad5a19b9940df');
$getState = $pp->getState($_SESSION['OrderID'], false); //orderId, showRefund
var_dump($getState);
/*можно ожидать результат платежа который пришёл в ResponseUrl*/
var_dump($_SESSION['OrderID']);

if ($getState['paymentState'] === 'SUCCESS') {
    echo 'SUCCESS';
    /*проводим проводки на магазине оплата прошла
    если был создан Отложенный платеж то делаем подтверждение
    $ConfirmHold=$pp->ConfirmHold($_SESSION['OrderID']);
    или отказываемся если нужно
    $CancelHold=$pp->CancelHold('ORDER-D3AE1082C5E2F81F2A904EAC3DB990E0A8F211B0'
    анализируем $ConfirmHold там будет результат операции*/
} else {
    echo $getState['paymentState'];
    /*есть ошибки в оплате или отказ*/
}





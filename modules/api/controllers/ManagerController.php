<?php

namespace app\modules\api\controllers;

use app\models\ClientDiscountCard;
use app\models\ClientTypeSale;
use app\models\Manager;
use app\models\ManagerBonus;
use app\models\SaleRating;
use app\models\User;
use Yii;

class ManagerController extends ApiController
{
    public function actionIndex() {
        $auth_key = Yii::$app->request->post('auth_key');
        if (!$auth_key) return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
        $user = User::findOne(['auth_key' => $auth_key]);
        if (!$user) return null;

        return $user->getManager()->one();
    }
	
	public function actionImport() {
        $xml = file_get_contents("php://input");
        //$xml = file_get_contents('https://hectare.com.ua/web/xml/manager.xml');
        $array = simplexml_load_string($xml);

        if($array){
            $month = (string)$array['month'];
            $month = date('Y-d-m', strtotime(str_replace('.','/',$month)));
            foreach ($array->SalesRating->record as $sales){
                $managerId = (string)$sales->Manager['id'];
                $managerName = (string)$sales->Manager;
                $sumSales = str_replace(',','.',(string)$sales->Summa);
                $type = 1; //1 manager
                //$this->checkManager($managerId, $managerName);
                $this->insertSales($managerId, $sumSales, $month, $type);
            }
            foreach ($array->SalesStores->record as $sales) {
                $storeId = (string)$sales->Store['id'];
                $sumSales = str_replace(',','.',(string)$sales->Summa);
                $type = 2; //2 store
                $this->insertSales($storeId, $sumSales, $month, $type);
            }
            foreach ($array->BonusManager->record as $bonus) {
                $managerId = (string)$bonus->Manager['id'];
                $sumBonus = str_replace(',','.',(string)$bonus->Summa);
                $this->insertBonus($managerId, $sumBonus, $month);
            }
            foreach ($array->DiscountCards->record as $card) {
                $clientId = (string)$card->Client['id'];
                $name = (string)$card->Client;
                $discCard = (string)$card->Card;
                $phone = (string)$card->telephone;
                $this->insertDiscount($clientId, $name, $discCard, $phone);
            }
            return '200';
        }else{
            return '400';
        }
        //$data = Yii::$app->request->post('auth_key');
        //if (!$data) return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
        //$user = User::findOne(['auth_key' => $auth_key]);
        //if (!$user) return null;


    }

    private function insertSales($manager, $sumSales, $month, $type){
            $checkSale = $this->checkSale($manager, $sumSales, $month);
            //echo $managerName;
            if(!$checkSale){
                $saleRating = new SaleRating();
                $saleRating->code1c = $manager;
                $saleRating->sale_sum = (float)$sumSales;
                $saleRating->rating_date = $month;
                $saleRating->type = $type;
                $saleRating->save();
            }
    }

    private function checkSale($manager, $sumSales, $month)
    {
        $salesRatingMan = SaleRating::find()->where(['code1c' => $manager,  'rating_date' => $month])->one();
        if(is_object($salesRatingMan)){
            SaleRating::updateAll(['sale_sum' => (float)$sumSales, 'updated_at' => date('Y-m-d H:i:s')], ['code1c' => $manager,  'rating_date' => $month]);
            return true;
        }else{
            return false;
        }
    }

    private function insertBonus($manager, $sumBonus, $month){
        $checkBonus = $this->checkBonus($manager, $sumBonus, $month);
        if(!$checkBonus){
            $managerBonus = new ManagerBonus();
            $managerBonus->manager_code1c = $manager;
            $managerBonus->sum_bonus = (float)$sumBonus;
            $managerBonus->bonus_date = $month;
            $managerBonus->save();
        }
    }

    private function checkBonus($manager, $sumBonus, $month)
    {
        $managerBonus = ManagerBonus::find()->where(['manager_code1c' => $manager,  'bonus_date' => $month])->one();
        if(is_object($managerBonus)){
            ManagerBonus::updateAll(['sum_bonus' => (float)$sumBonus], ['manager_code1c' => $manager,  'bonus_date' => $month]);
            return true;
        }else{
            return false;
        }
    }

    private function insertDiscount($clientId, $name, $discCard, $phone){
        $checkDiscountCard = $this->checkDiscount($clientId, $name, $discCard, $phone);
        if(!$checkDiscountCard){
            $clientDiscountCard = new ClientDiscountCard();
            $clientDiscountCard->client_code1c = $clientId;
            $clientDiscountCard->name = $name;
            $clientDiscountCard->card = $discCard;
            $clientDiscountCard->phone = $phone;
            $clientDiscountCard->save();
        }
    }

    private function checkDiscount($clientId, $name, $discCard, $phone)
    {
        $clientDiscountCard = ClientDiscountCard::find()->where(['client_code1c' => $clientId])->one();
        if(is_object($clientDiscountCard)){
            ClientDiscountCard::updateAll(['name' => $name, 'card' => $discCard, 'phone' => $phone], ['client_code1c' => $clientId]);
            return true;
        }else{
            return false;
        }
    }
	
	    public function actionImportOrderByManufacturer(){
        $xml = file_get_contents("php://input");
        //$xml = file_get_contents('/var/www/hectarecomua/data/www/hectare.com.ua/web/xml/manufacturer2.xml');
        $array = simplexml_load_string($xml);
        if(!empty($array)){
            $month = (string)$array['month'];
            $month = date('Y-d-m', strtotime(str_replace('.','/',$month)));
            if($this->deleteCurrentMonthSale($month)) {
                foreach ($array->SalesManufacturer->group_Manufacturer as $manufacturer) {
                    $manufacturerName = (string)$manufacturer->Manufacturer;
                    foreach ($manufacturer->records->record as $record) {
                        $clientTypeSale = new ClientTypeSale();
                        $clientTypeSale->manager_code1c = (string)$record->Manager['id'];
                        $clientTypeSale->manager_name = (string)$record->Manager;
                        $clientTypeSale->manufacturer_code1c = $manufacturerName;
                        $clientTypeSale->manufacturer_name = $manufacturerName;
                        $clientTypeSale->product_code1c = (string)$record->Tovar['id'];
                        $clientTypeSale->product_name = (string)$record->Tovar;
                        $clientTypeSale->order_date = date('Y-m-d H:i:s', strtotime((string)$record->Order_Date));
                        $clientTypeSale->sale_date = $month;
                        $clientTypeSale->sale_sum = str_replace(',', '.', (string)$record->Summa);
                        $clientTypeSale->qty = (string)$record->kvo;
                        $clientTypeSale->import_date = date('Y-m-d H:i:s');
                        $clientTypeSale->save();
                    }
                }
            }
            return ['success' => true, 'status' => 200];
        }else{
            return ['success' => false, 'status' => 400, 'error' => 'no data'];
        }
    }
	
	private function deleteCurrentMonthSale($month){
        try{
            Yii::$app->db->createCommand("
                delete from client_type_sale where sale_date = :month
            ")->bindValue(':month', $month)
            ->execute();
            return true;
        }catch (\Exception $e){
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            return false;
        }

    }

}

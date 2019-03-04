<?php

namespace app\modules\api\controllers;

use app\models\Product;
use app\models\Product1c;
use app\models\Stock;
use app\models\Stock1c;
use app\models\StockPrice;
use app\models\AttributeValue;
use yii\data\ActiveDataProvider;


class Stocko {

	public $regionname;
	public $stockname;
	public $stockid;
	public $quantity;
	
	public function __construct($regionname,$stockname,$stockid,$quantity) {
		$this->regionname=$regionname;
		$this->stockname = $stockname;
		$this->stockid = $stockid;
		//$this->quantity = $quantity;
		$this->quantity = round(str_replace(' ','',str_replace(',','.',$quantity)),2);
	}
	
}

class Offer {

	public $price;
	public $stockid;
	public $currency;
	public $course;
	public $type;
	
	public function __construct($price,$stockid,$currency,$course,$type='price') {
		$this->price=str_replace(' ','',str_replace(',','.',$price));
		$this->stockid = $stockid;
		$this->currency = $currency;
		$this->course = $course;
		$this->type = $type;
	}
	
}

class Prod {

	public $id;
	public $uid;
	public $sid;
	public $name;
	public $unit;
	public $offers = [];
	public $stocks =[];	
	
	public function __construct($id,$uid,$name,$unit,$offers=[],$stocks=[]) {
		$this->id=$id;
		$this->uid=$uid;
		$this->name = $name;
		$this->unit = $unit;
		$this->offers = $offers;
		$this->stocks = $stocks;
	}
}



class StockController extends ApiController
{
    private function useProductSerializer() {
      $this->serializer = [
        'class' => 'app\modules\api\components\ProductSerializer'
      ];
    }
    
    private function xmlObjToArr() {
		return unserialize(serialize(json_decode(json_encode((array)simplexml_load_string($obj)), 1)));
	}

    public function actionView($id)
    {
      $this->useProductSerializer();
    	return Product::findOne($id);
    }
    
/*
    public function actionOldnew()
    {

		$attr = AttributeValue::find()->all();
		foreach ($attr as $a) {
			if ($a->code1c==NULL) {
				$prod = Product1C::findOne(['av'=>$a->id]);
				if ($prod && $prod->{"1cfull"}) {
					$atos = AttributeValue::findOne(['id'=>$a->id]);
					$atos->code1c = $prod->{"1cfull"};
					$res = $atos->update();
					echo $a->id , ' => ', $prod->{"1cfull"}, ' ==> ', json_encode($res), '<br/>';
				}
			}
		}
    	return true;
    }
  */  

    public function actionIndex2() {
	//	echo phpinfo();
	
		// file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/in'.md5(time()).'.log',json_encode($_POST));
		
		$var = file_get_contents("php://input");
		
		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/ind_'.md5(time()).'.log',$var);

		
		if (strlen($var)>5) {$ret = "200";}

		return $ret;
    }
		
		
	private function checkPrice($of,$prodAV) {
				
	//			var_dump($of['currency']["@attributes"]['name'] != "UAH"); echo '<hr>';
				
		$course = floatval(preg_replace("/[^-0-9\.]/","",str_ireplace(',','.',$of['currency']['course'])));
		$price = floatval(preg_replace("/[^-0-9\.]/","",str_ireplace(',','.',$of['price'])));
		
		switch ($of["@attributes"]['id']) {
			case "ФР-000015":  //Роздрібна ціна USD
				$type = 'price';
				$price = floatval($price * $course);
				break;
			case "ФР-000017": //Роздрібна ціна EUR":
				$type = 'price';
				$price = floatval($price * $course);
				break;											
			case "ФР-000016": //"Роздрібна ціна UAH":
				$type = 'price';
				break;											
			case "ФР-000022": //  мелк опт"
				$type = 'opt_uk';
				if ($of['currency']["@attributes"]['name'] != "UAH") {
					$price = floatval($price * $course * 100); // $prodAV->opt);
				}
				break;											
			case "ФР-000020": //  круп опт"
				$type = 'opt_uk1';
				if ($of['currency']["@attributes"]['name'] != "UAH") {
					$price = floatval($price * $course * 100); //$prodAV->opt1);
				}											
				break;										
		}			
							
		$offero = new Offer(
			$price,
			$of["@attributes"]['id'],
			$of['currency']["@attributes"]['name'],
			$course,
			$type
		);
		
		return $offero;
	}	
	
	
	private function savePrice(&$prodo,&$prodAV,&$offero,&$pricelog){
	
//		echo $pricelo = 'Обновление цены на товар ' .$prodo->id.' атрибут '.$prodAV->id.' с '. $prodAV->price .' на '. $offero->price;
//		echo '<br/>';	
			$prodAV->{$offero->type} = $offero->price;
			$resav = $prodAV->update();
		
			$pricelog[] = $pricelo.' - '.json_encode($resav).'
';  

		$prodo->offers[] = $offero;
		
		
		return true;
	}

	private function saveQuantity($regionname,$stock,&$prodo,$bt) {
		
		$stocko = new Stocko(
			$regionname,
			$stock["@attributes"]['name'],
			$stock["@attributes"]['id'],
			$stock['quantity']
		);
		
		$stockidfull = Stock1c::isStock($stocko->stockid,$stocko->stockname);
		if (in_array($stockidfull['code'],array(200,404))){
			$stockid = $stockidfull['info'];
			$product = new Stock();
			$product->avid = $prodo->sid;
			$product->{"product_id"} = $prodo->id;
			$product->stockid = $stockid;
			$product->main = 0;
			$product->franch = 0;
			$product->stock = 0;
			$product->$bt = $stocko->quantity;
			$product->save();

			$prodo->stock[] = $stocko;	
		}
	
		return true;
	}
	
	private function checkingStocksOffer($reg,$stocks,&$prodo,$bt) {
		
			//checking for stocks

					
			if (isset($stocks["@attributes"])) { // stock в единственном виде

							
			
			if ($prodo->id == '3343') {  //// LOOKING
				echo '1: <br/>'; var_dump($stocks);		
				echo '<br/>';	
			}
							
				$this->saveQuantity($reg,$stocks,$prodo,$bt);					

			} else { //у нас явно массив записей, перебираем
				foreach($stocks as $of) {
					
			
			if ($prodo->id == '3343') {  //// LOOKING
				echo '<br/>';
				var_dump($of);	
				echo '<br/>';		
			}
											
					$this->saveQuantity($reg,$of,$prodo,$bt);
					
				}	
			}	
	
			return true;
	}
	
	private function checkingRegionOffer($stocks,&$prodo,$bt) {
					
			if (isset($stocks["@attributes"])) { 

				$this->checkingStocksOffer($stocks['@attributes']['name'],$stocks['stock'],$prodo,$bt);					

			}
	
			return true;
	}

	private function checkingStockOffer(&$prodo,&$offer,$bt) {

			//checking for stocks
			if (($offer['stockQuantity']) || ($offer['region'])) {
			
				if ($offer['stockQuantity']) {
					
					if (isset($offer['stockQuantity']["@attributes"])) { // запись в единственном виде

							
		/*	
			if ($prodo->id == '3343') {  //// LOOKING
				echo '1: <br/>'; var_dump($offer['stockQuantity']);		
				echo '<br/>';	
			}
		*/						
						$this->checkingRegionOffer($offer['stockQuantity'],$prodo,$bt);					

					} else { //у нас явно массив записей, перебираем
						foreach($offer['stockQuantity'] as $of) {
							
			
			if ($prodo->id == '3343') {  //// LOOKING
				var_dump($of);	
				echo '<br/>';		
			}
							if (isset($of["@attributes"])) {	
							
								$this->checkingRegionOffer($of,$prodo,$bt);
							} else {
								foreach ($of as $off) {
									$this->checkingRegionOffer($off,$prodo,$bt);
								}
							}
						}
					}
				}
			}	
	
			return true;
	}
		
	private function checkingPriceOffer(&$prodo,&$prodAV,&$offero,&$offer,&$pricelog) {
		// checking for prices
		
	//	var_dump($offer);
		
		if (($offer['categoryPrice']) || ($offer['price'])) {
			
			if ($offer['categoryPrice']) {
				
				if (isset($offer['categoryPrice']["@attributes"])) { // запись в единственном виде
//var_dump($offer['categoryPrice']);
					$offero = $this->checkPrice($offer['categoryPrice'],$prodAV);
					$this->savePrice($prodo,$prodAV,$offero,$pricelog);

				} else { //у нас явно массив записей, перебираем
					foreach($offer['categoryPrice'] as $of) {

						$offero = $this->checkPrice($of,$prodAV);										
						$this->savePrice($prodo,$prodAV,$offero,$pricelog);
															
					}
				}
			}

			
	/*		if ($productsource = Product::findOne(['id'=>$prodo->id])) {
				$productsource->{"currency_id"} = 2;
				$productsource->save();
			}
		*/	

		}		
		return true;
	}

    public function actionIndex() {
	//	echo phpinfo();
			
		
	set_time_limit(0);

		$ret = 500;
		$pricelog = [];
		$xml = file_get_contents("php://input");
		
		if (isset($_GET['test']) && ($_GET['test']=='test') && isset($_GET['file']) && $_GET['file']) {
			$xml = file_get_contents('/var/www/admin/www/hectare.com.ua/web/xml/'.$_GET['file']);
		}
		$absend = [];
		
		$ar = json_decode(json_encode((array)simplexml_load_string($xml)), 1);  
		
		$prods = [];
		
		if ((strlen($xml)>5) && (count($ar)>0)) {

			$bt = $ar["@attributes"]['base'];

			switch ($bt) {
				case "main": Stock::deleteAll("`franch` = '0'"); break;
				case "franch": Stock::deleteAll("`main` = '0'"); break;
				default:
			}
			
			// Stock::deleteAll($bt.'>0');
			StockPrice::deleteAll();

			foreach ($ar['products']["product"] as $prod) {
				
			//	var_dump($prod['offer']);echo'<br/><br/>';
				
				$prodo = new Prod(
					$prod["@attributes"]['id'],
					$prod["@attributes"]['productId'],
					$prod["@attributes"]['name'],
					$prod['unit']
				);
				
				if (isset($prod["@attributes"]['productId'])) {
					$productId = $prod["@attributes"]['productId'];
				} else {
					$productId = $prod["@attributes"]['idProduct'];
				}
				
				$prodAV = AttributeValue::findOne(['code1c'=>$productId]);
				if ($prodAV) {
					$prodo->sid = $prodAV->id;
					$prodo->id = $prodAV->{"product_id"};
					
					if ($prodo->id == '3343') {  //// LOOKING
						echo '<hr><br>ID = ', $prodo->id,'  AV=', $prodo->sid, '<br/>';
					}
					
						// checking for offers
					if ($prod['offer']) {
				
						if (isset($prod['offer']['categoryPrice']) || isset($prod['offer']['stockQuantity'])) { // В единственном виде
//echo '<br>!1!<br>';
								$this->checkingPriceOffer($prodo,$prodAV,$offero,$prod['offer'],$pricelog);
								$this->checkingStockOffer($prodo,$prod['offer'],$bt);					
							
						} else {	// Присутствует массив предложений
//echo '<br>!2!<br>';								
							foreach ($prod['offer'] as $offer) {

								$this->checkingPriceOffer($prodo,$prodAV,$offero,$offer,$pricelog);
								$this->checkingStockOffer($prodo,$offer,$bt);

							}
						}	
						
						$prods[] = $prodo;				
					
							
					} else {
						$absend[] = $productId;
					}
				}
				$ret = "200";

			}
		} else {
			$ret = false;
		}				
		$label = md5(time());
		
//		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/res'. $label .'.log',$ret);
//		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/absend'. $label .'.csv',implode(';',$absend));
		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/query'. $label .'.log',$xml);
//		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/pricelog'. $label .'.log',$pricelog);

		return $ret;
    }
 
}

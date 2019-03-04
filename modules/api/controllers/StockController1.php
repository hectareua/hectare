<?php

namespace app\modules\api\controllers;

use app\models\Product;
use app\models\Product1c;
use app\models\Stock;
use app\models\StockPrice;
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
		$this->quantity = $quantity;
	}
	
}

class Offer {

	public $price;
	public $stockid;
	public $currency;
	public $course;
	
	public function __construct($price,$stockid,$currency,$course) {
		$this->price=$price;
		$this->stockid = $stockid;
		$this->currency = $currency;
		$this->course = $course;
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
    

    public function actionIndex2() {
	//	echo phpinfo();
	
		// file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/in'.md5(time()).'.log',json_encode($_POST));
		
		$var = file_get_contents("php://input");
		
		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/ind_'.md5(time()).'.log',$var);

		
		if (strlen($var)>5) {$ret = "200";}

		return $ret;
    }
		

    public function actionIndex() {
	//	echo phpinfo();
	
		$ret = 500;
		
		$xml = file_get_contents("php://input");
		
		if (isset($_GET['test']) && ($_GET['test']=='test') && isset($_GET['file']) && $_GET['file']) {
			$xml = file_get_contents('/var/www/admin/www/hectare.com.ua/web/xml/'.$_GET['file']);
		//	$xml = json_decode($xml);
		}
	
	//	file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/in'.md5(time()).'.log',json_encode($_POST));
		
		$absend = [];
	//	/*
	//	$xml = file_get_contents('/var/www/admin/www/hectare.com.ua/web/xml/hectare.xml');
	//	$ar = unserialize(serialize(json_decode(json_encode((array)simplexml_load_string($xml)), 1)));  
		$ar = json_decode(json_encode((array)simplexml_load_string($xml)), 1);  
	//var_dump($ar);die();
	//	$ar = $this->xmlObjToArr($xml);
		
		$prods = [];
		
		if ((strlen($xml)>5) && (count($ar)>0)) {
		
			Stock::deleteAll();
			StockPrice::deleteAll();
			
			$stocks = ['00-000001'=>stock1,'ФР-000003'=>stock2,'ФР-000006'=>stock3,'НФ-000020'=>stock4];
			$curr = ['USD'=>stock1,'UAH'=>stock2,'EUR'=>stock3];

			foreach ($ar['products']["product"] as $prod) {
				
			//	var_dump($prod['offer']);echo'<br/><br/>';
				
				$prodo = new Prod(
					$prod["@attributes"]['id'],
					$prod["@attributes"]['productId'],
					$prod["@attributes"]['name'],
					$prod['unit']
				);
				
				
				$product1c = Product1c::findOne(['1cfull'=>$prod["@attributes"]['productId']]);
				if ($product1c && isset($product1c->av)) {
					$prodo->sid = $product1c->av;
					
				//	echo $product1c->av,': ',''
						
				} else {
					$absend[] = $prod["@attributes"]['productId'];
				}
							
				
				if ($prod['offer']) {
					foreach ($prod['offer'] as $offer) {
						if ($offer['categoryPrice']) {
							$offero = new Offer(
								$offer['categoryPrice']['price'],
								$offer['categoryPrice']["@attributes"]['id'],
								$offer['categoryPrice']['currency']["@attributes"]['name'],
								$offer['categoryPrice']['currency']['course']
							);
							
							$productprice = StockPrice::findOne(['avid'=>$product1c->av]);
							
							if ($offero->currency) {
								if ($productprice) {
									$productprice->$curr[$offer->currency] = $offero->price;
								} else {
									$productprice = new StockPrice;
									$productprice->avid = $prodo->sid;
									$productprice->{"product_id"} = $prodo->id;
									$productprice->stock1 = 0;
									$productprice->stock2 = 0;
									$productprice->stock3 = 0;
									$productprice->stock4 = 0;
									$productprice->$curr[$offero->currency] = $offero->price;
								}
								$productprice->save(); 						
							}
							
							$prodo->offers[] = $offero;
						}
						
						if ($offer['stockQuantity']) {
							$stocko = new Stocko(
								$offer['stockQuantity']['region']["@attributes"]['name'],
								$offer['stockQuantity']['region']['stock']["@attributes"]['name'],
								$offer['stockQuantity']['region']['stock']["@attributes"]['id'],
								$offer['stockQuantity']['region']['stock']['quantity']
							);


										
							$product = Stock::findOne(['avid'=>$product1c->av]);
							//echo $stocko->stockid, ' === ',$stocks[$stocko->stockid],'<br/>';
							if ($stocko->stockid) {
								if ($product) {
									$product->$stocks[$stocko->stockid] = (float) $stocko->quantity;
								} else {
									$product = new Stock;
									$product->avid = ($prodo->sid)?($prodo->sid):'0';
									$product->{"product_id"} = ($prodo->id)?($prodo->id):'0';
									$product->stock1 = (float) 0;
									$product->stock2 = (float) 0;
									$product->stock3 = (float) 0;
									$product->stock4 = (float) 0;
									//if (isset($_GET['test']) && ($_GET['test']=='test')) { var_dump($stocko->stockid);die();}
									$product->$stocks[$stocko->stockid] = (float) $stocko->quantity;
								//	var_dump($product);
								}
								$product->save();
							//	var_dump($product->getErrors());
							}

							
							$prodo->stock[] = $stocko;	
						}
					}
				}	
				
				$prods[] = $prodo;
			}
			$ret = "200";
		} else {
			$ret = false;
		}
		
		$label = md5(time());
		
		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/res'. $label .'.log',$ret);
		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/absend'. $label .'.csv',implode(';',$absend));
		file_put_contents('/var/www/admin/www/hectare.com.ua/web/xml/query'. $label .'.log',$xml);


		// ($prods);
	
/*		foreach ($ar['products']["product"] as $prod) {
			var_dump($prod["@attributes"]);die();
			$id = $prod["@attributes"]['id'];
			$name = $prod["@attributes"]['name'];
			$productId = $prod["@attributes"]['productId'];			
			$unit = $prod['unit'];
		
			if (isset($prod['offer']['stockQuantity']['region']["@attributes"]['name'])) {
					$region = $prod['offer']['stockQuantity']['region']["@attributes"]['name'];
					$stock_id = $prod['offer']['stockQuantity']['region']['stock']["@attributes"]['id'];
					$stock = $prod['offer']['stockQuantity']['region']['stock']["@attributes"]['name'];
					$qty = $prod['offer']['stockQuantity']['region']['stock']['quantity'];
					$price = $prod['offer']['categoryPrice']['price'];
					$currency = $prod['offer']['categoryPrice']['currency']["@attributes"]['name'];
			}
			$stock1 = 0;
			$stock2 = 0;
			$stock3 = 0;
			$stock4 = 0;
		
			if ($region == 'Николаевская обл' && $stock_id == 'ФР-000006') {
				$stock1 = $qty;
			}
			
	//		$product = Stock::findOne(['product_id'=>$id]);
			$product1c = Product1c::findOne(['1cfull'=>$productId]);
			$product = Stock::findOne(['avid'=>$product1c->av]);
			if ($product) {
				$product->stock1 = $stock1;
			} else {
				$product = new Stock;
				$product->avid = $productId;
				$product->{"product_id"} = $id;
				$product->stock1 = $stock1;
				$product->stock2 = $stock2;
				$product->stock3 = $stock3;
				$product->stock4 = $stock4;
			}
			$product->save(); 
			
			echo $product->pid.' '. $product->av.' '. $product->1cfull.' 
			';
		}
		
		/*
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Product::find()
                ->where(['is_on_sale' => true]),
        ]);
    */
		return $ret; //json_encode($_POST); //true;
    }
  /*
    public function actionSearch($search, $page, $items)
    {
        $this->serializer['fields'] = ['id', 'name_uk', 'manufacturer_name', 'currencyPrice'];
        $this->serializer['expand'] = ['image'];
        $paginationParams = ['page' => $page, 'pageSize' => $items];
        return new ActiveDataProvider([
            'pagination' => $paginationParams,
            'query' => Product::find()->where([
                'or',
                ['like', 'name_uk', $search],
                ['like', 'name_ru', $search],
                ['like', 'dv', $search]
            ])
        ]);
    }
    */
}

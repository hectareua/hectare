<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-26
	 * Time: 00:13
	 */

	namespace app\components\feedManufacture;
	use app\models\Manufacturer;
	use app\models\ProductImage;
	use app\models\Category;
	use Yii;

	class feedManufacture extends \yii\base\Widget
	{

		public function init()
		{
			parent::init();
		}

		/**
		 * @return string
		 */
		public function run()
		{
			return $this -> getProductManufactureFeed();
		}

		/**
		 * @return array|\yii\db\ActiveRecord[]
		 * Get data Manufacture
		 */
		protected function getManufactureForFeed()
		{
			return Manufacturer::find()
							   -> with('products')
							   -> asArray()
							   -> where(['set_feed_merchant_google' => Manufacturer::STATUS_SET_TO_FEED])
							   -> all();
		}

		protected function getProductManufactureFeed()
		{
			$manufacture = $this -> getManufactureForFeed();
			$resutl = $this -> generateArrayForFeed(['manufactures' => $manufacture,]);
			$this -> generateFeed($resutl);
		}

		/**
		 * @param $prod_id
		 *
		 * @return array|\yii\db\ActiveRecord|null
		 */
		protected function getDataProductFeed($prod_id)
		{
			$row = ProductImage::find()
					-> with('product')
					-> where(['product_id' => $prod_id])
					-> with('image')
				    -> limit(80)
				    -> one();
			return [
				'image' => $row['image'] -> url,
				'link' => $this -> getCategoryFeed($row['product'] -> category_id)
			];
		}

		protected function getCategoryFeed($id_category)
		{
			$row = Category::findOne($id_category);
			return [
				'category_name' => $row['name_'.Yii::$app -> language],
				'category_slug' => $row['slug'],
				'link' => $_SERVER['HTTP_HOST'].'/internet-magazin/product/view/'.$row -> slug.'/',
			];
		}
		/**
		 * @param $data
		 *
		 * @return array
		 */
		protected function generateArrayForFeed($data)
		{
			$lang = Yii::$app -> language;
			$array_mass = [];
			foreach($data['manufactures'] as $item_m)
			{
				foreach($item_m['products'] as $item_p )
				{
					$array_mass[$item_p ['id']]['manufacture'] = $item_m['name'];
					$array_mass[$item_p ['id']]['id_manufacture'] = $item_m['id'];
					$array_mass[$item_p ['id']]['id_product'] = $item_p['id'];
					$array_mass[$item_p ['id']]['category'] = $this -> getDataProductFeed($item_p['id'])['link']['category_name'];
					$array_mass[$item_p ['id']]['link'] = $this -> getDataProductFeed($item_p['id'])['link']['link'].$item_p['id'];
					$array_mass[$item_p ['id']]['title'] = $item_p['name_'.$lang];
					$array_mass[$item_p ['id']]['description'] = mb_substr($item_p['seo_description_'.$lang], 0, 100);
					$array_mass[$item_p ['id']]['price'] = $item_p['price'];
					$array_mass[$item_p ['id']]['image'] = $this -> getDataProductFeed($item_p['id'])['image'];
				}

			}
			return $array_mass;
		}

		/**
		 * Generate and save feed in xml type
		 */
		protected function generateFeed($array)
		{
			$shop_name = "Магазин";
			$shop_link = "https://".$_SERVER['HTTP_HOST'].'/shop';

			$feed_products = [];

			//LOOP THROUGH PRODUCTS
			foreach($product = $array as $item){
				//CREATE EMPTY ARRAY FOR GOOGLE-FRIENDLY INFO
				$gf_product = [];
				//feed attributes
				$gf_product['g:id'] = $item['id_product'];
				$gf_product['g:title'] = $item['title'];
				$gf_product['g:description'] = $item['description'];
				$gf_product['g:link'] = $item['link'];
				$gf_product['g:image_link'] = $item['image'];
				$gf_product['g:price'] = $item['price'];
				$gf_product['g:product_type'] = $item['category'];
				$gf_product['g:brand'] = $item['manufacture'];

				$feed_products[] = $gf_product;
			}

			//CREATE XML
			$doc = new \DOMDocument('1.0', 'UTF-8');
			$xmlRoot = $doc->createElement("rss");
			$xmlRoot = $doc->appendChild($xmlRoot);
			$xmlRoot->setAttribute('version', '2.0');
			$xmlRoot->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:g', "http://base.google.com/ns/1.0");

			$channelNode = $xmlRoot->appendChild($doc->createElement('channel'));
			$channelNode->appendChild($doc->createElement('title', $shop_name));
			$channelNode->appendChild($doc->createElement('link', $shop_link));

			foreach ($feed_products as $product) {
				$itemNode = $channelNode->appendChild($doc->createElement('item'));
				foreach($product as $key=>$value) {
					if ($value != "") {
						if (is_array($product[$key])) {
							$subItemNode = $itemNode->appendChild($doc->createElement($key));
							foreach($product[$key] as $key2=>$value2){
								$subItemNode->appendChild($doc->createElement($key2))->appendChild($doc->createTextNode($value2));
							}
						} else {
							$itemNode->appendChild($doc->createElement($key))->appendChild($doc->createTextNode($value));
						}
					} else {

						$itemNode->appendChild($doc->createElement($key));
					}
				}
			}
			$doc->formatOutput = true;
			header('Content-Type: text/xml');
			echo $doc->saveXML();
		}
	}
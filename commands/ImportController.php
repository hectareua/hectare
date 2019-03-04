<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Currency;
use app\models\Manufacturer;
use app\models\Country;
use app\models\Attribute;
use app\models\AttributeOption;
use app\models\AttributeValue;
use app\models\Field;
use app\models\FieldOption;
use app\models\FieldValue;
use app\models\OrderStatus;
use app\models\PaymentSystem;
use app\models\Category;
use app\models\CategoryField;
use app\models\Image;
use app\models\Product;
use app\models\ProductImage;
use app\models\Suggestion;
use app\models\News;
use app\models\User;
use app\models\Client;
use app\models\Manager;

class ImportController extends Controller
{
	public function actionIndex()
	{
		d('import');
		foreach (glob(dirname(__DIR__).'/migrations/import/*.sql') as $file)
		{
			$table_name = pathinfo($file)['filename'];
			Yii::$app->db->createCommand("DROP TABLE IF EXISTS $table_name")->execute();
			$sql = file_get_contents($file);
			Yii::$app->db->createCommand($sql)->execute();
		}

        $transaction = Yii::$app->db->beginTransaction();
        try
        {
			d('b0cko_jshopping_manufacturers');
			if (!Manufacturer::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						`manufacturer_id`,
						`name_uk-UA`
					FROM b0cko_jshopping_manufacturers
				")->queryAll();

				foreach ($data as $manufacturerData)
				{
					if (!$manufacturerData['name_uk-UA']) continue;
					$manufacturer = new Manufacturer([
						'id' => $manufacturerData['manufacturer_id'],
						'name' => $manufacturerData['name_uk-UA'],
					]);
					if (!$manufacturer->save())
						_d($manufacturer->getErrors());
				}
			}

			d('b0cko_jshopping_categories');
			if (!Category::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						`category_id`,
						`category_parent_id`,
						`description_ru-RU`,
						`name_ru-RU`,
						`description_uk-UA`,
						`name_uk-UA`,
						`ordering`,
						`category_image`
					FROM b0cko_jshopping_categories
				")->queryAll();

				foreach ($data as $categoryData)
				{
					$category = new Category([
						'id' => $categoryData['category_id'],
						'parent_id' => $categoryData['category_parent_id']?:null,
						'description_ru' => $categoryData['description_ru-RU'],
						'description_uk' => $categoryData['description_uk-UA'],
						'name_ru' => $categoryData['name_ru-RU'],
						'name_uk' => $categoryData['name_uk-UA'],
						'order' => $categoryData['ordering'],
					]);
					if (!$category->save())
						_d($category->getErrors());
					if ($categoryData['category_image'])
					{
						$imageUrl = "http://hectare.com.ua/components/com_jshopping/files/img_categories/".$categoryData['category_image'];
						$image = Image::findOne(['url' => $imageUrl]);
	        			if (!$image)
	        			{
		        			$image = new Image([
					            'remote' => true,
		        				'url' => $imageUrl,
		        			]);
		        			$image->save();
	        			}
	        			$category->link('image', $image);
					}
				}
			}

			d('b0cko_jshopping_attr');
			if (!Attribute::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						`attr_id`,
						`name_ru-RU`,
						`name_uk-UA`
					FROM b0cko_jshopping_attr
				")->queryAll();

				foreach ($data as $attrData)
				{
					$attr = new Attribute([
						'id' => $attrData['attr_id'],
						'name_ru' => $attrData['name_ru-RU'],
						'name_uk' => $attrData['name_uk-UA'],
					]);
					if (!$attr->save())
						_d($attr->getErrors());
				}
			}

			d('b0cko_jshopping_attr_values');
			if (!AttributeOption::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						`value_id`,
						`attr_id`,
						`name_ru-RU`,
						`name_uk-UA`
					FROM b0cko_jshopping_attr_values
				")->queryAll();

				foreach ($data as $attrValueData)
				{
					$attrValue = new AttributeOption([
						'id' => $attrValueData['value_id'],
						'attribute_id' => $attrValueData['attr_id'],
						'name_ru' => $attrValueData['name_ru-RU'],
						'name_uk' => $attrValueData['name_uk-UA'],
					]);
					if (!$attrValue->save())
						_d($attrValue->getErrors());
				}
			}

			d('b0cko_jshopping_products_extra_fields');
			if (!Field::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						`id`,
						`cats`,
						`name_ru-RU`,
						`name_uk-UA`
					FROM b0cko_jshopping_products_extra_fields
				")->queryAll();

				foreach ($data as $fieldData)
				{
					$field = new Field([
						'id' => $fieldData['id'],
						'name_ru' => $fieldData['name_ru-RU'],
						'name_uk' => $fieldData['name_uk-UA'],
					]);
					if (!$field->save())
						_d($field->getErrors());
					$catsData = $fieldData['cats'];
					if ($catsData)
					{
						$cats = unserialize($catsData);
						if ($cats)
						{
							foreach ($cats as $category_id)
							{
								$category = Category::findOne($category_id);
								if (!$category)
								{
									d('no category');
									_d($catsData);
								}
								$categoryField = new CategoryField([
									'category_id' => $category->id,
									'field_id' => $field->id,
								]);
								if (!$categoryField->save())
									_d($categoryField->getErrors());
							}
						}
					}
				}
			}

			d('b0cko_jshopping_products_extra_field_values');
			if (!FieldOption::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						`id`,
						`field_id`,
						`name_ru-RU`,
						`name_uk-UA`
					FROM b0cko_jshopping_products_extra_field_values
					ORDER BY ordering
				")->queryAll();

				foreach ($data as $fieldOptionData)
				{
					$fieldOption = new FieldOption([
						'id' => $fieldOptionData['id'],
						'field_id' => $fieldOptionData['field_id'],
						'name_ru' => $fieldOptionData['name_ru-RU'],
						'name_uk' => $fieldOptionData['name_uk-UA'],
					]);
					if (!$fieldOption->save())
						_d($fieldOption->getErrors());
				}
			}

			d('b0cko_content+b0cko_assets');
			if (!News::find()->exists())
        	{
        		$data = Yii::$app->db->createCommand("
        			SELECT
        				c.*
        			FROM b0cko_content c
        				INNER JOIN b0cko_assets a
        					ON a.id = c.asset_id
        			ORDER BY publish_up
        		")->queryAll();

        		foreach ($data as $newsData)
        		{
    				$imageJson = $newsData['images'];
    				$images = json_decode($imageJson, 1);

        			$news = new News([
        				'publishing_since' => $newsData['publish_up'],
        				'publishing_till' => $newsData['publish_down'],
        				'title_uk' => $newsData['title'],
        				'text_uk' => $newsData['introtext'],
        			]);
        			$imageUrl = 'http://hectare.com.ua/' . $images['image_intro'];
        			$image = Image::findOne(['url' => $imageUrl]);
        			if (!$image)
        			{
	        			$image = new Image([
				            'remote' => true,
	        				'url' => $imageUrl,
	        			]);
	        			$image->save();
        			}
        			$news->link('image', $image);
        		}
        	}

			d('b0cko_jshopping_products+b0cko_jshopping_products_to_categories');
			if (!Product::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						p.*,
						pc.`category_id`
					FROM b0cko_jshopping_products p
						LEFT JOIN b0cko_jshopping_products_to_categories pc
							ON p.product_id = pc.product_id
					WHERE product_publish = 1
				")->queryAll();

				foreach ($data as $productData)
				{
					$product = new Product([
						'id' => $productData['product_id'],
						'category_id' => ($productData['category_id']?:null),
						'manufacturer_id' => ($productData['product_manufacturer_id']?:null),
						'currency_id' => $productData['currency_id'],
						'price' => $productData['product_price'],
						'old_price' => $productData['product_old_price'],
						'is_in_stock' => ($productData['product_quantity']==0?1:0),
						'is_new' => ($productData['label_id']==1?1:0),
						'is_on_sale' => ($productData['label_id']==2?1:0),
						'name_uk' => $productData['name_uk-UA'],
						'name_ru' => $productData['name_ru-RU'],
						'description_uk' => $productData['description_uk-UA'],
						'description_ru' => $productData['description_ru-RU'],
					]);
					if (!$product->save())
					{
						d($product);
						_d($product->getErrors());
					}
					foreach (Field::find()->all() as $field)
					{
						if (!empty($productData['extra_field_'.$field->id]))
						{
							$fieldValue = new FieldValue(['product_id' => $product->id, 'option_id' => $productData['extra_field_'.$field->id]]);
							$fieldValue->save();
						}
					}
				}
			}

			d('b0cko_jshopping_products_images');
			if (!ProductImage::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						pi.`product_id`,
						pi.`image_name`
					FROM b0cko_jshopping_products_images pi
					WHERE product_id != 0
				")->queryAll();

				foreach ($data as $imageData)
				{
					$product = Product::findOne($imageData['product_id']);
					if (!$product)
					{
						_d($imageData);
					}
					$imageUrl = "http://hectare.com.ua/components/com_jshopping/files/img_products/".$imageData['image_name'];
        			$image = Image::findOne(['url' => $imageUrl]);
        			if (!$image)
        			{
	        			$image = new Image([
				            'remote' => true,
	        				'url' => $imageUrl,
	        			]);
	        			$image->save();
        			}
			        $product->link('images', $image);
				}
			}

			d('b0cko_jshopping_products_attr');
			if (!AttributeValue::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						pa.*
					FROM b0cko_jshopping_products_attr pa
					WHERE product_id != 0
				")->queryAll();

				foreach ($data as $attributeData)
				{
					$product = Product::findOne($attributeData['product_id']);
					if (!$product)
					{
						d('no profile');
						_d($attributeData);
					}
					foreach (Attribute::find()->all() as $attr)
					{
						if (!$attributeData['attr_'.$attr->id])
							continue;
						$option = AttributeOption::findOne($attributeData['attr_'.$attr->id]);
						if (!$option)
						{
							d('no attribute');
							_d($attributeData);
						}
						$attributeValue = new AttributeValue([
							'product_id' => $product->id,
							'option_id' => $option->id,
							'price' => $attributeData['price'],
						]);
						$attributeValue->save();
					}
				}
			}

			d('b0cko_jshopping_products_relations');
			if (!Suggestion::find()->exists())
			{
				$data = Yii::$app->db->createCommand("
					SELECT
						ps.`product_id`,
						ps.`product_related_id` as suggestion_id
					FROM b0cko_jshopping_products_relations ps
					WHERE product_id != 0
				")->queryAll();

				foreach ($data as $suggestionData)
				{
					$suggestion = new Suggestion($suggestionData);
					$suggestion->save();
				}
			}

			$transaction->commit();
		}
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

		foreach (glob(dirname(__DIR__).'/migrations/import/*.sql') as $file)
		{
			$table_name = pathinfo($file)['filename'];
			Yii::$app->db->createCommand("DROP TABLE IF EXISTS $table_name")->execute();
		}
	}

	public function actionSeo()
	{
		d('import seo');
		foreach (glob(dirname(__DIR__).'/migrations/import/*.sql') as $file)
		{
			$table_name = pathinfo($file)['filename'];
			Yii::$app->db->createCommand("DROP TABLE IF EXISTS $table_name")->execute();
			$sql = file_get_contents($file);
			Yii::$app->db->createCommand($sql)->execute();
		}

		d('b0cko_jshopping_products');
		if (!Product::find()->where(['not', ['slug' => null]])->exists())
		{
			$data = Yii::$app->db->createCommand("
				SELECT
					p.*
				FROM b0cko_jshopping_products p
				WHERE product_publish = 1
			")->queryAll();

			foreach ($data as $productData)
			{
				$product = Product::findOne($productData['product_id']);
				if (!$product)
					continue;
				$product->seo_title_uk = $productData['meta_title_uk-UA'];
				$product->seo_description_uk = $productData['meta_description_uk-UA'];
				$product->seo_keywords_uk = $productData['meta_keyword_uk-UA'];
				$product->seo_title_ru = $productData['meta_title_ru-RU'];
				$product->seo_description_ru = $productData['meta_description_ru-RU'];
				$product->seo_keywords_ru = $productData['meta_keyword_ru-RU'];
				$product->slug = $productData['alias_uk-UA'];
				if (!$product->save())
					_d($product->getErrors());
			}
		}

		d('b0cko_jshopping_categories');
		if (!Category::find()->where(['not', ['slug' => null]])->exists())
		{
			$data = Yii::$app->db->createCommand("
				SELECT
					c.*
				FROM b0cko_jshopping_categories c
			")->queryAll();

			foreach ($data as $categoryData)
			{
				$category = Category::findOne($categoryData['category_id']);
				if (!$category)
					continue;
				$category->seo_title_uk = $categoryData['meta_title_uk-UA'];
				$category->seo_description_uk = $categoryData['meta_description_uk-UA'];
				$category->seo_keywords_uk = $categoryData['meta_keyword_uk-UA'];
				$category->seo_title_ru = $categoryData['meta_title_ru-RU'];
				$category->seo_description_ru = $categoryData['meta_description_ru-RU'];
				$category->seo_keywords_ru = $categoryData['meta_keyword_ru-RU'];
				$category->slug = $categoryData['alias_uk-UA'];
				if (!$category->save())
					_d($category->getErrors());
			}
		}


		d('b0cko_content+b0cko_assets');
		if (!News::find()->where(['not', ['slug' => null]])->exists())
		{
			$data = Yii::$app->db->createCommand("
				SELECT
					c.*
				FROM b0cko_content c
					INNER JOIN b0cko_assets a
						ON a.id = c.asset_id
				ORDER BY publish_up
			")->queryAll();

			foreach ($data as $newsData)
			{
				$news = News::findOne(['title_uk' => $newsData['title']]);
				if (!$news)
					continue;
				$news->title_ru = $news->title_uk;

				$news->seo_description_uk = $newsData['metadesc'];
				$news->seo_keywords_uk = $newsData['metakey'];
				$news->seo_description_ru = $newsData['metadesc'];
				$news->seo_keywords_ru = $newsData['metakey'];
				$news->slug = $newsData['alias'];
				if (!$news->save())
					_d($news->getErrors());
			}
		}

		foreach (glob(dirname(__DIR__).'/migrations/import/*.sql') as $file)
		{
			$table_name = pathinfo($file)['filename'];
			Yii::$app->db->createCommand("DROP TABLE IF EXISTS $table_name")->execute();
		}
	}

	public function actionClients()
	{
		d('import clients');
		foreach (glob(dirname(__DIR__).'/migrations/import/*.sql') as $file)
		{
			$table_name = pathinfo($file)['filename'];
			Yii::$app->db->createCommand("DROP TABLE IF EXISTS $table_name")->execute();
			$sql = file_get_contents($file);
			Yii::$app->db->createCommand($sql)->execute();
		}

		d('b0cko_jshopping_users');
		$data = Yii::$app->db->createCommand("
			SELECT
				u.*
			FROM b0cko_jshopping_users u
			WHERE user_id NOT IN (546, 547, 548, 549, 550)
		")->queryAll();

		foreach ($data as $userData)
		{
			$user = new User();
			$client = new Client();
			$user->setPassword(uniqid());
			$user->login = $userData['u_name'];
			$user->email = $userData['email'];
			$user->generateAuthKey();
			$user->manager_id = Manager::find()->one()->id;
			$client->billing_first_name = $userData['f_name'];
		    $client->billing_last_name = $userData['l_name'];
		    $client->billing_middle_name = $userData['m_name'];
		    $client->billing_address = $userData['street'];
		    $client->billing_city = $userData['city'];
		    $client->billing_postcode = $userData['zip'];
		    $client->billing_region = $userData['state'];
		    $client->billing_country_id = $userData['country']?:null;
		    $client->billing_phone = $userData['phone'];
		    $client->delivery_differs = $userData['delivery_adress'];
		    $client->delivery_first_name = $userData['d_f_name'];
		    $client->delivery_last_name = $userData['d_l_name'];
		    $client->delivery_middle_name = $userData['d_m_name'];
		    $client->delivery_address = $userData['d_street'];
		    $client->delivery_city = $userData['d_city'];
		    $client->delivery_postcode = $userData['d_zip'];
		    $client->delivery_region = $userData['d_state'];
		    $client->delivery_country_id = $userData['d_country']?:null;
		    $client->delivery_phone = $userData['d_phone'];
			if (!$user->save())
				_d($user->getErrors());
			$client->user_id = $user->id;
			if (!$client->save(false))
				_d($client->getErrors());
		}

		foreach (glob(dirname(__DIR__).'/migrations/import/*.sql') as $file)
		{
			$table_name = pathinfo($file)['filename'];
			Yii::$app->db->createCommand("DROP TABLE IF EXISTS $table_name")->execute();
		}
	}

	public function actionImages()
	{
		foreach (Image::find()->all() as $image)
		{
			$image->download();
			echo '.';
		}
	}
}

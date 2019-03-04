<?php

namespace app\models;


use Yii;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "complects".
 *
 * @property integer $id
 * @property string $name
 *
 */
class Complects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [    
            [['name'], 'required'],
            [['name'], 'string'],		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name',       
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [  
            'id', 
            'name', 
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     * /
    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }
*/
    public function saveForm()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
            if (!$this->save())
            {
                return false;
            }

            $transaction->commit();
			return Yii::$app->response->redirect(Url::to(['complects-product/create', 'complectid' => $this->id]));
        //    return true;http://hectare.com.ua/admin/complects-product/create
        }
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }
    
}

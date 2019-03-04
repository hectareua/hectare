<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "complects_product".
 *
 * @property integer $id
 * @property string $name
 *
 */
class ComplectsProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complects_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complectid','attributeid','productid','discount'], 'required'],
            [['complectid','attributeid','productid','is_slider'], 'integer'],
            [['attributeid'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValue::className(), 'targetAttribute' => ['attributeid' => 'id']],
            [['complectid'], 'exist', 'skipOnError' => true, 'targetClass' => Complects::className(), 'targetAttribute' => ['complectid' => 'id']],                      
            [['productid'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productid' => 'id']],                      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'complectid' => 'complect ID',           
            'productid' => 'product ID',           
            'attributeid' => 'product attribute ID',           
            'discount' => 'discount',
            'is_slider' => 'is Slider',
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [  
            'complectid',    
            'productid',    
            'attributeid',    
            'discount',
            'is_slider',
       //     'product_name' => function($model){return $model->product_id?$model->product_id->name:null;},        
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'attributeid']);
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productid']);
    }
    
    public function getComplect()
    {
        return $this->hasOne(Complects::className(), ['id' => 'complectid']);
    }

    public function saveForm()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
            if (!$this->save())
            {
               // return false;
               return Yii::$app->response->redirect(Url::to(['complects-product/index']));
            }

            $transaction->commit();
            return Yii::$app->response->redirect(Url::to(['complects-product/index']));
        }
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }
    
}

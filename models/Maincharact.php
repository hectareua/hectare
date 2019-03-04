<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maincharact".
 *
 * @property integer $id
 * @property string $name
 *
 */
class Maincharact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maincharact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru','name_uk','product_id'], 'required'],
            [['product_id'], 'integer'],  
            [['name_ru','name_uk','val'], 'string'],  
            [['name_ru','name_uk','val'], 'safe'],  
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],                      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => 'Characteristics name ru ID',           
            'name_uk' => 'Characteristics name uk ID',           
            'product_id' => 'product ID',            
            'val' => 'Value',            
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [   
            'product_id',    
            'name_ru',    
            'name_uk',    
            'val', 
       //     'product_name' => function($model){return $model->product_id?$model->product_id->name:null;},        
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }

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
            return true;
        }
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }
}

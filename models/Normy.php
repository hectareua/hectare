<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "normy".
 *
 * @property integer $id
 * @property string $name
 *
 */
class Normy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'norma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plant_id','norma','product_id'], 'required'],
            [['plant_id','product_id'], 'integer'],  
            [['norma'], 'string'],  
            [['norma'], 'safe'],  
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['plant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plants::className(), 'targetAttribute' => ['plant_id' => 'id']],                      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plant_id' => 'plant ID',           
            'product_id' => 'product ID',            
            'norma' => 'Norma',            
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'plant_id',            
            'product_id',    
            'norma'=>function($model){
                return mb_convert_encoding($model->norma, 'UTF-8');
            }, 
            'plants'
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlants()
    {
        return $this->hasMany(Plants::className(), ['id' => 'plant_id']);
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

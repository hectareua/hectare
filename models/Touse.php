<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "touse".
 *
 * @property integer $id
 * @property string $name
 * @property integer $image_id
 * @property integer $id_manufacture
 *
 */
class Touse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'touse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plant_id','phase_id','problem_id','product_id','sector_id'], 'required'],
            [['plant_id','phase_id','problem_id','sector_id','id_manufacture'], 'integer'],
            [['product_id'], 'string'],  
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],                      
            [['problem_id'], 'exist', 'skipOnError' => true, 'targetClass' => Problems::className(), 'targetAttribute' => ['problem_id' => 'id']],                      
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
            'phase_id' => 'phase ID',            
            'problem_id' => 'problem ID',            
            'product_id' => 'product ID',            
            'sector_id' => 'Sector',            
            'id_manufacture' => 'Id Manufacture',
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'plant_id',
            'phase_id',            
            'problem_id',            
            'product_id',    
            'sector_id',    
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhases()
    {
        return $this->hasMany(Phases::className(), ['id' => 'phase_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProblems()
    {
        return $this->hasMany(Problems::className(), ['id' => 'problem_id']);
    }

    public function getManufacture()
	{
        return $this->hasMany(Manufacturer::className(), ['id' => 'id_manufacture']);
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

    public static function forFilterData($cure_id,$id = null)
	{
		$row = Touse::find() ->where(['sector_id' => $cure_id]);
		if($id) {
			$row -> andWhere(['id_manufacture' => $id]);
		}
		$row ->joinWith(['product'], true, 'LEFT JOIN')
		 ->joinWith(['problems'], true, 'LEFT JOIN')
		 ->joinWith(['phases'], true, 'LEFT JOIN')
		 ->joinWith(['plants'], true, 'LEFT JOIN')
		 ->asArray();

		return $row ->all();
	}
}

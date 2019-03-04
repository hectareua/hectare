<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phases".
 *
 * @property integer $id
 * @property string $name
 * @property integer $image_id
 *
 */
class Phases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','name_uk'], 'required'],
            [['image_id'], 'integer'],
            [['name','name_uk'], 'string', 'max' => 100],            
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],                        
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Iм\'я',
            'name_uk' => 'Iм\'я UK',
            'image_id' => 'Image ID',            
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'name',
            'name_uk',
            'image',            
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

}

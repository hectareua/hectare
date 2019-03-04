<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager_trophy".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $desc_uk
 * @property string $desc_ru
 *
 * @property Image $image
 */
class ManagerTrophy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager_trophy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id'], 'required'],
            [['image_id','min_sale','max_sale','step'], 'integer'],
            [['desc_uk', 'desc_ru'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
			[['trophy_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TrophyType::className(), 'targetAttribute' => ['trophy_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Картинка',
            'desc_uk' => 'Опис укр.',
            'desc_ru' => 'Опис рос.',
			'trophy_type_id' => 'Тип нагороди',
            'min_sale' => 'Мінімальна сума продажу',
            'max_sale' => 'Максимальна сума продажу',
            'step' => 'Інтервал за якого видається зірочка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    public function getManagerTrophyRelation()
    {
        return $this->hasMany(ManagerTrophyRelation::className(), ['manager_trophy_id' => 'id']);
    }
	
	 public function getTrophyType()
    {
        return $this->hasOne(TrophyType::className(), ['id' => 'trophy_type_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_tabs".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $slug
 */
class InfoTabs extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_tabs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id'], 'required'],
            [['name_uk', 'name_ru', 'slug'], 'string', 'max' => 255],
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
            'name_uk' => 'Категорія',
            'name_ru' => 'Name Ru',
            'slug' => 'Slug',
            'image_id' => 'Картинка',
        ];
    }

    public function getInfoTabsContent(){
        return $this->hasMany(InfoTabsContent::className(), ['info_tabs_id' => 'id']);
    }

    public function getImage(){
        return $this->hasOne(Image::className(),['id' => 'image_id']);
    }
}

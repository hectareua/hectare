<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $c_id
 * @property string $c_name
 * @property integer $c_approved
 * @property integer $c_rating
 * @property string $c_body
 * @property string $c_created
 * @property string $c_amended
 * @property integer $c_deleted
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_name', 'c_body'], 'required'],
            [['c_approved', 'c_rating', 'c_deleted'], 'integer'],
            [['c_body'], 'string'],
            [['c_created', 'c_amended' ,'c_type'], 'safe'],
            [['c_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'Номер',
            'c_name' => 'Имя',
			'c_type' => 'Тип',
            'c_approved' => 'Показывать',
            'c_rating' => 'Порядок',
            'c_body' => 'Тело',
            'c_created' => 'Создано',
            'c_amended' => 'Изменено',
            'c_deleted' => 'Удалено',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $image_id
 *
 * @property Image $image
 * @property User[] $users
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'image_id'], 'required'],
            [['image_id','carma','manager_type','user_add_id'], 'integer'],
            [['bd'], 'string', 'max' => 10],
            [['date_add'], 'safe'],
            [['name', 'phone','job','last_name', 'code1c'], 'string', 'max' => 255],
            ['email', 'email'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['image_two_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
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
            'phone' => 'Телефон',
            'job' => 'Посада',
            'bd' => 'Дата народження',
            'date_add' => 'Дата прийняття на роботу',
            'manager_type' => 'Тип менеджера',
            'user_add_id' => 'Користувач, який додав',
            'carma' => 'Карма',
            'image_id' => 'Image ID',
            'code1c' =>'Код з 1с',
            'last_name' => 'Прізвище'
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'name',
            'phone',
            'job',
            'bd',
            'carma',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageTwo()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_two_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['manager_id' => 'id']);
    }

    public function getManagerTrophyRelation(){
        return $this->hasMany(ManagerTrophyRelation::className(), ['manager_id' => 'id']);
    }

    public function getManagerTrophy(){
        return $this->hasMany(ManagerTrophy::className(), ['id' => 'manager_trophy_id'])->via('managerTrophyRelation');
    }
}

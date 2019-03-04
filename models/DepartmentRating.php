<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department_rating".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $depart_id
 * @property integer $mark
 * @property string $date_add
 *
 * @property Department $depart
 * @property User $user
 */
class DepartmentRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'depart_id', 'mark'], 'required'],
            [['user_id', 'depart_id', 'mark'], 'integer'],
            [['date_add'], 'safe'],
            [['depart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['depart_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Користувач',
            'depart_id' => 'Відділ',
            'mark' => 'Оцінка',
            'date_add' => 'Дата оцінювання',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepart()
    {
        return $this->hasOne(Department::className(), ['id' => 'depart_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getClient()
    {
        return $this->hasOne(Client::className(), ['user_id' => 'user_id']);
    }
}

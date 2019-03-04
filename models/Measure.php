<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "measure".
 *
 * @property integer $id
 * @property string $name
 * @property integer $opt
 * @property integer $attribute_id
 *
 * @property Attribute $attribute
 */
class Measure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'opt', 'attribute_id'], 'required'],
            [['opt', 'attribute_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    public static function getDropDownList()
    {
        $result = [];
        $models = self::find()->all();
        foreach ($models as $model)
        {
            $result[$model->unit] = $model->name_uk;
        }
           return $result;
    }

    public static function getDropDownListOptions() {
        $result = [];
        $models = self::find()->all();
        foreach ($models as $model)
        {
            $alias = $model->attr ? $model->attr->alias : 'none';
            $lab = $model->attr ? $model->attr->name_uk : null;
            $result[$model->unit] = ['opt-status' => $model->opt, 'name'=> $alias, 'lab' => $lab];
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'opt' => 'Opt',
            'attribute_id' => 'Attribute ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }


}

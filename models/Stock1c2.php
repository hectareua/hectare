<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock1c".
 *
 */
class Stock1c extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock1c';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['fullname','name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name',
            'fullname' => 'fullname',
        ];
    }

	public static function isStock($name,$fullname) {
		$ret = ['code'=>10,'info'=>'Error'];
		$res = Stock1c::findOne(['name'=>$name]);
		if ($res) {
			$ret = ['code'=>200,'info'=>$res->id];
		} else {
			$st = new Stock1c();
			$st->name = $name;
			$st->fullname = $fullname;
			if($res = $st->save())
			{
				$ret = ['code'=>404,'info'=>$st->id];
			} else {
				$ret = ['code'=>500,'info'=>$st->getErrors()];
			}
		}
		return $ret;
	}

}

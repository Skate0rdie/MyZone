<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%building}}".
 *
 * @property integer $buil_id
 * @property string $buil_name
 * @property integer $admin_id
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%building}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buil_name', 'admin_id'], 'required'],
            [['admin_id'], 'integer'],
            [['buil_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'buil_id' => 'Buil ID',
            'buil_name' => 'Buil Name',
            'admin_id' => 'Admin ID',
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $user_nickname
 * @property string $user_name
 * @property string $user_tel
 * @property string $user_sex
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_nickname', 'user_name', 'user_tel', 'user_sex'], 'required'],
            [['user_nickname', 'user_name', 'user_tel', 'user_sex'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_nickname' => 'User Nickname',
            'user_name' => 'User Name',
            'user_tel' => 'User Tel',
            'user_sex' => 'User Sex',
        ];
    }
}

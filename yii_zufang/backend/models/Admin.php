<?php

namespace backend\models;

use Yii;
use backend\models\Building;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property integer $id
 * @property integer $admin_sex
 * @property string $admin_nickname
 * @property integer $admin_status
 * @property string $admin_tel
 * @property string $num_wechat
 * @property string $num_alipay
 * @property string $admin_pass
 * @property integer $admin_type
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_sex', 'admin_status', 'admin_type'], 'integer'],
            [['admin_nickname', 'num_wechat', 'num_alipay'], 'string', 'max' => 16],
            [['admin_tel'], 'string', 'max' => 11],
            [['admin_pass'], 'string', 'max' => 50],
            [['admin_pass','admin_nickname'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'ID',
            'admin_sex' => '性别',
            'admin_nickname' => '昵称',
            'admin_status' => '',
            'admin_tel' => '电话',
            'num_wechat' => '微信号',
            'num_alipay' => '支付宝号',
            'admin_pass' => '密码',
            'admin_type' => '',
        ];
    }
}

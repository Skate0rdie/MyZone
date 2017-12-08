<?php

namespace backend\models;

use Yii;
use backend\models\User;
use backend\models\Building;
use backend\models\Houses;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $bl_id
 * @property integer $ho_id
 * @property string $order_type
 * @property string $order_status
 * @property string $order_qq
 * @property string $order_wx
 * @property integer $admin_id
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'bl_id', 'ho_id', 'order_type', 'order_status', 'order_qq', 'order_wx', 'admin_id'], 'required'],
            [['user_id', 'bl_id', 'ho_id', 'admin_id', 'order_status','order_type'], 'integer'],
            [['order_qq'], 'string', 'max' => 15],
            [['order_wx'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'bl_id' => 'Bl ID',
            'ho_id' => 'Ho ID',
            'order_type' => 'Order Type',
            'order_status' => 'Order Status',
            'order_qq' => 'Order Qq',
            'order_wx' => 'Order Wx',
            'admin_id' => 'Admin ID',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['user_id'=>'user_id']);
    }
    
    public function getBuilding(){
        return $this->hasOne(Building::className(),['buil_id'=>'bl_id']);
    }

    public function getHouses(){
        return $this->hasOne(Houses::className(),['ho_id'=>'ho_id']);
    }

    public function getAdmin(){
        return $this->hasOne(Admin::className(),['admin_id'=>'admin_id']);
    }

    // public function getHouses()
    // {
    //     return $this->hasOne(Houses::className(), ['bid' => 'bid'])
    //           ->viaTable(Building::tableName(), ['bid' => 'bl_id']);
    // }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%houses}}".
 *
 * @property integer $ho_id
 * @property string $ho_hname
 * @property integer $bid
 * @property integer $tid
 * @property string $ho_address
 * @property string $ho_pic
 * @property string $ho_acreage
 * @property string $furn_id
 * @property integer $hold_id
 * @property string $ho_rent
 * @property string $ho_deposit
 * @property integer $payment_id
 * @property string $ho_creattime
 * @property string $ho_description
 * @property integer $ho_renttype
 */
class Houses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%houses}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ho_hname', 'bid', 'tid', 'ho_address', 'ho_pic', 'ho_acreage', 'furn_id', 'hold_id', 'ho_rent', 'ho_deposit', 'payment_id', 'ho_creattime', 'ho_description'], 'required'],
            [['bid', 'tid', 'hold_id', 'payment_id', 'ho_renttype'], 'integer'],
            [['ho_hname', 'ho_address', 'ho_pic', 'ho_acreage', 'furn_id'], 'string', 'max' => 50],
            [['ho_rent', 'ho_deposit', 'ho_creattime'], 'string', 'max' => 20],
            [['ho_description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ho_id' => 'Ho ID',
            'ho_hname' => 'Ho Hname',
            'bid' => 'Bid',
            'tid' => 'Tid',
            'ho_address' => 'Ho Address',
            'ho_pic' => 'Ho Pic',
            'ho_acreage' => 'Ho Acreage',
            'furn_id' => 'Furn ID',
            'hold_id' => 'Hold ID',
            'ho_rent' => 'Ho Rent',
            'ho_deposit' => 'Ho Deposit',
            'payment_id' => 'Payment ID',
            'ho_creattime' => 'Ho Creattime',
            'ho_description' => 'Ho Description',
            'ho_renttype' => 'Ho Renttype',
        ];
    }
}

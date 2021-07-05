<?php

namespace app\models;

use Yii;

/**
 *
 * @property int $id
 * @property string $name
 * @property int $ip_address_id
 * @property int $status
 * @property int $attempts
 *
 */
class MacAddresses extends \yii\base\Model
{
    public $id;
    public $name;
    public $ip_address_id;
    public $status;
    public $attempts;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'ip_address_id'], 'required'],
            [['id', 'ip_address_id', 'status', 'attempts'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['ip_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => IpAddresses::className(), 'targetAttribute' => ['ip_address_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'MAC-адрес',
            'ip_address_id' => 'Ip Address ID',
            'status' => 'Статус активности Mac-адреса',
            'attempts' => 'С какой попытки был создан уникальный Mac-адрес',
        ];
    }
}
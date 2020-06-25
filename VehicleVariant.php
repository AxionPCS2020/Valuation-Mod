<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vehicle_variant".
 *
 * @property int $id
 * @property int $makeId
 * @property int $modelId
 * @property string $variant
 * @property string $createdOn
 */
class VehicleVariant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_variant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['makeId', 'modelId', 'variant'], 'required'],
            [['makeId', 'modelId'], 'integer'],
            [['createdOn'], 'safe'],
            [['variant'], 'string', 'max' => 50],
        ];
    }

    public function getVariantmake()
    {
        return $this->hasOne(VehicleMake::className(), ['id' => 'makeId']);
    }

    public function getVariantmodel()
    {
        return $this->hasOne(VehicleModel::className(), ['id' => 'modelId']);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'makeId' => 'Make',
            'modelId' => 'Model',
            'variant' => 'Variant',
            'createdOn' => 'Created On',
        ];
    }
}

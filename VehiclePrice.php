<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vehicle_price".
 *
 * @property int $id
 * @property int $makeId
 * @property int $modelId
 * @property int $variantId
 * @property string $variantStartingMonth
 * @property string $variantStartingYear
 * @property string $variantEndMonth
 * @property string $variantEndYear
 * @property string $fuelType
 * @property string $cubicCapacity
 * @property string $month
 * @property string $year
 * @property string $state
 * @property int $Calculate
 * @property string $Age
 * @property string $ex_showroom_price
 * @property string $current_market_price
 * @property string $createdOn
 */
class VehiclePrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'variantStartingMonth', 'variantStartingYear', 'variantEndMonth', 'variantEndYear', 'fuelType', 'cubicCapacity', 'month', 'year', 'state'], 'required'],
            [['makeId', 'modelId', 'variantId', 'Calculate'], 'integer'],
            [['createdOn','makeId', 'modelId',], 'safe'],
            [['variantStartingMonth', 'variantStartingYear', 'variantEndMonth', 'variantEndYear', 'fuelType', 'cubicCapacity', 'year', 'state', 'ex_showroom_price', 'current_market_price'], 'string', 'max' => 50],
            [['month', 'Age'], 'string', 'max' => 30],
        ];
    }


       public function getPricemake()
    {
        return $this->hasOne(VehicleMake::className(), ['id' => 'makeId']);
    }
    
    public function getPricemodel()
    {
        return $this->hasOne(VehicleModel::className(), ['id' => 'modelId']);
    }

     public function getPricevariant()
    {
        return $this->hasOne(VehicleVariant::className(), ['id' => 'variantId']);
    }

    


    
    public function getState()
   {
     $states = [
                ['id' => '' , 'name' => '-Select-'],
                ['id' => 'TamilNadu' , 'name' => 'TamilNadu'],
                ['id' => 'Kerala' ,  'name' => 'Kerala'],
                ['id' => 'Bangalore' , 'name' => 'Bangalore'],
                ['id' => 'Delhi' ,  'name' => 'Delhi'],
                ['id' => 'Mumbai' ,  'name' => 'Mumbai'],
                ['id' => 'Bengal' ,  'name' => 'Bengal'],
                ['id' => 'Uttarpradesh' ,  'name' => 'Uttarpradesh'],
                ['id' => 'Rajasthan' ,  'name' => 'Rajasthan'],
                ['id' => 'Andhrapradesh' ,  'name' => 'Andhrapradesh'],
               
                    
            ];
          $state = ArrayHelper::map($states, 'id', 'name');
          return $state;
  }

  public function getMonthValue()
    {
        $monthList = [
            ['id' => '', 'name' => '-Select-'],
           ['id' => '1', 'name' => 'January'],
           ['id' => '2', 'name' => 'February'],
           ['id' => '3', 'name' => 'March'],
           ['id' => '4', 'name' => 'April'],
           ['id' => '5', 'name' => 'May'],
           ['id' => '6', 'name' => 'June'],
           ['id' => '7', 'name' => 'July'],
           ['id' => '8', 'name' => 'August'],
           ['id' => '9', 'name' => 'September'],
           ['id' => '10', 'name' => 'October'],
           ['id' => '11', 'name' => 'November'],
           ['id' => '12', 'name' => 'December'],
        ];
        $monthArray = ArrayHelper::map($monthList,'id','name');
        return $monthArray;
    }

     public function getYearValue()
    {
        $yearList = [
            ['id' => '', 'name' => '-Select-'],
           ['id' => '2009', 'name' => '2009'],
           ['id' => '2010', 'name' => '2010'],
           ['id' => '2011', 'name' => '2011'],
           ['id' => '2012', 'name' => '2012'],
           ['id' => '2013', 'name' => '2013'],
           ['id' => '2014', 'name' => '2014'],
           ['id' => '2015', 'name' => '2015'],
           ['id' => '2016', 'name' => '2016'],
           ['id' => '2017', 'name' => '2017'],
           ['id' => '2018', 'name' => '2018'],
           ['id' => '2019', 'name' => '2019'],
           
        ];
        $yearArray = ArrayHelper::map($yearList,'id','name');
        return $yearArray;
    }



  public function getFuelTypevalue()
    {
        $fuelTypeList = [
              ['id' => '', 'name' => '-Select-'],
              ['id' => 'Diesel', 'name' => 'Diesel'],
              ['id' => 'Petrol', 'name' => 'Petrol'],   
              ['id' => 'CNG(Petrol)', 'name' => 'CNG(Petrol)'],
              ['id' => 'CNG(Diesel)', 'name' => 'CNG(Diesel)'],
              ['id' => 'LPG(Petrol)', 'name' => 'LPG(Petrol)'],
              ['id' => 'LPG', 'name' => 'LPG'],
              ['id' => 'Electric', 'name' => 'Electric'],
                       ];
    $fuelTypeArray = ArrayHelper::map($fuelTypeList, 'id', 'name');
        return $fuelTypeArray;
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
            'variantId' => 'Variant',
            'variantStartingMonth' => 'Variant Starting Month',
            'variantStartingYear' => 'Variant Starting Year',
            'variantEndMonth' => 'Variant End Month',
            'variantEndYear' => 'Variant End Year',
            'fuelType' => 'Fuel Type',
            'cubicCapacity' => 'Cubic Capacity',
            'month' => 'Month',
            'year' => 'Year',
            'state' => 'State',
            'Calculate' => 'Calculate',
            'Age' => 'Age',
            'ex_showroom_price' => 'Ex Showroom Price',
            'current_market_price' => 'Current Market Price',
            'createdOn' => 'Created On',
        ];
    }
}

<?php

/**
 * This is the model class for table "varasto_rakenne".
 *
 * The followings are the available columns in table 'varasto_rakenne':
 * @property integer $id
 * @property integer $yid
 * @property string $time
 * @property string $varaston_nimike
 * @property string $sarakkeen_nimi
 * @property integer $sarakkeen_tyyppi
 * @property integer $sum
 */
class VarastoRakenne extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VarastoRakenne the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'varasto_rakenne';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('yid, varaston_nimike, sarakkeen_nimi, sarakkeen_tyyppi, sum, position', 'required'),
			array('yid, sarakkeen_tyyppi, sum, position, is_otsikko, varaston_nimike_id, tr_rivi', 'numerical', 'integerOnly'=>true),
			array('varaston_nimike, sarakkeen_nimi', 'length', 'max'=>255),
			array('value', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, yid, time, varaston_nimike, sarakkeen_nimi, sarakkeen_tyyppi, sum', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'yid' => 'Yid',
			'time' => 'Time',
			'varaston_nimike' => 'Varaston Nimike',
			'sarakkeen_nimi' => 'Sarakkeen Nimi',
			'sarakkeen_tyyppi' => 'Sarakkeen Tyyppi',
			'sum' => Yii::t('main', 'Yhteensä raportissa'),
			'position'=>Yii::t('main', 'Järjestysnumero'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('yid',$this->yid);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('varaston_nimike',$this->varaston_nimike,true);
		$criteria->compare('sarakkeen_nimi',$this->sarakkeen_nimi,true);
		$criteria->compare('sarakkeen_tyyppi',$this->sarakkeen_tyyppi);
		$criteria->compare('sum',$this->sum);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

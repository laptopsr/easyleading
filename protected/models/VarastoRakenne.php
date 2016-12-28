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

		$table = Yii::app()->db->schema->getTable('varasto_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `varasto_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `varaston_nimike` varchar(500) NOT NULL,
		  `tuotteen_ryhman_nimike` varchar(255) NOT NULL,
		  `sarakkeen_nimi` varchar(500) NOT NULL,
		  `sarakkeen_tyyppi` int(3) NOT NULL,
		  `sum` int(1) NOT NULL,
		  `value` TEXT NOT NULL,
		  `position` int(10) NOT NULL,
		  `varaston_nimike_id` int(11) NOT NULL,
		  `tr_rivi` varchar(500) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "varasto_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('varaston_nimike, sarakkeen_nimi, sarakkeen_tyyppi, sum, position', 'required'),
			array('sarakkeen_tyyppi, sum, position, varaston_nimike_id', 'numerical', 'integerOnly'=>true),
			array('varaston_nimike, sarakkeen_nimi', 'length', 'max'=>500),
			array('value, tr_rivi', 'length', 'max'=>500),
			array('tuotteen_ryhman_nimike', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time, varaston_nimike, sarakkeen_nimi, sarakkeen_tyyppi, sum', 'safe', 'on'=>'search'),
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
			'time' => 'Time',
			'varaston_nimike' => 'Varaston Nimike',
			'sarakkeen_nimi' => 'Sarakkeen Nimi',
			'sarakkeen_tyyppi' => 'Sarakkeen Tyyppi',
			'sum' => Yii::t('main', 'Yhteensä raportissa'),
			'position'=>Yii::t('main', 'Järjestysnumero'),
			'tuotteen_ryhman_nimike'=>Yii::t('main', 'Ryhmä'),
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

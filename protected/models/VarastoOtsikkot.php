<?php

/**
 * This is the model class for table "varasto_otsikkot".
 *
 * The followings are the available columns in table 'varasto_otsikkot':
 * @property integer $id
 * @property integer $yid
 * @property string $time
 * @property string $varaston_nimike
 * @property string $sarakkeen_nimi
 * @property integer $sarakkeen_tyyppi
 * @property integer $sum
 * @property string $value
 * @property integer $position
 * @property integer $varaston_nimike_id
 * @property integer $tr_rivi
 */
class VarastoOtsikkot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VarastoOtsikkot the static model class
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
		$table = Yii::app()->db->schema->getTable('varasto_otsikkot_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `varasto_otsikkot_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `yid` int(11) NOT NULL,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `varaston_nimike` varchar(500) NOT NULL,
		  `sarakkeen_nimi` varchar(500) NOT NULL,
		  `sarakkeen_tyyppi` int(3) NOT NULL,
		  `sum` int(1) NOT NULL,
		  `value` varchar(500) NOT NULL,
		  `position` int(10) NOT NULL,
		  `varaston_nimike_id` int(11) NOT NULL,
		  `tr_rivi` varchar(500) NOT NULL,
		  `naytetaan_taulussa` int(1) NOT NULL DEFAULT 1
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "varasto_otsikkot_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
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
			array('yid, sarakkeen_tyyppi, sum, position, varaston_nimike_id, naytetaan_taulussa', 'numerical', 'integerOnly'=>true),
			array('varaston_nimike, sarakkeen_nimi', 'length', 'max'=>500),
			array('value, tr_rivi', 'length', 'max'=>500),
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
			'varaston_nimike' => 'Varaston nimi',
			'sarakkeen_nimi' => 'Sarakkeen nimi',
			'sarakkeen_tyyppi' => 'Sarakkeen tyyppi',
			'sum' => 'Summaus',
			'value' => 'Value',
			'position' => 'Sarakkeen järjestynumero',
			'varaston_nimike_id' => 'Varaston nimi',
			'tr_rivi' => 'Tr Rivi',
			'naytetaan_taulussa'=> 'Sarake näytetään varaston etusivulla',
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
		$criteria->compare('value',$this->value,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('varaston_nimike_id',$this->varaston_nimike_id);
		$criteria->compare('tr_rivi',$this->tr_rivi);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

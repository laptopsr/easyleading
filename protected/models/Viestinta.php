<?php

/**
 * This is the model class for table "viestinta".
 *
 * The followings are the available columns in table 'viestinta':
 * @property integer $id
 * @property string $time
 * @property integer $saaja
 * @property integer $lahettaja
 * @property string $teksti
 */
class Viestinta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Viestinta the static model class
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


		$table = Yii::app()->db->schema->getTable('viestinta_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `viestinta_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `saaja` int(11) NOT NULL,
		  `lahettaja` int(11) NOT NULL,
		  `teksti` TEXT NOT NULL,
		  `is_katsonut` int(1) NOT NULL,
		  `otsikko` varchar(255) NOT NULL,
		  `piilottu_seuraavasta_idsta` varchar(255) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "viestinta_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('saaja, lahettaja, teksti, otsikko', 'required'),
			array('saaja, lahettaja, is_katsonut', 'numerical', 'integerOnly'=>true),
			array('otsikko', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time, saaja, lahettaja, teksti', 'safe', 'on'=>'search'),
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
			'time' => 'Lähetysaika',
			'saaja' => 'Saaja',
			'lahettaja' => 'Lähettäjä',
			'teksti' => 'Teksti',
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
		$criteria->compare('saaja',$this->saaja);
		$criteria->compare('lahettaja',$this->lahettaja);
		$criteria->compare('teksti',$this->teksti,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

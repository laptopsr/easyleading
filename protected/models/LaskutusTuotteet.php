<?php

/**
 * This is the model class for table "laskutus_tuotteet".
 *
 * The followings are the available columns in table 'laskutus_tuotteet':
 * @property integer $id
 * @property string $time
 * @property string $tuotenimi
 * @property string $hinta_alv_0
 * @property string $hinta_alv_sis
 * @property string $alv
 * @property string $yksikko
 * @property integer $netvisorkey
 * @property integer $ryhma
 * @property integer $is_active
 */
class LaskutusTuotteet extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		$table = Yii::app()->db->schema->getTable('laskutus_tuotteet_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `laskutus_tuotteet_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `tuotenimi` varchar(100) NOT NULL,
		  `hinta_alv_0` varchar(20) NOT NULL,
		  `hinta_alv_sis` varchar(20) NOT NULL,
		  `alv` varchar(10) NOT NULL,
		  `yksikko` varchar(20) NOT NULL,
		  `netvisorkey` int(11) NOT NULL,
		  `ryhma` int(3) NOT NULL,
		  `is_active` int(1) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "laskutus_tuotteet_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tuotenimi, hinta_alv_0, hinta_alv_sis, alv, yksikko, is_active', 'required'),
			array('netvisorkey, ryhma, is_active', 'numerical', 'integerOnly'=>true),
			array('tuotenimi', 'length', 'max'=>100),
			array('hinta_alv_0, hinta_alv_sis, yksikko', 'length', 'max'=>20),
			array('alv', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, time, tuotenimi, hinta_alv_0, hinta_alv_sis, alv, yksikko, netvisorkey, ryhma, is_active', 'safe', 'on'=>'search'),
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
			'tuotenimi' => 'Tuotenimi',
			'hinta_alv_0' => 'Hinta Alv 0',
			'hinta_alv_sis' => 'Hinta Alv Sis',
			'alv' => 'Alv',
			'yksikko' => 'Yksikko',
			'netvisorkey' => 'Netvisorkey',
			'ryhma' => 'Ryhma',
			'is_active' => 'Is Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('tuotenimi',$this->tuotenimi,true);
		$criteria->compare('hinta_alv_0',$this->hinta_alv_0,true);
		$criteria->compare('hinta_alv_sis',$this->hinta_alv_sis,true);
		$criteria->compare('alv',$this->alv,true);
		$criteria->compare('yksikko',$this->yksikko,true);
		$criteria->compare('netvisorkey',$this->netvisorkey);
		$criteria->compare('ryhma',$this->ryhma);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LaskutusTuotteet the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

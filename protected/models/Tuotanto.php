<?php

/**
 * This is the model class for table "tuotanto".
 *
 * The followings are the available columns in table 'tuotanto':
 * @property integer $id
 * @property string $time
 * @property string $tehtavanimike
 * @property integer $osoitettu_tyontekija
 * @property string $tyon_tiedot
 * @property string $suunniteltu_aloitus
 * @property string $suuniteltu_lopetus
 * @property string $toteutunut_aloitus
 * @property string $toteutunut_lopetus
 * @property string $lisatiedot
 * @property integer $liitteet
 * @property integer $varasto_tuote
 * @property string $extra_sarake1
 */
class Tuotanto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tuotanto the static model class
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
		$table = Yii::app()->db->schema->getTable('tuotanto_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `tuotanto_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `tehtavanimike` varchar(255) NOT NULL,
		  `osoitettu_tyontekija` int(11) NOT NULL,
		  `tyon_tiedot` text NOT NULL,
		  `suunniteltu_aloitus` varchar(50) NOT NULL,
		  `suuniteltu_lopetus` varchar(50) NOT NULL,
		  `toteutunut_aloitus` varchar(50) NOT NULL,
		  `toteutunut_lopetus` varchar(50) NOT NULL,
		  `lisatiedot` text NOT NULL,
		  `liitteet` text NOT NULL,
		  `varasto_tuote` int(11) NOT NULL,
		  `extra_sarake1` varchar(255) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "tuotanto_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('time, tehtavanimike, osoitettu_tyontekija, tyon_tiedot, suunniteltu_aloitus, suuniteltu_lopetus, toteutunut_aloitus, toteutunut_lopetus, lisatiedot, liitteet, varasto_tuote, extra_sarake1', 'required'),
			array('osoitettu_tyontekija, varasto_tuote', 'numerical', 'integerOnly'=>true),
			array('tehtavanimike, extra_sarake1', 'length', 'max'=>255),
			array('suunniteltu_aloitus, suuniteltu_lopetus, toteutunut_aloitus, toteutunut_lopetus', 'length', 'max'=>50),
			array('liitteet', 'length', 'max'=>5000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time, tehtavanimike, osoitettu_tyontekija, tyon_tiedot, suunniteltu_aloitus, suuniteltu_lopetus, toteutunut_aloitus, toteutunut_lopetus, lisatiedot, liitteet, varasto_tuote, extra_sarake1', 'safe', 'on'=>'search'),
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
			'tehtavanimike' => 'Tehtavanimike',
			'osoitettu_tyontekija' => 'Osoitettu Tyontekija',
			'tyon_tiedot' => 'Tyon Tiedot',
			'suunniteltu_aloitus' => 'Suunniteltu Aloitus',
			'suuniteltu_lopetus' => 'Suuniteltu Lopetus',
			'toteutunut_aloitus' => 'Toteutunut Aloitus',
			'toteutunut_lopetus' => 'Toteutunut Lopetus',
			'lisatiedot' => 'Lisatiedot',
			'liitteet' => 'Liitteet',
			'varasto_tuote' => 'Varasto Tuote',
			'extra_sarake1' => 'Extra Sarake1',
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
		$criteria->compare('tehtavanimike',$this->tehtavanimike,true);
		$criteria->compare('osoitettu_tyontekija',$this->osoitettu_tyontekija);
		$criteria->compare('tyon_tiedot',$this->tyon_tiedot,true);
		$criteria->compare('suunniteltu_aloitus',$this->suunniteltu_aloitus,true);
		$criteria->compare('suuniteltu_lopetus',$this->suuniteltu_lopetus,true);
		$criteria->compare('toteutunut_aloitus',$this->toteutunut_aloitus,true);
		$criteria->compare('toteutunut_lopetus',$this->toteutunut_lopetus,true);
		$criteria->compare('lisatiedot',$this->lisatiedot,true);
		$criteria->compare('liitteet',$this->liitteet);
		$criteria->compare('varasto_tuote',$this->varasto_tuote);
		$criteria->compare('extra_sarake1',$this->extra_sarake1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

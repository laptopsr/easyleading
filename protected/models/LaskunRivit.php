<?php

/**
 * This is the model class for table "laskun_rivit".
 *
 * The followings are the available columns in table 'laskun_rivit':
 * @property integer $id
 * @property string $time
 * @property integer $lid
 * @property integer $rivi
 * @property string $tkoodi
 * @property string $nimike
 * @property string $kpl
 * @property string $yksikko
 * @property string $hinta
 * @property string $alv
 * @property string $hinta_alv
 * @property string $ale
 * @property string $veroton
 * @property string $yhteensa_alv
 * @property integer $tuoteID
 * @property string $free_text
 */
class LaskunRivit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{

		$table = Yii::app()->db->schema->getTable('laskun_rivit_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `laskun_rivit_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `lid` int(11) NOT NULL,
		  `rivi` int(11) NOT NULL,
		  `tkoodi` varchar(255) NOT NULL,
		  `nimike` varchar(100) NOT NULL,
		  `kpl` varchar(20) NOT NULL,
		  `yksikko` varchar(20) NOT NULL,
		  `hinta` varchar(20) NOT NULL,
		  `alv` varchar(20) NOT NULL,
		  `hinta_alv` varchar(20) NOT NULL,
		  `ale` varchar(20) NOT NULL,
		  `veroton` varchar(20) NOT NULL,
		  `yhteensa_alv` varchar(20) NOT NULL,
		  `tuoteID` int(11) NOT NULL,
		  `free_text` varchar(250) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "laskun_rivit_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('lid, rivi, tkoodi, nimike, kpl, yksikko, hinta, alv, hinta_alv, ale, veroton, yhteensa_alv, tuoteID, free_text', 'required'),*/
			array('lid, rivi, tuoteID', 'numerical', 'integerOnly'=>true),
			array('tkoodi', 'length', 'max'=>255),
			array('nimike', 'length', 'max'=>100),
			array('kpl, yksikko, hinta, alv, hinta_alv, ale, veroton, yhteensa_alv', 'length', 'max'=>20),
			array('free_text', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, time, lid, rivi, tkoodi, nimike, kpl, yksikko, hinta, alv, hinta_alv, ale, veroton, yhteensa_alv, tuoteID, free_text', 'safe', 'on'=>'search'),
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
			'lid' => 'Lid',
			'rivi' => 'Rivi',
			'tkoodi' => 'Tkoodi',
			'nimike' => 'Nimike',
			'kpl' => 'Kpl',
			'yksikko' => 'Yksikko',
			'hinta' => 'Hinta',
			'alv' => 'Alv',
			'hinta_alv' => 'Hinta Alv',
			'ale' => 'Ale',
			'veroton' => 'Veroton',
			'yhteensa_alv' => 'Yhteensa Alv',
			'tuoteID' => 'Tuote',
			'free_text' => 'Free Text',
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
		$criteria->compare('lid',$this->lid);
		$criteria->compare('rivi',$this->rivi);
		$criteria->compare('tkoodi',$this->tkoodi,true);
		$criteria->compare('nimike',$this->nimike,true);
		$criteria->compare('kpl',$this->kpl,true);
		$criteria->compare('yksikko',$this->yksikko,true);
		$criteria->compare('hinta',$this->hinta,true);
		$criteria->compare('alv',$this->alv,true);
		$criteria->compare('hinta_alv',$this->hinta_alv,true);
		$criteria->compare('ale',$this->ale,true);
		$criteria->compare('veroton',$this->veroton,true);
		$criteria->compare('yhteensa_alv',$this->yhteensa_alv,true);
		$criteria->compare('tuoteID',$this->tuoteID);
		$criteria->compare('free_text',$this->free_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LaskunRivit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "asiakkaat_yid".
 *
 * The followings are the available columns in table 'asiakkaat_yid':
 * @property integer $id
 * @property string $time
 * @property string $yrityksen_nimi
 * @property integer $tyyppi
 * @property string $y_tunnus
 * @property string $henkilotunnus
 * @property string $yhteyshenkilo
 * @property string $sahkoposti
 * @property string $osoite
 * @property integer $postinumero
 * @property string $postitoimipaikka
 * @property string $kayntiosoite
 * @property integer $kayntipostinumero
 * @property string $kayntipostitoimipaikka
 * @property string $puhelinnumero
 * @property string $laskutuskanava
 * @property integer $kirjeluokka
 * @property string $ovt_tunnus
 * @property string $verkkolaskuosoite
 * @property string $valittajatunnus
 * @property integer $viivastyskorko
 * @property integer $maksuehto
 * @property integer $alv_prosentti
 */
class Asiakkaat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Asiakkaat the static model class
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
		$table = Yii::app()->db->schema->getTable('asiakkaat_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `asiakkaat_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `asiakasnumero` varchar(255) NOT NULL,
		  `ryhma` varchar(255) NOT NULL,
		  `yrityksen_nimi` varchar(255) NOT NULL,
		  `tyyppi` int(1) NOT NULL,
		  `y_tunnus` varchar(255) NOT NULL,
		  `henkilotunnus` varchar(255) NOT NULL,
		  `yhteyshenkilo` varchar(255) NOT NULL,
		  `sahkoposti` varchar(255) NOT NULL,
		  `osoite` varchar(255) NOT NULL,
		  `postinumero` int(1) NOT NULL,
		  `postitoimipaikka` varchar(255) NOT NULL,
		  `kayntiosoite` varchar(255) NOT NULL,
		  `kayntipostinumero` int(1) NOT NULL,
		  `kayntipostitoimipaikka` varchar(255) NOT NULL,
		  `puhelinnumero` varchar(255) NOT NULL,
		  `laskutuskanava` varchar(255) NOT NULL,
		  `kirjeluokka` int(1) NOT NULL,
		  `ovt_tunnus` varchar(255) NOT NULL,
		  `verkkolaskuosoite` varchar(255) NOT NULL,
		  `valittajatunnus` varchar(255) NOT NULL,
		  `viivastyskorko` int(10) NOT NULL,
		  `maksuehto` int(10) NOT NULL,
		  `alv_prosentti` int(10) NOT NULL,
		  `netvisorkey` int(11) NOT NULL,
		  `aktiivinen` int(1) NOT NULL,
		  `eriosoite` varchar(100) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "asiakkaat_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asiakasnumero', 'required'),
                        array('asiakasnumero','unique', 'message'=>'Tämä asiakasnmero on jo annettu toiselle aisakkaalle.'),
			array('tyyppi, postinumero, kayntipostinumero, kirjeluokka, viivastyskorko, maksuehto, alv_prosentti, aktiivinen', 'numerical', 'integerOnly'=>true),
			array('yrityksen_nimi, y_tunnus, henkilotunnus, yhteyshenkilo, sahkoposti, osoite, postitoimipaikka, kayntiosoite, kayntipostitoimipaikka, puhelinnumero, ovt_tunnus, verkkolaskuosoite, valittajatunnus, asiakasnumero, ryhma', 'length', 'max'=>255),
			array('laskutuskanava, eriosoite', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
	
		array('id, time, yrityksen_nimi, tyyppi, y_tunnus, henkilotunnus, yhteyshenkilo, sahkoposti, osoite, postinumero, postitoimipaikka, kayntiosoite, kayntipostinumero, kayntipostitoimipaikka, puhelinnumero, laskutuskanava, kirjeluokka, ovt_tunnus, verkkolaskuosoite, valittajatunnus, viivastyskorko, maksuehto, alv_prosentti', 'safe', 'on'=>'search'),
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
			'time' => 'Luontiaika',
			'yrityksen_nimi' => 'Yrityksen nimi',
			'tyyppi' => 'Tyyppi',
			'y_tunnus' => 'Y-tunnus',
			'henkilotunnus' => 'Henkilötunnus',
			'yhteyshenkilo' => 'Yhteyshenkilö',
			'sahkoposti' => 'Sähköposti',
			'osoite' => 'Osoite',
			'postinumero' => 'Postinumero',
			'postitoimipaikka' => 'Postitoimipaikka',
			'kayntiosoite' => 'Käyntiosoite',
			'kayntipostinumero' => 'Käyntipostinumero',
			'kayntipostitoimipaikka' => 'Käyntipostitoimipaikka',
			'puhelinnumero' => 'Puhelinnumero',
			'laskutuskanava' => 'Laskutuskanava',
			'kirjeluokka' => 'Kirjeluokka',
			'ovt_tunnus' => 'Ovt-tunnus',
			'verkkolaskuosoite' => 'Verkkolaskuosoite',
			'valittajatunnus' => 'Välittäjatunnus',
			'viivastyskorko' => 'Viivästyskorko',
			'maksuehto' => 'Maksuehto',
			'alv_prosentti' => 'Alv%',
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
		$criteria->compare('yrityksen_nimi',$this->yrityksen_nimi,true);
		$criteria->compare('tyyppi',$this->tyyppi);
		$criteria->compare('y_tunnus',$this->y_tunnus,true);
		$criteria->compare('henkilotunnus',$this->henkilotunnus,true);
		$criteria->compare('yhteyshenkilo',$this->yhteyshenkilo,true);
		$criteria->compare('sahkoposti',$this->sahkoposti,true);
		$criteria->compare('osoite',$this->osoite,true);
		$criteria->compare('postinumero',$this->postinumero);
		$criteria->compare('postitoimipaikka',$this->postitoimipaikka,true);
		$criteria->compare('kayntiosoite',$this->kayntiosoite,true);
		$criteria->compare('kayntipostinumero',$this->kayntipostinumero);
		$criteria->compare('kayntipostitoimipaikka',$this->kayntipostitoimipaikka,true);
		$criteria->compare('puhelinnumero',$this->puhelinnumero,true);
		$criteria->compare('laskutuskanava',$this->laskutuskanava,true);
		$criteria->compare('kirjeluokka',$this->kirjeluokka);
		$criteria->compare('ovt_tunnus',$this->ovt_tunnus,true);
		$criteria->compare('verkkolaskuosoite',$this->verkkolaskuosoite,true);
		$criteria->compare('valittajatunnus',$this->valittajatunnus,true);
		$criteria->compare('viivastyskorko',$this->viivastyskorko);
		$criteria->compare('maksuehto',$this->maksuehto);
		$criteria->compare('alv_prosentti',$this->alv_prosentti);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}

<?php

/**
 * This is the model class for table "asetukset".
 *
 * The followings are the available columns in table 'asetukset':
 * @property integer $id
 * @property string $johtaja
 * @property string $viivastyskorko
 * @property string $tilinumero
 * @property string $iban
 * @property string $bic
 * @property string $netvisor_customer_id
 * @property string $netvisor_partner_id
 * @property string $netvisor_userkey
 * @property string $netvisor_partnerkey
 * @property integer $netvisor_kaytto
 * @property string $netvisor_organisation_identifier
 * @property string $netvisor_host
 * @property string $netvisor_acceptancestatus
 * @property string $netvisor_mita_lahetetaan
 */
class Asetukset extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{

		$table = Yii::app()->db->schema->getTable('asetukset_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `asetukset_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `johtaja` varchar(100) NOT NULL,
		  `viivastyskorko` varchar(50) NOT NULL,
		  `tilinumero` varchar(100) NOT NULL,
		  `iban` varchar(100) NOT NULL,
		  `bic` varchar(100) NOT NULL,
		  `netvisor_customer_id` varchar(255) NOT NULL,
		  `netvisor_partner_id` varchar(255) NOT NULL,
		  `netvisor_userkey` varchar(255) NOT NULL,
		  `netvisor_partnerkey` varchar(255) NOT NULL,
		  `netvisor_kaytto` int(1) NOT NULL,
		  `netvisor_organisation_identifier` varchar(255) NOT NULL,
		  `netvisor_host` varchar(500) NOT NULL,
		  `logon_polkku` varchar(500) NOT NULL,
		  `netvisor_acceptancestatus` varchar(50) NOT NULL,
		  `laskutus_yritys` varchar(255) NOT NULL,
		  `laskutus_osoite` varchar(255) NOT NULL,
		  `laskutus_postinumero` varchar(20) NOT NULL,
		  `laskutus_postitoimipaikka` varchar(255) NOT NULL,
		  `laskutus_y_tunnus` varchar(20) NOT NULL,
		  `laskutus_puhelin` varchar(20) NOT NULL,
		  `laskutus_sahkoposti` varchar(255) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "asetukset_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('id, johtaja, viivastyskorko, tilinumero, iban, bic, netvisor_customer_id, netvisor_partner_id, netvisor_userkey, netvisor_partnerkey, netvisor_kaytto, netvisor_organisation_identifier, netvisor_host, netvisor_acceptancestatus, netvisor_mita_lahetetaan', 'required'),*/
			array('id, netvisor_kaytto', 'numerical', 'integerOnly'=>true),
			array('johtaja, tilinumero, iban, bic', 'length', 'max'=>100),
			array('viivastyskorko, netvisor_acceptancestatus, laskutus_postinumero', 'length', 'max'=>50),
			array('laskutus_postinumero, laskutus_y_tunnus, laskutus_puhelin', 'length', 'max'=>20),
			array('netvisor_customer_id, netvisor_partner_id, netvisor_userkey, netvisor_partnerkey, netvisor_organisation_identifier, laskutus_yritys, laskutus_osoite, laskutus_postitoimipaikka, laskutus_sahkoposti', 'length', 'max'=>255),
			array('netvisor_host, logon_polkku', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, johtaja, viivastyskorko, tilinumero, iban, bic, netvisor_customer_id, netvisor_partner_id, netvisor_userkey, netvisor_partnerkey, netvisor_kaytto, netvisor_organisation_identifier, netvisor_host, netvisor_acceptancestatus', 'safe', 'on'=>'search'),
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
			'johtaja' => 'Yhteyshekilö	',
			'viivastyskorko' => 'Viivästyskorko',
			'tilinumero' => 'Tilinumero',
			'logon_polkku' => 'Laskun logon url osoite',
			'iban' => 'IBAN tilinumero',
			'bic' => 'BIC-koodi',
			'netvisor_customer_id' => 'Netvisor Customer (Käyttäjätunniste, henk koht.)',
			'netvisor_partner_id' => 'Netvisor Partner (Kumppanitunnus: Vet_14435)',
			'netvisor_userkey' => 'Netvisor Userkey (avain, henk koht.)',
			'netvisor_partnerkey' => 'Netvisor Partnerkey (Kumppaniavain: 40DDD78D82314AEF7CB502E210B9AAA2)',
			'netvisor_kaytto' => 'Netvisor aktivoitu (0=aktivoitu, 1=ei aktivoitu)',
			'netvisor_organisation_identifier' => 'Netvisor Organisation Identifier (y-tunnus)',
			'netvisor_host' => 'Netvisor Host (yhteysosoite: integrationdemo.netvisor.fi)',
			'netvisor_acceptancestatus' => 'Netvisor Acceptancestatus',
			'laskutus_yritys' => 'Laskutus yritys',
			'laskutus_osoite' => 'Laskutus osoite',
			'laskutus_postinumero' => 'Laskutus postinumero',
			'laskutus_postitoimipaikka' => 'Laskutus postitoimipaikka',
			'laskutus_y_tunnus' => 'Laskutus sähköposti',
			'laskutus_puhelin' => 'Laskutus puhelinnumero',
			'laskutus_sahkoposti' => 'Laskutus sähköposti',

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
		$criteria->compare('johtaja',$this->johtaja,true);
		$criteria->compare('viivastyskorko',$this->viivastyskorko,true);
		$criteria->compare('tilinumero',$this->tilinumero,true);
		$criteria->compare('iban',$this->iban,true);
		$criteria->compare('bic',$this->bic,true);
		$criteria->compare('netvisor_customer_id',$this->netvisor_customer_id,true);
		$criteria->compare('netvisor_partner_id',$this->netvisor_partner_id,true);
		$criteria->compare('netvisor_userkey',$this->netvisor_userkey,true);
		$criteria->compare('netvisor_partnerkey',$this->netvisor_partnerkey,true);
		$criteria->compare('netvisor_kaytto',$this->netvisor_kaytto);
		$criteria->compare('netvisor_organisation_identifier',$this->netvisor_organisation_identifier,true);
		$criteria->compare('netvisor_host',$this->netvisor_host,true);
		$criteria->compare('netvisor_acceptancestatus',$this->netvisor_acceptancestatus,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asetukset the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

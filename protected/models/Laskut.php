<?php

/**
 * This is the model class for table "laskut".
 *
 * The followings are the available columns in table 'laskut':
 * @property integer $id
 * @property integer $lid
 * @property integer $yid
 * @property string $time
 * @property string $tyyppi
 * @property string $yritys
 * @property string $y_tunnus
 * @property string $nimi
 * @property integer $as_nro
 * @property string $osoite
 * @property string $postinumero
 * @property string $toimipaikka
 * @property string $laskutus
 * @property string $sahkoposti
 * @property string $verkkolaskuosoite
 * @property string $v_tunnus
 * @property string $yhteyshenkilo
 * @property string $nimitarkenne
 * @property string $puhelin
 * @property string $t_yritys
 * @property string $t_y_tunnus
 * @property string $t_nimi
 * @property string $t_osoite
 * @property string $t_postinumero
 * @property string $t_toimipaikka
 * @property string $t_puhelin
 * @property string $t_sahkoposti
 * @property string $toimitusosoite
 * @property string $paivays
 * @property string $erapaiva
 * @property string $toimituspaiva
 * @property string $maksuehto
 * @property string $viitenumero
 * @property string $viivastyskorko
 * @property string $yhteensa_total_verot
 * @property string $yhteensa_total_veroton
 * @property string $yhteensa_total
 * @property string $saaja_iban
 * @property string $saaja_virtualkoodi
 * @property string $tilanne
 * @property string $maksettu_euro
 * @property string $hyvityslasku
 * @property string $laskun_nimetys
 * @property string $tapahtumapvm
 * @property string $laskunumero
 * @property integer $muistutuslasku_auto
 * @property integer $kirjeenluokka
 * @property string $viitenne
 * @property string $viitemme
 * @property string $freetext
 * @property string $deliverymethod
 * @property string $deliveryterm
 * @property string $vatperiod
 * @property integer $netvisorkey
 */
class Laskut extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		$table = Yii::app()->db->schema->getTable('laskut_yid_'.Yii::app()->getModule('user')->user()->profile->getAttribute('yid'));
		if(!isset($table->columns['id'])) {

		Yii::app()->db->createCommand("
		CREATE TABLE IF NOT EXISTS `laskut_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `tyyppi` varchar(100) NOT NULL,
		  `yritys` varchar(100) NOT NULL,
		  `y_tunnus` varchar(50) NOT NULL,
		  `nimi` varchar(100) NOT NULL,
		  `as_nro` int(11) NOT NULL,
		  `osoite` varchar(255) NOT NULL,
		  `postinumero` varchar(10) NOT NULL,
		  `toimipaikka` varchar(50) NOT NULL,
		  `laskutus` varchar(50) NOT NULL,
		  `sahkoposti` varchar(100) NOT NULL,
		  `verkkolaskuosoite` varchar(255) NOT NULL,
		  `v_tunnus` varchar(100) NOT NULL,
		  `yhteyshenkilo` varchar(100) NOT NULL,
		  `nimitarkenne` varchar(100) NOT NULL,
		  `puhelin` varchar(50) NOT NULL,
		  `t_yritys` varchar(100) NOT NULL,
		  `t_y_tunnus` varchar(50) NOT NULL,
		  `t_nimi` varchar(100) NOT NULL,
		  `t_osoite` varchar(100) NOT NULL,
		  `t_postinumero` varchar(10) NOT NULL,
		  `t_toimipaikka` varchar(100) NOT NULL,
		  `t_puhelin` varchar(50) NOT NULL,
		  `t_sahkoposti` varchar(100) NOT NULL,
		  `toimitusosoite` varchar(100) NOT NULL,
		  `paivays` varchar(20) NOT NULL,
		  `erapaiva` varchar(20) NOT NULL,
		  `toimituspaiva` varchar(20) NOT NULL,
		  `maksuehto` varchar(20) NOT NULL,
		  `viitenumero` varchar(100) NOT NULL,
		  `viivastyskorko` varchar(50) NOT NULL,
		  `yhteensa_total_verot` varchar(20) NOT NULL,
		  `yhteensa_total_veroton` varchar(20) NOT NULL,
		  `yhteensa_total` varchar(20) NOT NULL,
		  `saaja_iban` varchar(100) NOT NULL,
		  `saaja_virtualkoodi` varchar(255) NOT NULL,
		  `tilanne` varchar(50) NOT NULL,
		  `maksettu_euro` varchar(100) NOT NULL,
		  `hyvityslasku` varchar(20) NOT NULL,
		  `laskun_nimetys` varchar(100) NOT NULL,
		  `tapahtumapvm` varchar(50) NOT NULL,
		  `laskunumero` varchar(11) NOT NULL,
		  `muistutuslasku_auto` int(1) NOT NULL,
		  `kirjeenluokka` int(1) NOT NULL,
		  `viitenne` varchar(255) NOT NULL,
		  `viitemme` varchar(255) NOT NULL,
		  `freetext` varchar(255) NOT NULL,
		  `deliverymethod` varchar(255) NOT NULL,
		  `deliveryterm` varchar(255) NOT NULL,
		  `vatperiod` varchar(50) NOT NULL,
		  `netvisorkey` int(11) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
		")->execute();

		}

		return "laskut_yid_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('tyyppi, yritys, y_tunnus, nimi, as_nro, osoite, postinumero, toimipaikka, laskutus, sahkoposti, verkkolaskuosoite, v_tunnus, yhteyshenkilo, nimitarkenne, puhelin, t_yritys, t_y_tunnus, t_nimi, t_osoite, t_postinumero, t_toimipaikka, t_puhelin, t_sahkoposti, toimitusosoite, paivays, erapaiva, toimituspaiva, maksuehto, viitenumero, viivastyskorko, yhteensa_total_verot, yhteensa_total_veroton, yhteensa_total, saaja_iban, saaja_virtualkoodi, tilanne, maksettu_euro, hyvityslasku, laskun_nimetys, tapahtumapvm, laskunumero, muistutuslasku_auto, kirjeenluokka, viitenne, viitemme, freetext, deliverymethod, deliveryterm, vatperiod, netvisorkey', 'required'),*/
			array('as_nro, muistutuslasku_auto, kirjeenluokka, netvisorkey', 'numerical', 'integerOnly'=>true),
			array('tyyppi, yritys, nimi, sahkoposti, v_tunnus, yhteyshenkilo, nimitarkenne, t_yritys, t_nimi, t_osoite, t_toimipaikka, t_sahkoposti, toimitusosoite, viitenumero, saaja_iban, maksettu_euro, laskun_nimetys', 'length', 'max'=>100),
			array('y_tunnus, toimipaikka, laskutus, puhelin, t_y_tunnus, t_puhelin, viivastyskorko, tilanne, tapahtumapvm, vatperiod', 'length', 'max'=>50),
			array('osoite, verkkolaskuosoite, saaja_virtualkoodi, viitenne, viitemme, freetext, deliverymethod, deliveryterm', 'length', 'max'=>255),
			array('postinumero, t_postinumero', 'length', 'max'=>10),
			array('paivays, erapaiva, toimituspaiva, maksuehto, yhteensa_total_verot, yhteensa_total_veroton, yhteensa_total, hyvityslasku', 'length', 'max'=>20),
			array('laskunumero', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, time, tyyppi, yritys, y_tunnus, nimi, as_nro, osoite, postinumero, toimipaikka, laskutus, sahkoposti, verkkolaskuosoite, v_tunnus, yhteyshenkilo, nimitarkenne, puhelin, t_yritys, t_y_tunnus, t_nimi, t_osoite, t_postinumero, t_toimipaikka, t_puhelin, t_sahkoposti, toimitusosoite, paivays, erapaiva, toimituspaiva, maksuehto, viitenumero, viivastyskorko, yhteensa_total_verot, yhteensa_total_veroton, yhteensa_total, saaja_iban, saaja_virtualkoodi, tilanne, maksettu_euro, hyvityslasku, laskun_nimetys, tapahtumapvm, laskunumero, muistutuslasku_auto, kirjeenluokka, viitenne, viitemme, freetext, deliverymethod, deliveryterm, vatperiod, netvisorkey', 'safe', 'on'=>'search'),
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
			'tyyppi' => 'Tyyppi',
			'yritys' => 'Yritys',
			'y_tunnus' => 'Y-tunnus',
			'nimi' => 'Nimi',
			'as_nro' => 'Asiakas',
			'osoite' => 'Osoite',
			'postinumero' => 'Postinumero',
			'toimipaikka' => 'Postitoimipaikka',
			'laskutus' => 'Laskutustapa',
			'sahkoposti' => 'Sähköposti',
			'verkkolaskuosoite' => 'Verkkolaskuosoite',
			'v_tunnus' => 'V Tunnus',
			'yhteyshenkilo' => 'Yhteyshenkilö',
			'nimitarkenne' => 'Nimitarkenne',
			'puhelin' => 'Puhelin',
			't_yritys' => 'T Yritys',
			't_y_tunnus' => 'T Y Tunnus',
			't_nimi' => 'T Nimi',
			't_osoite' => 'T Osoite',
			't_postinumero' => 'T Postinumero',
			't_toimipaikka' => 'T Toimipaikka',
			't_puhelin' => 'T Puhelin',
			't_sahkoposti' => 'T Sahkoposti',
			'toimitusosoite' => 'Toimitusosoite eri kuin laskutusosoite',
			'paivays' => 'Paivays',
			'erapaiva' => 'Eräpaivä',
			'toimituspaiva' => 'Toimituspäivä',
			'maksuehto' => 'Maksuehto',
			'viitenumero' => 'Viitenumero',
			'viivastyskorko' => 'Viivästyskorko',
			'yhteensa_total_verot' => 'Yhteensä Total Verot',
			'yhteensa_total_veroton' => 'Yhteensä Total Veroton',
			'yhteensa_total' => 'Yhteensä Total',
			'saaja_iban' => 'Saaja IBAN',
			'saaja_virtualkoodi' => 'Saaja Virtualkoodi',
			'tilanne' => 'Laskun status',
			'maksettu_euro' => 'Maksettu Euro',
			'hyvityslasku' => 'Hyvityslasku',
			'laskun_nimetys' => 'Laskun nimi',
			'tapahtumapvm' => 'Tapahtuma pvm',
			'laskunumero' => 'Laskunumero',
			'muistutuslasku_auto' => 'Muistutuslasku automaattisesti',
			'kirjeenluokka' => 'Kirjeluokka',
			'viitenne' => 'Viitenne',
			'viitemme' => 'Viitemme',
			'freetext' => 'Vapaa tekstikenttä',
			'deliverymethod' => 'Deliverymethod',
			'deliveryterm' => 'Deliveryterm',
			'vatperiod' => 'Vatperiod',
			'netvisorkey' => 'Netvisorkey',
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
		$criteria->compare('tyyppi',$this->tyyppi,true);
		$criteria->compare('yritys',$this->yritys,true);
		$criteria->compare('y_tunnus',$this->y_tunnus,true);
		$criteria->compare('nimi',$this->nimi,true);
		$criteria->compare('as_nro',$this->as_nro);
		$criteria->compare('osoite',$this->osoite,true);
		$criteria->compare('postinumero',$this->postinumero,true);
		$criteria->compare('toimipaikka',$this->toimipaikka,true);
		$criteria->compare('laskutus',$this->laskutus,true);
		$criteria->compare('sahkoposti',$this->sahkoposti,true);
		$criteria->compare('verkkolaskuosoite',$this->verkkolaskuosoite,true);
		$criteria->compare('v_tunnus',$this->v_tunnus,true);
		$criteria->compare('yhteyshenkilo',$this->yhteyshenkilo,true);
		$criteria->compare('nimitarkenne',$this->nimitarkenne,true);
		$criteria->compare('puhelin',$this->puhelin,true);
		$criteria->compare('t_yritys',$this->t_yritys,true);
		$criteria->compare('t_y_tunnus',$this->t_y_tunnus,true);
		$criteria->compare('t_nimi',$this->t_nimi,true);
		$criteria->compare('t_osoite',$this->t_osoite,true);
		$criteria->compare('t_postinumero',$this->t_postinumero,true);
		$criteria->compare('t_toimipaikka',$this->t_toimipaikka,true);
		$criteria->compare('t_puhelin',$this->t_puhelin,true);
		$criteria->compare('t_sahkoposti',$this->t_sahkoposti,true);
		$criteria->compare('toimitusosoite',$this->toimitusosoite,true);
		$criteria->compare('paivays',$this->paivays,true);
		$criteria->compare('erapaiva',$this->erapaiva,true);
		$criteria->compare('toimituspaiva',$this->toimituspaiva,true);
		$criteria->compare('maksuehto',$this->maksuehto,true);
		$criteria->compare('viitenumero',$this->viitenumero,true);
		$criteria->compare('viivastyskorko',$this->viivastyskorko,true);
		$criteria->compare('yhteensa_total_verot',$this->yhteensa_total_verot,true);
		$criteria->compare('yhteensa_total_veroton',$this->yhteensa_total_veroton,true);
		$criteria->compare('yhteensa_total',$this->yhteensa_total,true);
		$criteria->compare('saaja_iban',$this->saaja_iban,true);
		$criteria->compare('saaja_virtualkoodi',$this->saaja_virtualkoodi,true);
		$criteria->compare('tilanne',$this->tilanne,true);
		$criteria->compare('maksettu_euro',$this->maksettu_euro,true);
		$criteria->compare('hyvityslasku',$this->hyvityslasku,true);
		$criteria->compare('laskun_nimetys',$this->laskun_nimetys,true);
		$criteria->compare('tapahtumapvm',$this->tapahtumapvm,true);
		$criteria->compare('laskunumero',$this->laskunumero,true);
		$criteria->compare('muistutuslasku_auto',$this->muistutuslasku_auto);
		$criteria->compare('kirjeenluokka',$this->kirjeenluokka);
		$criteria->compare('viitenne',$this->viitenne,true);
		$criteria->compare('viitemme',$this->viitemme,true);
		$criteria->compare('freetext',$this->freetext,true);
		$criteria->compare('deliverymethod',$this->deliverymethod,true);
		$criteria->compare('deliveryterm',$this->deliveryterm,true);
		$criteria->compare('vatperiod',$this->vatperiod,true);
		$criteria->compare('netvisorkey',$this->netvisorkey);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Laskut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

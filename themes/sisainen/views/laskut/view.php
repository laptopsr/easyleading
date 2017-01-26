<?php
/* @var $this LaskutController */
/* @var $model Laskut */

$this->breadcrumbs=array(
	'Laskuts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Laskut', 'url'=>array('index')),
	array('label'=>'Create Laskut', 'url'=>array('create')),
	array('label'=>'Update Laskut', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Laskut', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Laskut', 'url'=>array('admin')),
);
?>

<h1>View Laskut #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lid',
		'yid',
		'time',
		'tyyppi',
		'yritys',
		'y_tunnus',
		'nimi',
		'as_nro',
		'osoite',
		'postinumero',
		'toimipaikka',
		'laskutus',
		'sahkoposti',
		'verkkolaskuosoite',
		'v_tunnus',
		'yhteyshenkilo',
		'nimitarkenne',
		'puhelin',
		't_yritys',
		't_y_tunnus',
		't_nimi',
		't_osoite',
		't_postinumero',
		't_toimipaikka',
		't_puhelin',
		't_sahkoposti',
		'toimitusosoite',
		'paivays',
		'erapaiva',
		'toimituspaiva',
		'maksuehto',
		'viitenumero',
		'viivastyskorko',
		'yhteensa_total_verot',
		'yhteensa_total_veroton',
		'yhteensa_total',
		'saaja_iban',
		'saaja_virtualkoodi',
		'tilanne',
		'maksettu_euro',
		'hyvityslasku',
		'laskun_nimetys',
		'tapahtumapvm',
		'laskunumero',
		'muistutuslasku_auto',
		'kirjeenluokka',
		'viitenne',
		'viitemme',
		'freetext',
		'deliverymethod',
		'deliveryterm',
		'vatperiod',
		'netvisorkey',
	),
)); ?>

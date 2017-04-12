<?php
/* @var $this LaskutController */
/* @var $model Laskut */

$this->breadcrumbs=array(
	'Laskuts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Laskut', 'url'=>array('index')),
	array('label'=>'Create Laskut', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#laskut-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Laskuts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'laskut-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'lid',
		'yid',
		'time',
		'tyyppi',
		'yritys',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

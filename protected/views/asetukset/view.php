<?php
/* @var $this AsetuksetController */
/* @var $model Asetukset */

$this->breadcrumbs=array(
	'Asetuksets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Asetukset', 'url'=>array('index')),
	array('label'=>'Create Asetukset', 'url'=>array('create')),
	array('label'=>'Update Asetukset', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Asetukset', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Asetukset', 'url'=>array('admin')),
);
?>

<h1>View Asetukset #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'johtaja',
		'viivastyskorko',
		'tilinumero',
		'iban',
		'bic',
		'netvisor_customer_id',
		'netvisor_partner_id',
		'netvisor_userkey',
		'netvisor_partnerkey',
		'netvisor_kaytto',
		'netvisor_organisation_identifier',
		'netvisor_host',
		'netvisor_acceptancestatus',
		'netvisor_mita_lahetetaan',
	),
)); ?>

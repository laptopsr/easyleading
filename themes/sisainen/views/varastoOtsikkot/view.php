<?php
/* @var $this VarastoOtsikkotController */
/* @var $model VarastoOtsikkot */

$this->breadcrumbs=array(
	'Varasto Otsikkots'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VarastoOtsikkot', 'url'=>array('index')),
	array('label'=>'Create VarastoOtsikkot', 'url'=>array('create')),
	array('label'=>'Update VarastoOtsikkot', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VarastoOtsikkot', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VarastoOtsikkot', 'url'=>array('admin')),
);
?>

<h1>View VarastoOtsikkot #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'yid',
		'time',
		'varaston_nimike',
		'sarakkeen_nimi',
		'sarakkeen_tyyppi',
		'sum',
		'value',
		'position',
		'is_otsikko',
		'varaston_nimike_id',
		'tr_rivi',
	),
)); ?>

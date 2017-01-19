<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */

$this->breadcrumbs=array(
	'Tuotantos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tuotanto', 'url'=>array('index')),
	array('label'=>'Create Tuotanto', 'url'=>array('create')),
	array('label'=>'Update Tuotanto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tuotanto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tuotanto', 'url'=>array('admin')),
);
?>

<h1>View Tuotanto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'time',
		'tehtavanimike',
		'osoitettu_tyontekija',
		'tyon_tiedot',
		'suunniteltu_aloitus',
		'suuniteltu_lopetus',
		'toteutunut_aloitus',
		'toteutunut_lopetus',
		'lisatiedot',
		'liitteet',
		'varasto_tuote',
		'extra_sarake1',
	),
)); ?>

<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */

$this->breadcrumbs=array(
	'Tuotantos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tuotanto', 'url'=>array('index')),
	array('label'=>'Create Tuotanto', 'url'=>array('create')),
	array('label'=>'View Tuotanto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tuotanto', 'url'=>array('admin')),
);
?>

<h1>Update Tuotanto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
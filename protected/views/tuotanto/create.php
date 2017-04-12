<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */

$this->breadcrumbs=array(
	'Tuotantos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tuotanto', 'url'=>array('index')),
	array('label'=>'Manage Tuotanto', 'url'=>array('admin')),
);
?>

<h1>Create Tuotanto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
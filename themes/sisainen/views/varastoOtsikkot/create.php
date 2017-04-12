<?php
/* @var $this VarastoOtsikkotController */
/* @var $model VarastoOtsikkot */

$this->breadcrumbs=array(
	'Varasto Otsikkots'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VarastoOtsikkot', 'url'=>array('index')),
	array('label'=>'Manage VarastoOtsikkot', 'url'=>array('admin')),
);
?>

<h1>Create VarastoOtsikkot</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
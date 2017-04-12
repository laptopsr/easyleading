<?php
/* @var $this AsetuksetController */
/* @var $model Asetukset */

$this->breadcrumbs=array(
	'Asetuksets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Asetukset', 'url'=>array('index')),
	array('label'=>'Create Asetukset', 'url'=>array('create')),
	array('label'=>'View Asetukset', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Asetukset', 'url'=>array('admin')),
);
?>

<h1>Update Asetukset <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
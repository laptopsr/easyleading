<?php
/* @var $this LaskutController */
/* @var $model Laskut */

$this->breadcrumbs=array(
	'Laskuts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Laskut', 'url'=>array('index')),
	array('label'=>'Create Laskut', 'url'=>array('create')),
	array('label'=>'View Laskut', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Laskut', 'url'=>array('admin')),
);
?>

<h1>Update Laskut <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
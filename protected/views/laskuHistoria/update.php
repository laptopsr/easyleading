<?php
/* @var $this LaskuHistoriaController */
/* @var $model LaskuHistoria */

$this->breadcrumbs=array(
	'Lasku Historias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LaskuHistoria', 'url'=>array('index')),
	array('label'=>'Create LaskuHistoria', 'url'=>array('create')),
	array('label'=>'View LaskuHistoria', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LaskuHistoria', 'url'=>array('admin')),
);
?>

<h1>Update LaskuHistoria <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
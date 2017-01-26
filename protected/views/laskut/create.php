<?php
/* @var $this LaskutController */
/* @var $model Laskut */

$this->breadcrumbs=array(
	'Laskuts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Laskut', 'url'=>array('index')),
	array('label'=>'Manage Laskut', 'url'=>array('admin')),
);
?>

<h1>Create Laskut</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
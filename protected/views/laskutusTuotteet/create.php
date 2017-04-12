<?php
/* @var $this LaskutusTuotteetController */
/* @var $model LaskutusTuotteet */

$this->breadcrumbs=array(
	'Laskutus Tuotteets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LaskutusTuotteet', 'url'=>array('index')),
	array('label'=>'Manage LaskutusTuotteet', 'url'=>array('admin')),
);
?>

<h1>Create LaskutusTuotteet</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this YiichatPostController */
/* @var $model YiichatPost */

$this->breadcrumbs=array(
	'Yiichat Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List YiichatPost', 'url'=>array('index')),
	array('label'=>'Manage YiichatPost', 'url'=>array('admin')),
);
?>

<h1>Create YiichatPost</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this AsetuksetController */
/* @var $model Asetukset */

$this->breadcrumbs=array(
	'Asetuksets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Asetukset', 'url'=>array('index')),
	array('label'=>'Create Asetukset', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#asetukset-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Asetuksets</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'asetukset-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'johtaja',
		'viivastyskorko',
		'tilinumero',
		'iban',
		'bic',
		/*
		'netvisor_customer_id',
		'netvisor_partner_id',
		'netvisor_userkey',
		'netvisor_partnerkey',
		'netvisor_kaytto',
		'netvisor_organisation_identifier',
		'netvisor_host',
		'netvisor_acceptancestatus',
		'netvisor_mita_lahetetaan',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

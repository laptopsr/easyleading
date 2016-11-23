<?php
$this->breadcrumbs=array(
	UserModule::t("Profiilit"),
);

/*
if(UserModule::isAdmin()) {
	$this->layout='//layouts/column2';
	$this->menu=array(
	    array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('/user/admin')),
	    //array('label'=>UserModule::t('Hallitse profiilikenttiä'), 'url'=>array('profileField/admin')),
	);
}
*/
?>


<div class="row">
   <div class="panel panel-primary">
     <div class="panel-heading">Kaikki profiilit</div>
     <div class="panel-body">

<div class="table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
        'itemsCssClass' => 'table table-striped small table-hover',
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		'create_at',
		'lastvisit_at',
	),
)); ?>
</div>

    </div>
  </div>
</div>

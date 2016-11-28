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
 <div class="col-sm-12">
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
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/update","id"=>$data->id))',
		),
		'profile.firstname',
		'profile.lastname',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'profile.tyyppi',
		    	'value'=>array($this,'tyyppiMuutos'),
		    	'type' => 'raw',
		),
	),
)); ?>
</div>

    </div>
  </div>
 </div>
</div>



<div class="row">
 <div class="col-sm-4">
   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-tasks"></i> Hallinta</div>
     <div class="panel-body">
	<?php 
		echo CHtml::link('Luo uusi työntekijä',Yii::app()->request->baseUrl.'/index.php/user/user/create',array('class'=>'btn btn-block btn-primary'));

	?>
    </div>
  </div>
 </div>
</div>

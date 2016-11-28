<div class="row">
<?php
$this->breadcrumbs=array(
	UserModule::t('Profiili')=>array('/user'),
	UserModule::t('Hallitse profiileja'),
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>




   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-user"></i> Hallitse profiileja</div>
     <div class="panel-body">

<div class="table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,

        'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
        'itemsCssClass' => 'table table-striped small table-hover',

	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		),
			'profile.yid',
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'create_at',
		'lastvisit_at',
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'name' => 'profile.tyyppi',
		    	'value'=>array($this,'tyyppiMuutos'),
		    	'type' => 'raw',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>

    </div>
  </div>


<div class="row">
 <div class="col-sm-4">
   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-tasks"></i> Hallinta</div>
     <div class="panel-body">
	<?php 

		if(UserModule::isAdmin())
		{
		echo CHtml::link('Luo uusi profiili',Yii::app()->request->baseUrl.'/index.php/user/admin/create',array('class'=>'btn btn-block btn-primary'));

		if(Yii::app()->user->name == 'admin' or Yii::app()->user->name == 'pekka') 
		{
		echo CHtml::link('Hallitse käyttäjiä',Yii::app()->request->baseUrl.'/index.php/user/admin',array('class'=>'btn btn-block btn-primary'));
		echo CHtml::link('Hallitse profiilikenttiä',Yii::app()->request->baseUrl.'/index.php/user/profileField/admin',array('class'=>'btn btn-block btn-primary'));
		echo CHtml::link('Listaa käyttäjät',Yii::app()->request->baseUrl.'/index.php/user',array('class'=>'btn btn-block btn-primary'));
		}
		}
	?>
    </div>
  </div>
 </div>
</div>


</div>

<?php
$this->breadcrumbs=array(
	(UserModule::t('Profiilit'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Muokkaa')),
);
/*
$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('View User'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
*/
?>

<!--Back-->
<p>
	<?php echo CHtml::link('<i class="fa fa-backward" aria-hidden="true"></i>',Yii::app()->request->urlReferrer, 
		array(
			'class'=>'btn btn-default', 
			'data-toggle'=>'tooltip', 
			'data-placement'=>'top', 
			'title'=>Yii::t('main', 'Takaisin')
		)); 
	?>
</p>
<!--Back-->

<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-cutlery"></i> <?php echo  UserModule::t('Muokkaa profiilia')." ".$model->username; ?></div>
     <div class="panel-body">
<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
    </div>
  </div>
 </div>
</div>

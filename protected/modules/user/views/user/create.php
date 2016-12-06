<?php
$this->breadcrumbs=array(
	UserModule::t('Profiilit')=>array('admin'),
	UserModule::t('Luo uusi profiili'),
);
/*
$this->menu=array(
    array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Hallitse profiilikenttiä'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('Listaa käyttäjät'), 'url'=>array('/user')),
);*/
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
     <div class="panel-heading"><i class="fa fa-cutlery"></i> <?php echo  UserModule::t('Luo profiili'); ?></div>
     <div class="panel-body">
<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
    </div>
  </div>
 </div>
</div>

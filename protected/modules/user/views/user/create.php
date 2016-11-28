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


<div class="row">
   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-cutlery"></i> <?php echo  UserModule::t('Luo profiili'); ?></div>
     <div class="panel-body">
<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
    </div>
  </div>
</div>

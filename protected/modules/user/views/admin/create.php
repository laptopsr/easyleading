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
<h1><?php echo UserModule::t("Luo uusi profiili"); ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>

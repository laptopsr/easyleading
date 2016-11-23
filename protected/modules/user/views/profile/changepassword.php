<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);

/*
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('Listaa käyttäjät'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profiili'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Muokkaa profiilia'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Kirjaudu ulos'), 'url'=>array('/user/logout')),
);
*/
?>

<h1><?php echo UserModule::t("Vaihda salasana"); ?></h1>

<div class="row form">
  <div class="col-sm-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo UserModule::t('Tähdellä <span class="required">*</span> merkityt kentät ovat pakollisia.'); ?></p>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'oldPassword'); ?>
	<?php echo $form->passwordField($model,'oldPassword', array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'oldPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'password'); ?>

	<?php echo UserModule::t("Salasanan pituus on oltava vähintään 5 merkkiä."); ?>

	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword', array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="row">
		<?php echo CHtml::submitButton(UserModule::t('Tallenna'),array('class'=>'btn btn-primary btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>
 </div>
</div><!-- form -->

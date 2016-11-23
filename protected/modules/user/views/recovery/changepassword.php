<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>

<h1><?php echo UserModule::t("Vaihda salasana"); ?></h1>


<div class="row form">
 <div class="col-sm-4">
<?php echo CHtml::beginForm(); ?>


	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
	<?php echo CHtml::activeLabelEx($form,'password'); ?>
	<?php echo CHtml::activePasswordField($form,'password', array('class'=>'form-control')); ?>
	<p class="hint">
	<?php echo UserModule::t("Salasanan pituus pitää olla vähintään 5 merkkiä."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?>
	<?php echo CHtml::activePasswordField($form,'verifyPassword', array('class'=>'form-control')); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Tallenna"), array('class'=>'btn btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

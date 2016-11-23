<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>


<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="row form">
<div class="col-sm-4">

  <div class="panel panel-info">
   <div class="panel-heading">Salasanan palautus</div>
   <div class="panel-body">

<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email',array('class'=>'form-control')) ?>
		<p class="hint"><?php echo UserModule::t("Anna käyttäjätunnuksesi tai sähköposti osoitteesi."); ?></p>
	</div>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Lähetä"),array('class'=>'btn btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

  </div>
 </div>

 </div>
</div><!-- form -->
<?php endif; ?>

<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profiili"),
);

/*
if(UserModule::isAdmin())
{
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Sivut'), 'url'=>array('/page/admin'))
		:array()),

	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('Listaa käyttäjät'), 'url'=>array('/user')),
);
}
*/
?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>


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
 <div class="col-sm-6">


   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-user"></i> Profiili</div>
     <div class="panel-body">

  <div class="table-responsive">
  <table class="table table-hover">
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
/*
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
		<th><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
*/
	?>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo $model->create_at; ?></td>
	</tr>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td><?php echo $model->lastvisit_at; ?></td>
	</tr>
<?php if(UserModule::isAdmin()) : ?>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
<?php endif; ?>

  </table>
  </div>

	<div class="row">
	 <div class="col-sm-12">
		<?php echo CHtml::link('Muokkaa profiilia', Yii::app()->request->baseUrl.'/index.php/user/profile/edit', array('class'=>'btn btn-primary')); ?>
	
	 </div>
	</div>

    </div>
  </div>




</div>
</div>


<?php if(UserModule::isAdmin()) : ?>
<div class="row">
 <div class="col-sm-4">
   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-tasks"></i> Hallinta</div>
     <div class="panel-body">
	<?php 
		if(UserModule::isAdmin())
		echo CHtml::link('Hallitse profiileja',Yii::app()->request->baseUrl.'/index.php/user/admin',array('class'=>'btn btn-block btn-primary'));
		echo CHtml::link('Listaa profiilit',Yii::app()->request->baseUrl.'/index.php/user',array('class'=>'btn btn-block btn-primary'));

	?>
    </div>
  </div>
 </div>
</div>
<?php endif; ?>








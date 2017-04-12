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




                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Profiili 
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">profiili</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Profiili</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">

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

	<br>
	<div class="">
		<?php echo CHtml::link('Muokkaa profiilia', Yii::app()->request->baseUrl.'/index.php/user/profile/edit', array('class'=>'btn btn-default')); ?>
	</div>


 </div>
</div>
<!-- /.portlet -->





<?php if(UserModule::isAdmin()) : ?>
<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Hallinta</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">
	<?php 
		if(UserModule::isAdmin())
		echo CHtml::link('Hallitse profiileja',Yii::app()->request->baseUrl.'/index.php/user/admin',array('class'=>'btn btn-block btn-default'));
		//echo CHtml::link('Listaa profiilit',Yii::app()->request->baseUrl.'/index.php/user',array('class'=>'btn btn-block btn-default'));

	?>
 </div>
</div>
<!-- /.portlet -->
<?php endif; ?>








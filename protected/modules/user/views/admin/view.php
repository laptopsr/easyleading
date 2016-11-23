<div class="row">
<?php
$this->breadcrumbs=array(
	UserModule::t('Profiili')=>array('admin'),
	$model->username,
);

/*
$this->menu=array(
    array('label'=>UserModule::t('Luo uusi käyttäjä'), 'url'=>array('create')),
    array('label'=>UserModule::t('Muokka profiilia'), 'url'=>array('update','id'=>$model->id)),
    array('label'=>UserModule::t('Poista profiili'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('admin')),
    //array('label'=>UserModule::t('Hallitse profiilikenttiä'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('Listaa käyttäjät'), 'url'=>array('/user')),
);
*/
?>


<div class="row">
 <div class="col-sm-6">
   <div class="panel panel-primary">
     <div class="panel-heading"><i class="fa fa-tasks"></i> Profiili</div>
     <div class="panel-body">

<?php
 
	$attributes = array(
		'id',
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		'password',
		'email',
		'activkey',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);
	
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
	

?>
    </div>
  </div>
 </div>
</div>


</div>

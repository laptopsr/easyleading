<?php
$this->breadcrumbs=array(
	UserModule::t("Profiilit"),
);

/*
if(UserModule::isAdmin()) {
	$this->layout='//layouts/column2';
	$this->menu=array(
	    array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('/user/admin')),
	    //array('label'=>UserModule::t('Hallitse profiilikenttiä'), 'url'=>array('profileField/admin')),
	);
}
*/
?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Kaikki profiilit <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/user/user/create'; ?>" data-toggle="tooltip" data-placement="right" title="Luo uusi profiili"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">Kaikki profiilit</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



                    <!-- Striped Responsive Table -->
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Henkilöstö</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
        'itemsCssClass' => 'table table-striped small table-hover',
	'columns'=>array(
		array(
			'header' => 'Muokkaa',
			'type'=>'raw',
			'value' => 'CHtml::link("<i class=\"fa fa-pencil-square-o btn btn-default btn-md\" aria-hidden=\"true\"></i>",array("user/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/update","id"=>$data->id))',
		),
		array(
			'header' => 'Viesti',
			'type'=>'raw',
			'value' => 'CHtml::link("<i class=\"fa fa-envelope btn btn-default btn-md\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lähetä uusi viesti\"></i>",array("//viestinta/create","saaja"=>$data->id))',
		),
		'profile.firstname',
		'profile.lastname',
		'create_at',
		'lastvisit_at',
		'status',
		array(
			'name' => 'profile.tyyppi',
		    	'value'=>array($this,'tyyppiMuutos'),
		    	'type' => 'raw',
		),
	),
)); ?>
</div>

                                </div>
                            </div>
                        </div>
                        <!-- /.portlet -->




<?php
/* @var $this ViestintaController */
/* @var $model Viestinta */
Viestinta::model()->updatebypk($model->id, array('is_katsonut'=>1));


$model->saaja = $this->etuSukunimi($model->saaja);
$model->lahettaja = $this->etuSukunimi($model->lahettaja);
?>


                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
				<!--Back-->
				<p>
					<?php echo CHtml::link('<i class="fa fa-backward" aria-hidden="true"></i>',Yii::app()->request->urlReferrer, 
						array(
							'class'=>'pull-left', 
							'style'=>'margin-right: 10px', 
							'data-toggle'=>'tooltip', 
							'data-placement'=>'top', 
							'title'=>Yii::t('main', 'Takaisin')
						)); 
					?>
				</p>
				<!--Back-->
                                Viestintä
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li> <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/viestinta/index'; ?>">viestintä</a></li>
                                <li class="active">viesti #<?php echo $model->id; ?></li>
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
         <h4>Viesti</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">
   <div class="table-responsive">


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'time',
		'saaja',
		'lahettaja',
		'otsikko',
		'teksti',
	),
)); ?>


   </div>
 </div>
</div>
<!-- /.portlet -->

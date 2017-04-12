<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */
?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Tuotanto
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a></li>
                                <li>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/tuotanto/index'; ?>">tuotantoot</a></li>
                                <li class="active">  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/tuotanto/update?id='.$model->id; ?>">muoka työ #<?php echo $model->id; ?></a></li>
                                <li class="active">  työ #<?php echo $model->id; ?></li>
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
         <h4>Katso työ</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'time',
		'tehtavanimike',
		'osoitettu_tyontekija',
		'tyon_tiedot',
		'suunniteltu_aloitus',
		'suuniteltu_lopetus',
		'toteutunut_aloitus',
		'toteutunut_lopetus',
		'lisatiedot',
		'liitteet',
		'varasto_tuote',
		'extra_sarake1',
	),
)); ?>


   </div>
 </div>
</div>
<!-- /.portlet -->




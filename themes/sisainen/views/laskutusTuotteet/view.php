<?php
/* @var $this LaskutusTuotteetController */
/* @var $model LaskutusTuotteet */

$arr = array(
		'id',
		'time',
		'tuotenimi',
		'hinta_alv_0',
		'hinta_alv_sis',
		'alv',
		'yksikko',
	);

?>



                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Tuotteet
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a></li>
                                <li>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskutusTuotteet/index'; ?>">tuotteet</a></li>
                                <li class="active">  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskutusTuotteet/update?id='.$model->id; ?>">muokkaa tuotetta #<?php echo $model->id; ?></a></li>
                                <li class="active">  tuote #<?php echo $model->id; ?></li>
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
         <h4>Tuote tiedot</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">

<?php 
   $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=> $arr,
   ));

?>


   </div>
 </div>
</div>
<!-- /.portlet -->

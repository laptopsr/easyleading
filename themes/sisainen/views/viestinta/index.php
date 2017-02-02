<?php
/* @var $this ViestintaController */
/* @var $dataProvider CActiveDataProvider */
?>


                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Viestintä <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/viestinta/create'; ?>" data-toggle="tooltip" data-placement="right" title="Luo viesti"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">viestintä</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



<div class="row">
 <div class="col-sm-6">


<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Saapuneet viestit</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">
   <div class="table-responsive">

    <table class="table">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'viewData' => array( 'saapuneet' => true ), 
	'itemView'=>'_view',
)); ?>
    </table>

   </div>
 </div>
</div>
<!-- /.portlet -->

 </div><div class="col-sm-6">

<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Lähetetyt viestit</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">
   <div class="table-responsive">

    <table class="table">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider_lahetetyt,
	'itemView'=>'_view',
)); ?>
    </table>

   </div>
 </div>
</div>
<!-- /.portlet -->

 </div>
</div>

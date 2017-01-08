<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>


                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Varastorakenne
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">varastorakenne</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



		<?php echo $this->renderPartial('//varastoOtsikkot/_form', array('model'=>$model)); ?>



<?php foreach($varastot as $data): ?>
<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND varaston_nimike='".$data->varaston_nimike."'
	";
	$varasto = VarastoOtsikkot::model()->findAll($criteria);
?>



<div class="row">
                            <!-- Basic Form Example -->
                            <div class="col-lg-12">

                                <div class="portlet portlet-default">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><?php echo $data->varaston_nimike; ?></h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample2"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="basicFormExample2" class="panel-collapse collapse in">
                                        <div class="portlet-body">



     <div class="table-responsive">
      <table class="table table-bordered">
       <tr>
	<?php foreach($varasto as $data): ?>
	  <?php echo $this->renderPartial('//varastoOtsikkot/_view', array('data'=>$data)); ?>
	<?php endforeach; ?>
       </tr>
      </table>
    </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.portlet -->
                            </div>
                            <!-- /.col-lg-12 (nested) -->
                            <!-- End Basic Form Example -->
</div><!-- row -->
<?php endforeach; ?>



                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Lasku
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a></li>
                                <li>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskut/index'; ?>">kaikki laskut</a></li>
                                <li class="active">  lasku <?php echo $model->id; ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



<div class="portlet portlet-default">
  <div class="portlet-heading">

	   <div class="pull-right">
	   <?php
		echo CHtml::link("poista", '#', array(
		'submit'=>array('delete', "id"=>$model->id), 
		'confirm' => 'Haluatko varmaasti poistaa laskun?',
		'class'=>'btn btn-primary myBgColors pull-right'
		));

	   ?>
	   </div>

      <div class="portlet-title">


         <h4>Lasku <?php echo $model->id; ?></h4>

      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


<?php echo $this->renderPartial('_form', array('model'=>$model, 'laskunRivit'=>$laskunRivit)); ?>


   </div>
 </div>
</div>
<!-- /.portlet -->

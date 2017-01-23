<?php
/* @var $this AsiakkaatController */
/* @var $model Asiakkaat */
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
                                <li>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/asiakkaat/index'; ?>">tuotantoot</a></li>
                                <li class="active">  luo työ</li>
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
         <h4>Uusi työ</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


   </div>
 </div>
</div>
<!-- /.portlet -->

<?php
/* @var $this AsiakkaatController */
/* @var $dataProvider CActiveDataProvider */
?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Tuotanto <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/tuotanto/create'; ?>" data-toggle="tooltip" data-placement="right" title="Luo työ"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">tuotanto</li>
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
         <h4>Haku</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">


    <div class="row">
    <form action="#" method="POST">   
     <div class="col-sm-2">
	<input type="text" name="osoite" class="form-control" placeholder="Tehtävänimike" value="<?php if(isset($_POST['tehtavanimike'])) echo $_POST['tehtavanimike']; ?>">
     </div>
     <div class="col-sm-2 col-sm-offset-8">
	<input type="submit" class="btn btn-block btn-default" value="HAE">
     </div>
    </form>
    </div>

   </div>
 </div>
</div>
<!-- /.portlet -->




<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Lista</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">
   <div class="table-responsive">


     <table class="table table-hovered">
     <tr>
 	<th></th>
 	<th>Tehtävänimike</th>
 	<th>Työntekijä</th>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		//'viewData' => array( 'netvisor' => $netvisor ),
	  	'template'=>'{items}<table class="table table-striped table-condensed"></table><br/>{pager}',
	)); ?>
     </table>


   </div>
 </div>
</div>
<!-- /.portlet -->

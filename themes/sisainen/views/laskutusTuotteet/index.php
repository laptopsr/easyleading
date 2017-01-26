<?php
/* @var $this KohteetController */
/* @var $dataProvider CActiveDataProvider */

?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Laskutus tuotteet <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskutusTuotteet/create'; ?>" data-toggle="tooltip" data-placement="right" title="Luo asiakas"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">tuotteet</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



<div class="admin-form">
  <div class="panel heading-border">
   <div class="panel-body">

<div class="row">
 <div class="table-responsive">
  <table class="table table-striped" id="mobileTable">
  <thead class="myBgColors">
  <tr>
  <th></th>
  <th><?php echo Yii::t('main', 'Tuotenimi'); ?></th>
  <th><?php echo Yii::t('main', 'Hinta Alv 0'); ?></th>
  <th><?php echo Yii::t('main', 'Hinta Alv Sis'); ?></th>
  <th><?php echo Yii::t('main', 'Alv'); ?></th>
  <th><?php echo Yii::t('main', 'Yksikko'); ?></th>
  <?php
    if($netvisor == true)
    echo '<th>'.Yii::t('main', 'Netvisor').'</th>';
  ?>
  </tr>
  </thead>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'viewData' => array( 'netvisor' => $netvisor ),
	'itemView'=>'_view',

  	'template'=>'{items}<table class="table table-striped table-condensed"></table><br/>{pager}',


	'pager' => array(
           'firstPageLabel'=>'<<',
           'prevPageLabel'=>'< Edellinen',
           'nextPageLabel'=>'Seuraava >',
           'lastPageLabel'=>'>>',
           //'maxButtonCount'=>'10',
           'header'=>'<h3>Siirry sivulle:</h3>',
           'cssFile'=>false,
       ), 

)); ?>
  </table>
 </div>
</div>


   </div>
  </div>
</div>



<script type="text/javascript">
$(document).ready(function(){

if($("#akt").val())
$("#aktiivinen").val($("#akt").val());
else
$("#aktiivinen").val(1);

$(".haemob").click(function(){
	$("#mobForm").submit();
});

});
</script>

<?php
/* @var $this AsiakkaatController */
/* @var $dataProvider CActiveDataProvider */
?>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Projektit <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/tuotanto/create'; ?>" data-toggle="tooltip" data-placement="right" title="Luo työ"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">projektit</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



                <div class="row">

                    <div class="col-lg-8">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Kalentteri ( kehittelemassa )</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Siirrettävä kohteet</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div id='external-events'>
                                    <div class='external-event'>Lounas</div>
                                    <div class='external-event'>Tapaaminen</div>
                                    <div class='external-event'>Ulos</div>
                                    <div class='external-event'>Asiakas</div>
                                    <div class='external-event'>Neuvotellu</div>
                                    <p>
                                        <input type='checkbox' id='drop-remove' />
                                        <label for='drop-remove'>Poista siirtymisen jälkeen</label>
                                    </p>
                                </div>
                            </div>
                        </div>

                </div>


    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/fullcalendar/jquery-ui.custom.min.js"></script>
    <!-- Morris Charts -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/morris/morris.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>

    <!-- THEME SCRIPTS -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/demo/calendar-demo.js"></script>


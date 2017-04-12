    <!-- PAGE LEVEL PLUGIN STYLES -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">


                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>Etusivu
                                <small>Klikkaa ja nauti!</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active"><i class="fa fa-dashboard"></i> Etusivu</li>
                                <li class="pull-right">
                                    <div id="reportrange" class="btn btn-green btn-square date-picker">
                                        <i class="fa fa-calendar"></i>
                                        <span class="date-range"></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->

		<?php
			$isMessage = false;
			$criteria = new CDbCriteria;
			$criteria->condition = " 
				saaja='".Yii::app()->user->id."' 
				AND is_katsonut!=1
			";
			$viestinta = Viestinta::model()->findAll($criteria);


			$criteria = new CDbCriteria;
			//$criteria->condition = " ";
			$asiakkaat = Asiakkaat::model()->findAll($criteria);

			$criteria = new CDbCriteria;
			$criteria->condition = " 
				tyyppi=2
				AND yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
			";
			$tyontekijat = Profile::model()->findAll($criteria);

			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->group = " varaston_nimike ";
			$criteria->condition = " 
				yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
			";
			$varastot = VarastoOtsikkot::model()->findAll($criteria);
		?>


                <!-- begin DASHBOARD CIRCLE TILES -->
                <div class="row">
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-user fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Työntekijät
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo count($tyontekijat); ?>
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user" class="circle-tile-footer">Kaikki käyttäjät <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
       <!--             <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/varastoOtsikkot/index">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-database fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Varastorakenne
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo count($tyontekijat); ?>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/varastoOtsikkot/index" class="circle-tile-footer">Hallinta <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
-->
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-database fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Varasto
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo count($tyontekijat); ?>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/varasto?id='.$data->id.'" class="circle-tile-footer">Hallinta <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/viestinta/index">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-envelope fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Viestit
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo count($viestinta); ?>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/viestinta/index" class="circle-tile-footer">Kaikki viestit <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/asiakkaat/index">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Asiakkaat
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo count($asiakkaat); ?>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/asiakkaat/index" class="circle-tile-footer">Kaikki asiakkaat <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/oma_kansio">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-files-o fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Liikekirjeet
                                </div>
                                <div class="circle-tile-number text-faded">
					<br>
                                    <span id="sparklineB"></span>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/oma_kansio"  class="circle-tile-footer">Kaikki tiedostot <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-truck fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    Tuotanto
                                </div>
                                <div class="circle-tile-number text-faded">
					<br><!--tähän tulee haluttaessa rivimäärät-->
                                    <span id="sparklineC"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">Hallinta<i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/laskut">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-money fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Laskutus
                                </div>
                                <div class="circle-tile-number text-faded">
					<br><!--tähän tulee haluttaessa rivimäärät-->
                                    <span id="sparklineC"></span>
                                </div>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/laskut" class="circle-tile-footer">Hallinta <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-line-chart fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Raportit
                                </div>
                                <div class="circle-tile-number text-faded">
					<br><!--tähän tulee haluttaessa rivimäärät-->
                                    <span id="sparklineC"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">Kaikki raportit <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end DASHBOARD CIRCLE TILES -->

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
                    <!-- /.col-lg-8 -->

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



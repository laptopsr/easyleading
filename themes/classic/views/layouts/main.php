
<!DOCTYPE html>

<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>Frontend - Home | AppUI</title>

        <meta name="description" content="AppUI - Frontend Template & UI Framework" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/css/app-custom.css" />
        <!-- End Stylesheets -->
    </head>

    <body class="app-ui">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <!-- Header -->
                <header class="app-layout-header">
                    <nav class="navbar navbar-default p-y">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                                <!-- Header logo -->
                                <a class="navbar-brand" href="javascript:void(0)">
                                    <!--<img class="img-responsive" src="assets/img/logo/logo-frontend.png" title="AppUI" alt="AppUI" />-->
				    <?php //echo Yii::app()->name; ?>
                                </a>
                            </div>

                            <div class="collapse navbar-collapse" id="header-navbar-collapse">
                                <!-- Header search form -->
                                <div class="pull-right">
                                    <div class="form-group">
                                        <div class="input-group">
                                            	<?php echo CHtml::link('Kirjaudu sisään',Yii::app()->request->baseUrl.'/index.php/user/login',
							array('class'=>'painike btn btn-default btn-block btn-lg')); 
	  					?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Header navigation menu -->
                                <ul id="main-menu" class="nav navbar-nav navbar-left">

                                    <li class="active">
                                        <a href="frontend_home.html">Home</a>
                                    </li>

                                    <li>
                                        <a href="frontend_about.html">About</a>
                                    </li>

                                    <li>
                                        <a href="frontend_pricing.html">Pricing</a>
                                    </li>

                                    <li>
                                        <a href="frontend_team.html">Team</a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown">Pages <span class="caret"></span></a>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <a href="frontend_search.html">Search</a>
                                            </li>

                                            <li>
                                                <a href="frontend_support.html">Support</a>
                                            </li>

                                            <li>
                                                <a href="frontend_contact.html">Contact</a>
                                            </li>

                                            <li>
                                                <a href="frontend_login_signup.html">Login / Signup</a>
                                            </li>

                                            <li>
                                                <a href="frontend_400.html">Error 400</a>
                                            </li>

                                        </ul>
                                    </li>

                                </ul>
                                <!-- End header navigation menu -->
                            </div>
                        </div>
                        <!-- .container -->
                    </nav>
                    <!-- .navbar -->
                </header>
                <!-- End header -->




	<?php echo $content; ?>




                <footer class="app-layout-footer">
                    <div class="container p-y-md">
                        <div class="pull-right hidden-sm hidden-xs">
                            <a href="https://shapebootstrap.net/item/1525731-appui-admin-frontend-template/?ref=rustheme" target="_blank" rel="nofollow">Purchase a license</a>
                        </div>
                        <div class="pull-left text-center text-md-left">
                            AppUI &copy; <span class="js-year-copy"></span>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- Apps Modal -->
        <!-- Opens from the button in the header -->
        <div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-sm modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <!-- Apps card -->
                    <div class="card m-b-0">
                        <div class="card-header bg-app bg-inverse">
                            <h4>Apps</h4>
                            <ul class="card-actions">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="row text-center">
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-secondary bg-inverse" href="index.html">
                                        <i class="ion-speedometer fa-4x"></i>
                                        <p>Admin</p>
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-tertiary bg-inverse" href="frontend_home.html">
                                        <i class="ion-laptop fa-4x"></i>
                                        <p>Frontend</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- .card-block -->
                    </div>
                    <!-- End Apps card -->
                </div>
            </div>
        </div>
        <!-- End Apps Modal -->

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/jquery.slimscroll.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/jquery.scrollLock.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/jquery.placeholder.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/app.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/classic_assets/js/app-custom.js"></script>

    </body>

</html>

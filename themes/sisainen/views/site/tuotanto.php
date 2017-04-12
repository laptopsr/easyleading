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
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user" class="circle-tile-footer">Kaikki <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

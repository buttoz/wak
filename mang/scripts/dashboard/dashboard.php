<section class="content">
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="col-md">
                <div class="row drtl">
                    <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=5'">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #93c01f;">
                            <div class="inner">
                                <h3 id="late_tasks">1</h3>

                                <p><?php echo $lang['renew_dash'] ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=1'">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #00a099;">
                            <div class="inner">
                                <h3>2</h3>

                                <p><?php echo $lang['all_active_dash'] ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=dashboard&action=onlineusers'">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #00a099;">
                            <div class="inner">
                                <h3>3</h3>

                                <p><?php echo $lang['user_online'] ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=excel&action=dailyreports'">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #00a099;">
                            <div class="inner">
                                <h3>4</h3>

                                <p>סה"כ מנויים בהמתנה לדיווח</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=dashboard&action=itemstoreport'">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #ea5b27;">
                            <div class="inner">
                                <h3>5</h3>

                                <p> סה"כ מנויים לא דיווחו לספק</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=dashboard&action=itemsneededserv'">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #00a099;">
                            <div class="inner">
                                <h3>6</h3>

                                <p>סה"כ מנויים צרכו שירות</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header" style="background-color: #b1b1b1;"><?= $lang['today'] ?></div>
                                    <div class="card-body">

                                        <div class="row drtl">
                                            <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=2'">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #93c01f;">
                                                    <div class="inner">
                                                        <h3 id="late_tasks">7</h3>

                                                        <p><?php echo $lang['polisa_today'] ?></p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=3'">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #7a7a7a;">
                                                    <div class="inner">
                                                        <h3>8</h3>

                                                        <p><?php echo $lang['to_be_canceled'] ?></p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=4'">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #ea5b27;">
                                                    <div class="inner">
                                                        <h3>9</h3>

                                                        <p><?php echo $lang['today_canceled_polisa'] ?></p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header" style="background-color: #b1b1b1;"><?= $lang['month'] ?></div>
                                    <div class="card-body">

                                        <div class="row drtl">
                                            <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=6'">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #93c01f;">
                                                    <div class="inner">
                                                        <h3 id="late_tasks">10</h3>

                                                        <p><?php echo $lang['polisa_today'] ?></p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg col-6" style="cursor: pointer;" onclick="window.location='index.php?sec=subs&action=managesubs&type=7'">
                                                <!-- small box -->
                                                <div class="small-box" style="background-color: #EA5B27;">
                                                    <div class="inner">
                                                        <h3>11</h3>

                                                        <p><?php echo $lang['today_canceled_polisa'] ?></p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-header" style="background-color: #b1b1b1;">
                            <? echo $lang['polisa_by_supp'] ?>
                        </div>
                        <div class="card-body">
                            <canvas id="chartarea3"></canvas>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-header" style="background-color: #b1b1b1;">
                            <? echo $lang['polisa_by_serv'] ?>
                        </div>
                        <div class="card-body">
                            <canvas id="chartarea2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #b1b1b1;">
                            <? echo $lang['subb'] ?>
                        </div>
                        <div class="card-body">
                            <canvas id="chartarea1"></canvas>
                        </div>
                    </div>

                </div> -->
            </div>

            <!-- Small boxes (Stat box) -->
            <?/*
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <? echo $lang['claims_status_g'] ?>
                        </div>
                        <div class="card-body">
                            <canvas id="chartarea4"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <? echo $lang['tasks'] ?>
                        </div>
                        <div class="card-body">
                            <canvas id="chartarea3"></canvas>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <? echo $lang['claims']  ?>
                        </div>
                        <div class="card-body">
                            <canvas id="chartarea2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <? echo $lang['all_tasks_graph'] ?>
                        </div>

                        <div class="card-body">
                            <canvas id="chartarea1"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        */ ?>

        </div>
    </div>
</section>
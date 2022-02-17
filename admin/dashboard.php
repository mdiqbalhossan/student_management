<?php include 'inc/header.php'; ?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid" id="main_content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $auth->tableRowcount('student'); ?></h3>

                        <p>Total Student</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $auth->tableRowcount('class'); ?><sup style="font-size: 20px"></sup></h3>

                        <p>Total Class</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $auth->totalCollectFees(); ?></h3>

                        <p>Collect Fees</p>
                    </div>
                    <div class="icon">
                        <!-- <ion-icon name="wallet"></ion-icon> -->
                        <!-- <i class="fa-solid fa-money-check-dollar"></i> -->
                        <i class="fa fa-money-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $auth->tableRowcount('student', 'verified', '0'); ?></h3>

                        <p>Unverified Student</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Student By Class</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Total Amount Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Student</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger"><?= $auth->latestRegisterStudent() ?> New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <?php
                            $path = '../assets/img/';
                            foreach ($auth->fetchStudent(8) as $student) :
                                if ($student['st_photo'] != '') {
                                    $uphoto = $path . $student['st_photo'];
                                } else {
                                    $uphoto = '../assets/img/avater.png';
                                } ?>
                                <li>
                                    <img src="<?= $uphoto; ?>" class="rounded-circle" style="width: 80px; height: 80px;">
                                    <!-- <img src="dist/img/user1-128x128.jpg" alt="User Image"> -->
                                    <a class="users-list-name" href="#"><?= $student['st_name'] ?></a>
                                    <span class="users-list-date"><?= $auth->timeAgo($student['created_at']) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="student.php">View All Users</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <div class="col-md-6">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                    <div class="card-header">
                        <h3 class="card-title">Latest Message</h3>

                        <div class="card-tools">
                            <span data-toggle="tooltip" title="<?= $auth->tableRowcount('contact', 'replied', '0'); ?> New Messages" class="badge badge-warning"><?= $auth->tableRowcount('contact', 'replied', '0'); ?></span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fas fa-comments"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" style="height: auto !important;">
                            <!-- Message. Default to the left -->
                            <?php foreach ($contact as $value) : ?>
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left"><?= $value['fname'] . " " . $value['lname'] ?></span>
                                        <span class="direct-chat-timestamp float-right"><?= date("d M H:i a", strtotime($value['created_at'])) ?></span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="assets/dist/img/user1-128x128.jpg" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        <?= $value['msg'] ?>
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="student.php">View All Message</a>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?php include 'inc/footer.php'; ?>
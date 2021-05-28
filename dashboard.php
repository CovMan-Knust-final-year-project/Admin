<?php 

  session_start();
  if(isset($_SESSION["id"])){
  }else{
      header('Location:index.php');
  }
  include_once 'partials/header.php';
  include_once 'database/config.php';
  include_once 'helpers/functions.php';
  include_once 'helpers/counters.php';

    $org_id       = $_SESSION['id'];
    $query        = "SELECT * FROM scans WHERE org_id = :org_id LIMIT 2";
    $statement    = $con->prepare($query);
    $statement->execute(
        array(
            ":org_id" => $org_id,
        )
    );

    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
?>

<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="javascript:;">CovMan | Dashboard</a>
            </div>

        <!-- adding the remaining navbar -->
        <?php include_once 'partials/navbar.php';?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand redded" href="javascript:;"><i class="material-icons">today</i> DAILY REPORT</a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">scanner</i>
                            </div>
                            <p class="card-category">Scans</p>
                            <h3 class="card-title"><?= countDailyScan($con);?>
                                <small></small>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">info</i>
                                <a href="javascript:;">View all scans...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-fire"></i>
                            </div>
                            <p class="card-category">Highest temperature</p>
                            <h3 class="card-title"><?= fetchDailyMaxtemperature($con);?>&#176;C</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Just Updated
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">info_outline</i>
                            </div>
                            <p class="card-category">Positive cases</p>
                            <h3 class="card-title"><?= countPositiveCases($con); ?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Today
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <p class="card-category">Negative cases</p>
                            <h3 class="card-title"><?= countNegativeCases($con);?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Today
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Daily Sales</h4>
                  <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.
                  </p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> updated 4 minutes ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                  <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Email Subscriptions</h4>
                  <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Completed Tasks</h4>
                  <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                  </div>
                </div>
              </div>
            </div>
          </div> -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">Recent Scans</h4>
                            <p class="card-category">Scans for today,
                                <script>
                                    document.write(new Date().toDateString());
                                </script>
                            </p>
                        </div>
                        <div class="card-body table-responsive">
                            <?php if ($count > 0 && !empty($rows)) { ?>
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Venue</th>
                                        <th>Temperature</th>
                                        <th>Time</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rows as $results){ ?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td>
                                                    <!--firstname --> <?= fetchUserDetailsFromID($con, $results['user_id'],'first_name'); ?> <!-- lastname--> <?= fetchUserDetailsFromID($con, $results['user_id'],'last_name'); ?>
                                                </td>
                                                <td><?= fetchMountPointDetailsFromID($con, $results['mount_point_id'], 'venue');?></td>
                                                <td><?=$results['temperature']?>&#176;C</td>
                                                <td>
                                                  <?=dateFormat($results['date_scanned']);?> at <?=$results['time_scanned'];?>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;}
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                                }else{?>
                                    <h3 class="text-center">No scans Yet</h3>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <a class="navbar-brand redded" href="javascript:;"><i class="material-icons">circle</i> OVERALL</a>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person_outline</i>
                            </div>
                            <p class="card-category">Total Students</p>
                            <h3 class="card-title"><?=CountAllScans($con, 'users')?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Last Updated (<?= dateFormat(fetchLatestUpdateDate_users($con, 'users'))?>)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-qrcode"></i>
                            </div>
                            <p class="card-category">Total Scans</p>
                            <h3 class="card-title"><?=CountAllScans($con, 'scans')?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Last Updated (<?= dateFormat(fetchLatestUpdateDate_scans($con, 'scans'))?>)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">info_outline</i>
                            </div>
                            <p class="card-category">Total cases</p>
                            <h3 class="card-title"><?=CountAllScans($con, 'cases')?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Last Updated (<?= dateFormat(fetchLatestUpdateDate_cases($con, 'cases'))?>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'partials/footer.php'?>
<?php
include("lang/en.php");

require("models/questions/mod_questions.php");
$qs = new ques();

require("classes/class_lib.php");
$ak = new akol();

require("classes/class_msg.php");
$msg = new messages();

$getall = $qs->getques();
$questinfo = $ak->getallinfo($getall);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/header.php"); ?>
</head>
<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <?php include("includes/top-bar.php"); ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <?php include("includes/sidebar.php"); ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-dark pb-10">
                    <div class="container">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="tag"></i></div><?php echo $lng_questions; ?>
                                    </h1>
                                    <div class="page-header-subtitle"><?php echo $lng_ques_text; ?></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container mt-n10">
                    <?php
                    if (isset($_GET['msg'])) {
                        $msgdis='';
                        if ($_GET['msg'] == 'catupdated') {
                            $msgdis = $msg->alertmessage('info', $lng_catupdate_msg);
                        }
                        if ($_GET['msg'] == 'catadded') {
                            $msgdis = $msg->alertmessage('success', $lng_catadded_msg);
                        }if ($_GET['msg'] == 'catdeleted') {
                            $msgdis = $msg->alertmessage('danger', $lng_catdel_msg);
                        }
                        if ($_GET['msg'] == 'noaccess') {
                            $msgdis = $msg->alertmessage('danger', $lng_noaccess);
                        }
                        echo $msgdis;
                    }
                    ?>
                    
                    <div class="row">
                        <!-- Left Content -->
                        <div class="col-lg-12">
                        <!-- Right Content -->
                        <div>
                            <div class="card card-header-actions">
                            <div class="card-header"><?php echo $lng_questions; ?>
                            <a href="question-new.php" class="btn btn-success btn-sm"> <i data-feather="plus"></i> <?php echo $lng_add_ques;?></a>
                        </div>
                                <div class="card-body"> 
                                   <div class="datatable">
                                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $lng_questions; ?></th>                                               
                                                    <th><?php echo $lng_type; ?></th>                                               
                                                    <th><?php echo $lng_cat; ?></th>                                               
                                                    <th><?php echo $lng_actions; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($questinfo) {
                                                    for ($q = 0; $q < count($questinfo); $q++) {

                                                        //Get Base Ques Info
                                                        $quesbase_query = $qs->getquesbase($questinfo[$q]['QBID']);
                                                        $quebase_data=$ak->getallinfo($quesbase_query);
                                                        
                                                        //Get Question Type Data
                                                        $questype_query = $qs->getquestype($quebase_data[0]['QTID']);
                                                        $questype_data=$ak->getallinfo($questype_query);

                                                        //Get Question Cat data
                                                        $quescat_query = $qs->getquescat($quebase_data[0]['QCATID']);
                                                        $quescat_data=$ak->getallinfo($quescat_query);



                                                        
                                                            echo '<tr>
                                                            <td>'.$questinfo[$q]['Qname'].'</td>
                                                            <td><div class="badge badge-'.$questype_data[0]['Color'].'-soft badge-pill">'.$questype_data[0]['Name'].'</div></td>
                                                            <td>'.$quescat_data[0]['Name'].'</td>
                                                            <td></td>
                                                            </tr>';

                                                        

                                                        
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        
                    </div>
                    
                </div>
            </main>
            <footer class="footer mt-auto footer-light">
                <?php include("includes/footer.php"); ?>
            </footer>
        </div>
    </div>
    <?php include("includes/footer-scripts.php"); ?>
    <script>
        $('#dataTable').dataTable({
            "ordering": false
        });
    </script>
</body>

</html>
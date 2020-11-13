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
                        <div class="col-lg-7">
                        <!-- Right Content -->
                        <div>
                            <div class="card card-header-actions">
                            <div class="card-header"><?php echo $lng_questions; ?>
                            <a href="questions.php" class="btn btn-sm btn-link"> <i data-feather="arrow-left"></i> <?php echo $lng_back;?></a>
                        </div>
                                <div class="card-body"> 
                                <form>                                    
                                    <div class="form-group">
                                        <label for="questype"><?php echo $lng_ques_type;?></label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Example multiple select</label><select class="form-control" id="exampleFormControlSelect2" multiple="">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group"><label for="exampleFormControlTextarea1">Example textarea</label><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>
                                </form>                                   
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
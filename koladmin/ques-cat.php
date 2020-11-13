<?php
include("lang/ta.php");

require("models/quescats/mod_ques-cat.php");
$qc = new qcats();

require("classes/class_lib.php");
$ak = new akol();

require("classes/class_msg.php");
$msg = new messages();

$getall = $qc->getcats();
$catinfo = $ak->getallinfo($getall);
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
                                        <div class="page-header-icon"><i data-feather="tag"></i></div><?php echo $lng_quescat; ?>
                                    </h1>
                                    <div class="page-header-subtitle"><?php echo $lng_quescat_text; ?></div>

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
                        <div class="col-lg-5">
                            <div class="card">

                                <?php
                                $catname = $catdesc = $catpid = '';
                                if (isset($_GET['action'])) {
                                    if ($_GET['action'] == 'edit' && $_GET['id'] != '') {
                                        $onecquery = $qc->getdata($_GET['id']); //Form the Query
                                        $catdata = $ak->getallinfo($onecquery); //Fetch the data
                                        $catname = $catdata[0]['Name'];
                                        $catdesc = $catdata[0]['Description'];
                                        $catpid = $catdata[0]['ParentID'];

                                        $btntext = $lng_quescat_update;
                                        $icon = 'save';
                                        echo '<div class="card-header">' . $lng_quescat_update . '</div>';
                                        echo '<div class="card-body">';
                                        echo '<form method="POST" name="updatecat" action="actions/quescats/ques-cat-update.php">';
                                        echo '<input type="hidden" name="catid" value="' . $_GET['id'] . '">';
                                    }
                                } else {
                                    $icon = 'plus';
                                    echo '<div class="card-header">' . $lng_quescat_add . '</div>';
                                    echo '<div class="card-body">';
                                    echo '<form method="POST" name="addnewcat" action="actions/quescats/ques-cat-add.php">';
                                    $btntext = $lng_quescat_add;
                                }

                                ?>
                                <div class="form-group"><label for="catname"><?php echo $lng_name; ?></label><input class="form-control" name="catname" id="catname" type="text" placeholder="" required value="<?php echo  $catname; ?>"></div>
                                <div class="form-group">
                                    <label for="parentcat"><?php echo $lng_parcat; ?></label>
                                    <select class="form-control" id="parentcat" name="parentcat">
                                        <option value="0"><?php echo $lng_none; ?></option>

                                        <?php
                                        for ($p = 0; $p < count($catinfo); $p++) {
                                            if ($catinfo[$p]['ParentID'] == 0) {
                                                if ($catpid == $catinfo[$p]['ID']) {
                                                    $sel = 'selected="selected"';
                                                } else {
                                                    $sel = '';
                                                }
                                                echo '<option ' . $sel . ' value="' . $catinfo[$p]['ID'] . '">' . $catinfo[$p]['Name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group"><label for="catdesc"><?php echo $lng_desc; ?></label><textarea name="catdesc" class="form-control" id="catdesc" rows="6"><?php echo  $catdesc; ?></textarea></div>
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i data-feather="<?php echo $icon; ?>"></i>&nbsp;<?php echo $btntext; ?></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <!-- Right Content -->
                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <h3><?php echo $lng_cats; ?> </h3>

                                    <div class="datatable">
                                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $lng_name; ?></th>
                                                    <th><?php echo $lng_desc; ?></th>
                                                    <th><?php echo $lng_total . ' ' . $lng_questions; ?></th>
                                                    <th><?php echo $lng_actions; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($catinfo) {
                                                    for ($c = 0; $c < count($catinfo); $c++) {

                                                        if ($catinfo[$c]['ParentID'] == 0) //Parent 
                                                        {
                                                            echo '<tr>';
                                                            echo '<td>' . $catinfo[$c]['Name'] . '</td>';
                                                            echo '<td>' . $catinfo[$c]['Description'] . '</td>';
                                                            echo '<td></td>';
                                                            echo '<td><a href="ques-cat.php?action=edit&id=' . $catinfo[$c]['ID'] . '"><button class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                        <i data-feather="edit-2"></i></button></a>
                                                        <button class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="modal" data-target="#catdel' . $catinfo[$c]['ID'] . '"><i data-feather="trash-2"></i></button>
                                                                <div class="modal fade" id="catdel'.$catinfo[$c]['ID'].'" tabindex="0" role="dialog" aria-labelledby="catdel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modeltitle">'.sprintf($lng_delops,$catinfo[$c]['Name']).'</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        '.sprintf($lng_delmsg,$catinfo[$c]['Name']).'
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <form method="POST" name="delcat" action="actions/quescats/ques-cat-del.php">
                                                                    <input type="hidden" name="catid" value="'.$catinfo[$c]['ID'].'">
                                                                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">'.$lng_clsbtn.'</button>
                                                                        <button type="submit" class="btn btn-danger btn-sm">'.$lng_delbtn.'</button>
                                                                        </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </td>';
                                                            echo '</tr>';

                                                            // Check if this ID is in the Parent?
                                                            $childquery = $qc->checkchild($catinfo[$c]['ID']); //Form the Query
                                                            $childcats = $ak->getallinfo($childquery); //Fetch the data
                                                            if ($childcats) {
                                                                for ($ci = 0; $ci < count($childcats); $ci++) {
                                                                    echo '<tr>';
                                                                    echo '<td> - ' . $childcats[$ci]['Name'] . '</td>';
                                                                    echo '<td>' . $childcats[$ci]['Description'] . '</td>';
                                                                    echo '<td></td>';
                                                                    echo '<td><a href="ques-cat.php?action=edit&id=' . $childcats[$ci]['ID'] . '"><button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" ><i data-feather="edit-2"></i></button></a>
                                                                <button class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="modal" data-target="#catdel' . $childcats[$ci]['ID'] . '"><i data-feather="trash-2"></i></button><div class="modal fade" id="catdel'.$childcats[$ci]['ID'].'" tabindex="0" role="dialog" aria-labelledby="catdel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modeltitle">'.sprintf($lng_delops,$childcats[$ci]['Name']).'</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        '.sprintf($lng_delmsg,$childcats[$ci]['Name']).'
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <form method="POST" name="delcat" action="actions/quescats/ques-cat-del.php">
                                                                    <input type="hidden" name="catid" value="'.$childcats[$ci]['ID'].'">
                                                                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">'.$lng_clsbtn.'</button>
                                                                        <button type="submit" class="btn btn-danger btn-sm">'.$lng_delbtn.'</button>
                                                                        </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div></td>';
                                                                    echo '</tr>';
                                                                }
                                                            } else {
                                                            }

                                                            // If it is there then Print it.
                                                            // Else move on
                                                        }
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
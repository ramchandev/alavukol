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
                        $msgdis = '';
                        if ($_GET['msg'] == 'catupdated') {
                            $msgdis = $msg->alertmessage('info', $lng_catupdate_msg);
                        }
                        if ($_GET['msg'] == 'catadded') {
                            $msgdis = $msg->alertmessage('success', $lng_catadded_msg);
                        }
                        if ($_GET['msg'] == 'catdeleted') {
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
                                        <a href="questions.php" class="btn btn-sm btn-link"> <i data-feather="arrow-left"></i> <?php echo $lng_back; ?></a>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $questype=$quescat=$quesname='';
                                        if(isset($_GET['qbid']))
                                        {

                                            //Question Base Info
                                            $quesbase_query=$qs->getquesbase($_GET['qbid']);
                                            $quesbaseinfo = $ak->getallinfo($quesbase_query);
                                            $questype=$quesbaseinfo[0]['QTID'];
                                            $quescat=$quesbaseinfo[0]['QCATID'];

                                             //Question Name Info
                                             $quesname_query=$qs->getquesnames($_GET['qbid']);
                                             $quesnameinfo = $ak->getallinfo($quesname_query);
                                             $quesname=$quesnameinfo[0]['Qname'];
                                             $qnid=$quesnameinfo[0]['ID'];

                                             echo '<form method="POST" name="addnewques" action="actions/questions/ques-update.php">';
                                             echo '<input type="hidden" name="qnameid" value="'.$qnid.'">';
                                             echo '<input type="hidden" name="qbaseid" value="'.$_GET['qbid'].'">';
                                             $qbtext='Update Question';
                                             $newques_ins='';

                                        }
                                        else
                                        {
                                           
                                            echo '<form method="POST" name="addnewques" action="actions/questions/ques-add.php">';
                                            $qbtext='Create & Continue';
                                            $newques_ins='* Create a question  first, then add options';
                                        }                                        
                                        ?>
                                            <div class="form-group">
                                            <?php
                                        
                                        if(isset($_GET['qbid']))
                                        {
 
                                             //Get Question Type Data
                                             $questype_query = $qs->getquestype($questype);
                                             $questype_data=$ak->getallinfo($questype_query);
                                             echo "Question Type: " .$questype_data[0]['Name'];


                                        }
                                        else
                                        {
                                            
                                            echo '<label for="questype"><?php echo $lng_ques_type; ?></label>
                                                <select class="form-control" id="questype" name="questype" required>
                                                    <option value="">Select a Question Type</option>';
                                                    //Get Question Cat data
                                                    $questypes_query = $qs->getquesalltype();
                                                    $questype_data = $ak->getallinfo($questypes_query);

                                                    for ($qi = 0; $qi < count($questype_data); $qi++) {                                                        
                                                        echo '<option value="' . $questype_data[$qi]['ID'] . '">' . $questype_data[$qi]['Name'] . '</option>';
                                                    }
                                            
                                               echo '</select>';

                                        }
                                        ?>

                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="quescat"><?php echo $lng_cat; ?></label>
                                                <select class="form-control" id="quescat" name="quescat">
                                                    <option value="">Select a Question Category</option>

                                                    <?php
                                                    //Get Question Cat data
                                                    $quescats_query = $qs->getquescats();
                                                    $quescats_data = $ak->getallinfo($quescats_query);
                                                   
                                                    for ($qt = 0; $qt < count($quescats_data); $qt++) {

                                                        if($quescat==$quescats_data[$qt]['ID'])
                                                        {
                                                            $selcat='selected="selected"';

                                                        }
                                                        else{
                                                            $selcat='';

                                                        }
                                                        echo '<option '.$selcat.' value="' . $quescats_data[$qt]['ID'] . '">' . $quescats_data[$qt]['Name'] . '</option>';
                                                    }
                                                    ?>


                                                </select>
                                            </div>
                                            <div class="form-group"><label for="quesname">Question</label><textarea class="form-control" name="quesname" id="quesname" rows="3"><?php echo $quesname;?></textarea></div>
                                            <div class="form-group">
                                            <button class="btn btn-success btn-sm" type="submit">
                                        <i data-feather="save"></i>&nbsp; <?php echo $qbtext;?></button><br/>
                                        <small><?php echo $newques_ins;?></small>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header">Options</div>
                                <div class="card-body">
                                    <div class="datatable">
                                        <table class="table table-bordered table-hover" id="" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Option</th>
                                                    <th>Is Answer?</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //Get Question Cat data
                                                if(isset($_GET['qbid']))
                                    {
                                                $quesopts_query = $qs->getquesopts($quesnameinfo[0]['ID']);
                                                $quesopts_data = $ak->getallinfo($quesopts_query);
                                                if($quesopts_data)
                                                {
                                                for($op=0;$op<count($quesopts_data); $op++)
                                                {
                                                    if($quesopts_data[$op]['IsAnswer']==1)
                                                    {
                                                        $icon='<span class="text-success"><i data-feather="check-circle"></i></span>';
                                                    }
                                                    else
                                                    {
                                                        $icon='';
                                                    }
                                                    echo '<tr>
                                                    <td>'.$quesopts_data[$op]['Optiontext'].'</td>
                                                    <td>'.$icon.'</td>
                                                    <td><a href="question-op.php?qbid='.$_GET['qbid'].'&opid='.$quesopts_data[$op]['ID'].'"><div class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                    <i data-feather="edit-2"></i></div></a><button class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="modal" data-target="#catdel"><i data-feather="trash-2"></i></button></td>
                                                </tr>';

                                                }
                                            }
                                            }

                                                

                                                ?>
                                                
                                            </tbody>
                                        </table>

                                    </div>
                                    <hr>
                                    <?php
                                    if(isset($_GET['qbid']))
                                    {
                                        $optname=$isans=$ck='';
                                        if(isset($_GET['opid']) && $_GET['opid']!='')
                                        {
                                            
                                            echo '<form method="POST" name="updateopt" action="actions/questions/ques-option-update.php">';
                                            echo '<input type="hidden" name="opid" value="'.$_GET['opid'].'">';
                                            
                                            $quesopt_query = $qs->getoptdata($_GET['opid']);
                                            $quesopt_data = $ak->getallinfo($quesopt_query);
                                            $optname=$quesopt_data[0]['Optiontext'];
                                            $isans=$quesopt_data[0]['IsAnswer'];


                                        }
                                        else
                                        {
                                            echo '<form method="POST" name="addnewques" action="actions/questions/ques-option.php">';
                                        }
                                    ?>
                                    
                                    <div class="form-group">
                                        <label for="questype">Option Name</label>
                                        <input type="text" class="form-control" name="qoption" value="<?php echo $optname;?>">
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <?php 
                                        if($isans==1)
                                        {
                                            $ck='checked="checked"';
                                        }
                                        else
                                        {
                                            $ck='';
                                        }
                                        ?>
                                        <input <?php echo $ck;?> type="checkbox" class="custom-control-input" name="isans" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Mark as answer</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="qbid" value="<?php echo $quesbaseinfo[0]['ID'];?>">
                                        <input type="hidden" name="qnid" value="<?php echo $quesnameinfo[0]['ID'];?>">

                                            <button class="btn btn-success btn-sm" type="submit">
                                        <i data-feather="plus"></i>&nbsp; Create Option</button><br/>
                                                 </div>
                                    </form>
                                    <?php }?>

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
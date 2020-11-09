<?php 
include("lang/en.php"); 
require ("models/mod_ques-cat.php");
require ("classes/class_lib.php");
$ak=new akol();

$catinfo=$ak->getallinfo($query_getcats);

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
                    <div class="row">
                        <!-- Left Content -->
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header"><?php echo $lng_quescat_add; ?></div>
                                <div class="card-body">
                                    <form method="POST" name="addnewcat" action="actions/ques-cat-add.php">
                                        <div class="form-group"><label for="catname"><?php echo $lng_name;?></label><input class="form-control" name="catname" id="catname" type="text" placeholder="" required></div>
                                        <div class="form-group">
                                            <label for="parentcat"><?php echo $lng_parcat;?></label>
                                            <select class="form-control" id="parentcat" name="parentcat">
                                                <option><?php echo $lng_none;?></option>
                                                
                                                <?php
                                                for($p=0; $p<count($catinfo); $p++)
                                                {
                                                    if($catinfo[$p]['ParentID']=='')
                                                    {
                                                        echo '<option value="'.$catinfo[$p]['ID'].'">'.$catinfo[$p]['Name'].'</option>';
                                                    }

                                                }
                                                ?> 
                                                </select>                                                
                                            
                                        </div>
                                        <div class="form-group"><label for="catdesc"><?php echo $lng_desc;?></label><textarea name="catdesc" class="form-control" id="catdesc"  rows="6"></textarea></div>  
                                        <div class="form-group">
                                        <button class="btn btn-success btn-sm" type="submit">
                                        <i data-feather="plus"></i> <?php echo $lng_quescat_add; ?></button>
                                        </div>                                  
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <!-- Right Content -->
                            <div class="nav-sticky">
                                <div class="card">
                                    <div class="card-body">
                                        <h3><?php echo $lng_cats;?> </h3>
                                       
                                    <div class="datatable">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th><?php echo $lng_name;?></th>
                                                <th><?php echo $lng_desc;?></th>
                                                <th><?php echo $lng_total.' '.$lng_questions;?></th>
                                                <th><?php echo $lng_actions;?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                            
                                            if($catinfo) {                                                
                                                for($c=0; $c<count($catinfo); $c++)
                                                {
                                                    echo '<tr>';
                                                    echo '<td>'.$catinfo[$c]['Name'].'</td>';
                                                    echo '<td>'.$catinfo[$c]['Description'].'</td>';
                                                    echo '<td></td>';
                                                    echo '<td><button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button></td>';
                                                    echo '</tr>';

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
</body>

</html>
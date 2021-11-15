<?php
include 'header.php';
include 'bidix.php'
?>

<div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!--[ daily sales section ] start-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4">Inta xabu alaabta</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-9" id="inta">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[ daily sales section ] end-->
                                <!--[ Monthly  sales section ] starts-->
                                <div class="col-md-6 col-xl-4">
                                    <div class="card Monthly-sales">
                                        <div class="card-block" >
                                            <h6 class="mb-4">Week</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-9" id="week">
                                                 
                                                </div>
                                         
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!--[ Monthly  sales section ] end-->
                                <!--[ year  sales section ] starts-->
                                <div class="col-md-12 col-xl-4">
                                    <div class="card yearly-sales">
                                        <div class="card-block">
                                            <h6 class="mb-4">Lacagta</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-9" id="lacagta">

                                                </div>
    
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!--[ year  sales section ] end-->
                                <!--[ Recent Users ] start-->
                         
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include 'footer.php';
?>
<script src="../js/dashboard.js"></script>
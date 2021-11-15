<?php
include 'header.php';
include 'bidix.php'
?>

<div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                        <div class="row">
                                <!-- [ basic-table ] start -->
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Shaqale Table</h5>
                                         </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <button class="btn btn-primary float-right" id="add">Add new</button>
                                                <table class="table" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th>magaca</th>
                                                            <th>phone</th>
                                                            <th>username</th>
                                                            <th>action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal" tabindex="-1" id="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">shaqale</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="x"></button>
                                        </div>
                                        <div class="modal-body">
                                           <form id="form">
                                           <div class="did" id="di">
                                            
                                               </div>
                                               <div class="col-sm-12">
                                               <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label ">name</label>
                                                <input type="text" name="magaca" id="magaca" class='form-control mt-2' required>
                                                </div>
                                               </div>
                                               <div class="col-sm-12">
                                               <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label ">Phone</label>
                                                <input type="text" name="phone" id="phone" class='form-control mt-2' required>
                                                </div>
                                               </div>
                                               <div class="col-sm-12">
                                               <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label ">username</label>
                                                <input type="text" name="username" id="username" class='form-control mt-2' required>
                                                </div>
                                               </div>
                                               <div class="col-sm-12">
                                               <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label ">password</label>
                                                <input type="password" name="password" id="password" class='form-control mt-2' required>
                                                </div>
                                               </div>
                                               <input type="text" name="id" id="id" class="form-control m-2 d-none" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="xa">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
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
    </div>

<?php
include 'footer.php';
?>
<script src="../js/shaqale.js"></script>
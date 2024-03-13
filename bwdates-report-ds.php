<?php include_once('layout/head.php'); ?>
<?php $title = 'Constant'; ?>


            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Between Dates </strong> Reports
                            </div>
                            <div class="card-body card-block">
                                <form action=" bwdates-reports-details.php" method="post" enctype="multipart/form-data" class="form-horizontal" name="bwdatesreport">
                                    <p style="font-size:16px; color:red" align="center">  asd  </p>
                                  
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">From Date</label></div>
                                        <div class="col-12 col-md-9"><input type="date" name="fromdate" id="fromdate" class="form-control" required="true"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">To Date</label></div>
                                        <div class="col-12 col-md-9"><input type="date" name="todate"  class="form-control" required="true"></div>
                                    </div>
                                   
                                   
                                  
                                    
                                    
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Submit</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

   <?php include_once('layout/footer.php');?>

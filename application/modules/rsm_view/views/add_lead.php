
<link rel="stylesheet" href="http://localhost/lms/assets/themes/admin/multi-select.css" />g
<style>
body{background:#eee;}
.bg-wh{background:#fff; float:left; padding:30px; width:100%; }
.bg-wh .form-group .form-control{border-radius:0; margin-bottom:5px;}
.mlr0{margin-left:0; margin-right:0;}
.mlr5{margin-left:-5px; margin-right:-5px;}
.plr5{padding-left:5px; padding-right:5px;}
.input-group-btn span.glyphicon, .input-group-btn i.fa {font-size:20px;}
.bg-wh .form-group .input-group .form-control{margin-bottom:0;}
.form-group .input-group-btn .btn{border-radius:0;}
.form-group label{font-weight:normal;}
.append-btn{border-radius:0; margin-bottom:5px; }
.mb5{margin-bottom:5px;}
.btn.multiselect{width:100%; border-radius:0; background:#fff; text-align:left;}
.multiselect-native-select .btn-group{width:100%; text-align:left;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Zone
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


            <?php 

            if($this->session->flashdata('success')){
             ?>
                
             <?php echo $this->session->flashdata('success'); ?>               

            <?php 
            
            }else if($this->session->flashdata('error')){ 
            ?>

            <?php echo $this->session->flashdata('error'); ?>

            <?php 

            }
            ?>

           










<div class="container">
            <div class="bg-wh">
                    <h2 class="text-center">Partner Lead Registration in PLMT</h2>
                    <br />
                    <br />
               <form method="post" action="<?php echo site_url('admin/lead/add_lead');?>" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Lead registration Date</label>
                        <input type="text" name="registration_date" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Lead ID</label>
                        <input type="text" name="lead_id" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Sales Motion</label>
                        <select class="form-control"  name="sales_motion">
                            <option value="1">Live</option>
                            <option value="2">Licensing Advisory & Gap</option>
                            <option value="3">Tender</option>
                        </select>
                        </div>
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer Segment</label>
                        <select class="form-control" name="constomer_segment">
                            <option value="1">SMB</option>
                            <option value="2">Consumer</option>
                            <option value="3">Existing customer</option>
                            <option value="4">Others</option>
                        </select>
                        </div>
                    </div>
                     <!-- <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Other</label>
                        <input type="text" name="other_segment" class="form-control" />
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" />
                        </div>
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer City</label>
                        <select class="form-control" name="city">
                            <option value="1">Indore</option>
                            <option value="2">Delhi</option>
                            <option value="3">Gwalior</option>
                        </select>
                        </div>
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Pin code</label>
                        <input type="text" name="pin_code" class="form-control" />
                        </div>
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Value of Deal</label>
                        <select class="form-control" name="value_of_deal">
                            <option value="1">Live (Total Veal value and SKU's)</option>
                            <option value="2">Gap(Expected Licenses)</option>
                            <option value="3">Tender (Product , deal size, tender type)</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                         <div class="form-group">
    <label for="teams">MS Product required</label><br/>
   <select id="multi-select-demo" multiple="multiple" name="product_required[]">
<option value="1">jQuery tutorial</option>
<option value="2">Bootstrap Tips</option>
<option value="3">HTML</option>
<option value="4">CSS tricks</option>
<option value="5">Angular JS</option>
</select>
</div>
                    </div>
               <div class="col-sm-6 col-md-4">
                         <div class="form-group">
    <label for="product">MS Involvement if any</label><br/>
   <select name="involvement">
<option value="1">MAF</option>
<option value="2">Licensing Policy Doc</option>
<option value="3">BDM Involvement</option>
<option value="4">Tale sales involvement</option>
</select>
</div>
                    </div> 
       <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Expected date of closing</label>
                        <select class="form-control" name="closing_date">
                            <option value="1">15 days</option>
                            <option value="2">30 days</option>
                            <option value="3">45 days</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Current status of the lead</label>
                        <select class="form-control" name="lead_status">
                            <option value="1">10% (Advice mail)</option>
                           <option value="2">20% (required Dics submitted)</option>
                           <option value="3">40% (BOM given)</option>
                           <option value="4">80% (PO recieved)</option>
                           <option value="5">100% (supplied)</option>
                           <option value="6">Other Lost (reasons)</option>
                        </select>
                        </div>
                    </div>             
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label style="visibility:hidden;">Submit</label>
                        <button type="submit" class="btn btn-primary btn-block " style="border-radius:0;">Submit</button>
                        </div>
                        </div>
                    </form>     


                    </div>
</div>
</div>
<div class="clearfix"></div>
<script src="http://localhost/lms/assets/themes/admin/multi-select-js.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#multi-select-demo').multiselect();
    $('#multi-select-demo2').multiselect();
});
</script>









































                           
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>



<script>
    $('#example1').DataTable();
</script>
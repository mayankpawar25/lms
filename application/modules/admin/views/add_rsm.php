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
.multiselect-native-select .btn-group{width:100%; text-align:left; }
.registration-form .multiselect-container.dropdown-menu{max-height:200px; overflow-y:scroll; width:100%;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add RSM (Regional Sales Manager)
            <small> </small>
        </h1>
        <?php echo $breadcrumb; ?>
       <!--  <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if($this->session->flashdata('success_add_rsm')){?>
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('success_add_rsm'); ?>",
                      //text: "<?php echo $this->session->flashdata('success_add_rsm'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'success'
                       });
                       });
                    </script>
                <?php }else if($this->session->flashdata('error_add_rsm')){ ?>
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('error_add_rsm'); ?>",
                      //text: "<?php echo $this->session->flashdata('error_add_rsm'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'error'
                     });
                     });
                    </script>
                <?php }?>
                <div class="">
                    <div class="bg-wh">
                        <h2 class="text-center">RSM Registration Form</h2>
                        <br />
                        <br />
                        <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data" class="registration-form">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM Name *</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" />
                                        <?php echo form_error('name'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM registration Date *</label>
                                        <input type="text" name="registration_date" class="form-control" id="registration_date" value="<?php echo set_value('registration_date'); ?>"/>
                                        <?php echo form_error('registration_date'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM Email *</label>
                                        <input type="text" name="rsm_email" class="form-control" value="<?php echo set_value('rsm_email'); ?>"/>
                                        <?php echo form_error('rsm_email'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM Mobile No. *</label>
                                        <input type="text" name="rsm_mobile" class="form-control" value="<?php echo set_value('rsm_mobile'); ?>"/>
                                        <?php echo form_error('rsm_mobile'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>Enter Zone Name *</label>
                                        <input type="text" name="zone_name" class="form-control" value="<?php echo set_value('zone_name'); ?>"/>
                                        <?php echo form_error('zone_name'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <?php
                                            $state_arr = array();
                                            if(!empty(set_value('state[]'))){
                                            $state_arr = set_value('state[]');
                                            }
                                        ?>
                                        <label>Select State *</label>
                                        <select class="form-control  " name="state[]" multiple="multiple" id="multi-select-demo">
                                            <?php
                                            if(!empty($states))
                                            {
                                                foreach ($states as $state) { 
                                                    ?>
                                                    
                                                    <option value="<?php echo $state['id']; ?>" <?php echo in_array($state['id'], $state_arr) ? 'selected' : '' ?>><?php echo $state['name']; ?></option>
                                                    
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('state'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-md-offset-4">
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
                <!-- All the script start-->
                <script src="<?php echo base_url();?>assets/themes/partner/jquery.js"></script>  
                <script src="<?php echo base_url();?>assets/themes/partner/bootstrap-datepicker.js"></script>
                <script src="<?php echo base_url();?>assets/themes/partner/multi-select-js.js"></script>
                <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/admin/multi-select.css" />
                <link href="<?php echo base_url();?>assets/themes/partner/bootstrap.min.css" rel="stylesheet">  
                <link href="<?php echo base_url();?>assets/themes/partner/bootstrap-datepicker.css" rel="stylesheet">  
                <!-- All the script end-->    
                <!-- For Multi selections Products -->
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#multi-select-demo').multiselect({
                           allSelectedText: 'All',
                           maxHeight: 200,
                           includeSelectAllOption: true
                       }).multiselect('updateButtonText');
                        $('#multi-select-demo2').multiselect();
                        /*For date picker*/
                        $('#registration_date').datepicker({
                            autoclose: true,
                            format: "dd/mm/yyyy",
                            todayHighlight:'TRUE',
                            endDate: '-0d'
                        }); 
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
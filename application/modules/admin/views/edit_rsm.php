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
.registration-form .multiselect-container.dropdown-menu{max-height:200px; overflow-y:scroll; width:100%;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit RSM
            <small> </small>
        </h1>
        <?php echo $breadcrumb; ?>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if($this->session->flashdata('success')){?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php }else if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        <strong>Error!</strong>  <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php }?>
                <div class="container">
                    <div class="bg-wh">
                        <h2 class="text-center">RSM Edit Form</h2>
                        <br />
                        <br />
                        <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data">
                            <?php  
                            foreach ($rsm_detail as $key => $value){
                               ?>
                               <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM Name *</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $value['name'] ?>" />
                                        <?php echo form_error('name'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM registration Date *</label>
                                        <?php 
                        //$date = date("d/m/y", strtotime($value['registration_date']))
                                        ?>
                                        <input type="text" name="registration_date" class="form-control" id="registration_date" value="<?php echo $value['registration_date']; ?>" />
                                        <?php echo form_error('registration_date'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM Email *</label>
                                        <input type="text" name="rsm_email" class="form-control" value="<?php echo $value['email'] ?>"/>
                                        <?php echo form_error('rsm_email'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>RSM Mobile No. *</label>
                                        <input type="text" name="rsm_mobile" class="form-control" value="<?php echo $value['mobile'] ?>"/>
                                        <?php echo form_error('rsm_mobile'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>Enter Zone Name *</label>
                                        <input type="text" name="zone_name" class="form-control" value="<?php echo $value['zone_name'] ?>"/>
                                        <?php echo form_error('zone_name'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label>Select State *</label>
                                        <?php   
                                        $arr = explode(',',$value['states']);
                                        ?>
                                        <select class="form-control  " name="state[]" multiple="multiple" id="multi-select-demo" >
                                            <?php
                                            if(!empty($states))
                                            {
                                                foreach ($states as $state) { 
                                                    ?>
                                                    <option value="<?php echo $state['id']; ?>" <?php for ($i=0; $i<count($arr); $i++) { 
                                                     if ($arr[$i]==$state['id']) {
                                                         echo 'selected';
                                                     }
                                                 } ?>>
                                                 <?php echo $state['name']; ?>
                                             </option>
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
                        <?php 
                    }
                    ?>              
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
    // $('#multi-select-demo2').multiselect({
    //      allSelectedText: 'All',
    //      maxHeight: 200,
    //   includeSelectAllOption: true
    //   }).multiselect('selectAll', false)
    // .multiselect('updateButtonText');
    /*For date picker*/
    $('#registration_date').datepicker({
        autoclose: true, 
                    format: "yyyy/mm/dd" 
                    //format: "dd/mm/yyyy"
                }); 
    show_deal_input(document.getElementById("value_of_deal"));
});
        /*show and hide customer segment other input box*/
        function show_other(that) {
            if (that.value ==4) {            
                document.getElementById("other_input").style.display = "block";
            } else {
                document.getElementById("other_input").style.display = "none";
            }
        }
        /*show and hide input for reason */
        function show_reason_input(that) {
            if (that.value ==6) {            
                document.getElementById("other_reasons").style.display = "block";
            } else {
                document.getElementById("other_reasons").style.display = "none";
            }
        }
        /*Show and hide input boxes for value of deal*/
        function show_deal_input(that) {
            if (that.value ==1) {  
                var elems = document.getElementsByClassName('live');
                for (var i=0;i<elems.length;i+=1){
                    elems[i].style.display = 'block';
                }
            }else {
                var elems = document.getElementsByClassName('live');
                for (var i=0;i<elems.length;i+=1){
                    elems[i].style.display = 'none';
                }
            }
            if (that.value ==2) {  
                document.getElementById("gap").style.display = "block";
            }else {
                document.getElementById("gap").style.display = "none";
            }
            if (that.value ==3) {  
                var elems = document.getElementsByClassName('tender');
                for (var i=0;i<elems.length;i+=1){
                    elems[i].style.display = 'block';
                }
            }else {
             var elems = document.getElementsByClassName('tender');
             for (var i=0;i<elems.length;i+=1){
                elems[i].style.display = 'none';
            }
        }
    }
    /*show all cities according to selected state*/
    function get_state(id){
        var state_id = id.value;
        if(state_id){
            $.post('<?php echo site_url('admin/lead/get_city');?>',
                {'id':state_id },
                function(data){
                    $('#city').html(data);
                });
        }
    }
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
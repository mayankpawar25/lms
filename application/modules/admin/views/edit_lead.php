


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
            Edit Lead
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
                    <h2 class="text-center">Lead Edit Form</h2>
                    <br />
                    <br />

               <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data">

                <?php  //echo"<pre>"; print_r($lead_detail);

                foreach ($lead_detail as $key => $value){
                 ?>

                    <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Lead registration Date*</label>
                        
                        <input type="text" name="registration_date" class="form-control" id="registration_date" value="<?php echo $value['registration_date'] ?>"  />
                        <?php echo form_error('registration_date'); ?>
                        </div>
                    </div>

                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Lead Email *</label>
                        <input type="text" name="lead_email" class="form-control" value="<?php echo $value['lead_email'] ?>"  />
                        <?php echo form_error('lead_email'); ?>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Lead Mobile No. *</label>
                        <input type="text" name="lead_mobile" class="form-control" value="<?php echo $value['lead_mobile'] ?>" />
                        <?php echo form_error('lead_mobile'); ?>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Lead ID</label>
                        <input type="text" name="lead_id" class="form-control" />
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Sales Motion*</label>
                        <select class="form-control" name="sales_motion" id="sales_motion" autocomplete='off' > 
                        <option value=""> Select Sales Motion</option>
                        <?php
                        if(!empty($sales_motions))
                        {
                        foreach ($sales_motions as $sales_motion) { 

                        ?>
                        <option <?php if($value['sales_motion']==$sales_motion['id']){ ?> selected="selected" <?php }?> value="<?php echo $sales_motion['id']; ?>"><?php echo $sales_motion['motion_types']; ?></option>
                        <?php
                            }
                        }
                        ?>
            </select>
            <?php echo form_error('sales_motion'); ?>
                        </div>
                    </div>

                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer Segment*</label>
                        <select class="form-control" name="customer_segment" id="customer_segment" onchange="show_other(this);">
                        <option value=""> Select Customer Segment</option>
                        <?php
                        if(!empty($segments))
                        {
                        foreach ($segments as $segment) { 


                        ?>
                        <option <?php if($value['customer_segment']==$segment['id']){ ?> selected="selected" <?php }?> value="<?php echo $segment['id']; ?>"><?php echo $segment['segment_types']; ?></option>
                        <?php
                            }
                        }
                        ?>
            </select>
            <?php echo form_error('customer_segment'); ?>
                        </div>
                    </div>


                    
                            
                     <div class="col-sm-6 col-md-4" id="other_input" >
                        <div class="form-group">
                        <label>Other*</label>
                        <input type="text" id="other_segment" name="other_segment" class="form-control" value="<?php echo $value['other_segment'] ?>" />
                        <?php echo form_error('other_segment'); ?>
                        </div>
                    </div>

                
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer Name*</label>
                        <input type="text" name="customer_name" class="form-control" value="<?php echo $value['customer_name'] ?>"/>
                        <?php echo form_error('customer_name'); ?>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer State*</label>
                        <select class="form-control" name="state" onchange="get_state(this);" >
                        <option value="">State</option>
                        <?php
                        if(!empty($states))
                        {
                        foreach ($states as $state) { 

                        ?>
                        <option <?php if($value['customer_state']==$state['id']){ ?> selected="selected" <?php }?> value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                        <?php echo form_error('state'); ?>
                        </div>
                    </div>



                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Customer City*</label>
                        <select class="form-control" name="city" id="city" >
                        <option value="">Select City</option>
                        <?php
                        if(!empty($cities_list))
                        {
                        foreach ($cities_list as $city) { 

                        ?>
                         <option <?php if($value['customer_city']==$city['id']){ ?> selected="selected" <?php }?> value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                        <?php echo form_error('city'); ?>
                        </div>
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Pin code*</label>
                        <input type="text" name="pin_code" class="form-control" value="<?php echo $value['pin_code'] ?>"/>
                        <?php echo form_error('pin_code'); ?>
                        </div>
                    </div>
                     
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Microsoft BDM working with him </label>
                        <select class="form-control" name="ms_bdm">
                        <option value=""> Select BDM</option>
                        <?php
                        if(!empty($bdms))
                        {
                        foreach ($bdms as $bdm) { 

                        ?>
                        <option value="<?php echo $bdm['id']; ?>" <?php echo set_value('ms_bdm') == $bdm['id'] ? 'selected' : '' ?>><?php echo $bdm['bdm_name']; ?></option>
                        <?php
                            }
                        }
                        ?>
            </select>
            <?php echo form_error('ms_bdm'); ?>
                        </div>
                    </div>


                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Value of Deal*</label>
                        <select class="form-control" name="value_of_deal" id="value_of_deal" onchange="show_deal_input(this);">
                        <option value="">Value of Deal </option>
                        <?php
                        if(!empty($value_of_deal))
                        {
                        foreach ($value_of_deal as $deal_value) { 

                        ?>
                        <option <?php if($value['value_of_deal']==$deal_value['id']){ ?> selected="selected" <?php }?> value="<?php echo $deal_value['id']; ?>"><?php echo $deal_value['deal_types']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                        <?php echo form_error('value_of_deal'); ?>
                        </div>
                    </div>

                    

                    <div class="col-sm-6 col-md-4 live" >
                        <div class="form-group">
                        <label>Total Deal Value*</label>
                    <input type="text" id="total_deal_value" name="total_deal_value" class="form-control" value="<?php echo $value['total_deal_value'] ?>"/>
                    <?php echo form_error('total_deal_value'); ?>
                        </div>
                    </div>

                

                

                    <div class="col-sm-6 col-md-4 live" >
                        <div class="form-group">
                        <label>SKU's*</label>
                        <input type="text" id="sku" name="sku" class="form-control" value="<?php echo $value['sku'] ?>"/>
                        <?php echo form_error('sku'); ?>
                        </div>
                    </div>
                

                  
                    <div class="col-sm-6 col-md-4 " id="gap" >
                        <div class="form-group">
                        <label>Expected Licenses*</label>
                    <input type="text" id="expected_license" name="expected_license" class="form-control" value="<?php echo $value['expected_license'] ?>"/>
                    <?php echo form_error('expected_license'); ?>
                        </div>
                    </div>
                  


                
                    <div class="col-sm-6 col-md-4 tender">
                        <div class="form-group">
                        <label>Product*</label>
                        <input type="text" id="product" name="product" class="form-control" value="<?php echo $value['product'] ?>"/>
                        <?php echo form_error('product'); ?>
                        </div>
                    </div>
                

                
                    <div class="col-sm-6 col-md-4 tender">
                        <div class="form-group">
                        <label>Deal Size*</label>
                        <input type="text" id="deal_size" name="deal_size" class="form-control" value="<?php echo $value['deal_size'] ?>"/>
                        <?php echo form_error('deal_size'); ?>
                        </div>
                    </div>
                


                
                    <div class="col-sm-6 col-md-4 tender" style="display: none;">
                        <div class="form-group">
                        <label>Tender Type*</label>
                        <input type="text" id="tender_type" name="tender_type" class="form-control"
                         value="<?php echo $value['tender_type'] ?>"/>
                         <?php echo form_error('tender_type'); ?>
                        </div>
                    </div>

                
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label for="teams">MS Product required</label><br/>
                            <?php   
                                $arr = explode(',',$value['product_required']);
                            ?>
                            <select id="multi-select-demo" multiple="multiple" name="product_required[]">
                            <option value="Windows" <?php echo ( !empty($arr) && in_array( 'Windows', $arr) ? ' selected="selected"' : '') ?>>Windows</option>
                            <option value="Ms Word" <?php echo ( !empty($arr) && in_array( 'Ms Word', $arr) ? ' selected="selected"' : '') ?>>Ms Word</option>
                            <option value="Ms Excel" <?php echo ( !empty($arr) && in_array( 'Ms Excel', $arr) ? ' selected="selected"' : '') ?>>Ms Excel</option>
                            <option value="Skype" <?php echo ( !empty($arr) && in_array( 'Skype', $arr) ? ' selected="selected"' : '') ?>>Skype</option>
                            <option value="Outlook" <?php echo ( !empty($arr) && in_array( 'Outlook', $arr) ? ' selected="selected"' : '') ?>>Outlook</option>
                            </select>
                        </div>
                    </div>
               <div class="col-sm-6 col-md-4">
                         <div class="form-group">
    <label for="product">MS Involvement if any</label><br/>
            <select class="form-control" name="ms_involvement" id="ms_involvement" >
                        <option value=""> Select MS Involvement</option>
                        <?php
                        if(!empty($invlovements))
                        {
                        foreach ($invlovements as $invlovement) { 

                        ?>
                        <option <?php if($value['involvement']==$invlovement['id']){ ?> selected="selected" <?php }?> value="<?php echo $invlovement['id']; ?>"><?php echo $invlovement['involvement_types']; ?></option>
                        <?php
                            }
                        }
                        ?>
            </select>
            <?php echo form_error('ms_involvement'); ?>
</div>
                    </div> 
       <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Expected date of closing *</label>
                        <select class="form-control" name="expected_closing_date" id="expected_closing_date" >
                        <option value=""> Select Expected closing date</option>
                        <?php
                        if(!empty($closing_dates))
                        {
                        foreach ($closing_dates as $closing_date) { 

                        ?>
                        <option <?php if($value['expected_closing_date']==$closing_date['id']){ ?> selected="selected" <?php }?> value="<?php echo $closing_date['id']; ?>"><?php echo $closing_date['days_types']; ?></option>
                        <?php
                            }
                        }
                        ?>
            </select>
            <?php echo form_error('expected_closing_date'); ?>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label>Current status of the lead *</label>
                        <select class="form-control" name="lead_current_status" id="lead_current_status" 
                        onchange="show_reason_input(this);">
                        <option value=""> Select Current status of the lead</option>
                        <?php
                        if(!empty($current_status))
                        {
                        foreach ($current_status as $status) { 

                        ?>
                        <option <?php if($value['current_status_lead']==$status['id']){ ?> selected="selected" <?php }?> value="<?php echo $status['id']; ?>"><?php echo $status['status_types']; ?></option>
                        <?php
                            }
                        }
                        ?>
            </select>
            <?php echo form_error('lead_current_status'); ?>
                        </div>
                    </div>


                <?php if($value['order_lost']!=''){ ?>
                    <div class="col-sm-6 col-md-4" id="other_reasons" style="display: none;">
                        <div class="form-group">
                        <label for="other_segment">Reasons</label>
                        <input type="text" id="order_lost" name="order_lost" class="form-control" value="<?php echo $value['order_lost'] ?>"/>
                        <?php echo form_error('order_lost'); ?>
                        </div>
                    </div>
</div>
                <?php } ?> -->
<div class="row">
    <br>
                    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
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
      }).multiselect('selectAll', false)
    .multiselect('updateButtonText');
    $('#multi-select-demo2').multiselect({
         allSelectedText: 'All',
         maxHeight: 200,
      includeSelectAllOption: true
      }).multiselect('selectAll', false)
    .multiselect('updateButtonText');
        /*For date picker*/
     $('#registration_date').datepicker({
                    autoclose: true,  
                    //format: "dd/mm/yyyy"
                    format: "yyyy/mm/dd"
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
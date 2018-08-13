<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Partner
            <small></small>
        </h1>
        <?php //echo $breadcrumb; ?>
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
     if($this->session->flashdata('success_partner')){?>
       
        <script type="text/javascript">
    $(document).ready(function() {
     swal({
      title: "<?php echo $this->session->flashdata('success_partner'); ?>",
      //text: "<?php echo $this->session->flashdata('success_partner'); ?>",
      //timer: 1500,
      showConfirmButton: true,
      type: 'success'
       });
       });
         </script>



    <?php }else if($this->session->flashdata('error_partner')){ ?>
        
        <script type="text/javascript">
    $(document).ready(function() {
     swal({
      title: "<?php echo $this->session->flashdata('error_partner'); ?>",
      //text: "<?php echo $this->session->flashdata('error_partner'); ?>",
      //timer: 1500,
      showConfirmButton: true,
      type: 'error'
     });
     });
        </script>


   <?php }?>

              <form action="<?php echo current_url();?>" method="post" id="register-form">
      <div class="row">

        <div class="col-sm-6 ">
        <div class="form-group has-feedback">
         <label>Firm name</label>
            <input type="text" name="firm_name" class="form-control" placeholder="Firm name" value="<?php echo $partner_detail[0]['firm_name'];?>" required>
           
            <span class=" glyphicon glyphicon-home form-control-feedback"></span>
             <?php echo form_error('firm_name'); ?>
        </div>
</div>
<div class="col-sm-6 ">
         <div class="form-group has-feedback">
          <label>Owner Name</label>
            <input type="text" name="owner_name" class="form-control" placeholder="Owner name" value="<?php echo $partner_detail[0]['owner_name'];?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
             <?php echo form_error('owner_name'); ?>
         </div>
</div>
<div class="col-sm-6 ">
         <div class="form-group has-feedback">
          <label>Contact No.</label>
            <input type="text" name="contact_no" class="form-control" placeholder="Contact No" value="<?php echo $partner_detail[0]['contact_no'];?>" required>
            <span class=" glyphicon glyphicon-earphone form-control-feedback"></span>
             <?php echo form_error('contact_name'); ?>
         </div>
</div>
<div class="col-sm-6 ">
          <div class="form-group has-feedback">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" id="email" value="<?php echo $partner_detail[0]['email'];?>" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span id="ver-email"></span>
             <?php echo form_error('email'); ?>
          </div>
</div>
<div class="col-sm-6 ">
          <div class="form-group has-feedback">
            <label>Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address" id="address" required>
            <span class=" glyphicon glyphicon-home form-control-feedback"></span>
            <!-- <span id="ver-email"></span> -->
             <?php echo form_error('address'); ?>
          </div>
</div>


<div class="col-sm-6 ">
  <div class="form-group has-feedback">
  <label>Partner State *</label>
  <select class="form-control" name="state" onchange="get_state(this);">
  <option value="">State</option>
  <?php 
  if(!empty($states))
  {
  foreach ($states as $state) { 

  ?>
  <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
  <?php
      }
  }
  ?>
  </select>
  <?php echo form_error('state'); ?>
  </div>
</div>

<div class="col-sm-6 has-feedback">
  <div class="form-group">
  <label>Partner City </label>
  <select class="form-control" name="city" id="citys" >
  <option value="">Select City</option>
  <?php
  if(!empty($cities))
  {
  foreach ($cities as $city) { 

  ?>
  <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
  <?php
      }
  }
  ?>
  </select>
  <?php echo form_error('city'); ?>
  </div>
</div>

<div class="col-sm-6 ">
           <div class="form-group has-feedback">
            <label>Firm Incorporation Date</label>
            <input type="text" name="firm_incorporation_date" id="firm_incorporation_date" class="form-control" placeholder="Firm Incorporation Date" value="<?php echo $partner_detail[0]['firm_incorporation_date'];?>" required>
            <span class=" glyphicon glyphicon-calendar form-control-feedback"></span>
             <?php echo form_error('firm_incorporation_date'); ?>
          </div>
</div>

<div class="col-sm-6">
                        <div class="form-group has-feedback multiselect-dropdown">
                        <label for="teams">Product Dealing</label><br/>

                        
                        <?php
                           $arr = explode(',',$partner_detail[0]['product_dealing_in']);
                        ?>

                            <select id="multi-select-demo" multiple="multiple1" name="product_dealing[]">
                            <option value="Windows" <?php echo ( !empty($arr) && in_array( 'Windows', $arr) ? ' selected="selected"' : '') ?>>Windows</option>
                            <option value="Ms Word" <?php echo ( !empty($arr) && in_array( 'Ms Word', $arr) ? ' selected="selected"' : '') ?>>Ms Word</option>
                            <option value="Ms Excel" <?php echo ( !empty($arr) && in_array( 'Ms Excel', $arr) ? ' selected="selected"' : '') ?>>Ms Excel</option>
                            <option value="Skype" <?php echo ( !empty($arr) && in_array( 'Skype', $arr) ? ' selected="selected"' : '') ?>>Skype</option>
                            <option value="Outlook" <?php echo ( !empty($arr) && in_array( 'Outlook', $arr) ? ' selected="selected"' : '') ?>>Outlook</option>
                            </select>
                            </select>
                        </div>
                    </div>



</div>
<div class="row">

<div class="col-sm-6 ">
          <div class="form-group has-feedback">
            <label>Turn Over</label>
            <input type="text" name="turn_over" class="form-control" placeholder="Turn Over" value="<?php echo $partner_detail[0]['turn_over'];?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
             <?php echo form_error('turn_over'); ?>
          </div>
</div>
<div class="col-sm-6 ">
           <div class="form-group has-feedback">
            <label>Percentage Overall Business</label>
            <input type="text" name="percentage_overall_business" class="form-control" placeholder="Current MS % to the Over all Business" value="<?php echo $partner_detail[0]['current_ms_perc_overall_business'];?>" required>
            <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
             <?php echo form_error('percentage_overall_business'); ?>
          </div>
</div>
<div class="col-sm-6">
           <div class="form-group has-feedback">
            <label>Percentage Terms Value</label>
            <input type="text" name="percentage_terms_value" class="form-control" placeholder="MS Product % Share in terms of Value" value="<?php echo $partner_detail[0]['product_percentage_share_terms_value'];?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
             <?php echo form_error('percentage_terms_value'); ?>
          </div>
</div>
<div class="col-sm-6 ">
           <div class="form-group has-feedback multiselect-dropdown2">
            <label>Product Promoted Past</label>

                      <?php
                           $arr = explode(',',$partner_detail[0]['product_promoted_past']);
                        ?>

            <select id="multi-select-demo2" multiple="multiple" name="product_promoted_past[]">
                            <option value="Windows" <?php echo ( !empty($arr) && in_array( 'Windows', $arr) ? ' selected="selected"' : '') ?>>Windows</option>
                            <option value="Ms Word" <?php echo ( !empty($arr) && in_array( 'Ms Word', $arr) ? ' selected="selected"' : '') ?>>Ms Word</option>
                            <option value="Ms Excel" <?php echo ( !empty($arr) && in_array( 'Ms Excel', $arr) ? ' selected="selected"' : '') ?>>Ms Excel</option>
                            <option value="Skype" <?php echo ( !empty($arr) && in_array( 'Skype', $arr) ? ' selected="selected"' : '') ?>>Skype</option>
                            <option value="Outlook" <?php echo ( !empty($arr) && in_array( 'Outlook', $arr) ? ' selected="selected"' : '') ?>>Outlook</option>
                            </select>
             <?php echo form_error('product_promoted_past'); ?>
          </div>
        </div>
</div>
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
           <div class="form-group has-feedback">
            <label style="visibility: hidden;">Submit</label>
            <button type="submit" id="sign-btn" class="btn btn-primary btn-block btn-flat">Submit</button>
          </div>
        </div>



</div>
       <!--  <?php if (isset($referrer)){?>
            <input type="hidden" name="referrer" value="<?php echo $referrer;?>">
        <?php }?> -->
       
    </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>


<style type="text/css">
.error {
    color:red !important;
} 
.multiselect-dropdown .btn-group{width: 100%; display: block;}
.multiselect-dropdown .btn-group>.btn{text-align: left;     width: 100%;}


.multiselect-dropdown2 .btn-group{width: 100%; display: block;}
.multiselect-dropdown2 .btn-group>.btn{text-align: left;     width: 100%;}

.login-box{width:767px;}
@media only screen and (max-width:767px)
{
  .login-box{width:300px;}
}
</style>

<!-- All the script start-->

    <script src="<?php echo base_url();?>assets/themes/partner/jquery.js"></script>  
    <script src="<?php echo base_url();?>assets/themes/partner/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/themes/partner/multi-select-js.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/admin/multi-select.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/partner/bootstrap.min.css" >  
    <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/partner/bootstrap-datepicker.css" >   

<!-- All the script end-->

<script type="text/javascript">
  $(document).ready(function() {
      $('#multi-select-demo').multiselect();
      $('#multi-select-demo2').multiselect();
        /*For date picker*/
       $('#firm_incorporation_date').datepicker({
                    autoclose: true, 
                    format: "yyyy-mm-dd" 
                    //format: "dd/mm/yyyy"
                    
                }); 

});

$("#register-formd" ).validate({
         rules: {
            email:
          {
            required: true,
            
            //remote:'/lms/partner/auth/get_email'
          },
         
          contact_name:
          {
            required: true,
            digits: true,
            minlength:10,
            maxlength:10
          },

          turn_over:
          {
            required: true,
            digits: true,
            
          },
          percentage_overall_business:
          {
            required: true,
            digits: true,
            
          },
          percentage_terms_value:
          {
            required: true,
            digits: true,
            
          }
           
        }
         /*messages:
          {
             email:'Email address exists.'
          }*/
    });


function get_state(id){
  //alert(id.value);
var state_id = id.value;
 if(state_id){
            $.post('<?php echo site_url('admin/partner/get_city');?>',
            {'id':state_id },
            function(data){
                $('#citys').html(data);
            });
        }
}
</script>

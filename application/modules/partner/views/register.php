

 <div class="login-box-heading"><h2><span class="glyphicon glyphicon-user " ></span> <span class="seprate-line">|</span> Registration</h2></div> 
<div class="login-box-body">
    <p class="login-box-msg"><!-- Sign up to start your session --></p>
    
     <?php
     if($this->session->flashdata('success')){?>
        <!-- <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div> -->
         <script type="text/javascript">
          $(document).ready(function() {
            swal({
              title: "<?php echo $this->session->flashdata('success'); ?>",
              //text: "<?php echo $this->session->flashdata('success'); ?>",
              //timer: 1500,
              showConfirmButton: true,
              type: 'success'
            });
          });
     </script>
    <?php }else if($this->session->flashdata('error')){ ?>
        <!-- <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
             <strong>Error!</strong>  <?php echo $this->session->flashdata('error'); ?>
        </div> -->
         <script type="text/javascript">
          $(document).ready(function() {
            swal({
              title: "<?php echo $this->session->flashdata('error'); ?>",
              //text: "<?php echo $this->session->flashdata('error'); ?>",
              //timer: 1500,
              showConfirmButton: true,
              type: 'error'
            });
          });
     </script>
   <?php }?>
    <form action="<?php echo site_url('partner/auth/do_register');?>" method="post" id="register-form">
      <div class="row">

        <div class="col-sm-6 ">
        <div class="form-group has-feedback">
         <label>Firm name *</label>
            <input type="text" name="firm_name" class="form-control" placeholder="Firm name"  value="<?php echo set_value('firm_name') ?>" required>
           
            <span class=" glyphicon glyphicon-home form-control-feedback"></span>
             <?php echo form_error('firm_name'); ?>
        </div>
</div>
<div class="col-sm-6 ">
         <div class="form-group has-feedback">
          <label>Owner Name *</label>
            <input type="text" name="owner_name" class="form-control" placeholder="Owner name" value="<?php echo set_value('owner_name') ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
             <?php echo form_error('owner_name'); ?>
         </div>
</div>
<div class="col-sm-6 ">
         <div class="form-group has-feedback">
          <label>Contact No. *</label>
            <input type="text" name="contact_name" class="form-control" placeholder="Contact No" value="<?php echo set_value('contact_name') ?>" required>
            <span class=" glyphicon glyphicon-earphone form-control-feedback"></span>
             <?php echo form_error('contact_name'); ?>
         </div>
</div>
<div class="col-sm-6 ">
          <div class="form-group has-feedback">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" placeholder="Email" id="email" value="<?php echo set_value('email') ?>" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span id="ver-email"></span>
             <?php echo form_error('email'); ?>
          </div>
</div>
<div class="col-sm-6 ">
          <div class="form-group has-feedback">
            <label>Address *</label>
            <input type="text" name="address" class="form-control" placeholder="Address" id="address" value="<?php echo set_value('address') ?>" required>
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
        <option value="<?php echo $state['id']; ?>" <?php echo set_value('state') == $state['id'] ? 'selected' : '' ?>><?php echo $state['name']; ?></option>
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
  <label>Partner City *</label>
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
            <label>Date of Incorporation of the firm *</label>
            <input type="text" name="firm_incorporation_date" id="firm_incorporation_date" class="form-control" placeholder="Firm Incorporation Date" value="<?php echo set_value('firm_incorporation_date') ?>" required>
            <span class=" glyphicon glyphicon-calendar form-control-feedback"></span>
             <?php echo form_error('firm_incorporation_date'); ?>
          </div>
</div>

<div class="col-sm-6">
                        <?php
                         $product_dealing_arr = array();
                            if(!empty(set_value('product_dealing[]'))){
                                $product_dealing_arr = set_value('product_dealing[]');
                            }
                        ?>
                        <div class="form-group has-feedback multiselect-dropdown">
                        <label for="teams">Product Dealing In *</label><br/>
                            <select id="multi-select-demo" multiple="multiple1" name="product_dealing[]" required>
                            <option value="Windows" <?php echo in_array("Windows", $product_dealing_arr) ? 'selected' : '' ?>>Windows</option>
                            <option value="Ms Word" <?php echo in_array("Ms Word", $product_dealing_arr) ? 'selected' : '' ?>>Ms Word</option>
                            <option value="Ms Excel" <?php echo in_array("Ms Excel", $product_dealing_arr) ? 'selected' : '' ?>>Ms Excel</option>
                            <option value="Skype" <?php echo in_array("Skype", $product_dealing_arr) ? 'selected' : '' ?>>Skype</option>
                            <option value="Outlook" <?php echo in_array("Outlook", $product_dealing_arr) ? 'selected' : '' ?>>Outlook</option>
                            </select>
                            </select>
                        </div>
                    </div>

<div class="col-sm-6 ">
          <div class="form-group has-feedback">
            <label>Turn Over *</label>
            <input type="text" name="turn_over" class="form-control" placeholder="Turn Over in INR" value="<?php echo set_value('turn_over') ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
             <?php echo form_error('turn_over'); ?>
          </div>
</div>

</div>
<div class="row">


<div class="col-sm-6 ">
           <div class="form-group has-feedback">
            <label>Current MS % to the overall Business </label>
            <input type="text" name="percentage_overall_business" class="form-control" placeholder="Current MS % to the overall Business" value="<?php echo set_value('percentage_overall_business') ?>">
            <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
             <?php echo form_error('percentage_overall_business'); ?>
          </div>
</div>
<div class="col-sm-6">
           <div class="form-group has-feedback">
            <label>MS Products % Share in terms of Value *</label>
            <input type="text" name="percentage_terms_value" class="form-control" placeholder="MS Products % Share in terms of Value" value="<?php echo set_value('percentage_terms_value') ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
             <?php echo form_error('percentage_terms_value'); ?>
          </div>
</div>
<div class="col-sm-6 ">
                 <?php
                         $product_promoted_arr = array();
                            if(!empty(set_value('product_promoted_past[]'))){
                                $product_promoted_arr = set_value('product_promoted_past[]');
                            }
                        ?>
           <div class="form-group has-feedback multiselect-dropdown2">
            <label>MS Products Promoted In The Past</label>
            <select id="multi-select-demo2" multiple="multiple" name="product_promoted_past[]">
                             <option value="Windows" <?php echo in_array("Windows", $product_promoted_arr) ? 'selected' : '' ?>>Windows</option>
                            <option value="Ms Word" <?php echo in_array("Ms Word", $product_promoted_arr) ? 'selected' : '' ?>>Ms Word</option>
                            <option value="Ms Excel" <?php echo in_array("Ms Excel", $product_promoted_arr) ? 'selected' : '' ?>>Ms Excel</option>
                            <option value="Skype" <?php echo in_array("Skype", $product_promoted_arr) ? 'selected' : '' ?>>Skype</option>
                            <option value="Outlook" <?php echo in_array("Outlook", $product_promoted_arr) ? 'selected' : '' ?>>Outlook</option>
                            </select>
             <?php echo form_error('product_promoted_past'); ?>
          </div>
        </div>
</div>
<div class="row">
<div class="col-sm-12 text-center">
           <div class="form-group has-feedback">
           
            <button type="submit" id="sign-btn" class="btn thm-btn btn-flat">Sign Up</button>
          </div>
        </div>

<div class="col-sm-12 text-center">
  <a href="<?php echo base_url();?>partner/auth" >Back to Login</a>
</div>

</div>
       <!--  <?php if (isset($referrer)){?>
            <input type="hidden" name="referrer" value="<?php echo $referrer;?>">
        <?php }?> -->
       
    </form>

    <!-- <a href="<?php echo base_url();?>partner/auth/forget_password">I forgot my password</a><br>
    <a href="<?php echo base_url();?>users/auth/register" class="text-center">Register a new membership</a> -->

</div>
<style type="text/css">

.multiselect-dropdown .btn-group{width: 100%; display: block;}
.multiselect-dropdown .btn-group>.btn{text-align: left;     width: 100%;}


.multiselect-dropdown2 .btn-group{width: 100%; display: block;}
.multiselect-dropdown2 .btn-group>.btn{text-align: left;     width: 100%;}
.login-box-body .open>.multiselect-container.dropdown-menu {
    margin-top: 0;
}

.login-box{width:767px;}
@media only screen and (max-width:767px)
{
  .login-box{width:300px;}
 
	.login_links .col-xs-6.text-left, .login_links .col-xs-6.text-right{text-align:center; margin-bottom:10px; width:100%;}
	.form-group label{font-size:13px;}
	.login-box-body .form-group{clear:both;}
	.login-box-body .multiselect-native-select{display:block; float:left; width:100%; margin-bottom:15px;}

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

<?php
    if(!empty(set_value('state'))){
?>
        var state_id = "<?php echo set_value('state'); ?>";
        if(state_id){
            $.post('<?php echo site_url('partner/auth/get_city');?>',
            {'id':state_id },
            function(data){
              $('#citys').html(data);

              var city_id = "<?php echo set_value('city') ?>";
              $('#citys [value="'+city_id+'"]').attr("selected","true");
            });
        }
<?php
    }
?>

/*show all cities according to selected state*/
function get_state(id){
  //alert(id.value);
    var state_id = id.value;
    if(state_id){
        $.post('<?php echo site_url('partner/auth/get_city');?>',
        {'id':state_id },
        function(data){
          $('#citys').html(data);
        });
    }
}
/**/
  
  $(document).ready(function() {
      $('#multi-select-demo').multiselect({
         allSelectedText: 'All',
         maxHeight: 200,
      includeSelectAllOption: true
      })
    .multiselect('updateButtonText');
      $('#multi-select-demo2').multiselect({
         allSelectedText: 'All',
         maxHeight: 200,
      includeSelectAllOption: true
      })
    .multiselect('updateButtonText');
        /*For date picker*/
       $('#firm_incorporation_date').datepicker({
            autoclose: true,  
           //format: "dd/mm/yyyy"
            todayHighlight:'TRUE',
            endDate: '-0d'
                    
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
    //$(document).ready(function () {
       // $('#sign-btn').click(function () {
            //$('#login-form').submit();
       // });
    //});

//$('#ver-email').remove();
// $("#email").on('change', function () {
//     var emailVal = $('#email').val(); // assuming this is a input text field
//     console.log(emailVal);
//     //alert(emailVal);
//     /*alert(emailVal);*/
//     $.get('/lms/partner/auth/get_email', data: {'email' : emailVal}, function(data) {
//        if (data=='allowed') {
//             $('#ver-email').html('Email address Already exists');
//             $('#ver-email').css('color', 'red');
//        }else if (data=='string'){
//             $('#spnPhoneStatus').html('Valid Email address');
//             $('#spnPhoneStatus').css('color', 'green');
//        }

//     });
// });

// $('#email').change(function(){
//     var selectedValue = $('#email').val();
//     alert(selectedValue);
//         $.ajax({
//             type: 'GET',
//             url:'/lms/partner/auth/get_email',
//             data:'id='+selectedValue,
//             success: function(response) {
//                 if (response) {
//                         $('#checkusername').html(response);
//                         $('#userName').css('border-color','red');
//                 }else{
//                         $('#checkusername').html("");
//                         $('#userName').css('border');
//                 }
//             },
//             error: function(e) {
//             }
//         });
//     });   

</script>
<style type="text/css">

@media only screen and (min-width:769px)
{
  .datepicker-dropdown{top:240px!important;}
}

</style>

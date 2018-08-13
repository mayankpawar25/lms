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
            Edit Profile 
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
            
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if($this->session->flashdata('success_profile')){?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success_profile'); ?>
                    </div>
                <?php }else if($this->session->flashdata('error_profile')){ ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        <strong>Error!</strong>  <?php echo $this->session->flashdata('error_profile'); ?>
                    </div>
                <?php }?>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Image Upload</a></li>
                    <li><a data-toggle="tab" href="#menu1"> Password</a></li>
                    <li><a data-toggle="tab" href="#menu2"> Profile</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                     
                      <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data">
                      
                        <div class="row">
      	<div class="col-sm-6">
     
         <h3>Upload Image</h3>
        <br />
        
        	<ul class="list-inline">
            	<li>
                 <input type="file" name="profile_pic"  class="form-control hidden" id="avatar" required/>
                
                     <button type="button" class="btn btn-warning btn-lg waves-effect" style="border-radius:0; width:200px;" id="browse-img" ><i class="fa fa-image"></i> &nbsp; Browse Image</button>
                </li>
                <li>
                 
                 <input type="submit" id="submit-form" class="btn btn-primary btn-lg waves-effect  " name="up_image" value="Upload" style="border-radius:0; width:200px;"   />
                 </li>
                 
            </ul>
        </div>
        <div class="col-sm-6">
     
        	<div id="image-holder"> </div>
                         <?php echo form_error('file_add'); ?>
                     </div>
        </div>
         </form>   
            </div>
            <div id="menu1" class="tab-pane fade">
     
              <h3>Change your Password</h3>
              <br />
              <form method="post" action="<?php echo base_url();?>rsm/profile/changepassword" id="passwordform" enctype="multipart/form-data">
                <div class="change_password well">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group ">
                            
                    <label class="form-label">Current Password</label>
                                      
                                     <input type="password" name="currentpassword" id="currentpassword" class="form-control"/>
                                    <span class="text-danger" id="currentpass"></span>
                                        </div>
                                    
                    
                            <div class="form-group ">
                                <label>New Password</label>
                                <input type="password" name="newpassword" id="newpassword" class="form-control"/>
                                <span class="text-danger" id="newpass"><span>
                            </div>
                            <div class="form-group ">
                                <label>Confirm Password</label>
                                <input type="password" name="conformpassword" id="conformpassword" class="form-control"/>
                                <span class="text-danger" id="cnfrmpass"><span>
                            </div>
                            <div class="form-group">
                               
                                <input type="button" class="btn btn-block btn-lg btn-primary waves-effect " id="submit" name="change_password" value="Save" style="border-radius:0;"/>
                            </div>
                        </div>
                       <!--  <div class="col-sm-6 col-md-4">
                            
                        </div> -->
                      </div>
                    </div>
                </form>
            </div>

            <div id="menu2" class="tab-pane fade">
           
              <h3>Edit</h3>
              <br />
              <!-- <small style="color: red"><b>Note: You can edit only name.</b></small> -->
              <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data">
                <?php 
                if(!empty($profiles_detail)){

                 ?>
                <?php
                    foreach ($profiles_detail as $detail){
                ?>

    <div class="table-responsive">
      <table class="table table-striped">

        <tr>
          <th>Name:</th>
          <th>

          <input type="text" name="name" value="<?php echo $detail['full_name']; ?>" class="form-control" required>
    
          </th>
        </tr>

        <tr>
          <th>Username:</th>
          <th>
         
          <input type="text" name="username" value="<?php echo $detail['username']; ?>" class="form-control" disabled>
     
          </th>
        </tr>

        <tr>
          <th>Email:</th>
          <th>
       
          <input type="text" name="email" value="<?php echo $detail['email']; ?>" class="form-control" disabled>
   
          </th>
        </tr>

        <tr>
          <th>Mobile No.:</th>
          <th>
          <input type="text" name="contact" value="<?php echo $detail['phone']; ?>" class="form-control" disabled>
     
          </th>
        </tr>


        <tr>
          <th>Zone Name:</th>
          <th><input type="text" name="contact" value="<?php echo $detail['zone_name']; ?>" class="form-control" disabled></th>
        </tr>
        <tr>
          <th>Image</th>
          <th>
            <?php if($detail['image']!=''){ ?>

              <img src="<?php echo base_url().$detail['image'];?>" class="img-circle" alt="User Image" width="40" height="40" style="border:1px solid #000;">

            <?php }else{ ?>

               <img src="<?php echo base_url();?>uploads/admins/images/default1.png" class="img-circle" alt="User Image" width="40" height="40" style="border:1px solid #000;">
            <?php } ?>
          </th>
        </tr>
        <tr>
        	<th></th>
            <th> <div class="form-group">
        
            <input type="submit" class="btn btn-primary btn-lg waves-effect " name="profile" value="Save" style="border-radius:0; min-width:200px;"/>
        </div></th>
        </tr>
      </table>
    </div>
<?php } ?>
<?php } ?>
   <div class="clearfix"></div>
       
  
  </form>
</div> 



        </div>
    </div>
</div>
<div class="clearfix"></div>
<style type="text/css">
   /* .change_password {
  display: none;
  }*/
  .thumb-image{
    width: 100px;
    height: auto;
}
#image-holder{ 
    width: 150px;
    margin-top: 12px;
}
#image-holder img{width:100%;}
.inventry-form .form-group .form-control, .inventry-form .btn{min-height:40px; border-radius:0;}

    </style>
    <!-- All the script start-->
    <script src="<?php echo base_url();?>assets/themes/partner/jquery.js"></script>  
    <script src="<?php echo base_url();?>assets/themes/partner/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/themes/partner/multi-select-js.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/themes/admin/multi-select.css" />
    <link href="<?php //echo base_url();?>assets/themes/partner/bootstrap.min.css" rel="stylesheet">  
    <link href="<?php echo base_url();?>assets/themes/partner/bootstrap-datepicker.css" rel="stylesheet">  
    <!-- All the script end-->    
    <!-- For Multi selections Products -->
    <script type="text/javascript">
        $("#avatar").on('change', function () {
            if (typeof (FileReader) != "undefined") {
                var image_holder = $("#image-holder");
                image_holder.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image"
                    }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        });
/*$("#change_password_button").click(function(){
        $(".change_password").toggle();
    });*/
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
        $.post('<?php echo site_url('partner/lead/get_city');?>',
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
    /*$(function() {*/
$('#submit-form').on('submit', function(e) {
      // alert('hello');
      //e.preventDefault();
      setTimeout(function() {
        window.location.reload();
        alert('test');
      },0);
});
        /*});*/
$(document).on('change','#conformpassword',function(){
  var NewPassword = $('#newpassword').val();
  var confirmPassword = $(this).val();

  if(confirmPassword == NewPassword){
      $('#cnfrmpass').html('');
  }else{
      $('#cnfrmpass').html('Password not Match');
  }
});

$(document).on('change','#currentpassword',function(){
  var pass = $(this).val();
  if(pass.length >0){
    $('#currentpass').html('');
  }
});
$(document).on('change','#newpassword',function(){
  var pass = $(this).val();
  if(pass.length >0){
    $('#newpass').html('');
  }
});

$(document).on('click','#submit', function(){

              var targeturl = $('#passwordform').attr('action');
              var Password = $('#currentpassword').val();
              var newPassword = $('#newpassword').val();
              var confirmPassword = $('#conformpassword').val();

            if(Password == ""){ 

                $('#currentpass').html('Current password field required!');

             }else if(newPassword == ""){
                $('#newpass').html('New password field required!');
              }else if(confirmPassword == ""){
                $('#cnfrmpass').html('Confirm password field required!');
              }else if(confirmPassword != newPassword){
                  $('#cnfrmpass').html('Password not match');
              }else{

                  $.ajax({
                        type: 'POST',
                        url: targeturl,
                        data:'password='+Password+'&newPassword='+newPassword,
                        beforeSend: function(xhr) {
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        },
                        success: function(response) {
                               if(response == 'wrongpassword'){
                                  alert('Please Check Your Current Password !');
                                   console.clear();
                               }else if(response == 'passwordchanged'){
                                  alert('Password Changed Successfully !');
                                  $('.box').load('/lms/rsm/profile/edit_profile .box');
                                  console.clear();
                               }else{
                                  alert('Password Not Changed !');
                                   console.clear();
                               }
                        },
                        error: function(e) {
                        }
                });
              }
});

  

</script>

<script>
	$("#browse-img").click(function(){
			$("#avatar").click();
		});
</script>
<style>
	.table-bordered>tbody>tr>th{vertical-align:middle!important;}
	.nav-tabs>li>a{color:#000; font-size:15px;}
	.form-control{border-radius:0;}
	#image-holder img{border:2px solid #ccc;
	}
	#browse-img, #submit-form{margin-bottom:15px;}
	@media only screen and (max-width:575px)
	{
	.nav-tabs>li>a{padding:7px!important; font-size:13px;}
	}
</style>
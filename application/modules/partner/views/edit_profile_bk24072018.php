


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
            Edit Profile Picture
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
<div class="container">
            <div class="bg-wh">
                    <!-- <h2 class="text-center">Lead Edit Form</h2> -->
                    <br />
                    <br />

            <!-- <button type="button" id="formButton">Toggle Form!</button> -->

    <button type="button" class="btn btn-primary btn-block" id="change_password_button" style="border-radius:0;width:13%">Change Password</button>
<form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data">

                <div class="change_password">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group ">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control"/>
                        <?php echo form_error('password'); ?>
                        </div>
                    </div>


            <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label style="visibility:hidden;">SAVE</label>
                        <input type="submit" class="btn btn-primary btn-block " name="change_password" value="Save" style="border-radius:0;width:42%"/>
                        </div>
                        </div>

</div>

 </form> 



               <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data">

                    <div class="row">

                        

                    <div class="form-group">
                        <label>Upload Image</label><br>
                            
                <input type="file" name="profile_pic"  class="form-control" id="avatar" style="width:30%" />
                          <div id="image-holder"> </div>
                          <?php echo form_error('file_add'); ?>
                            </div>
                   
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label style="visibility:hidden;">Submit</label>
                        <input type="submit" class="btn btn-primary btn-block " name="up_image" value="Upload" style="border-radius:0;width:42%"/>
                        </div>
                        </div>


                    </form>     


                    </div>
</div>
</div>
<div class="clearfix"></div>


<style type="text/css">

    .change_password {
  display: none;
}

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
.error {
color:red !important;
}.error {
color:red !important;
}`
</style>

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


$("#change_password_button").click(function(){
        $(".change_password").toggle();
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
    $('#example1').DataTable();
</script>
<style type="text/css">
.thumb-image{
        width: 100px;
        height: auto;
    }
    #image-holder{ 
       max-width: 250px;
    margin-top: 12px;
    margin: auto;
}
#image-holder img{width:100%;}
.inventry-form .form-group .form-control, .inventry-form .btn{min-height:40px; border-radius:0;}
.holder-img{min-height:275px;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Banner
            <small></small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">

             <?php
     if($this->session->flashdata('success')){?> 
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
            <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data" onsubmit="return validateForm()">

                   


                   <div class="well">
                    <div class="row">
                    <div class="col-sm-6 ">
                        <div class="form-group ">
                        <label>Enter Content</label>
                        <textarea rows = "1" cols = "50" name="banner_content" class="form-control"></textarea>
                        <!-- <input type="textarea" name="banner_content" class="form-control"/> -->
                        <?php echo form_error('banner_content'); ?>
                        </div>
                        
                    
                        <div class="form-group ">
                        <label>Button Text</label>
                        <!-- <textarea rows = "5" cols = "50" name="banner_content" class="form-control"></textarea> -->
                        <input type="text" name="button_text" class="form-control"/>
                        <?php echo form_error('link'); ?>
                        </div>
                    
                        <div class="form-group ">
                        <label>Button Link</label>
                        <!-- <textarea rows = "5" cols = "50" name="banner_content" class="form-control"></textarea> -->
                        <input type="text" name="link" class="form-control"/>
                        <?php echo form_error('link'); ?>
                        </div>
                 <br />
                   <div class="row">
                   
                   <div class=" col-md-6">
                   	<div class="form-group">
                <input type="file" name="profile_pic"  class="form-control hidden" id="avatar"  />
                <button type="button" class="btn btn-warning btn-block" id="up_file" style="border-radius:0;">Browse Image</button>
                         
                           
                   </div></div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                        
                        <input type="submit" class="btn btn-primary btn-block " name="up_image" value="Submit" style="border-radius:0;"/>
                        </div>
                        </div>

                  </div>
                  
                  </div>
                   <div class="col-sm-6 ">
                    <div class="well holder-img" >
                     <div id="image-holder"> </div>
                          <?php echo form_error('file_add'); ?>
                            </div>
                    
                    </div>
                    </div>
                  
                    
  </form> 
                           
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>



<script>
    
	$(document).ready(function(e) {
        $("#up_file").click(function(){
			$("#avatar").click();
			});
    });
	$('#example1').DataTable();
</script>

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




</script>


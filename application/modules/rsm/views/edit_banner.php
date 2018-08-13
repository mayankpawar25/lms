
<style type="text/css">

    

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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Banner
            <small></small>
        </h1>
         <?php echo $breadcrumb; ?>
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

            <form method="post" action="<?php echo current_url();?>" enctype="multipart/form-data" onsubmit="return validateForm()">

                    <?php 
                    foreach ($bannner_detail as $banner) {
                   
                     ?>

                        

                    <div class="form-group">
                        <label>Upload Image</label><br>
                            
                <input type="file" name="profile_pic"  class="form-control" id="avatar" style="width:30%" />

                    <?php 
                    if($banner['image']!=''){
                     ?>

                          <div id="image-holder"><img src="<?php echo base_url().$banner['image'];?>"  height="42" width="42"></div>
                          
                          <?php 
                            }else{
                           ?>

                           <div id="image-holder"></div>

                           <?php 

                            }
                            ?>

                          <?php echo form_error('file_add'); ?>
                            </div>
                            <div class="clearfix"> </div>
                    


                   <div class="">
                    <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group ">
                        <label>Enter Content</label>
                        <textarea rows = "5" cols = "50" name="banner_content"><?php echo $banner['banner_text']; ?></textarea>
                        
                        <!-- <input type="textarea" name="banner_content" class="form-control"/> -->
                        <?php echo form_error('banner_content'); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group ">
                        <label>Button Text</label>
                        <!-- <textarea rows = "5" cols = "50" name="banner_content" class="form-control"></textarea> -->
                        <input type="text" name="button_text" class="form-control" value="<?php echo $banner['button_text']; ?>"/>
                        <?php echo form_error('link'); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group ">
                        <label>Button Link</label>
                        <!-- <textarea rows = "5" cols = "50" name="banner_content" class="form-control"></textarea> -->
                        <input type="text" name="link" class="form-control" value="<?php echo $banner['button_link']; ?>"/>
                        <?php echo form_error('link'); ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                   <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                        <label style="visibility:hidden;">Submit</label>
                        <input type="submit" class="btn btn-primary btn-block " name="up_image" value="Upload" style="border-radius:0;width:42%"/>
                        </div>
                        </div>

                  </div>


            <?php 
            }

             ?>


                    </form> 
                           
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


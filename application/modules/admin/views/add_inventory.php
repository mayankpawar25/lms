<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventory
            <!-- <small>it all starts here</small> -->
        </h1>
        <!-- <?php echo $breadcrumb; ?> -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <!--<div class="box-header">
                <h3 class="box-title"><strong>Inventory Form</strong></h3>
                <hr>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body inventry-form">
                <?php
                /*echo "<pre>"; 
                print_r( $data['all_inventory']);*/
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
            <div class="box-body">

                 <form role="form" action="<?php echo site_url('admin/inventory/add_inventory'); ?>" method="post" enctype="multipart/form-data">
           
                <div class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>     
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" >
</div></div>
<div class="col-sm-6">
                            <div class="form-group">
                    <label for="exampleInputEmail1">Product Description</label> 
                    <textarea rows="1"  name="product_description" placeholder="Description.." class="form-control"></textarea>    
                   </div></div>
                   <div class="col-sm-6">
                            <div class="form-group">
                    <label for="exampleInputEmail1">Product Price</label>
                    <input type="text" name="product_price" class="form-control" placeholder="Price" >
                    </div></div>
                    <div class="col-sm-6">
                            <div class="form-group">
                    <label for="exampleInputEmail1">Stock Quantity</label>
                    <input type="text" name="stock_quantity" class="form-control" placeholder="Quantity" >
</div></div>
                       <div class="col-sm-12">
                            <div class="form-group">              
                    <label for="exampleInputEmail1">Product Image</label>
                    <input type="file" id="avatar" name="product_image" accept="image/png, image/jpeg" />
                      <div id="image-holder"> </div>
                </div>
            </div></div>
            
                            <div class="form-group">
                    <input type="Submit" name="submit" value="Add Inventory" class="btn btn-info " >
                    </form>
                  </div></div>
                

            </div>
        
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
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

</style>
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

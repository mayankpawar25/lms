<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Sub Distributor
            <!-- <small>it all starts here</small> -->
        </h1>
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
                <h3 class="box-title">Sub Distributor Register Form</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo site_url('distributor/AddSubDistributor'); ?>" method="post">
            <div class="box-body">
            <?php echo $this->session->flashdata('msg'); ?>
            <h2 class="text-center pagetitleh2">Add Sub Distributor</h2>
                <div class="">
                    <label for="exampleInputEmail1">First Name</label>     
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" >

                    <label for="exampleInputEmail1">Last Name</label>     
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" >

                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="user_name" class="form-control" placeholder="User Name" >
                    <input type="hidden" name="user_role" class="form-control" value="3">

                    <label for="exampleInputEmail1">User Password</label>
                    <input type="text" name="user_password" class="form-control" placeholder="User Password" >

                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="user_email" class="form-control" placeholder="Email" >

                    <label for="exampleInputEmail1">Phone No.</label><span class="alert"></span>
                    <input type="text" name="phone" onkeydown="return validate_number(event);" class="form-control" placeholder="Phone no." >

                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="user_street" class="form-control" placeholder="Street" >
                    <input type="text" name="user_city" class="form-control" placeholder="City" >
                    <input type="text" name="user_state" class="form-control" placeholder="state" >
                    <input type="text" name="user_postal_code" class="form-control" placeholder="Postal Code" >
                    <input type="text" name="user_country" class="form-control" placeholder="Country" >

                    <label for="exampleInputEmail1">Assigned</label>
                    <input type="text" name="user_assigned" class="form-control" placeholder="Assigned" >
                    
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" id="avatar" name="image" accept="image/png, image/jpeg" />
                </div>
                    <input type="Submit" name="submit" value="Add Sub Distributor" class="btn btn-info pull-right" style="margin:20px">
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
    $('#example1').DataTable();

</script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
              My Profile            
        </h1>
        <?php echo $breadcrumb; ?> 
    </section>

   
    
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header text-right">
                <?php 
            echo anchor('rsm/profile/edit_profile','<span class= "btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</span> ' ); 
            ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <?php //echo '<pre>';
               //print_r($profiles_detail); ?>
             <div class="col-md-12 col-sm-6 col-xs-6  ">
               <?php
               

                          foreach ($profiles_detail as $detail){
        ?>

        

        
               <div class="table-responsive">
        <table class="table table-striped table-bordered">
          
            <tr>
              <th>Name:</th>
              <th><?php echo $detail['full_name']; ?></th>
            </tr>

            <tr>
              <th>Username:</th>
              <th><?php echo $detail['username']; ?></th>
            </tr>

             <tr>
              <th>Email:</th>
              <th><?php echo $detail['email']; ?></th>
            </tr>

             <tr>
              <th>Mobile No.:</th>
              <th><?php echo $detail['phone']; ?></th>
            </tr>

             <tr>
              <th>Zone Name:</th>
              <th><?php echo $detail['zone_name']; ?></th>
            </tr>




             <tr>
              <th>Image</th>
              <th>
                <?php 
                if($detail['image']!=''){
                 ?>
                <img src="<?php echo base_url().$detail['image'];?>" class="img-circle" alt="User Image" width="50" height="50">

                <?php 
              }else{

                 ?>

                 <img src="<?php echo base_url();?>uploads/admins/images/default1.png" class="img-circle" alt="User Image" width="50" height="50">

                 <?php 
                }

                  ?>
                </th>
            </tr>


         
        </table>
      </div>
      <?php
      //$count++;
      } 
      ?>
      </div>
            </div>
           
        </div>
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
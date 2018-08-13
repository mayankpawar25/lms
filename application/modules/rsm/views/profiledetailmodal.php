    <!-- Content Header (Page header) -->
    
        <!-- Default box -->
<div class="box">
<button type="button" id="closebutton2" class="close" style="visibility:hidden"  data-dismiss="modal"><span class="btn btn-danger">close</span></button>
          <!-- <h1> My Profile </h1> -->
           
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <?php //echo '<pre>';
               //print_r($profiles_detail); ?>
             <div class="col-md-12 col-sm-6 col-xs-6  ">
               <?php foreach ($profiles_detail as $detail){ ?>

               <div class="table-responsive">
        <table class="table">
          
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
<style type="text/css">
      .box{
      border-top: 0px solid #d2d6de;
        
      }

</style>
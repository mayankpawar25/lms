

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
            <div class="box-header  text-right">
              <?php 
            echo anchor('partner/partner/edit_profile','<span class= "btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</span> ' ); 
            ?>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
             <div class="col-xs-12  ">
               <?php
             $count=0;
             //echo "<pre>";
             //print_r($this->session->userdata('logged_in'));
             //print_r($profiles);
                         foreach ($profiles as $profile){
        ?>
               <div class="table-responsive">
        <table class="table table-striped table-bordered">
          
            <tr>
              <th>Firm name</th>
              <th><?php echo $profile['firm_name']; ?></th>
            </tr>

            <tr>
              <th>Owner Name</th>
              <th><?php echo $profile['owner_name']; ?></th>
            </tr>

             <tr>
              <th>Contact No</th>
              <th><?php echo $profile['contact_no']; ?></th>
            </tr>

             <tr>
              <th>Email</th>
              <th><?php echo $profile['email']; ?></th>
            </tr>

             <tr>
              <th>Firm Incorporation Date</th>
             <!--  <th><?php echo $profile['firm_incorporation_date']; ?></th> -->
             <td><?php echo date( "d-m-Y", strtotime ( $profile['firm_incorporation_date'] ) ); ?></td>
            </tr>

             <tr>
              <th>Profile Image</th>
              <th class="tedit">
                <?php 
                       if($this->session->userdata('logged_in')->image!=''){

               ?>
                      <img src="<?php  echo base_url().$this->session->userdata('logged_in')->image;?>" class="user-image" width="60" height="50" alt="User Image">

              <?php 
              }else{

               ?>


               <img src="<?php echo base_url();?>uploads/partners/images/default.png" class="img-circle" alt="User Image">



               <?php 
                } 

                ?>
              </th>
            </tr>

             <?php 
              if(isset($profile['states_name']) && !empty($profile['states_name'])){
             ?>
            <tr>
              <th>state</th>
              <th><?php echo $profile['states_name']; ?></th>
            </tr>

            <?php
              }
            ?>


             <?php 
              if(isset($profile['city_name']) && !empty($profile['city_name'])){
             ?>

             <tr>
              <th>City</th>
              <th><?php echo $profile['city_name']; ?></th>
            </tr>

             <?php
              }
            ?>


            <?php 
              if(isset($profile['product_dealing_in']) && !empty($profile['product_dealing_in'])){
             ?>
            <tr>
              <th>Product Dealing In</td>
              <th><?php echo $profile['product_dealing_in']; ?></th>
            </tr>
            <?php
              }
            ?>



            <?php 
              if(isset($profile['turn_over']) && !empty($profile['turn_over'])){
             ?>
             <tr>
              <th>Turn Over</td>
              <th><?php echo $profile['turn_over']; ?></th>
            </tr>

            <?php
              }
            ?>

            <?php 
              if(isset($profile['current_ms_perc_overall_business']) && !empty($profile['current_ms_perc_overall_business'])){
             ?>
            <tr>
              <th>Current MS % to the overall Business</th>
              <th><?php echo $profile['current_ms_perc_overall_business']; ?></th>
            </tr>

              <?php
              }
            ?>

            <?php 
              if(isset($profile['product_percentage_share_terms_value']) && !empty($profile['product_percentage_share_terms_value'])){
             ?>
            <tr>
              <th>MS Products % Share in terms of Value </th>
              <th><?php echo $profile['product_percentage_share_terms_value']; ?></th>
            </tr>
            <?php
              }
            ?>

            <?php 
              if(isset($profile['product_promoted_past']) && !empty($profile['product_promoted_past'])){
             ?>
            <tr>
              <th>MS Products Promoted In The Past </th>
              <th><?php echo $profile['product_promoted_past']; ?></th>
            </tr>
            <?php
              }
            ?>


         
        </table>
      </div>
      <?php
      $count++;
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
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <?php 
          if($this->session->userdata('logged_in')->image!=''){
           ?>
          <img src="<?php echo base_url().$this->session->userdata('logged_in')->image;?>" class="img-circle" alt="User Image">
          <?php 
          }else{
           ?>
           <img src="<?php echo base_url();?>uploads/admins/images/default1.png" class="img-circle" alt="User Image">
           <?php 
            }
            ?>
          <!-- <img src="<?php echo base_url();?>assets/themes/partner/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('logged_in')->full_name;?></p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <?php 
        $controller = $this->router->fetch_class(); // class = controller
        $action = $this->router->fetch_method(); // action
      ?>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       

        <?php
                $active_class = '';
                if($controller == 'admin' OR $action == 'index'){
                    $active_class = 'active';
                }
        ?>
        <li class="<?php echo $active_class; ?>"><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>assets/themes/partner/index.html"><i class="fa fa-long-arrow-right"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url();?>assets/themes/partner/index2.html"><i class="fa fa-long-arrow-right"></i> Dashboard v2</a></li>
          </ul>
        </li> -->

        <?php
                $active_class = '';
                if($action == 'all_partners' OR $action == 'all_leads'){
                    $active_class = 'active';
                }
        ?>
        <li class="treeview <?php echo $active_class; ?>">
          <a href="#">
            <i class="fa fa-users"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
                $sub_active_class = '';
                if($controller == 'partner' && $action == 'all_partners'){
                    $sub_active_class = 'active';
                }
            ?>
     
      <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url();?>admin/partner/all_partners"><i class="fa fa-long-arrow-right"></i>Partners</a></li>


     
       
        <?php 
              $sub_active_class = '';
              if($controller == 'lead' && $action == 'all_leads'){
                  $sub_active_class = 'active';
              }
        ?>
              <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url('admin/lead/all_leads');?>"><i class="fa fa-long-arrow-right"></i>Created Leads</a></li>


        <?php 
              $sub_active_class = '';
              if($controller == 'lead' && $action == 'assigned_leads'){
                  $sub_active_class = 'active';
              }
              ?>
              <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url('admin/lead/assigned_leads');?>"><i class="fa fa-long-arrow-right"></i>Assigned Leads</a></li>


              
          </ul>
        </li>


        


        <?php
                $active_class = '';
                if($action == 'rsm' OR $action == 'all_rsm' OR $action == 'add_rsm' ){
                    $active_class = 'active';
                }
             ?>
        <li class="treeview <?php echo $active_class; ?>">
          <a href="#">
            <i class="fa fa-sitemap" aria-hidden="true"></i>
            <span>Manage RSM </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
                $sub_active_class = '';
                if($controller == 'rsm' && $action == 'add_rsm'){
                    $sub_active_class = 'active';
                }
            ?>
      <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url();?>admin/rsm/add_rsm"><i class="fa fa-plus"></i> Add RSM</a></li>
            <?php 
                $sub_active_class = '';
                if($controller == 'rsm' && $action == 'all_rsm' ){
                    $sub_active_class = 'active';
                }
            ?>
            <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url('admin/rsm/all_rsm');?>"><i class="fa fa-long-arrow-right"></i> View RSM</a></li>
            
          </ul>
        </li>


      <?php 
          $active_class = '';
          if($action == 'add_banner' OR $action == 'view_banner'){
              $active_class = 'active';
          }
      ?>
      <li class="treeview <?php echo $active_class;?>">
          <a href="#">
            <i class="fa fa-picture-o"></i> <span>Manage Banner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
                $sub_active_class = '';
                if($controller == 'banner' && $action == 'add_banner'){
                    $sub_active_class = 'active';
                }
            ?>
              <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url();?>admin/banner/add_banner"><i class="fa fa-plus"></i>Add Banner</a></li>
            <?php 
                $sub_active_class = '';
                if($controller == 'banner' && $action == 'view_banner'){
                    $sub_active_class = 'active';
                }
            ?>
              <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url();?>admin/banner/view_banner"><i class="fa fa-long-arrow-right"></i>View Banner data</a></li>
       
          </ul>
        </li>



        <?php
                $active_class = '';
                if($action == 'profile_details' OR $action == 'edit_profile'){
                    $active_class = 'active';
                }
             ?>

        <li class="treeview <?php echo $active_class; ?>">
          <a href="#">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <span>Account Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php 
                $sub_active_class = '';
                if($controller == 'profile' && $action == 'profile_details'){
                    $sub_active_class = 'active';
                }
            ?>
            
            <li class="<?=$sub_active_class?>"><a style="cursor:pointer; data-toggle="modal" data-target="#view" onclick="view_detail()"><i class="fa fa-user"></i> View Profile</a></li>

            <!-- <li class="<?=$sub_active_class?>"><a href="<?php echo base_url('admin/profile/profile_details'); ?>"><i class="fa fa-user"></i> View Profile</a></li> -->

            <?php 
                $sub_active_class = '';
                if($controller == 'profile' && $action == 'edit_profile'){
                    $sub_active_class = 'active';
                }
            ?>


            <li class="<?=$sub_active_class?>"><a href="<?php echo base_url('admin/profile/edit_profile'); ?>"><i class="fa fa-pencil"></i> Edit Profile</a></li>

            
           
          </ul>
        </li>

        <?php
                $active_class = '';
                if($action == 'lead' OR $action == 'deleted_leads' OR $action == 'deleted_partners' OR $action == 'deleted_rsm'){
                    $active_class = 'active';
                }
             ?>
        <li class="treeview <?php echo $active_class; ?>">
          <a href="#">
            <i class="fa fa-trash" aria-hidden="true"></i>
            <span>Deleted</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            
            <!-- <li class="<?=$sub_active_class?>"><a href="<?php echo base_url('admin/lead/deleted_leads'); ?>"><i class="fa fa-user"></i> View Profile</a></li> -->

            <?php 
                $sub_active_class = '';
                if($controller == 'partner' && $action == 'deleted_partners'){
                    $sub_active_class = 'active';
                }
            ?>
     
      <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url();?>admin/partner/deleted_partners"><i class="fa fa-long-arrow-right"></i> Deleted Partners</a></li>

            
            <?php 
                $sub_active_class = '';
                if($controller == 'lead' && $action == 'deleted_leads' ){
                    $sub_active_class = 'active';
                }
            ?>
            
            <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url('admin/lead/deleted_leads');?>"><i class="fa fa-long-arrow-right"></i> Deleted Leads</a></li>


            <?php 
                $sub_active_class = '';
                if($controller == 'rsm' && $action == 'deleted_rsm'){
                    $sub_active_class = 'active';
                }
            ?>
            <li class="<?php echo $sub_active_class?>"><a href="<?php echo base_url('admin/rsm/deleted_rsm');?>"><i class="fa fa-long-arrow-right"></i>Deleted RSM</a></li>
           
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 
  <script type="text/javascript"> 
    function view_detail(){
    $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/profile/profile_details');?>',
        //data: {'id': id},
        success: function(res) {
            $('#showdata2').html(res);
            $('#user_profile').modal('show');
        }
    });
}
</script>
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

           <img src="<?php echo base_url();?>uploads/partners/images/default1.png" class="img-circle" alt="User Image">



           <?php 
            }

            ?>

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
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
       <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
         <li class="">
          <a href="<?php echo base_url();?>partner/">
           <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
             
            </span>
          </a>
         
        </li> 
       <!--  <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
        <!-- <span>Manage Leads</span> -->

        

         <?php
                $controller = $this->router->fetch_class(); // class = controller
                $action = $this->router->fetch_method(); // action
               
                $active_class = '';
                if($action == 'add_lead' OR $action == 'all_leads' OR  $action == 'assigned_leads' ){
                    $active_class = 'active';
                }
             ?>

        <li class="treeview <?php echo $active_class; ?>">
          <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>Manage Leads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php 
            $controller = $this->router->fetch_class(); // class = controller
                $action = $this->router->fetch_method();
                $sub_active_class = '';
                if($controller == 'lead' && $action == 'add_lead'){
                    $sub_active_class = 'active';
                }
            ?>
            
            <li class="<?=$sub_active_class?>"><a href="<?php echo base_url('partner/lead/add_lead'); ?>"><i class="fa fa-plus"></i> Add Lead</a></li>

            <?php 
            $controller = $this->router->fetch_class(); // class = controller
                $action = $this->router->fetch_method();
                $sub_active_class = '';
                if($controller == 'lead' && $action == 'all_leads'){
                    $sub_active_class = 'active';
                }
            ?>


            <li class="<?=$sub_active_class?>"><a href="<?php echo base_url('partner/lead/all_leads'); ?>"><i class="fa fa-circle-o"></i> View Leads</a></li>

            <?php 
            $controller = $this->router->fetch_class(); // class = controller
                $action = $this->router->fetch_method();
                $sub_active_class = '';
                if($controller == 'lead' && $action == 'assigned_leads'){
                    $sub_active_class = 'active';
                }
            ?>


           <li class="<?=$sub_active_class?>"><a href="<?php echo base_url('partner/lead/assigned_leads'); ?>"><i class="fa fa-circle-o"></i> Assigned Leads</a></li>
           
          </ul>
        </li> 
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Sub Distributor Section</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>distributor/ShowSubDistributorForm"><i class="fa fa-circle-o"></i> Add Sub Distributor</a></li>
            <li><a href="<?php echo base_url(); ?>distributor/all_sub_distributor"><i class="fa fa-circle-o"></i> View Sub Distributor</a></li>
            
          </ul>
        </li> -->
     
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Partner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i>Add Partner</a></li>
            <li><a href="<?php echo base_url('distributor/partner/all_partner'); ?>"><i class="fa fa-circle-o"></i> View Partner</a></li>
            
          </ul>
        </li>  -->
       <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('distributor/inventory/all_inventory'); ?>"><i class="fa fa-circle-o"></i> View Inventory</a></li>
            
          </ul>
        </li>  -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="../tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li> -->
       <!--  <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li> -->
         <!--  <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li> -->
       <!--  <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
         <!--  <ul class="treeview-menu">
            <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li class="active"><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li> -->
       <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul> -->
    </section>
    <!-- /.sidebar -->
  </aside>

 
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">LMS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>LMS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <!--  <i class="fa fa-envelope-o"></i> -->
              <span class="label label-success"></span>
            </a>
            <ul class="dropdown-menu">
             <!--  <li class="header">You have 4 messages</li> -->
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/themes/partner/dist/img/user8-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                     <!--  <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> </small>
                      </h4> -->
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"></span>
            </a> -->
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"></span>
            </a> -->
            <ul class="dropdown-menu">
              <li class="header"></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <?php 
                if($this->session->userdata('logged_in')->image!=''){

               ?>

              <img src="<?php  echo base_url().$this->session->userdata('logged_in')->image;?>" class="user-image" alt="User Image">

              <?php 
              }else{

               ?>


               <img src="<?php echo base_url();?>uploads/partners/images/default.png" class="img-circle" alt="User Image">



               <?php 
                } 

                ?>

              <span class="hidden-xs"><?php  echo $this->session->userdata('logged_in')->full_name;?></span>
            </a>


            <?php 
            // echo "<pre>";
            // print_r($this->session->userdata('logged_in'));


             ?>


            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <?php 
                if($this->session->userdata('logged_in')->image!=''){


                 ?>


                <img src="<?php  echo base_url().$this->session->userdata('logged_in')->image;?>" class="img-circle" alt="User Image">



                <?php 
              }else{
                 ?>

                 <img src="<?php echo base_url();?>uploads/partners/images/default1.png" class="img-circle" alt="User Image">

                 <?php 
                }
                  ?>

                <p>
                    <?php echo $this->session->userdata('logged_in')->full_name;?> - <?php echo $this->session->userdata('logged_in')->type;?>
                    <h5><span class="label label-danger"><i class="fa fa-calendar"></i>  Last Login : <?php echo date('d M Y  h:i A',strtotime($this->session->userdata('logged_in')->last_login_time));?></span></h5>
                    
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('partner/partner/edit_profile');?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>partner/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
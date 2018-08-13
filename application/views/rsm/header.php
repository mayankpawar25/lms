<header class="main-header">

    <!-- Logo -->

    <a href="<?php echo base_url();?>admin" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>CDS LMS</b></span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b>CDS LMS</b></span>

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

          <!-- <li class="dropdown messages-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-envelope-o"></i>

              <span class="label label-success">4</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 4 messages</li>

              <li>

                

                <ul class="menu">

                  <li>

                    <a href="#">

                      <div class="pull-left">

                        <img src="<?php echo base_url();?>assets/themes/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                      </div>

                      <h4>

                        Support Team

                        <small><i class="fa fa-clock-o"></i> 5 mins</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  

                </ul>

              </li>

              <li class="footer"><a href="#">See All Messages</a></li>

            </ul>

          </li> -->

          

          <!-- <li class="dropdown notifications-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-bell-o"></i>

              <span class="label label-warning">10</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 10 notifications</li>

              <li>

                inner menu: contains the actual data

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

          </li> -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- <li class="dropdown tasks-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-flag-o"></i>

              <span class="label label-danger">9</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 9 tasks</li>

              <li>

                

                <ul class="menu">

                  <li>

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

                  

                </ul>

              </li>

              <li class="footer">

                <a href="#">View all tasks</a>

              </li>

            </ul>

          </li> -->

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


               <img src="<?php echo base_url();?>uploads/admins/images/default.png" class="img-circle" alt="User Image">



               <?php 
                } 

                ?>

             

              <span class="hidden-xs"><?php echo $this->session->userdata('logged_in')->full_name;?></span>

            </a>

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
                

                 <img src="<?php echo base_url();?>uploads/admins/images/default1.png" class="img-circle" alt="User Image">

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

                  <a href="<?php echo base_url('rsm/profile/profile_details');?>" class="btn btn-default btn-flat">Profile</a>

                </div>

                <div class="pull-right">
              <!--  <?php echo"<pre>"; print_r($this->session->userdata('logged_in'));  ?> -->

                  <a href="<?php echo base_url();?>rsm/auth/logout" class="btn btn-default btn-flat">Sign out</a>

                </div>

              </li>

            </ul>

          </li>



        </ul>

      </div>

    </nav>

  </header>
  <!-- Content Header (Page header) -->
<div class="modal fade" id="myModal26" style="display : none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" id="closebutton" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Profile Detail <div class="form-btn" style="float: right; margin-right: 15px"><?php 
              echo anchor('rsm/profile/edit_profile','<span class= "btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</span> ' ); 
            ?></div></h4>
                </div>
                <div class="modal-body">
                    <div class="box-body pad">
                        
                            
                            <div class="form-group" id="showdata2">

                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label"></label>
                                <div class="modal-footer">
                                </div>
                            </div>
                        
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script type="text/javascript">
      $('#closebutton').click(function(){
          $('#closebutton2').click();
      });
    </script>
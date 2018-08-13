<?php
/**
 * Created by PhpStorm.
 * User: sunil
 * Date: 01-02-2018
 * Time: 01:59 PM
 */

?>
 <div class="login-box-heading"><h2><span class="glyphicon glyphicon-user " ></span> <span class="seprate-line">|</span> Admin Login</h2></div> 
<div class="login-box-body">
   
    
    
    <?php if($error){?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-times"></i> Alert!</h4>
        <?php echo $error;?>
    </div>
    <?php }?>
    <form action="<?php echo current_url();?>" method="post" id="login-form">
        <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <input type="text" name="username" class="form-control" placeholder="Username">
            
        </div>
        <div class="form-group has-feedback">
         <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <input type="password" name="password" class="form-control" placeholder="Password">
           
        </div>
        <?php if (isset($referrer)){?>
            <input type="hidden" name="referrer" value="<?php echo $referrer;?>">
        <?php }?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <button type="button" id="sign-btn" class="btn thm-btn btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>




<p class="text-center">
    <a href="<?php echo site_url('admin/auth/forget_password') ?>" style="coloe:#2a2a2a;">I forgot my password</a><br>
    <!-- <a href="<?php echo base_url();?>admin/auth/register" class="text-center">Register a new membership</a> -->
    </p>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sign-btn').click(function () {
            $('#login-form').submit();
        });
    });

    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#login-form').submit();
              //alert('You pressed a "enter" key in somewhere');   
         }
    });
</script>

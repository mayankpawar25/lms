<?php
/**
 * Created by PhpStorm.
 * User: sunil
 * Date: 01-02-2018
 * Time: 01:59 PM
 */

?>
 <div class="login-box-heading"><h2><span class="glyphicon glyphicon-user " ></span> <span class="seprate-line">|</span> Partner Login</h2></div> 
<div class="login-box-body">
    <p class="login-box-msg"><!-- Sign in to start your session --></p>
    <?php if($error){?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-times"></i> Alert!</h4>
        <?php echo $error;?>
    </div>
    <?php }?>
    <form action="<?php echo current_url();?>" method="post" id="login-form">
        <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <?php if (isset($referrer)){?>
            <input type="hidden" name="referrer" value="<?php echo $referrer; ?>">
        <?php }?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <button type="button" id="sign-btn" class="btn thm-btn btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
<div class=" row login_links">
<div class="col-xs-6 text-left">
    <a href="<?php echo base_url();?>partner/auth/forget_password">I forgot my password</a></div>
    <div class="col-xs-6 text-right">
    <a href="<?php echo base_url();?>partner/auth/register" class="text-center">Partner Registration</a>
    </div>
</div>
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
<style>
@media only screen and (max-width:575px)
{
	.login_links .col-xs-6.text-left, .login_links .col-xs-6.text-right{text-align:center; margin-bottom:10px; width:100%;}

}
</style>

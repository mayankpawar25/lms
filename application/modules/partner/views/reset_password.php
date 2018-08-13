

<div class="login-box-body">

    <p class="login-box-msg">Reset Password</p>


<?php if($this->session->flashdata('success_msg')) { ?>

    <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

      <?php echo $this->session->flashdata('success_message') ?>
       
    </div>


 <?php }else if($this->session->flashdata('error_msg')){ ?>

        <div class="alert alert-danger alert-dismissible">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <?php echo $this->session->flashdata('error_message') ?>

    </div>

    <?php 
    }
    ?>  


   

    <form action="<?php echo current_url();?>" method="post" id="reset_pass-form">

        <div class="form-group has-feedback">

            <input type="text" name="new_password" class="form-control" placeholder="New Password">

            <span class="glyphicon glyphicon-user form-control-feedback"></span>

        </div>



        <div class="form-group has-feedback">

            <input type="text" name="confirm_password" class="form-control" placeholder="Confirm Password">

            <span class="glyphicon glyphicon-user form-control-feedback"></span>

        </div>


        <?php if (isset($referrer)){?>

            <input type="hidden" name="referrer" value="<?php echo $referrer;?>">

        <?php }?>

        <div class="row">

            <div class="col-xs-12">

                <button type="button" id="reset-btn" class="btn btn-primary btn-block btn-flat">Submit</button>

            </div>

            

        </div>

    </form>











    <a href="<?php echo base_url();?>partner/auth" class="text-center">Go to Login</a>


</div>



<script type="text/javascript">

    $(document).ready(function () {

        $('#reset-btn').click(function () {

            $('#reset_pass-form').submit();

        });

    });

</script>


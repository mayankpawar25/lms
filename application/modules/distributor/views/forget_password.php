

<div class="login-box-body">

    <p class="login-box-msg">Forget Password</p>

    <?php if($this->session->flashdata('success_message')) { ?> 

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

      <?php echo $this->session->flashdata('success_message') ?>
       
    </div>

    <?php }else if($this->session->flashdata('error_message')){ ?>

        <div class="alert alert-danger alert-dismissible">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <?php echo $this->session->flashdata('error_message') ?>

    </div>

    <?php 
    }
    ?>    


    <form action="<?php echo current_url();?>" method="post" id="forget-form">

        <div class="form-group has-feedback">

            <input type="email" name="email" class="form-control" placeholder="Enter Email">

            <span class="glyphicon glyphicon-user form-control-feedback"></span>

        </div>


        <?php if (isset($referrer)){?>

            <input type="hidden" name="referrer" value="<?php echo $referrer;?>">

        <?php }?>

        <div class="row">

            <div class="col-xs-12">

                <button type="button" id="sign-btn" class="btn btn-primary btn-block btn-flat">Submit</button>

            </div>

            

        </div>

    </form>


    <a href="<?php echo base_url();?>distributor/auth" class="text-center">Back  to Login</a>

</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#sign-btn').click(function () {

            $('#forget-form').submit();

        });

    });

</script>


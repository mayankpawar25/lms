 <div class="login-box-heading"><h2><span class="glyphicon glyphicon-user " ></span> <span class="seprate-line">|</span> Forget Password</h2></div> 

<div class="login-box-body">

  

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
  <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <input type="email" name="email" class="form-control" placeholder="Enter Email">

          

        </div>


        <?php if (isset($referrer)){?>

            <input type="hidden" name="referrer" value="<?php echo $referrer;?>">

        <?php }?>

        <div class="row">

            <div class="col-xs-12 text-center">

                <button type="button" id="sign-btn" class="btn thm-btn btn-flat">Submit</button>

            </div>

            

        </div>

    </form>

<p class="text-center">
    <a href="<?php echo base_url();?>admin/auth" class="text-center"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> &nbsp; Back  to Login</a>
</p>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#sign-btn').click(function () {

            $('#forget-form').submit();

        });

    });

</script>


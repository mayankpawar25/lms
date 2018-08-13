
<style>
body{background:#eee;}
.bg-wh{background:#fff; float:left; padding:10px; }
.bg-wh .form-group .form-control{border-radius:0; margin-bottom:5px;}
.mlr0{margin-left:0; margin-right:0;}
.mlr5{margin-left:-5px; margin-right:-5px;}
.plr5{padding-left:5px; padding-right:5px;}
.input-group-btn span.glyphicon, .input-group-btn i.fa {font-size:16px;}
.bg-wh .form-group .input-group .form-control{margin-bottom:0;}
.form-group .input-group-btn .btn{border-radius:0;}
.form-group label{font-weight:normal;}
.append-btn{border-radius:0; margin-bottom:5px; }
.mb5{margin-bottom:5px;}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Lead
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <!-- <h3 class="box-title">Data Table With Full Features</h3> -->   
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                 <h4>Overview</h4>
            <?php
            if($this->session->flashdata('success')){?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php }else if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        <strong>Error!</strong>  <?php echo $this->session->flashdata('error'); ?>
                    </div>
                  
               <?php }?>

            

           

            <form id="distributor" method="post" action="<?php echo site_url('admin/distributor/add_distributor');?>" enctype="multipart/form-data">     
            <div class="row">   
                <div class="col-sm-8">
                <div class="bg-wh">
                        <div class="row">
                            
                            
                            
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label>Name</label>
                                <div class="row mlr5">
                                <div class="col-sm-4 plr5">
                                        
                                        <select class="form-control" name="catagory" id="catagory" required>
                                            <option value="">Select</option>
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Miss">Miss</option>
                                        </select>
                                        <?php echo form_error('catagory'); ?>
                                    </div>


                                    <div class="col-sm-4 plr5">
                                        
                                        <input type="text" name="first_name"  class="form-control" placeholder="First Name" required />
                                        <?php echo form_error('first_name'); ?>
                                    </div>
                                    <div class="col-sm-4 plr5">
                                        
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required/>
                                        <?php echo form_error('last_name'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            
                            <div class="form-group">
                            <label>Account Name</label>
                            
                            <input type="password" id="account_no" class="form-control" name ="account_number"/>
                            <?php //echo form_error('account_number'); ?>
                            </div>
                        </div> -->
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            
                        <div class="form-group">
                        <label>Email</label>
                            <div class="input-group mb5">
                
                <input type="email" autocomplete='off' id="email" class="form-control" name="email[]" required>
                
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-ban" ></i></button>
                    <button type="button" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></button>
                </span>
                
            </div>
              <button type="button" class="btn btn-default append-btn" id="add-email"><span class=" glyphicon glyphicon-plus"></span></button>
              <?php echo form_error('email'); ?>
            
            </div>
             </div>   
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                        <label>Phone</label>
                            <div class="input-group mb5">
                <span class="input-group-btn">
                   <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">+91 <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">+91</a></li>
                       
                    </ul>
                </span>
                
                <input type="text" class="form-control" name="phone[]" id="phone" placeholder="Mobile" required>
                
            </div>
             <button type="button" class="btn btn-default append-btn" id="add-phone"><span class="  glyphicon glyphicon-plus"></span></button>
             <?php echo form_error('phone'); ?>
            
            </div>
                        </div>    
                        
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                        
                        <div class="form-group">
                        <label>Username</label>
                        
                        <input type="text" name="username" id="username" class="form-control" required/>
                        <?php echo form_error('username'); ?>
                        </div></div>
                        
                         <div class="col-sm-6">
                        
                        <div class="form-group">
                        <label>Password</label><br />
                        
                        <input type="password" name="password" id="password" class="form-control" required/>
                        <?php echo form_error('password'); ?>
                        </div></div>
                        </div>     
                        
                        <div class="row">
                        <div class="col-sm-6">
                            
                            
                            
                        <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="1" placeholder="Address" name="address" id="address" autocomplete='off' required></textarea>
                        <?php echo form_error('address'); ?>
                        <div class="row mlr5">
                                <div class="col-sm-4 plr5">

                        
                        <select class="form-control" name="city" id="city" autocomplete='off' required>
                        <option value="">city</option>
                        <?php
                        if(!empty($cities))
                        {
                        foreach ($cities as $city) { 

                        ?>
                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                        <?php echo form_error('city'); ?>



                                        <!-- <input type="text" class="form-control" placeholder="City" /> -->
                                    </div>
                                    <div class="col-sm-4 plr5">
                                      
                        <select class="form-control" name="state" id="state" autocomplete='off' required>
                        <option value="">States</option>
                        <?php
                        if(!empty($states))
                        { 
                        foreach ($states as $state) { 

                        ?>
                        <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select> 
                        <?php echo form_error('state'); ?> 

                                        <!-- <input type="text" class="form-control" placeholder="State" /> -->
                                    </div>
                                    <div class="col-sm-4 plr5">

                                        <!-- <input type="text" class="form-control" placeholder="Postal code " /> -->
                                    </div>
                                </div>
                        
                        <select class="form-control" name="country" id="country" autocomplete='off' required>
                        <option value="">Country</option>
                        <?php
                        if(!empty($countries))
                        {
                        foreach ($countries as $country){ 

                        ?>
                        <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select> 
                        <?php echo form_error('country'); ?> 

                        </div></div>
                       
                         
                        </div>
                        
                      <hr />
                      <h4>Firm Detail</h4>
                        

                        <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">

                            <div class="col-sm-6">
                        <div class="form-group">
                        <label>Firm Name</label><br />
                        
                        <input type="text" name="firm_name" id="firm_name" class="form-control"  required/>
                        <?php echo form_error('firm_name'); ?>
                        </div></div>




                       
                        
                         <div class="col-sm-6">
                        <div class="form-group">
                        <label>Source</label>
                        
                        <select class="form-control" name="source" id="source" required>
                            <option value="">Select</option>
                            <option value="1">Source1</option>
                            <option value="2" >Source2</option>
                            <option value="3">Source3</option>
                            
                        </select>
                        <?php echo form_error('source'); ?>
                        </div></div>


                         <label>Status</label>

                       
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            
                        </select>
                        <?php echo form_error('status'); ?>
                        </div></div>




                        <div class="col-sm-6">
                        <div class="form-group">
                        <label>Website</label><br />
                        
                        <input type="text" name="website" id="website" class="form-control"  required/>
                        <?php echo form_error('website'); ?>
                        </div></div>

                         <div class="col-sm-6">
                        <div class="form-group">
                        <label>Registration No.</label><br />
                        
                        <input type="text" name="registration" id="registration" class="form-control"  required/>
                        <?php echo form_error('registration'); ?>
                        </div></div>


                        <div class="col-sm-6">
                        <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="1" placeholder="Address" name="firm_address" id="firm_address" autocomplete='off' required></textarea>
                        <?php echo form_error('firm_address'); ?>

                        <div class="row mlr5">
                                <div class="col-sm-4 plr5">

                        
                        <select class="form-control" name="firm_city" id="firm_city" autocomplete='off' required>
                        <option value="">city</option>
                        <?php
                        if(!empty($cities))
                        {
                        foreach ($cities as $city) { 

                        ?>
                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                        <?php echo form_error('city'); ?>



                                        <!-- <input type="text" class="form-control" placeholder="City" /> -->
                                    </div>
                                    <div class="col-sm-4 plr5">
                                     
                        <select class="form-control" name="firm_state" id="firm_state" autocomplete='off' required>
                        <option value="">States</option>
                        <?php
                        if(!empty($states))
                        { 
                        foreach ($states as $state) { 

                        ?>
                        <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select> 
                        <?php echo form_error('state'); ?>  

                                        <!-- <input type="text" class="form-control" placeholder="State" /> -->
                                    </div>
                                    <div class="col-sm-4 plr5">

                                        <!-- <input type="text" class="form-control" placeholder="Postal code " /> -->
                                    </div>
                                </div>
                        
                        <select class="form-control" name="firm_country" id="firm_country" autocomplete='off'  required>
                        <option value="">Country</option>
                        <?php
                        if(!empty($countries))
                        {
                        foreach ($countries as $country){ 

                        ?>
                        <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select> 
                        <?php echo form_error('country'); ?> 

                        </div></div>






                        </div>
                         
                        
                </div></div>
                <div class="col-sm-4">
                    <div class="bg-wh">
                    <div class="form-group">
                        <label>Assigned Admin</label>
                            <div class="input-group">

                                
                    
                    <select class="form-control" name="assigned" id="assigned" autocomplete='off' required>
                        <option value="">Select Admin</option>
                        <?php
                        if(!empty($all_admins))
                        {
                        foreach ($all_admins as $admin) { 

                        ?>
                        <option value="<?php echo $admin['id']; ?>"><?php echo $admin['username']; ?></option>
                        <?php
                            }
                        }
                        ?>
                        </select> 
                        <?php echo form_error('assigned'); ?>



            </div></div>
            <div class="clearfix"></div>
            <div class="form-group">
                        <label>Upload File</label><br>
                            
                          <input type="file" name="profile_pic"  class="form-control" id="avatar" required/>
                          <div id="image-holder"> </div>
                          <?php echo form_error('file_add'); ?>
                            </div>

                    </div>
                </div>
            </div>
   
<div class="clearfix"></div>


<input type="submit"  name="submit" value="submit">

</form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>


<script>
$(document).ready(function() {
    $("button#add-email").click(function() {
        var domElement = $('<div class="input-group mb5"> <input type="text" class="form-control" name="email[]" ><span class="input-group-btn"> <button type="button" class="btn btn-default"><i class="fa fa-ban" ></i></button><button type="button" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></button></span> </div>');
        $(this).before(domElement);
    });


    $("button#add-phone").click(function() {
        var domElement = $('<div class="input-group mb5"><span class="input-group-btn"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">+91 <span class="caret"></span></button> <ul class="dropdown-menu"><li><a href="#">+91</a></li> </ul></span> <input type="text" class="form-control" placeholder="Mobile" name="phone[]" > </div>');
        $(this).before(domElement);
    });
    
});
</script>



<style type="text/css">
    .thumb-image{
        width: 100px;
        height: auto;
    }
    #image-holder{ 
    width: 150px;
   
    margin-top: 12px;
}
#image-holder img{width:100%;}
.inventry-form .form-group .form-control, .inventry-form .btn{min-height:40px; border-radius:0;}
.error {
color:red !important;
}.error {
color:red !important;
}`
</style>
<script type="text/javascript">
    $("#avatar").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#image-holder");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });

$("#distributor" ).validate({
  rules: {
    first_name:
     {
       lettersonly: true
    },

    last_name:
     {
        lettersonly: true
    },

    email:
     {
        required: true,
        email: true
    },

    phone:
     {
        required: true,
        digits: true
    },

    username:
     {
        required: true,
        
        text:true

    },

    password:
     {
        required: true,
        
        text:true
    },

    firm_name:
     {
        required: true,
        text: true
    },

    registration:
     {
        required: true,
        digits: true,
        text:true
    }

    

  }
});
</script>






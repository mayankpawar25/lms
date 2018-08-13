<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All RSM (Regional Sales Manager)
            <small></small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

            <?php
                if($this->session->flashdata('success')){?>
                  
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('success'); ?>",
                      //text: "<?php echo $this->session->flashdata('success'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'success'
                       });
                       });
                    </script>

                <?php }else if($this->session->flashdata('error')){ ?>
                   
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('error'); ?>",
                      //text: "<?php echo $this->session->flashdata('error'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'error'
                     });
                     });
                    </script>

                <?php }?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <?php 
            //echo anchor('admin/distributor/add_distributor','<span class= "btn btn-info">Add Distributor</span> ' ); 
                ?> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example5" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <!-- <th>ID</th> -->
                                <th>Registration Date</th>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Mobile No.</th>
                                <th>Zone Name</th>
                                <th>States</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=1;
                            foreach ($rsm as $rs){
                                ?>
                                <tr>
                                    <th><?php echo $count;  ?></th>
                                    <!-- <td></td>       -->
                                    <td><?php echo date( "d-m-Y", strtotime ( $rs['registration_date'] ) ); ?></td>
                                    <td><?php echo $rs['name']; ?></td>
                                    <td><?php echo $rs['email']; ?></td>
                                    <td><?php echo $rs['mobile']; ?></td>
                                    <td><?php echo $rs['zone_name']; ?></td>
                                    <td>
                                        <?php 
                                        $exp = explode(',', $rs['states']);
                                        for($i=0; $i<=count($exp); $i++){
                                            if (!empty($exp[$i])) {
                                                $satat = $this->rsms->getstatebyId($exp[$i]);
                                                echo $satat->name;
                                                echo "<br>";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo ($rs['status']) ? '<a href="javascript:void(0)" st-data-id="'.$rs['id'].'" class="active-lang "><span class="btn-xs btn-success active-btn" title="Activate Account">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$rs['id'].'" class="inactive-lang  "><span class="btn-xs btn-danger inactive-btn" title="Deactivate Account">Inactive</span></a>' ?>
                                    </td>
                                    <td>
                                        <?php if($rs['status']==1){ ?>
                                            <button type="button" class="btn btn-xs btn-info" onclick="sendmail_to_rsm(<?php echo $rs['id']; ?>)" title="Send Credentials"> <i class="fa fa-envelope"></i></button>
                                        <?php } ?>
                                        <?php echo anchor('admin/rsm/edit_rsm/'.base64_encode($rs['id']), '<span class= "btn btn-xs btn-info" title="Edit Leads"><i class="fa fa-pencil"></i></span> ' ); ?>
                                        <span class= "btn btn-xs btn-danger" onclick="delete_lead(<?php echo $rs['id'];?>)" title="Delete Leads" ><i class="fa fa-trash"></i></span>
                                        <span class= "btn btn-success btn-xs" data-toggle="modal" data-target="#view" onclick="view(<?php echo $rs['id']; ?>)"  title="View RSM Details"><i class="fa fa-eye"></i></span>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<script>
    $('#example5').DataTable();
</script>
<script type="text/javascript">
    function delete_lead(id){
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Delete this RSM ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm == true){
          swal({
            title: 'Success!',
            text: 'Your RSM Deleted Successfully..!',
            type: 'success'
          }, function(isConf){
                location.reload();
              if (!isConf) return;
              $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/rsm/delete_rsm');?>',
        data: {'id': id},
        success: function(responce) {
            //alert("RSM restored successfully.!"); 
            }
        });  
          })
        }else{
          swal({
            title: 'Cancelled',
            text: 'Your Request Cancelled',
            type: 'error'
          })
        }
    });    
}
</script>
<script type="text/javascript">
    $(document).on('click','.inactive-lang',function(){
    
    var id = $(this).attr('st-data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Active this RSM ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm == true){
          swal({
            title: 'Success!',
            text: 'RSM Active Successfully..!',
            type: 'success'
          }, function(isConf){
                //location.reload();
              if (!isConf) return;
        //alert(id);
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/rsm/update_status_rsm');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"   class="active-lang "><span class=" btn-xs active-btn  btn-success">Active</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });  
          })
        }else{
          swal({
            title: 'Cancelled',
            text: 'Your Request Cancelled',
            type: 'error'
          })
        }
    });


    //     var result = confirm("Are you sure you want to Active this RSM ?");
    //     if(result){      
    //         var id = $(this).attr('st-data-id');
    //     //alert(id);
    //     var status_check = 1;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/rsm/update_status_rsm');?>',
    //         {'id':id,'status':status_check},
    //         function(resp){
    //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'"   class="active-lang "><span class=" btn-xs active-btn  btn-success">Active</span></a>';
    //             eve.closest('td').html(html_data);
    //             location.reload();
    //         });
    // }
});
    $(document).on('click','.active-lang',function(){
        
        var id = $(this).attr('st-data-id');
        swal({
        title: "Confirmation !",
        text: "Are you sure you want to Inactive this RSM ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm == true){
          swal({
            title: 'Success!',
            text: 'RSM Inactive Successfully..!',
            type: 'success'
          }, function(isConf){
                //location.reload();
              if (!isConf) return;
           
            var status_check = 0;
            var eve = $(this);
            $.post('<?php echo site_url('admin/rsm/update_status_rsm');?>',
                {'id':id,'status':status_check},
                function(resp){
                    var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs btn-danger inactive-btn">Inactive</span></a>';
                    eve.closest('td').html(html_data);
                    location.reload();
                });  
          })
        }else{
          swal({
            title: 'Cancelled',
            text: 'Your Request Cancelled',
            type: 'error'
          })
        }
        });

        // var result = confirm("Are you sure you want to Inactive this RSM ?");
        // if(result){
        //     var id = $(this).attr('st-data-id');
        //     var status_check = 0;
        //     var eve = $(this);
        //     $.post('<?php echo site_url('admin/rsm/update_status_rsm');?>',
        //         {'id':id,'status':status_check},
        //         function(resp){
        //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs btn-danger inactive-btn">Inactive</span></a>';
        //             eve.closest('td').html(html_data);
        //             location.reload();
        //         });
        // }
    });
    function view(id){
        //alert(id);
        $.ajax({
            type: "POST",
            url: '<?php echo site_url('admin/rsm/view_rsm_details');?>',
            data: {'id': id},
            success: function(res){
            //alert(res);
            $('#showdata').html(res);
            //$('#view').modal('show');
        }
    });
    }
    /*Send email to RSM with there login ID and Password */
    function sendmail_to_rsm(id){
        var return_confirmation = confirm('Are you sure! You want to send Credentials to this RSM ?');
        if(return_confirmation){
            $.post('<?php echo site_url('admin/rsm/send_email');?>',
                {'id':id},function(resp){
                    if(resp){
                        alert('Email Sent Successfully..!');
                    }
                });
        }
    }
</script>
<style>
#example5 tr>th:nth-child(15){min-width:100px;}

#example5 tr>th:last-child, #example5 tr>td:last-child, #example5 tr>th:nth-last-child(2), #example5 tr>td:nth-last-child(2){width:35px!important; min-width:35px!important; }

	 #example5 tr>th:nth-last-child(2), #example5 tr>td:nth-last-child(2){text-align:center;}
</style>
<div class="modal fade" id="view" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">RSM Details</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body pad">
                        <div class="form-group" id="showdata">
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
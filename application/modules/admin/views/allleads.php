<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Created Leads
        <small></small>
    </h1>
       <?php echo $breadcrumb; ?>
</section>

            <?php
                if($this->session->flashdata('success_edit_lead')){?>
                  
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('success_edit_lead'); ?>",
                      //text: "<?php echo $this->session->flashdata('success_edit_lead'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'success'
                       });
                       });
                    </script>

                <?php }else if($this->session->flashdata('error_add_rsm')){ ?>
                   
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('error_add_rsm'); ?>",
                      //text: "<?php echo $this->session->flashdata('error_add_rsm'); ?>",
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
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lead ID</th>
                        <th>Registration Date</th>
                        <th>Name</th>
                        <th>City</th>
                        <!-- <th>Pin Code</th> -->
                        <th>Sales Motion</th>
                        <th>Segment</th>
                        <th>Value of Deal</th>
                        <th>Product Required</th>
                        <th>Involvement</th>
                        <!-- <th>Expected Closing Date</th> -->
                        <th>BDM Name</th>
                        <!-- <th>Current Status Lead</th> -->
                        <th>Partner</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Approval</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($leads as $lead){

                    ?> 
                        <tr>
                            <th><?php echo $count;  ?></th>
                            <td><?php echo $lead['id']; ?></td>      
                            <td><?php echo date( "d/m/Y", strtotime ( $lead['registration_date'] ) ); ?></td>
                            <td><?php echo $lead['customer_name']; ?></td>
                            <td><?php echo $lead['city_name']; ?></td>
                            <!-- <td><?php // echo $lead['pin_code']; ?></td> -->
                            <td><?php echo $lead['motion_types']; ?></td>
                            <td><?php echo $lead['segment_types']; ?></td>
                            <td><?php echo $lead['deal_types']; ?></td>
                            <td><?php echo $lead['product_required']; ?></td>
                            <td><?php echo $lead['involvement_types']; ?></td>
                            <td><?php echo $lead['bdm_name']; ?></td>
                            <!-- <td><?php // echo $lead['days_types']; ?></td> -->
                            <td>
                            <?php echo $lead['owner_name']; ?>
                            </td>
                            



                            <td>
                                <?php echo anchor('admin/lead/edit_lead/'.base64_encode($lead['id']), '<span class= "btn btn-xs btn-info" title="Edit Leads"><i class="fa fa-pencil"></i></span> ' ); ?>
                                <span class= "btn btn-xs btn-success view-lead" title="View Leads" onclick="view(<?php echo $lead['id'] ?>)"><i class="fa fa-eye"></i></span>
                                <span class= "btn btn-xs btn-danger" onclick="delete_lead(<?php echo $lead['id'];?>)" title="Delete Leads" ><i class="fa fa-trash"></i></span>
                                <?php
                                    if($lead['approval']==1){
                                ?>
                                        <span class= "btn btn-xs btn-info assign-partner" data-partner-id="<?php echo $lead['assigned_to_partner'] ?>" data-lead-id="<?php echo $lead['id'] ?>" title="Assign Partner" ><i class="fa fa-handshake-o"></i></span>


                                        <span title="Show History" class= "btn btn-warning btn-xs" data-toggle="modal" data-target="#lead-history" onclick="view_assigned(<?php echo $lead['id']; ?>,'history')"><i class="fa fa-history"></i></span>

                                <?php   
                                    }
                                ?>
                            </td>
                            <td>
                               <?php echo ($lead['status']) ? '<a href="javascript:void(0)" st-data-id="'.$lead['id'].'" class="active-lang "><span class="btn-xs btn-success active-btn" title="Activate Account">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$lead['id'].'" class="inactive-lang  "><span class="btn-xs btn-danger inactive-btn" title="Deactivate Account">Inactive</span></a>' ?>
                            </td>

                            <td>
                               <?php 
                                echo ($lead['approval']) ? '<a href="javascript:void(0)" data-id="'.$lead['id'].'" class="approved-partn " title="Approved"><span class="btn-xs active-btn btn-success">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$lead['id'].'" class="disapprove-partn  "><span class="btn-xs btn-warning inactive-btn" title="Disapproved">Waiting For Approval</span></a>' 
                               ?>
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
$('#example3').DataTable();
</script>
<script type="text/javascript">
function delete_lead(id){
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Delete this Lead ?",
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
            text: 'Your Lead Deleted Successfully..!',
            type: 'success'
          }, function(isConf){
                location.reload();
              if (!isConf) return;
              $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/lead/delete_lead');?>',
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
        text: "Are you sure you want to Active this Lead ?",
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
            text: 'Your Lead Activated Successfully..!',
            type: 'success'
          }, function(isConf){
                //location.reload();
              if (!isConf) return;
               //alert('test'+id);
              var status_check = 1;
              var eve = $(this);
            $.post('<?php echo site_url('admin/lead/update_status_lead');?>',
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

    // var result = confirm("Are you sure you want to Active this Lead ?");
    // if(result){      
    //     var id = $(this).attr('st-data-id');
    //     var status_check = 1;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/lead/update_status_lead');?>',
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
        text: "Are you sure you want to Inactive this Lead ?",
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
            text: 'Your Lead Deactivated Successfully..!',
            type: 'success'
          }, function(isConf){
              if (!isConf) return;
            var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/update_status_lead');?>',
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


    // var result = confirm("Are you sure you want to Inactive this Lead ?");
    // if(result){
    //     var id = $(this).attr('st-data-id');
    //     var status_check = 0;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/lead/update_status_lead');?>',
    //         {'id':id,'status':status_check},
    //         function(resp){
    //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs btn-danger inactive-btn">Inactive</span></a>';
    //             eve.closest('td').html(html_data);
    //             location.reload();
    //         });
    // }
});


/* script for partner Approval */


$(document).on('click','.disapprove-partn',function(){
    
    var id = $(this).attr('data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Approve this Lead ?",
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
            text: 'Lead Approved Successfully..!',
            type: 'success'
          }, function(isConf){
              if (!isConf) return;
            
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/approved_disapproved_lead');?>',
            {'id':id,'approval':status_check},
            function(resp){


                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="approved-partn" ><span class=" btn-xs active-btn  btn-success">Approved</span></a>';
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


    // var result = confirm("Are you sure you want to Approve this Lead ?");
    // if(result){      
    //     var id = $(this).attr('data-id');
    //     var status_check = 1;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/lead/approved_disapproved_lead');?>',
    //         {'id':id,'approval':status_check},
    //         function(resp){


    //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="approved-partn" ><span class=" btn-xs active-btn  btn-success">Approved</span></a>';
    //             eve.closest('td').html(html_data);
    //             location.reload();
    //         });
    // }
});
$(document).on('click','.approved-partn',function(){
    
    var id = $(this).attr('data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Disapproved this Lead ?",
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
            text: 'Lead Disapproved Successfully..!',
            type: 'success'
          }, function(isConf){
              if (!isConf) return;
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/approved_disapproved_lead');?>',
            {'id':id,'approval':status_check},
            function(resp){

                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="disapprove-partn "><span class="btn-xs btn-danger inactive-btn">Waiting For Approval</span></a>';
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

    // var result = confirm("Are you sure you want to Disapproved this Lead ?");
    // if(result){
    //     var id = $(this).attr('data-id');
    //     var status_check = 0;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/lead/approved_disapproved_lead');?>',
    //         {'id':id,'approval':status_check},
    //         function(resp){

    //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="disapprove-partn "><span class="btn-xs btn-danger inactive-btn">Waiting For Approval</span></a>';
    //             eve.closest('td').html(html_data);
    //             location.reload();
    //         });
    // }
});




/*For assign Admin*/

function select_admin(row,id)
{

         var result = confirm("Are you sure you want to Assign to This Partner ?");
         if(result){
        var admin_name = $("#select_partner option:selected").html()
        var partner_id = id.value;
        var row_id = row;
        //alert(row_id+admin_id);
        $.post('<?php echo site_url('admin/lead/assigned_to_partner');?>',
            {'id':row_id,'assigned':partner_id },
            function(resp){
                 alert("You have assgined..!");          
                 location.reload();
                
            });
     }
}


$(document).on('click','.assign-partner', function(){
    $('#assign-lead').modal('show');
    var data_lead_id = $(this).attr('data-lead-id');
    var data_partner_id = $(this).attr('data-partner-id');
    $.post('<?php echo base_url('admin/lead/show_partners_dropdown') ?>',{lead_id: data_lead_id, partner_id: data_partner_id},function(resp){
        $('#showdata').html(resp);
    })
});


function view_assigned(id, history) {
    //alert(id);
  $("#lead_id").val(id);
  //$.post("assignedleads.php", {"aa_id": aa_id});
  $.ajax({
          type: "POST",
          url: '<?php echo site_url('partner/lead/view_assigned_status_details');?>',
           data: {'id': id},
           success: function(res) {
                    //alert(data);
                    //console.log(res);
                    $('#showhistory').html(res);
                }
            });
    if(history == 'history'){

        $('.nav-tabs a[href="#menu1"]').tab('show');   
    }else{
        $('.nav-tabs a[href="#home"]').tab('show');   
    }
          
}




function view(id){
    $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/lead/view_lead_details');?>',
        data: {'id': id},
        success: function(res) {
            $('#showdataview').html(res);
            $('#view').modal('show');
        }
    });
}
</script>
<style>
#example1 tr>th:nth-child(15){min-width:100px;}
	 #example3 tr>th:nth-last-child(2), #example3 tr>td:nth-last-child(2), #example3 tr>th:nth-last-child(3), #example3 tr>td:nth-last-child(3){width:35px!important; min-width:35px!important; }
	 #example3 tr>th:nth-last-child(2), #example3 tr>td:nth-last-child(2), #example3 tr>th:nth-last-child(1), #example3 tr>td:nth-last-child(1){text-align:center;}
     .btn-group-xs>.btn.inactive-btn, .btn-xs.inactive-btn,.approve-btn, .active-btn{width:130px!important;}
</style>

<div class="modal fade" id="lead-history" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">View History</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body pad"> 
                            <div class="form-group" id="showhistory">

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




<div class="modal fade" id="assign-lead" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Assign Leads to Parnter</h4>
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

 <div class="modal fade" id="view" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Lead Details</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body pad">
                        
                            
                            <div class="form-group" id="showdataview">
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
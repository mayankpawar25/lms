<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Deleted Partners
        <small></small>
    </h1>
       <?php echo $breadcrumb; ?>
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <?php 
            //echo anchor('admin/lead/add_lead','<span class= "btn btn-info">Add Lead</span> ' ); 
            ?> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Firm Name</th>
                        <th>Owners Name</th>
                        <th>Contact No.</th>
                        <th>Email ID</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Date Incorporation of the Firm</th>
                        <th>Products Dealing In</th>
                        <!-- <th>Turn Over</th>
                        <th>Current MS % To Over All Business</th>
                        <th>MS Products % share in terms of Value</th>
                        <th>MS Products Promoted in the Past</th> -->
                        <!-- <th>Assigned_to</th> -->
                        <!-- <th>Status</th>
                        <th>Approval</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($partners as $partner){
                        ?>
                        <tr>
                             <th><?php echo $count;  ?></th> 
                             <td><?php echo $partner['firm_name']; ?></td>
                             <td><?php echo $partner['owner_name']; ?></td>
                            <td><?php echo $partner['contact_no']; ?></td>
                            <td><?php echo $partner['email']; ?></td>
                            <td><?php echo $partner['st_name']; ?></td>
                            <td><?php echo $partner['c_name']; ?></td>
                            <td><?php echo $partner['address']; ?></td>
                            <td><?php $date = strtotime($partner['firm_incorporation_date']); echo date('d-m-Y', $date);  ?></td>
                            <td><?php echo $partner['product_dealing_in']; ?></td>
                            <!-- <td><?php echo $partner['turn_over']; ?></td> 
                            <td><?php echo $partner['current_ms_perc_overall_business']; ?></td>
                            <td><?php echo $partner['product_percentage_share_terms_value']; ?></td>
                            <td><?php echo $partner['product_promoted_past']; ?></td> -->
                            
                            <!-- <td>
                               <?php echo ($partner['status']) ? '<a href="javascript:void(0)" st-data-id="'.$partner['id'].'" class="active-lang "><span class="active-btn btn-success btn-xs">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$partner['id'].'" class="inactive-lang  "><span class="inactive-btn btn-xs">Inactive</span></a>' ?>
                            </td> -->
                            <!-- <td style="text-align: center;">
                               <?php echo ($partner['approval']) ? '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="approved-partn "><span class="active-btn btn-success btn-xs">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="disapprove-partn  "><span class="inactive-btn btn-xs">Disapproved</span></a>' ?>
                            </td> -->
                            <td>
                                <!-- <?php echo anchor('admin/partner/edit_partner/'.$partner['id'], '<span class= "btn btn-xs btn-info"><i class="fa fa-edit"></i></span> ' ); ?> -->
                                <!-- <span class= "btn btn-xs btn-danger" onclick="delete_partner(<?php echo $partner['id'];?>)"><i class="fa fa-trash"></i></span> -->
                                <?php if($partner['approval']==1){ ?>
                                        <!-- <button type="button" class="btn btn-xs btn-primary" onclick="sendmail_to_partner(<?php echo $partner['id']; ?>)"> <i class="fa fa-envelope"></i></button> -->
                                <?php } ?>


                                <span class= "btn btn-xs btn-info" title="Restore Partner" onclick="restore(<?php echo $partner['id'] ?>)"><i class="fa fa-undo"></i></span>
                                <span class= "btn btn-success btn-xs" data-toggle="modal" data-target="#view" onclick="view(<?php echo $partner['id']; ?>)"  title="View Partner Details"><i class="fa fa-eye"></i></span>
                            </td>
                       </tr>
                       <?php
                       $count++;
                   }
                   ?>
               </tbody>
           </table>
       </div></div>
       <!-- /.box-body -->
   </div>
   <!-- /.box -->
</section>
<!-- /.content -->
</div>
<script>
$('#example1').DataTable();
</script>
<script type="text/javascript">
function delete_partner(id){
    //alert(id);
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/partner/delete_partner');?>',
            data:{'id':id},
            success: function(responce){
            }
        });
        alert("Partner Deleted..!");
        location.reload();
    }
}

function view(id) {
    //alert(id);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('admin/partner/view_deleted_partner_details');?>',
                // async: false,
                data: {'id': id},

                //dataType: 'json',
                success: function(res) {
                    //alert(res);
                    //console.log(res);
                    $('#showdataview').html(res);
                    //$('#view').modal('show');
                }
            });
        }
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Active this Parner ?");
    if(result){      
        var id = $(this).attr('st-data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/update_status_partner');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class="active-btn btn-success btn-xs">Active</span></a>';
                eve.html(html_data);
                location.reload();
            });
    }
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Inactive this Parner ?");
    if(result){
        var id = $(this).attr('st-data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/update_status_partner');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="inactive-btn  btn-xs">Inactive</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
});
/* script for partner Approval */
$(document).on('click','.disapprove-partn, .disapprove-partn.label.label-default',function(){
    var result = confirm("Are you sure you want to Approve this Partner ?");
    if(result){      
        var id = $(this).attr('data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/approved_disapproved_partner');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" active-btn btn-success btn-xs">Approved</span></a>';
                eve.parent('td').html(html_data);

                // location.reload();
            });
    }
});
$(document).on('click','.approved-partn, .approved-partn.label.label-default',function(){
    var result = confirm("Are you sure you want to Disapproved this Partner ?");
    if(result){
        var id = $(this).attr('data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/approved_disapproved_partner');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="inactive-btn btn-xs">Disapproved</span></a>';
                eve.parent('td').html(html_data);
                // eve.parent('td').replaceWith('<a href="javascript:void(0)" data-id="4" class="disapprove-partn  "><span class="btn inactive-btn">Disapproved</span></a>');
                // location.reload();
            });
    }
});
/*For assign Admin*/
function select_admin(row,id)
{
        var result = confirm("Are you sure you want to assign to This Admin ?");
        if(result){
        var admin_name = $("#select_admin option:selected").html()
        var admin_id = id.value;
        var row_id = row;
        $.post('<?php //echo site_url('admin/partner/assigned_to_admin');?>',
            {'id':row_id,'assigned':admin_id },
            function(resp){
                alert("You have assgined..!");          
                location.reload();
            });
     }
}
/*Send email to partner with his login ID and Password */
function sendmail_to_partner(id){
            var return_confirmation = confirm('Are you sure! You want to send Credentials to this partner ?');
            if(return_confirmation){
                $.post('<?php echo site_url('admin/partner/send_email');?>',
                    {'id':id},function(resp){
                    if(resp){
                        alert('Email Sent Successfully..!');
                    }
                });
            }
        }


function restore(id){
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Restore this Partner ?",
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
            text: 'Your Partner Restored Successfully..!',
            type: 'success'
          }, function(isConf){
              if (!isConf) return;
              $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/partner/restore_partner');?>',
        data: {'id': id},
        success: function(res){
            //alert("Partner restored successfully.!");
            location.reload();
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
<style type="text/css">
    
    #example1_wrapper tr>th:nth-child(11){min-width:100px;}
</style>

<div class="modal fade" id="view" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Deleted Partner Details</h4>
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
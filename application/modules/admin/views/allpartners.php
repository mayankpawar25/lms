<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Partners
        <small></small>
    </h1>
       <?php echo $breadcrumb; ?>
</section>

<?php
     if($this->session->flashdata('success_partner')){?>
       
    <script type="text/javascript">
    $(document).ready(function() {
     swal({
      title: "<?php echo $this->session->flashdata('success_partner'); ?>",
      //text: "<?php echo $this->session->flashdata('success_partner'); ?>",
      //timer: 1500,
      showConfirmButton: true,
      type: 'success'
       });
       });
      </script> 



    <?php }else if($this->session->flashdata('error_partner')){ ?>
        
    <script type="text/javascript">
    $(document).ready(function() {
     swal({
      title: "<?php echo $this->session->flashdata('error_partner'); ?>",
      //text: "<?php echo $this->session->flashdata('error_partner'); ?>",
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
            //echo anchor('admin/lead/add_lead','<span class= "btn btn-info">Add Lead</span> ' ); 
            ?> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table id="example2" class="table table-bordered table-striped">
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
                        <th>Status</th>
                        <th>Approval</th>
                        <th >Action</th>
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
                            
                            <td>
                               <?php echo ($partner['status']) ? '<a href="javascript:void(0)" st-data-id="'.$partner['id'].'" class="active-lang "><span class="active-btn btn-success btn-xs">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$partner['id'].'" class="inactive-lang  "><span class="inactive-btn btn-danger btn-xs">Inactive</span></a>' ?>
                            </td>
                            <td style="text-align: center;">
                               <?php echo ($partner['approval']) ? '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="approved-partn "><span class="active-btn btn-success btn-xs approve-btn">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="disapprove-partn  "><span class="inactive-btn btn-warning btn-xs">Waiting For Approval</span></a>' ?>
                            </td>
                            <td>
                                <?php echo anchor('admin/partner/edit_partner/'.$partner['id'], '<span class= "btn btn-xs btn-info"><i class="fa fa-edit"></i></span> ' ); ?>
                                <span class= "btn btn-xs btn-danger" onclick="delete_partner(<?php echo $partner['id'];?>)"><i class="fa fa-trash"></i></span>
                                <?php if($partner['approval']==1){ ?>
                                        <button type="button" class="btn btn-xs btn-primary" onclick="sendmail_to_partner(<?php echo $partner['id']; ?>)"> <i class="fa fa-envelope"></i></button>
                                <?php } ?>

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
$('#example2').DataTable();
</script>
<script type="text/javascript">
function delete_partner(id){
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Delete this Partner ?",
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
            text: 'Your Partner Deleted Successfully..!',
            type: 'success'
          }, function(isConf){
                location.reload();
              if (!isConf) return;
              $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/partner/delete_partner');?>',
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


function view(id) {
    //alert(id);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('admin/partner/view_partner_details');?>',
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

 //For Active the Partner   
$(document).on('click','.inactive-lang',function(){
    var id = $(this).attr('st-data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Active this Parner ?",
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
            text: 'Partner Activated Successfully..!',
            type: 'success'
          }, function(isConf){ 
                //location.reload();
              if (!isConf) return;
              
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/update_status_partner');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  class="active-lang "><span class="active-btn btn-success btn-xs">Active</span></a>';
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
});

/*For Inactive the Partner */
$(document).on('click','.active-lang',function(){
    var id = $(this).attr('st-data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Inactive this Parner ?",
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
            text: 'Partner Deactivated Successfully..!',
            type: 'success'
          }, function(isConf){
                //location.reload();
              if (!isConf) return;
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/update_status_partner');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="inactive-btn btn-danger btn-xs">Inactive</span></a>';
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
});

/* script for partner Approval */
$(document).on('click','.disapprove-partn',function(){
    
    var id = $(this).attr('data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Approve this Partner ?",
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
            text: 'Partner Approved Successfully..!',
            type: 'success'
          }, function(isConf){
                //location.reload();
              if (!isConf) return;
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/approved_disapproved_partner');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="approved-partn" ><span class=" btn-xs active-btn  btn-success">Approved</span></a>';
                eve.parent('td').html(html_data);
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
});

/*For Disapproved the Partner*/
$(document).on('click','.approved-partn',function(){
    var id = $(this).attr('data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Disapproved this Partner ?",
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
            text: 'Partner Disapproved Successfully..!',
            type: 'success'
          }, function(isConf){
                //location.reload();
              if (!isConf) return;
        
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/partner/approved_disapproved_partner');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="disapprove-partn"><span class="btn-xs btn-danger inactive-btn">Waiting For Approval</span></a>';
                eve.parent('td').html(html_data);
                // eve.parent('td').replaceWith('<a href="javascript:void(0)" data-id="4" class="disapprove-partn  "><span class="btn inactive-btn">Disapproved</span></a>');
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
</script>
<style type="text/css">
    
    #example1_wrapper tr>th:nth-child(11){min-width:100px;}
	#example2 tr>th:last-child, #example2 tr>td:last-child, #example2 tr>th:nth-last-child(3), #example2 tr>td:nth-last-child(3){width:35px!important; min-width:35px!important; }
	#example2 tr>th:nth-last-child(3), #example2 tr>td:nth-last-child(3){text-align:center;}
    .btn-group-xs>.btn.inactive-btn, .btn-xs.inactive-btn,.approve-btn, .active-btn{width:130px!important;}
	
</style>


<div class="modal fade" id="view" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Partner Details</h4>
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
 <style>
 	.btn-warning, .btn{border-radius:0!important; }
	span.inactive-btn.btn-xs, span.active-btn.btn-xs {
    padding: 4px 5px;
}
 </style>
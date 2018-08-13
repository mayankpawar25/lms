<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Deleted RSM
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
            //echo anchor('admin/distributor/add_distributor','<span class= "btn btn-info">Add Distributor</span> ' ); 
            ?> 
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
            <div class="table-responsive">
            <table id="example9" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>ID</th>
                        <th>Registration Date</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Mobile No.</th>
                        <th>Zone Name</th>
                        <th>States</th>
                        <!-- <th>Status</th> -->
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
                            <td><!-- <?php echo $rs['id']; ?> --></td>      
                            <td><?php echo date( "d-m-Y", strtotime ( $rs['registration_date'] ) ); ?></td>
                            <td><?php echo $rs['name']; ?></td>
                            <!-- <td><?php echo $rs['city_name']; ?></td> -->
                            <!-- <td><?php // echo $lead['pin_code']; ?></td> -->
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

                            <!-- <td>
                                    
                                <?php 
                                
                                 echo ($rs['status']) ? '<a href="javascript:void(0)" st-data-id="'.$rs['id'].'" class="active-lang "><span class="btn-xs btn-success active-btn" title="Activate Account">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$rs['id'].'" class="inactive-lang  "><span class="btn-xs btn-danger inactive-btn" title="Deactivate Account">Inactive</span></a>' 
                                
                                ?>

                            </td> -->

                            <td>
                                
                                <span class= "btn btn-xs btn-info" title="Restore RSM" onclick="restore(<?php echo $rs['id'] ?>)"><i class="fa fa-undo"></i></span>

                                <!-- <span class= "btn btn-xs btn-danger" onclick="delete_lead(<?php echo $rs['id'];?>)" title="Delete Leads" ><i class="fa fa-trash"></i></span> -->

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
$('#example9').DataTable();
</script>
<script type="text/javascript">
function delete_lead(id){

    //alert(id);
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/lead/delete_lead');?>',
            data:{'id':id},
            success: function(responce){
            }
        });
        alert("Lead Deleted..!");
        location.reload();
    }
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Active this Lead ?");
    if(result){      
        var id = $(this).attr('st-data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/update_status_lead');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn-xs active-btn  btn-success">Active</span></a>';
                eve.html(html_data);
                location.reload();
            });
    }
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Inactive this Lead ?");
    if(result){
        var id = $(this).attr('st-data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/update_status_lead');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs btn-default inactive-btn">Inactive</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
});


/* script for partner Approval */


$(document).on('click','.disapprove-partn, .disapprove-partn.label.label-default',function(){
    var result = confirm("Are you sure you want to Approve this Lead ?");
    if(result){      
        var id = $(this).attr('data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/approved_disapproved_lead');?>',
            {'id':id,'approval':status_check},
            function(resp){


                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn-xs active-btn  btn-success">Approved</span></a>';
                eve.html(html_data);
                location.reload();
            });
    }
});
$(document).on('click','.approved-partn, .approved-partn.label.label-default',function(){
    var result = confirm("Are you sure you want to Disapproved this Lead ?");
    if(result){
        var id = $(this).attr('data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/lead/approved_disapproved_lead');?>',
            {'id':id,'approval':status_check},
            function(resp){

                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs btn-default inactive-btn">Disapproved</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
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

function view(id){
    //alert(id);
    $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/rsm/view_deleted_rsm_details');?>',
        data: {'id': id},
        success: function(res) {
            //alert(res);
            $('#showdataview').html(res);
            //$('#view').modal('show');
        }
    });
}


function restore(id){
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Restore this RSM ?",
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
            text: 'Your RSM Restored Successfully..!',
            type: 'success'
          }, function(isConf){
              if (!isConf) return;
              $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/rsm/restore_rsm');?>',
        data: {'id': id},
        success: function(res) {
            //alert("RSM restored successfully.!");
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
<style>
#example9 tr>th:nth-child(15){min-width:100px;}
#example9 tr>th:last-child, #example9 tr>td:last-child{width:35px!important; min-width:35px!important; }
</style>

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
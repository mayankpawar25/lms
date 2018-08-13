<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Deleted Leads
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lead ID</th>
                        <th>Registration Date</th>
                        <th>Name</th>
                        <th>City</th>
                        
                        <th>Sales Motion</th>
                        <th>Segment</th>
                        <th>Value of Deal</th>
                        <th>Product Required</th>
                        <th>Involvement</th>
                        
                        <th>Current Status Lead</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($leads as $lead){

                    ?>
                        <tr>
                            <th><?php echo $count;  ?></th>
                            <td><?php  echo $lead['id']; ?></td>      
                            <td><?php echo date( "d/m/Y", strtotime ( $lead['registration_date'] ) ); ?></td>
                            <td><?php echo $lead['customer_name']; ?></td>
                            <td><?php echo $lead['city_name']; ?></td>
                            
                            <td><?php echo $lead['motion_types']; ?></td>
                            <td><?php echo $lead['segment_types']; ?></td>
                            <td><?php echo $lead['deal_types']; ?></td>
                            <td><?php echo $lead['product_required']; ?></td>
                            <td><?php echo $lead['involvement_types']; ?></td>
                            
                            <td><?php echo $lead['status_types']; ?></td>
                            
                            <td>
                                <span class= "btn btn-xs btn-info" title="Restore Lead" onclick="restore(<?php echo $lead['id'] ?>)"><i class="fa fa-undo"></i></span>

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
$('#example1').DataTable();
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


function restore(id){
    var result = confirm("Are you sure you want to Restore this Lead ?");
    if(result){
    $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/lead/restore_lead');?>',
        data: {'id': id},
        success: function(res) {
            alert("Lead restored successfully.!");
            location.reload();
        }
    });
  }
}
</script>
<style>
#example1 tr>th:nth-child(15){min-width:100px;}
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
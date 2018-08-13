<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Created Leads
        <small></small>
    </h1>
     <?php echo $breadcrumb; ?>
   <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol> -->
</section>


            <?php
     if($this->session->flashdata('success_edit_lead')){?>
       <!--  <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
            <strong>Success!</strong> <?php echo $this->session->flashdata('success_add_lead'); ?>
        </div> -->

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
    <?php }else if($this->session->flashdata('error_edit_lead')){ ?>
        <!-- <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
             <strong>Error!</strong>  <?php echo $this->session->flashdata('error_add_lead'); ?>
        </div> -->

         <script type="text/javascript">
          $(document).ready(function() {
              swal({
                  title: "<?php echo $this->session->flashdata('error_edit_lead'); ?>",
                  //text: "<?php echo $this->session->flashdata('error_add_lead'); ?>",
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
        <div class="box-header text-right">
            <?php 
            echo anchor('partner/lead/add_lead','<span class= "btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Add Lead</span> ' ); 
            ?> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Registration Date</th>
                        <th>Name</th>
                        <th>Product Required</th>
                        <th>Involvement</th>
                        <th>Expected Closing Date</th>
                        <th>Microsoft BDM working with him</th>
                        <th >Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($leads as $lead){
                      ?>
                        <tr>
                            <th><?php echo $count;  ?></th>
                            <td><?php echo date( "d-m-Y", strtotime ( $lead['registration_date'] ) ); ?></td>
                            <td><?php echo $lead['customer_name']; ?></td>
                            <td><?php echo $lead['product_required']; ?></td>
                            <td>
                                <?php
                                if($lead['involvement']==$lead['involvement_id']){ 
                                echo $lead['involvement_types']; }
                                ?>
                                    
                            </td>
                            <td>
                                <?php
                                if($lead['expected_closing_date']==$lead['closing_date_id']) {
                                echo $lead['days_types']; }
                                ?>
                                    
                            </td>
                            <td>
                                <?php
                                if($lead['ms_bdm']==$lead['bdm_id']) {
                                echo $lead['bdm_name']; }
                                ?> 
                                    
                            </td>
                           
                            <td>
                                <?php echo anchor('partner/lead/edit_lead/'.base64_encode($lead['id']), '<span class= "btn btn-info btn-xs" title="Edit Leads"><i class="fa fa-pencil"></i></span> ' ); ?>
                                
                                <!-- <span class= "btn btn-danger btn-xs" onclick="delete_partner(<?php echo $lead['id'];?>)" title="Delete Leads"><i class="fa fa-trash"></i></span> -->


                                <span class= "btn btn-success btn-xs" data-toggle="modal" data-target="#view" onclick="view(<?php echo $lead['id']; ?>)"  title="View Leads Details"><i class="fa fa-eye"></i></span>


                                <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view" onclick="view(<?php echo $lead['id']; ?>)"><i class="fa fa-eye"></i> View</button> -->
                            </td>









                           <!--  <td>
                               <?php // echo ($lead['status']) ? '<a href="javascript:void(0)" st-data-id="'.$lead['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$lead['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
                           </td> -->
                           <!-- <td>
                               <?php 
                               // echo ($lead['approval']) ? '<a href="javascript:void(0)" data-id="'.$lead['id'].'" class="approved-partn "><span class="btn active-btn btn-success">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$lead['id'].'" class="disapprove-partn  "><span class="btn inactive-btn">Disapproved</span></a>' 
                               ?>
                           </td> -->
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
$('#example1').DataTable({
    "processing": true
});
</script>
<script type="text/javascript">


function view(id) {
    //alert(id);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('partner/lead/view_lead_details');?>',
                // async: false,
                data: {'id': id},

                //dataType: 'json',
                success: function(res) {
                    //alert(res);
                    //console.log(res);
                    $('#showdata').html(res);
                    //$('#view').modal('show');
                }
            });
        }

function delete_partner(id){
    //alert(id);
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('partner/lead/delete_lead');?>',
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
        $.post('<?php echo site_url('partner/lead/update_status_lead');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
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
        $.post('<?php echo site_url('partner/lead/update_status_lead');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
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
        $.post('<?php echo site_url('partner/lead/approved_disapproved_lead');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Approved</span></a>';
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
        $.post('<?php echo site_url('partner/lead/approved_disapproved_lead');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Disapproved</span></a>';
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
        $.post('<?php echo site_url('partner/lead/assigned_to_partner');?>',
            {'id':row_id,'assigned':partner_id },
            function(resp){
                 alert("You have assgined..!");          
                 location.reload();
            });
     }
}
</script>
<style>
#example1 tr>th:nth-child(8){min-width:100px;}
#example1 tr>th:last-child, #example1 tr>td:last-child{width:35px!important; min-width:35px!important; }
</style>
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
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Assigned Leads
        <small></small>
    </h1>
     <?php echo $breadcrumb; ?>
   <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol> -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <?php 
            // echo anchor('partner/lead/add_lead','<span class= "btn btn-info">Add Lead</span> ' ); 
            ?> 
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lead ID</th> 
                        <th>Registration Date</th>
                        <th>Name</th>
                        <!-- <th>City</th>
                        <th>Pin Code</th>
                        <th>Sales Motion</th>
                        <th>Segment</th>
                        <th>Value of Deal</th>

                        <th>Total Deale Value</th>
                        <th>SKU's</th>
                        <th>Expected Licenses</th>
                        <th>Product</th>
                        <th>Deal Size</th>
                        <th>Tender Type</th> -->
                        
                        <th>Product Required</th>
                        <th>Involvement</th>
                        <th>Expected Closing Date</th>
                        <th>Current Status Lead</th>
                        <th>Microsoft BDM working with him</th>
                        <th >Action</th>
                        <!-- <th>Status</th> -->
                        <!-- <th>Approval</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    //echo"<pre>"; print_r($assigned_leads);
                    foreach ($assigned_leads as $lead){

                        ?>


                        <tr>
                            <th><?php echo $count;  ?></th>
                            <td><?php echo $lead['id']; ?></td>
                            <!-- <td><?php echo $lead['registration_date']; ?></td> -->
                            <td><?php echo date( "d-m-Y", strtotime ( $lead['registration_date'] ) ); ?></td>
                            <td><?php echo $lead['customer_name']; ?></td>
                            <!-- <td>

                                <?php 
                                if($lead['customer_city']==$lead['city_id'])
                                echo $lead['city_name']; 
                                ?></td>
                            <td><?php echo $lead['pin_code']; ?></td>
                            <td>
                                <?php 
                                if($lead['sales_motion']==$lead['sales_motion_id'])
                                echo $lead['motion_types']; ?>
                                    
                                </td>
                            <td>
                                <?php 
                                if($lead['customer_segment']==$lead['customer_segment_id'])
                                echo $lead['segment_types']; 
                                ?>
                                    
                            </td>
                            <td>
                                <?php 
                                if($lead['value_of_deal']==$lead['value_of_deal_id'])
                                echo $lead['deal_types']; 
                                ?>
                                    
                            </td>

                            <td>
                                <?php 
                                
                                echo $lead['total_deal_value']; 
                                ?>
                                    
                            </td>

                            <td>
                                <?php 
                                
                                echo $lead['sku']; 
                                ?>
                                    
                            </td>

                            <td>
                                <?php 
                                
                                echo $lead['expected_license']; 
                                ?>
                                    
                            </td>

                            <td>
                                <?php 
                                
                                echo $lead['product']; 
                                ?>
                                    
                            </td>


                            <td>
                                <?php 
                                
                                echo $lead['deal_size']; 
                                ?>
                                    
                            </td>

                            <td>
                                <?php 
                                
                                echo $lead['tender_type']; 
                                ?>
                                    
                            </td> -->
                            <td><?php echo $lead['product_required']; ?></td>
                            <td>
                                <?php
                                if($lead['involvement']==$lead['involvement_id']) 
                                echo $lead['involvement_types']; 
                                ?>
                                    
                            </td>
                            <td>
                                <?php
                                if($lead['expected_closing_date']==$lead['closing_date_id']) 
                                echo $lead['days_types']; 
                                ?>
                                    
                            </td>
                            <td>
                                <?php                                    
                                        echo $lead['followup_status']; 
                                ?>
                                    
                            </td>


                            <td>
                                <?php
                                if($lead['ms_bdm']==$lead['bdm_id']) {
                                echo $lead['bdm_name']; }
                                ?>
                                    
                            </td>

                            
                            <!-- <td>
                                <?php
                                 
                                echo $lead['order_lost']; 
                                ?>
                                    
                            </td> -->
                            <td>
                                 <span title="Follow ups" class= "btn btn-info btn-xs" data-toggle="modal" data-target="#assigned_view" onclick="view_assigned(<?php echo $lead['id']; ?>)",''><i class="fa fa-pencil"></i></span>
                               <!--  <?php echo anchor('partner/lead/edit_assigned_lead/'.$lead['id'], '<span class= "btn btn-info btn-xs"><i class="fa fa-pencil"></i></span> ' ); ?> -->
                                <!-- <span class= "btn btn-danger" onclick="delete_partner(<?php echo $lead['id'];?>)"><i class="fa fa-trash"></i></span>
 -->
                                <span title="View Assigned Leads" class= "btn btn-success btn-xs" data-toggle="modal" data-target="#view" onclick="view(<?php echo $lead['id']; ?>)"><i class="fa fa-eye"></i></span>

                                <span title="Leads Followup History" class= "btn btn-warning btn-xs" data-toggle="modal" data-target="#assigned_view" onclick="view_assigned(<?php echo $lead['id']; ?>,'history')"><i class="fa fa-history"></i></span>

                            </td>
                            <!-- <td>
                               <?php // echo ($lead['status']) ? '<a href="javascript:void(0)" st-data-id="'.$lead['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$lead['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
                           </td> -->
                           <!-- <td>
                               <?php 
                                echo ($lead['approval']) ? '<a href="javascript:void(0)" data-id="'.$lead['id'].'" class="approved-partn "><span class="btn active-btn btn-success">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$lead['id'].'" class="disapprove-partn  "><span class="btn inactive-btn">Disapproved</span></a>' 
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
$('#example2').DataTable();
</script>
<script type="text/javascript">

function view_assigned(id, history) {
    //alert(id);
  $("#lead_id").val(id);

/*Get Leads Name by id*/
   $.ajax({
          type: "POST",
          url: '<?php echo site_url('partner/lead/get_leads_name_by_id');?>',
           data: {'id': id},
           success: function(response) {
                    //alert(data);
                    //console.log(res);
                    $('.status_lead_name').html(response);
                }
            });

  //$.post("assignedleads.php", {"aa_id": aa_id});
   /*Lead Status history*/
  $.ajax({
          type: "POST",
          url: '<?php echo site_url('partner/lead/view_assigned_status_details');?>',
           data: {'id': id},
           success: function(res) {
                    //alert(data);
                    //console.log(res);
                    $('#myshowdata').html(res);
                }
            });
    if(history == 'history'){
        $('.nav-tabs a[href="#menu1"]').tab('show');   
    }else{
        $('.nav-tabs a[href="#home"]').tab('show');   
    }
          
}

function view(id) {
    //alert(id);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('partner/lead/view_lead_details');?>',
                data: {'id': id},
                success: function(res) {
                    //alert(data);
                    //console.log(res);
                    $('#showdata').html(res);
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
#example2 tr>th:last-child, #example2 tr>td:last-child{width:35px!important; min-width:35px!important; }
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

<div class="modal fade" id="assigned_view" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <!-- <h4 class="modal-title">Follow Up Status</h4> -->
                <h4 class="modal-title"><span class="status_lead_name"></span> </h4>
            </div>
            <div class="modal-body">
                <div class="box-body pad">
                                <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Update Status</a></li>
                        <li><a data-toggle="tab" href="#menu1">Status History</a></li>
                        
                    </ul>
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
    <form method="post" action="<?php echo site_url('partner/lead/edit_assigned_lead');?>" enctype="multipart/form-data">
                        <div class="col-sm-12">
                            <div class="form-group">
                               <?php 
                                //echo "<pre>"; print_r($assigned_leads);

                                    $logged_partner_data = $this->session->userdata('logged_in');
                                    $partner_id = $logged_partner_data->partner_id; ?>
                                            <input type="hidden" name="lead_id" id="lead_id" value="">
                                            <input type="hidden" name="partner_id" id="partner_id" value="<?php echo $partner_id ?>">
                                
                               <?php //foreach ($assigned_leads as $lead){
                                        //if($lead['assigned_to_partner']==$partner_id){ ?>
                                           
                                <label>Status</label>
                                <select class="form-control" name="status" id="status" >
                                    <option value="">Select Status</option>
                                    <?php
                                    if(!empty($followup_status))
                                    {

                                    foreach ($followup_status as $status) {
                                    ?>
                                    <option <?php if($lead['followup_status_id']==$status['id']){ ?> selected="selected" <?php }?> value="<?php echo $status['id']; ?>"><?php echo $status['status']; ?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('status'); ?>
                            </div>
                        </div>
                             <?php  //}//} ?>    
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label>Description</label>
                             <textarea id="assgined_description" name="assgined_description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                             <div class="form-group">
                        <input type="submit" name="" id="assgined_submit" class="btn btn-primary" style="border-radius:0;" />
                    </div>
                    </div>
                    </form>
   
    </div>

<div id="menu1" class="tab-pane fade">
    <h3></h3>
    <form method="post" action="<?php echo site_url('partner/lead/edit_assigned_lead');?>" enctype="multipart/form-data">
        <div class="col-sm-12">
            <div class="form-group">
               <h3>History</h3>
                <div class="" id="myshowdata"></div>
    <!-- <?php //echo"<pre>"; print_r($followup_status);
        $count=1;?>
        <?php foreach ($assigned_status as $status) {
        $logged_partner_data = $this->session->userdata('logged_in');
        $partner_id = $logged_partner_data->partner_id;
        if($status['partner_id']==$partner_id){ ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered follow-table" > 
                <tbody> 
                  
                    <tr>
                        <td>Date</td>
                        <td><?php echo date('d-m-y h:i:sa', strtotime($status['modified'])); ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $status['status']; ?></td>
                    </tr>
                    <tr>
                        <td>Note</td>
                        <td><?php echo $status['description']; ?></td>
                    </tr>
                </tbody>
            </table> 
            <style type="text/css">
            .follow-table tr td:nth-child(1){width:40%;}
            .follow-table{    border: 2px solid #eee;}
            </style>
        </div>
        <?php  $count ++; } } ?> -->
                                                   
                                            </div>
                                                    
                                                    
                                                
                                        </div>
                                </div>
               
                        </div>
            <!-- /.modal-content -->
                </div>
        <!-- /.modal-dialog -->
        </div>
        </div>
    </div>
</div>
    <div class="clearfix"></div>
    <style>
        
           #myshowdata{ max-height: 340px;
    overflow-y: scroll;
}
}
    </style>
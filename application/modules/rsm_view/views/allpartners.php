<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Partners
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
                        <th>Owners Name</th>
                        <th>Contact No.</th>
                        <th>Email ID</th>
                        <th>Date Incorporation of the Firm</th>
                        <th>State</th>
                        <th>Products Dealing In</th>
                        <th>Status</th>
                        <th>Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $count=1;
                foreach ($partner_by_id as $key => $value) {
                    $exp = explode(",",$partner_by_id[$key]['states']);
                     for($i=0; $i<=count($exp); $i++){
                        if (!empty($exp[$i])) {
                            //echo $exp[$i];
                            $satat = $this->partners->getpartnerbystateId($exp[$i]);
                           /* echo"<pre>";
                            print_r($satat);*/
                    foreach ($satat as $partner){
                                         
                        ?>
                        <tr>
                            <th><?php echo $count;  ?></th> 
                            <td><?php echo $partner['owner_name']; ?></td>
                            <td><?php echo $partner['contact_no']; ?></td>
                            <td><?php echo $partner['email']; ?></td>
                            <td><?php $date = strtotime($partner['firm_incorporation_date']); echo date('d-m-Y', $date);  ?></td>
                            <td><?php echo $partner['states_name']; ?></td>
                            <td><?php echo $partner['product_dealing_in']; ?></td>
                            <td>
                               <?php echo ($partner['status']) ? '<a href="javascript:void(0)" st-data-id="'.$partner['id'].'" class="active-lang "><span class="active-btn btn-success btn-xs waves-effect">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$partner['id'].'" class="inactive-lang  "><span class="inactive-btn btn-danger btn-xs">Inactive</span></a>' ?>
                            </td>
                            <td style="text-align: center;">
                               <?php echo ($partner['approval']) ? '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="approved-partn "><span class="active-btn btn-success btn-xs waves-effect">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="disapprove-partn  "><span class="inactive-btn btn-danger btn-xs">Disapproved</span></a>' ?>
                            </td>
                            <td>
                                <span class= "btn btn-success btn-xs waves-effect" data-toggle="modal" data-target="#view" onclick="view(<?php echo $partner['id']; ?>)"  title="View Partners Details"><i class="fa fa-eye"></i></span>
                                <?php if($partner['approval']==1){ ?>
                                        <button type="button" class="btn btn-xs btn-primary waves-effect" onclick="sendmail_to_partner(<?php echo $partner['id']; ?>)"> <i class="fa fa-envelope"></i></button>
                                <?php } ?>
                            </td>

                            <!--  <td>
                                <?php //echo anchor('admin/partner/edit_partner/'.$partner['id'], '<span class= "btn btn-xs btn-info"><i class="fa fa-edit"></i></span> ' ); ?>
                                <span class= "btn btn-xs btn-danger" onclick="delete_partner(<?php echo $partner['id'];?>)"><i class="fa fa-trash"></i></span>
                                <?php if($partner['approval']==1){ ?>
                                        <button type="button" class="btn btn-xs btn-primary" onclick="sendmail_to_partner(<?php echo $partner['id']; ?>)"> <i class="fa fa-envelope"></i></button>
                                <?php } ?>
                            </td>   -->
                       </tr>
                       <?php
                    $count++;
                  
                   }
               }
            }
                        
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

</script>

<script type="text/javascript">
// View Partner Info
 function view(id) {
    //alert(id);
            $.ajax({
                type: "POST",
                /*url: '<?php //echo site_url('partner/lead/view_lead_details');?>',*/
                url: '<?php echo site_url('rsm/lead/view_partner_details');?>',
                // async: false,
                data: {'id': id},

                //dataType: 'json',
                success: function(res) {
                    //alert(data);
                    //console.log(res);
                    $('#showdata').html(res);
                    //$('#view').modal('show');
                }
            });
        }   
/* script for partner Active */    
$(document).on('click','.inactive-lang',function(){
    var result = confirm("Are you sure you want to Active this Parner ?");
    if(result){      
        var id = $(this).attr('st-data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('rsm/partner/update_status_partner');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  class="active-lang "><span class="active-btn btn-success btn-xs">Active</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
});
/* script for partner Inactive */
$(document).on('click','.active-lang',function(){
    var result = confirm("Are you sure you want to Inactive this Parner ?");
    if(result){
        var id = $(this).attr('st-data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('rsm/partner/update_status_partner');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="inactive-btn btn-danger btn-xs">Inactive</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
});
/* script for partner Approval */
$(document).on('click','.disapprove-partn',function(){
    var result = confirm("Are you sure you want to Approve this Partner ?");
    if(result){      
        var id = $(this).attr('data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('rsm/partner/approved_disapproved_partner');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="approved-partn" ><span class=" btn-xs active-btn  btn-success">Approved</span></a>';
                eve.parent('td').html(html_data);

                 location.reload();
            });
    }
});
/* script for partner Disapproved */
$(document).on('click','.approved-partn',function(){
    var result = confirm("Are you sure you want to Disapproved this Partner ?");
    if(result){
        var id = $(this).attr('data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('rsm/partner/approved_disapproved_partner');?>',
            {'id':id,'approval':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="disapprove-partn"><span class="btn-xs btn-danger inactive-btn">Disapproved</span></a>';
                eve.parent('td').html(html_data);
                // eve.parent('td').replaceWith('<a href="javascript:void(0)" data-id="4" class="disapprove-partn  "><span class="btn inactive-btn">Disapproved</span></a>');
                location.reload();
            });
    }
});

/*Send email to partner with his login ID and Password */
function sendmail_to_partner(id){
    var return_confirmation = confirm('Are you sure! You want to send Credentials to this partner ?');
    if(return_confirmation){
        $.post('<?php echo site_url('rsm/partner/send_email');?>',
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
	
	
#example1 tr>th:last-child, #example1 tr>td:last-child, #example1 tr>th:nth-last-child(2), #example1 tr>td:nth-last-child(2), #example1 tr>th:nth-last-child(3), #example1 tr>td:nth-last-child(3){width:35px!important; min-width:35px!important; }

	 #example1 tr>th:nth-last-child(2), #example1 tr>td:nth-last-child(2),  #example1 tr>th:nth-last-child(3), #example1 tr>td:nth-last-child(3){text-align:center;}
	
	
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
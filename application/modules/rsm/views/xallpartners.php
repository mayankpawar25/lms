<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Partners
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
                <?php echo anchor('admin/add_newzone','<span class= "btn btn-info">Add Partner</span> ' ); ?> 
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                       <!--  <th>Street</th> -->
                       <th>Country</th>
                       <th>State</th>
                        <th>City</th>
                        <!-- <th>Postal Code</th> -->
                        <!-- <th>Assigned To</th> -->
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=1;
                     foreach ($partners as $partner){
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $partner['name'].'&nbsp'.$partner['first_name'].'&nbsp'.$partner['last_name']; ?></td>
                            <td><?php echo $partner['email']; ?></td>
                            <td><?php echo $partner['phone']; ?></td>
                           <!--  <td><?php echo $sub_distributors['street']; ?></td> -->
                             <td><?php echo $partner['country']; ?></td>
                            <td><?php echo $partner['state']; ?></td>
                            <td><?php echo $partner['city']; ?></td>
                            <!-- <td><?php echo $sub_distributors['postal_code']; ?></td> -->
                            <!-- <td><?php echo $partner['assigned_to']; ?></td> -->
                            <td><?php echo anchor('admin/partner/edit_partner/'.$partner['id'], '<span class= "btn btn-info">Edit</span> ' ); ?> 
                                 <span class= "btn btn-danger" onclick="delete_partner(<?php echo $partner['id'];?>)">Delete</span>
                            </td>
                            <td>
                                <?php echo ($partner['status']) ? '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$partner['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
                            </td>
                        </tr>
                        <?php
                         $count++;
                     }
                    ?>
                    </tbody>
                </table>
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
function delete_partner(id){
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/partner/delete_partner');?>',
            data:{'id':id},
            success: function(responce){
               /* alert(responce);*/
            }
        });
        alert("Partner Deleted..!");
         location.reload();
    }
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
var result = confirm("Are you sure you want to Active this Partner ?");
if(result){      
    var id = $(this).attr('data-id');
    var status_check = 1;
    var eve = $(this);
    $.post('<?php echo site_url('admin/partner/update_status');?>',
    {'id':id,'status':status_check},
    function(resp){
    var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
    eve.html(html_data);
    location.reload();
});
}
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
var result = confirm("Are you sure you want to Inactive this Partner ?");
if(result){
    var id = $(this).attr('data-id');
    var status_check = 0;
    var eve = $(this);
    $.post('<?php echo site_url('admin/partner/update_status');?>',
    {'id':id,'status':status_check},
    function(resp){
    var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
    eve.closest('td').html(html_data);
    location.reload();
});
}
});
</script>

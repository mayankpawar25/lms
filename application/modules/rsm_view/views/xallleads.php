<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Sub-Distributors
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
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            <?php 
            //echo anchor('admin/subdistributor/add_newlead','<span class= "btn btn-info">Add Sub-Distributor</span> ' ); 
            ?>
        </div>
        <!-- /.box-header -->
         
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Approval</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($leads as $lead){


                        echo "<pre>";
                        print_r($leads);
                        die();
                       
                        ?>
                        <tr>
                            <th><?php echo $count;  ?></th>
                            <td><?php echo $subdistributor['name'].'&nbsp'.$subdistributor['first_name'].'&nbsp'.$subdistributor['last_name'] ; ?></td>
                            <td><?php echo $subdistributor['email']; ?></td>
                            <td><?php echo $subdistributor['phone']; ?></td>
                            <td><?php echo $subdistributor['country']; ?></td>
                            <td><?php echo $subdistributor['state']; ?></td>
                            <td><?php echo $subdistributor['city']; ?></td>
                            <td>
                                <?php echo anchor('admin/subdistributor/edit_subdistributor/'.$subdistributor['id'], '<span class= "btn btn-info">Edit</span> ' ); ?>
                                <span class= "btn btn-danger" onclick="delete_distributor(<?php echo $subdistributor['id'];?>)">Delete</span>
                            </td>
                            <td>
                               <?php echo ($subdistributor['status']) ? '<a href="javascript:void(0)" data-id="'.$subdistributor['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$subdistributor['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
                           </td>

                           <td>
                               <?php echo ($subdistributor['status']) ? '<a href="javascript:void(0)" data-id="'.$subdistributor['id'].'" class="active-lang "><span class="btn active-btn btn-success">Approved</span></a>' : '<a href="javascript:void(0)" data-id="'.$subdistributor['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Disapproved</span></a>' ?>
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
function delete_distributor(id){

    //alert(id);
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/subdistributor/delete_subdistributor');?>',
            data:{'id':id},
            success: function(responce){
            }
        });
        alert("Subdistributor Deleted..!");
        location.reload();
    }
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Active this Subdistributor ?");
    if(result){      
        var id = $(this).attr('data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/subdistributor/update_status_subdistributor');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
                eve.html(html_data);
                location.reload();
            });
    }
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Inactive this Subdistributor ?");
    if(result){
        var id = $(this).attr('data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/subdistributor/update_status_subdistributor');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
});
</script>

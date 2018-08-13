

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Sub Distributor
            <small></small>
        </h1>
       <!--  <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol> -->
         <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                <?php echo anchor('admin/add_newzone','<span class= "btn btn-info">Add Sub Distributor</span> ' ); ?> 
            </div>
            <!-- /.box-header -->


            

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                       <!--  <th>Street</th> -->
                        <th>City</th>
                        <th>State</th>
                        <!-- <th>Postal Code</th> -->
                        <th>Country</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=1;
                     foreach ($all_sub_distributor as $sub_distributors){
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>

                            <td><?php echo $sub_distributors['name'].'&nbsp'.$sub_distributors['first_name'].'&nbsp'.$sub_distributors['last_name']; ?></td>

                            <td><?php echo $sub_distributors['email']; ?></td>

                            <td><?php echo $sub_distributors['phone']; ?></td>

                           <!--  <td><?php echo $sub_distributors['street']; ?></td> -->

                            <td><?php echo $sub_distributors['city']; ?></td>

                            <td><?php echo $sub_distributors['state']; ?></td>

                            <!-- <td><?php echo $sub_distributors['postal_code']; ?></td> -->

                            <td><?php echo $sub_distributors['country']; ?></td>

                            <td><?php echo $sub_distributors['assigned_to']; ?></td>

                            <td><?php echo anchor('distributor/distributor/ShowSubDistributorForm/'.$sub_distributors['id'], '<span class= "btn btn-info">Edit</span> ' ); ?> 
                                 <span class= "btn btn-danger" onclick="delete_subdistributor(<?php echo $sub_distributors['id'];?>)">Delete</span>
                            </td>
                            <td>
                                <?php echo ($sub_distributors['status']) ? '<a href="javascript:void(0)" data-id="'.$sub_distributors['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$sub_distributors['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
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
function delete_subdistributor(id){
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('distributor/delete_subdistributor');?>',
            data:{'id':id},
            success: function(responce){
            }
        });
        alert("Sub Distributor Deleted..!");
         location.reload();
    }
}
</script>



<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
var result = confirm("Are you sure you want to Active this zone ?");
if(result){      
    var id = $(this).attr('data-id');
    var status_check = 1;
    var eve = $(this);
    $.post('<?php echo site_url('distributor/update_status');?>',
    {'id':id,'status':status_check},
    function(resp){
    var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
    eve.html(html_data);
    location.reload();
});
}
});




$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
var result = confirm("Are you sure you want to Inactive this zone ?");
if(result){
    var id = $(this).attr('data-id');
    var status_check = 0;
    var eve = $(this);
    $.post('<?php echo site_url('distributor/update_status');?>',
    {'id':id,'status':status_check},
    function(resp){
    var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
    eve.closest('td').html(html_data);
    location.reload();
});
}
});

</script>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Zones
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
                <?php echo anchor('admin/add_newzone','<span class= "btn btn-info">Add Zone</span> ' ); ?>
                
            </div>
            <!-- /.box-header -->


             

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Zone Name</th>
                        <th>Zone Area</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=1;
                     foreach ($zones as $zone){
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $zone['zone_name']; ?></td>
                            <td><?php echo $zone['zone_area']; ?></td>
                            <td>

                                


                                <?php echo anchor('admin/edit_zone/'.$zone['id'], '<span class= "btn btn-info">Edit</span> ' ); ?> 


                                 

                        <span class= "btn btn-danger" onclick="delet_zone(<?php echo $zone['id'];?>)">Delete</span>


                                 </td>


                                 <td>
                                     
<?php echo ($zone['status']) ? '<a href="javascript:void(0)" data-id="'.$zone['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$zone['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>


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

function delet_zone(id){

var result = confirm("Are you sure you want to delete ?");
if (result) {

        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/delete_zone');?>',
            data:{'id':id},
            success: function(responce){
                
            }

            });
        
        alert("Zone Deleted..!");
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
    $.post('<?php echo site_url('admin/update_status');?>',
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
    $.post('<?php echo site_url('admin/update_status');?>',
    {'id':id,'status':status_check},
    function(resp){
    var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
    eve.closest('td').html(html_data);
    location.reload();
});
}
});

</script>

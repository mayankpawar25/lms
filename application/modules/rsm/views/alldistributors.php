<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Distributors
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
            
            <?php 
            //echo anchor('admin/distributor/add_distributor','<span class= "btn btn-info">Add Distributor</span> ' ); 
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($distributors as $distributor){
                        
                        ?>

                        <?php 
                        //email = explode('',$distributor['email'])

                        //foreach ($distributor['email'] as $key => $email) {
                            # code...
                        //}


                         ?>

                        <tr>
                            <th><?php echo $count;  ?></th>
                            <td><?php echo $distributor['name'].'&nbsp'.$distributor['first_name'].'&nbsp'.$distributor['last_name'] ; ?></td>





                            <td><?php echo $distributor['email']; ?></td>
                            <td><?php echo $distributor['phone']; ?></td>
                            <td><?php echo $distributor['country']; ?></td>
                            <td><?php echo $distributor['state']; ?></td>
                            <td><?php echo $distributor['city']; ?></td>
                            <td>
                                <?php echo anchor('admin/distributor/edit_distributor/'.$distributor['id'], '<span class= "btn btn-info">Edit</span> ' ); ?>
                                <span class= "btn btn-danger" onclick="delete_distributor(<?php echo $distributor['id'];?>)">Delete</span>
                            </td>
                            <td>
                               <?php echo ($distributor['status']) ? '<a href="javascript:void(0)" data-id="'.$distributor['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$distributor['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
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
            url:'<?php echo site_url('admin/distributor/delete_distributor');?>',
            data:{'id':id},
            success: function(responce){
            }
        });
        alert("Distributor Deleted..!");
        location.reload();
    }
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Active this Distributor ?");
    if(result){      
        var id = $(this).attr('data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/distributor/update_status_distributor');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
                eve.html(html_data);
                location.reload();
            });
    }
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Inactive this Distributor ?");
    if(result){
        var id = $(this).attr('data-id');
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/distributor/update_status_distributor');?>',
            {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });
    }
});
</script>

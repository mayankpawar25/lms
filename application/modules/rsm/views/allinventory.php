

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventory
            <small></small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
               <!--  <h3 class="box-title">Data Table With Full Features</h3> -->
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Description</th>
                       <!--  <th>Street</th> -->
                        <th>Product Price</th>
                        <th>Stock Quantity</th>
                        <!-- <th>Postal Code</th> -->
                        <th>Sales Out as on Date</th>
                       <th>Action</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=1;
                     foreach ($all_inventory as $inventory){
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>

                            <td><img src="<?php echo base_url().$inventory['product_image']; ?>" style="height: auto; width: 100px"></td>

                            <td><?php echo $inventory['product_name']; ?></td>

                            <td><?php echo $inventory['product_description']; ?></td>

                            <td><?php echo $inventory['product_price']; ?></td>

                            <td><?php echo $inventory['stock_quantity']; ?></td>

                           <td><?php echo $inventory['sales_out_as_on_date']; ?></td>

                           <td><?php echo anchor('admin/inventory/edit_inventory/'.$inventory['id'], '<span class= "btn btn-info">Edit</span> ' ); ?> 
                                 <span class= "btn btn-danger" onclick="delete_inventory(<?php echo $inventory['id'];?>)">Delete</span>
                            </td> 
                            <td>
                                <?php echo ($inventory['status']) ? '<a href="javascript:void(0)" data-id="'.$inventory['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$inventory['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
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
function delete_inventory(id){
    var result = confirm("Are you sure you want to Leads ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/inventory/delete_inventory');?>',
            data:{'id':id},
            success: function(responce){
               /* alert(responce);*/
            }
        });
        alert("Inventory Deleted..!");
         location.reload();
    }
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Active this Leads ?");
    if(result){      
        var id = $(this).attr('data-id');
       /* alert(id);*/
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/inventory/update_status');?>',
        {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
                eve.html(html_data);
                location.reload();
        });
    }
});

$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Inactive this Leads ?");
    if(result){
        var id = $(this).attr('data-id');
        /*alert(id);*/
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/inventory/update_status');?>',
        {'id':id,'status':status_check},
            function(resp){
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
                eve.closest('td').html(html_data);
                //location.reload();
        });
    }
});

</script>








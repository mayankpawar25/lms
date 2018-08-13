

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
                       <!--  <th>Action</th>
                        <th>Status</th> -->
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
<!-- 
                           <td><?php echo anchor('distributor/partner/edit_subdistributor/'.$inventory['id'], '<span class= "btn btn-info">Edit</span> ' ); ?> 
                                 <span class= "btn btn-danger" onclick="delete_partner(<?php echo $inventory['id'];?>)">Delete</span>
                            </td> -->
                           <!--  <td>
                                <?php echo ($inventory['status']) ? '<a href="javascript:void(0)" data-id="'.$inventory['id'].'" class="active-lang "><span class="btn active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" data-id="'.$partners['id'].'" class="inactive-lang  "><span class="btn inactive-btn">Inactive</span></a>' ?>
                            </td> -->
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








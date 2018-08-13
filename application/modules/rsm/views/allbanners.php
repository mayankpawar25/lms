<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Banners
        <small></small>
    </h1>
     <?php echo $breadcrumb; ?>
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header text-right">
            
           
            <?php 
            echo anchor('admin/banner/add_banner','<span class= "btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Add Banner</span> ' ); 
            ?> 
            
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Banner image</th>
                        <th>Content</th>
                        <th>Button Link</th>
                        <th>Button Text</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach ($all_banners as $banner){

                        ?>

                        <tr>
                            <th><?php echo $count;  ?></th>
                            
                            <td>
                                <img src="<?php echo base_url().$banner['image']; ?>" alt="Smiley face" height="42" width="42">
                                <!-- <?php echo $banner['image']; ?> -->
                                
                            </td>
                            <td><?php echo $banner['banner_text']; ?></td>
                            
                            <td><?php echo $banner['button_link']; ?></td>
                             <td><?php echo $banner['button_text']; ?></td>
                              <td><?php echo ($banner['status']) ? '<a href="javascript:void(0)" st-data-id="'.$banner['id'].'" class="active-lang "><span class="btn-xs active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$banner['id'].'" class="inactive-lang  "><span class="btn-xs inactive-btn">Inactive</span></a>' ?></td>
                            
                            <td>
                                <?php echo anchor('admin/banner/edit_banner/'.$banner['id'], '<span class= "btn btn-xs btn-info"><i class="fa fa-pencil"></i></span> ' ); ?>
                                <span class= "btn btn-xs btn-danger" onclick="delete_partner(<?php echo $banner['id'];?>)"><i class="fa fa-trash"></i></span>
                            </td>
                            

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
$('#example1').DataTable();
</script>
<script type="text/javascript">
function delete_partner(id){

    //alert(id);
    var result = confirm("Are you sure you want to delete ?");
    if (result) {
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('admin/banner/delete_banner');?>',
            data:{'id':id},
            success: function(responce){
            }
        });
        alert("Banner Deleted..!");
        location.reload();
    }
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Active this Banner ?");
    if(result){      
        var id = $(this).attr('st-data-id');
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/banner/update_status_banner');?>',
            {'id':id,'status':status_check},
            function(resp){
                //alert(resp);
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class=" btn active-btn  btn-success">Active</span></a>';
                eve.html(html_data);
                //location.reload();
            });
    }
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    var result = confirm("Are you sure you want to Inactive this Banner ?");
    if(result){
        var id = $(this).attr('st-data-id');

        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/banner/update_status_banner');?>',
            {'id':id,'status':status_check},
            function(resp){
                //alert(resp);
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn inactive-btn">Inactive</span></a>';
                eve.closest('td').html(html_data);
                //location.reload();
            });
    }
});

</script>
<style>
#example1 tr>th:nth-child(21){min-width:100px;}
</style>
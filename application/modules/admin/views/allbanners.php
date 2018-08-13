<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        All Banners
        <small></small>
    </h1>
     <?php echo $breadcrumb; ?>
</section>

                <?php
                if($this->session->flashdata('success')){?>
                  
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('success'); ?>",
                      //text: "<?php echo $this->session->flashdata('success'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'success'
                       });
                       });
                    </script>

                <?php }else if($this->session->flashdata('error')){ ?>
                   
                    <script type="text/javascript">
                    $(document).ready(function() {
                     swal({
                      title: "<?php echo $this->session->flashdata('error'); ?>",
                      //text: "<?php echo $this->session->flashdata('error'); ?>",
                      //timer: 1500,
                      showConfirmButton: true,
                      type: 'error'
                     });
                     });
                    </script>

                <?php }?>
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
            <table id="example6" class="table table-bordered table-striped">
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
                              <td><?php echo ($banner['status']) ? '<a href="javascript:void(0)" st-data-id="'.$banner['id'].'" class="active-lang "><span class="btn-xs active-btn btn-success">Active</span></a>' : '<a href="javascript:void(0)" st-data-id="'.$banner['id'].'" class="inactive-lang  "><span class="btn-xs inactive-btn btn-danger">Inactive</span></a>' ?></td>
                            
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
$('#example6').DataTable();
</script>
<script type="text/javascript">
function delete_partner(id){
  swal({
        title: "Confirmation !",
        text: "Are you sure you want to Delete this Banner ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm == true){
          swal({
            title: 'Success!',
            text: 'Your Banner Deleted Successfully..!',
            type: 'success'
          }, function(isConf){
                location.reload();
              if (!isConf) return;
              $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/banner/delete_banner');?>',
        data: {'id': id},
        success: function(responce){
            //alert("RSM restored successfully.!"); 
            }
        });

          })
        }else{
          swal({
            title: 'Cancelled',
            text: 'Your Request Cancelled',
            type: 'error'
          })
        }
    });
}
</script>
<script type="text/javascript">
$(document).on('click','.inactive-lang, .inactive-lang.label.label-default',function(){
    
    var id = $(this).attr('st-data-id');
  swal({
        title: "Confirmation !",
        text: "Are you sure you want to Active this Banner ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm == true){
          swal({
            title: 'Success!',
            text: 'Banner Active Successfully..!',
            type: 'success'
          }, function(isConf){
                location.reload();
              if (!isConf) return;
              
        var status_check = 1;
        var eve = $(this);
        $.post('<?php echo site_url('admin/banner/update_status_banner');?>',
            {'id':id,'status':status_check},
            function(resp){
                //alert(resp);
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class="btn-xs active-btn  btn-success">Active</span></a>';
                eve.html(html_data);
                location.reload();
            });  
          })
        }else{
          swal({
            title: 'Cancelled',
            text: 'Your Request Cancelled',
            type: 'error'
          })
        }
    });



    // var result = confirm("Are you sure you want to Active this Banner ?");
    // if(result){      
    //     var id = $(this).attr('st-data-id');
    //     var status_check = 1;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/banner/update_status_banner');?>',
    //         {'id':id,'status':status_check},
    //         function(resp){
    //             //alert(resp);
    //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'"  ><span class="btn-xs active-btn  btn-success">Active</span></a>';
    //             eve.html(html_data);
    //             location.reload();
    //         });
    // }
});
$(document).on('click','.active-lang, .active-lang.label.label-default',function(){
    
    var id = $(this).attr('st-data-id');
    swal({
        title: "Confirmation !",
        text: "Are you sure you want to Inactive this Banner ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm){
        if(isConfirm == true){
          swal({
            title: 'Success!',
            text: 'Banner Active Successfully..!',
            type: 'success'
          }, function(isConf){
                location.reload();
              if (!isConf) return;
        var status_check = 0;
        var eve = $(this);
        $.post('<?php echo site_url('admin/banner/update_status_banner');?>',
            {'id':id,'status':status_check},
            function(resp){
                //alert(resp);
                var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs inactive-btn btn-danger ">Inactive</span></a>';
                eve.closest('td').html(html_data);
                location.reload();
            });  
          })
        }else{
          swal({
            title: 'Cancelled',
            text: 'Your Request Cancelled',
            type: 'error'
          })
        }
    });  


    // var result = confirm("Are you sure you want to Inactive this Banner ?");
    // if(result){
    //     var id = $(this).attr('st-data-id');

    //     var status_check = 0;
    //     var eve = $(this);
    //     $.post('<?php echo site_url('admin/banner/update_status_banner');?>',
    //         {'id':id,'status':status_check},
    //         function(resp){
    //             //alert(resp);
    //             var html_data = '<a href="javascript:void(0)" data-id="'+id+'" class="inactive-lang "><span class="btn-xs inactive-btn btn-danger ">Inactive</span></a>';
    //             eve.closest('td').html(html_data);
    //             location.reload();
    //         });
    // }
});

</script>
<style>
#example6 tr>th:nth-child(21){min-width:100px;}



#example6 tr>th:last-child, #example6 tr>td:last-child, #example6 tr>th:nth-last-child(2), #example6 tr>td:nth-last-child(2){width:35px!important; min-width:35px!important; }

	 #example6 tr>th:nth-last-child(2), #example6 tr>td:nth-last-child(2){text-align:center;}
</style>
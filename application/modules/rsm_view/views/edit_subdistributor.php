
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
                <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

             <?php 

            if($this->session->flashdata('success')){
             ?>
                
             <?php echo $this->session->flashdata('success'); ?>               

            <?php 
            
            }else if($this->session->flashdata('error')){ 

            ?>   

            <?php echo $this->session->flashdata('error'); ?>

            <?php 

            }
             ?>
            <form method=post action="<?php echo current_url();?>">

              Zone Name<br>
              <input type="text" name="zone_name" pattern="[a-zA-Z\s]+" title="Alfabets Only" value="<?php echo $zone_detail[0]['zone_name']  ?>">
              <br>
              Zone Area:<br>
              <input type="text" name="zone_area" pattern="[a-zA-Z\s]+" title="Alfabets Only" value="<?php echo $zone_detail[0]['zone_area'] ?>">
              <br><br>
              <input type="submit" value="Submit" class="btn-sm btn-info">
            </form>
                           
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
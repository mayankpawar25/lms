<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br />
    <div class="col-sm-12">
   <div class="box">
            <div class="box-header"> 
            <div class="content-header" style="padding:0;">
     <div class="col-sm-6">
        <h1>
            Dashboard
            <!-- <small>it all starts here</small> -->
        </h1>
        </div>
        <div class="col-sm-6">
        <?php echo $breadcrumb; ?>
        </div>
     
    </div>   </div></div>
</div>
<div class="clearfix"></div>
    <!-- Main content -->
    <section class="content" >

        <!-- Default box -->
        <div class="box">
          
            <!-- /.box-header -->
            <div class="box-body" style="padding-bottom:0;" >
                <div class="row">
             <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo base_url()?>admin/partner/all_partners">
                        <span class="info-box-icon terques-bg"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number"><?php echo $total_partners['total'];?></span>
                            <span class="info-box-text">Total Partners</span>
                            
                        </div>
                  <!--   </a> -->
                </div> 
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo base_url()?>admin/partner/all_partners">
                        <span class="info-box-icon red-bg"><i class="fa fa-user-plus"></i></span>
                        <div class="info-box-content">
                         <span class="info-box-number"><?php echo $total_approved_partners['total']; ?></span>
                            <span class="info-box-text">Approved Partners</span>
                           
                        </div>
                   <!--  </a> -->
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo base_url()?>admin/partner/all_partners">
                        <span class="info-box-icon yellow-bg"><i class="fa fa-ban"></i></span>
                        <div class="info-box-content">
                           <span class="info-box-number"><?php echo $total_inactive_partners['total']; ?></span>
                            <span class="info-box-text">Inactive Partners</span>
                         
                        </div>
                   <!--  </a> -->
                </div>
            </div>
            <!-- <div class="col-md-3 col-sm-6 col-xs-12"> -->
                <!-- <div class="info-box"> -->
                   <!--  <a href="<?php //echo site_url('admin/teacher') ?>">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Expired User </span>
                            <span class="info-box-number">0</span>
                        </div>
                   </a> -->
                </div>

              
                <div class="row">
             <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo base_url()?>admin/lead/all_leads">
                        <span class="info-box-icon blue-bg"><i class="fa fa-bullhorn"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number"><?php echo $total_leads['total'];?></span>
                            <span class="info-box-text">Total Leads</span>
                            
                        </div>
                  <!--   </a> -->
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo base_url()?>admin/lead/all_leads">
                        <span class="info-box-icon bg-facebook"><i class="fa fa-thumbs-o-up"></i></span>
                        <div class="info-box-content">
                         <span class="info-box-number"><?php echo $total_approved_leads['total']; ?></span>
                            <span class="info-box-text">Approved Leads</span>
                           
                        </div>
                   <!--  </a> -->
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php echo base_url()?>admin/lead/all_leads">
                        <span class="info-box-icon bg-light-green"><i class="fa fa-ban"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number"><?php echo $total_inactive_leads['total']; ?></span>
                            <span class="info-box-text">Inactive Leads</span>
                            
                        </div>
                   <!--  </a> -->
                </div>
            </div>
            <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?php //echo site_url('admin/teacher') ?>"> 
                        <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Expired User </span>
                            <span class="info-box-number">0</span>
                        </div>
                    </a> 
                </div>

            </div> -->
        </div>
</div></div>
<div class="clearfix"></div>

 <div class="box">
          
<div class="box-body">
                <div class="row">
                <div class="col-sm-12">
        <div class="slider-sec"> 
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
             
            <?php
              $count=0;
              foreach ($banners as $banner){
            ?>
                  <li data-target="#myCarousel" data-slide-to="<?php echo $count;?>"></li>
            <?php
                  $count++;
                
              } 
            ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <?php
                $count=1;
                foreach ($banners as $banner){
              ?>
                    <div class="item <?php if($count ==1){ echo"active";}  ?>">
                      <img src="<?php echo base_url().$banner['image']; ?>" alt="Banner<?php echo $count ?>" style="width:100%;">
                      <div class="carousel-caption">
                          <div class="row">
                              <div class="col-sm-8">
                                  <h2 style="margin-top:6px; text-align: left;"><?php echo $banner['banner_text']; ?></h2>
                              </div>
                              <div class="col-sm-4 pull-right">
                                <p><a href="<?php echo $banner['button_link']; ?>" target="_blank" class="btn btn-primary slider-btn btn-lg"><?php echo $banner['button_text']; ?></a></p>
                              </div>
                            </div>
                          </div>
                      </div>
              <?php
                    $count++;
                }
              ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        </div>
        </div>
        </div>
        
        
           <!-- Banner Section End -->

                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<style>
.carousel-control .glyphicon-chevron-left, .glyphicon.glyphicon-chevron-right{color:#000!important;}
.carousel-caption {
      background: rgba(0, 0, 0, 0.50);
    margin-bottom: 0px;
    padding-bottom: 0;
    padding-top: 10px;
    width: 100%;
    left: 0; padding-left:20px;
}
.carousel-indicators li{display:none;}
.content-header h1{margin-top:0; margin-bottom:0;}
ol.breadcrumb{margin-bottom:0; background:transparent; text-align:right;}
.info-box{background:#f2f2f2;}
.info-box-content{text-align:center;}
.info-box-number{font-size:35px; color:#8b8c90;}
.info-box-text a{color:#666;}
 .terques-bg {
    background: #6ccac9;
}
.red-bg{
    background: #ff6c60;
} .yellow-bg {
    background: #f8d347;
}
 .blue-bg {
    background: #57c8f2;
}
.bg-facebook{background:#7e909a;}
.bg-light-green{background:#6ab187;}
.info-box-icon{color:#fff;}
</style>

<script>
    $('#example1').DataTable();
</script>
<?php if(!empty($data)){?>
<div class="table-responsive">
    <?php foreach ($data as $key => $value): ?>
    <table class="table table-striped table-bordered follow-table" > 
                <tbody> 
                  
                    <tr>
                        <td>Date</td>
                        <td><?php echo date('d-m-y h:i:sa', strtotime($value['modified'])); ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $value['status']; ?></td>
                    </tr>
                    <tr>
                        <td>Note</td>
                        <td><?php echo $value['description']; ?></td>
                    </tr>
                </tbody>
    </table> 
   <?php endforeach ?>
   <?php
            }else{
                echo"<tr> <th><h3>No History Found</h3></th></tr>";
            }
        ?>
            <style type="text/css">
            .follow-table tr td:nth-child(1){width:40%;}
            .follow-table{    border: 2px solid #eee;}
            </style>
</div>
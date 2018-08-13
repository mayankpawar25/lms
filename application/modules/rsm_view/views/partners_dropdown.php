<select class="form-control" name="partner" id="select_partner" onchange="select_admin('<?php echo $lead_id;?>',this)">
    <option value="">Select Partner</option>
    <?php
        if(!empty($all_partners)){
            foreach ($all_partners as $partner) { 
    ?>
                <option <?php if($partner_id==$partner['id']){ ?> selected="selected" <?php }?> value="<?php echo $partner['id']; ?>"><?php echo $partner['owner_name']; ?></option>
    <?php
            }
        }
    ?>
</select>
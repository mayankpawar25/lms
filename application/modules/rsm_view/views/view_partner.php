<table class="table table-hover table-striped">	
	<?php //echo '<pre>'; print_r($data); die();  ?>
	<?php 
			if(isset($data['id']) && !empty($data['id'])){
		?>
		<tr>
			<th>Partner Id</th>
			<td><?php echo $data['id'] ?></td>
		</tr>
		<?php
			}
		?>

		<?php 
			if(isset($data['firm_name']) && !empty($data['firm_name'])){
		?>
		<tr>
			<th>firm name Date</th>
			<td><?php echo $data['firm_name'] ?></td>
		</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['owner_name']) && !empty($data['owner_name'])){
		?>
		<tr>
			<th>owner name</th>
			<td><?php echo $data['owner_name'] ?></td>
		</tr>

		<?php
			}
		?>

		<?php 
			if(isset($data['contact_no']) && !empty($data['contact_no'])){
		?>
		<tr>
			<th>Partner Contact Number</th>
			<td><?php echo $data['contact_no'] ?></td>
		</tr>

		<?php
			}
		?>
		
		<?php 
			if(isset($data['email'])){
		?>
			<tr>
				<th>Email</th>
				<td><?php echo $data['email'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['address']) && !empty($data['address'])){
		?>
			<tr>
				<th>Address</th>
				<td><?php echo $data['address'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['state_name']) && !empty($data['state_name'])){
		?>
			<tr>
				<th>State</th>
				<td><?php echo $data['state_name'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['city_name']) && !empty($data['city_name'])){
		?>
			<tr>
				<th>City</th>
				<td><?php echo $data['city_name'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['firm_incorporation_date']) && !empty($data['firm_incorporation_date'])){
		?>
			<tr>
				<th>firm incorporation date</th>
				<td><?php echo $data['firm_incorporation_date'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['product_dealing_in']) && !empty($data['product_dealing_in'])){
		?>
			<tr>
				<th>Product Dealing In</th>
				<td><?php echo $data['product_dealing_in'] ?></td>
			</tr>
		<?php
			}
		?>
		
		<?php 
			if(isset($data['turn_over']) && !empty($data['turn_over'])){
		?>
			<tr>
				<th>Turn over in INR</th>
				<td><?php echo $data['turn_over'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['current_ms_perc_overall_business']) && !empty($data['current_ms_perc_overall_business'])){
		?>
			<tr>
				<th>Current ms perc overall business</th>
				<td><?php echo $data['current_ms_perc_overall_business'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['product_percentage_share_terms_value']) && !empty($data['product_percentage_share_terms_value'])){
		?>
			<tr>
				<th>Product percentage share terms value</th>
				<td><?php echo $data['product_percentage_share_terms_value'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['product_promoted_past']) && !empty($data['product_promoted_past'])){
		?>
			<tr>
				<th>Products Promoted in Past</th>
				<td><?php echo $data['product_promoted_past'] ?></td>
			</tr>
		<?php
			}
		?>
		

		
		<!-- <?php 
			if(isset($data['current_status_lead']) && !empty($data['current_status_lead'])){
		?>
			<tr>
				<th>Current Status of the Lead</th>
				<td><?php echo $data['status_types'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['order_lost']) && !empty($data['order_lost'])){
		?>
			<tr>
				<th>Order Lost</th>
				<td><?php echo $data['order_lost'] ?></td>
			</tr>
		<?php
			}
		?> -->
</table>
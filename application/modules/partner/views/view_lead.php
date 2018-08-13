<?php //echo '<pre>'; print_r($data) ?>

<table class="table table-hover table-striped">	
			
		<tr>
			<th>Lead Id</th>
			<td><?php echo $data['id'] ?></td>
		</tr>
		<tr>
			<th>Registration Date</th>
			<td><?php echo $data['registration_date'] ?></td>
		</tr>
		<tr>
			<th>Lead Email</th>
			<td><?php echo $data['lead_email'] ?></td>
		</tr>
		<tr>
			<th>Lead Contact Number</th>
			<td><?php echo $data['lead_mobile'] ?></td>
		</tr>
		<?php 
			if(isset($data['sales_motion'])){
		?>
			<tr>
				<th>Sales Motion</th>
				<td><?php echo $data['motion_types'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['customer_segment']) && !empty($data['customer_segment'])){
		?>
			<tr>
				<th>Customer Segment</th>
				<td><?php echo $data['segment_types'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['other_segment']) && !empty($data['other_segment'])){
		?>
			<tr>
				<th>Other Segment</th>
				<td><?php echo $data['other_segment'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['customer_name']) && !empty($data['customer_name'])){
		?>
			<tr>
				<th>Customer Name</th>
				<td><?php echo $data['customer_name'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['customer_state']) && !empty($data['customer_state'])){
		?>
			<tr>
				<th>State</th>
				<td><?php echo $data['name'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['customer_city']) && !empty($data['customer_city'])){
		?>
			<tr>
				<th>City</th>
				<td><?php echo $data['city_name'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['pin_code']) && !empty($data['pin_code'])){
		?>
			<tr>
				<th>Pin Code</th>
				<td><?php echo $data['pin_code'] ?></td>
			</tr>
		<?php
			}
		?>

			<tr>
				<th>Microsoft BDM working with him</th>
				<td><?php echo $data['bdm_name'] ?></td>
			</tr>


		<?php 
			if(isset($data['value_of_deal']) && !empty($data['value_of_deal'])){
		?>
			<tr>
				<th>Value of Deal</th>
				<td><?php echo $data['deal_types'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['total_deal_value']) && !empty($data['total_deal_value'])){
		?>
			<tr>
				<th>Total Deal Value</th>
				<td><?php echo $data['total_deal_value'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['sku']) && !empty($data['sku'])){
		?>
			<tr>
				<th>Sku's</th>
				<td><?php echo $data['sku'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['expected_license']) && !empty($data['expected_license'])){
		?>
			<tr>
				<th>Expected License</th>
				<td><?php echo $data['expected_license'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['product']) && !empty($data['product']) && !empty($data['product'])){
		?>
			<tr>
				<th>Product</th>
				<td><?php echo $data['product'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['deal_size']) && !empty($data['deal_size'])){
		?>
			<tr>
				<th>Deal Size</th>
				<td><?php echo $data['deal_size'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['tender_type']) && !empty($data['tender_type'])){
		?>
			<tr>
				<th>Tender Type</th>
				<td><?php echo $data['tender_type'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['product_required']) && !empty($data['product_required'])){
		?>
			<tr>
				<th>MS Product Required</th>
				<td><?php echo $data['product_required'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['involvement']) && !empty($data['involvement'])){
		?>
			<tr>
				<th>MS Involvement (if any)</th>
				<td><?php echo $data['involvement_types'] ?></td>
			</tr>
		<?php
			}
		?>
		<?php 
			if(isset($data['expected_closing_date']) && !empty($data['expected_closing_date'])){
		?>
			<tr>
				<th>Expected Date of Closing</th>
				<td><?php echo $data['days_types'] ?></td>
			</tr>
		<?php
			}
		?>

		<?php 
			if(isset($data['status_name']) && !empty($data['status_name'])){
		?>
			<tr>
				<th>Current Status Lead</th>
				<td><?php echo $data['status_name'] ?></td>
			</tr>
		<?php
			}
		?>
		
		<?php 
			if(isset($data['lead_status_description']) && !empty($data['lead_status_description'])){
		?>
			<tr>
				<th>Current Status Description</th>
				<td><?php echo $data['lead_status_description'] ?></td>
			</tr>
		<?php
			}
		?>


</table>
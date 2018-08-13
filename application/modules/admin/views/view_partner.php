<table class="table table-hover table-striped">	
		<?php 
		// echo "<pre>";
		// print_r($data);
		// die();

		 ?>

		 <!-- <tr>
			<th>Partner Id</th>
			<td><?php echo $data['id'] ?></td>
		</tr> -->
		<tr>
			<th>Firm Name</th>
			<td><?php echo $data['firm_name'] ?></td>
		</tr>
		<tr>
			<th>Owner Name</th>
			<td><?php echo $data['owner_name'] ?></td>
		</tr>
		<tr>
			<th>Contact Number</th>
			<td><?php echo $data['contact_no'] ?></td>
		</tr>
		
		<tr>
			<th>Email ID</th>
			<td><?php echo $data['email'] ?></td>
		</tr>
		
		<tr>
			<th>State</th>
			<td><?php echo $data['st_name'] ?></td>
		</tr>

		<tr>
			<th>City</th>
			<td><?php echo $data['c_name'] ?></td>
		</tr>
		
		<tr>
			<th>Address</th>
			<td><?php echo $data['address'] ?></td>
		</tr>

		<tr>
			<th>Firm incorporation date</th>
			<td><?php echo $data['firm_incorporation_date'] ?></td>
		</tr>

		<tr>
			<th>Product dealing in</th>
			<td><?php echo $data['product_dealing_in'] ?></td>
		</tr>
</table>
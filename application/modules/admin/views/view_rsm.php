<table class="table table-hover table-striped">	
	<tr>
		<th>Registration Date</th>
		<td><?php echo $data['registration_date'] ?></td>
	</tr>
	<tr>
		<th>RSM Email</th>
		<td><?php echo $data['email'] ?></td>
	</tr>
	<tr>
		<th>Mobile No.</th>
		<td><?php echo $data['mobile'] ?></td>
	</tr>
	<tr>
		<th>Zone Name</th>
		<td><?php echo $data['zone_name'] ?></td>
	</tr>
	<tr>
		<th>States</th>
		<td>
			<?php 
			$exp = explode(',', $data['states']);
			for($i=0; $i<=count($exp); $i++){
				if (!empty($exp[$i])) {
					$satat = $this->rsms->getstatebyId($exp[$i]);
					echo $satat->name;
					echo "<br>";
				}
			}
			?>
			<!-- <?php echo $data['states'] ?> -->
		</td>
	</tr>
</table>
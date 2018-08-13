
			
		
		<?php 
			if(isset($data['customer_name']) && !empty($data['customer_name'])){
		?>
			<div class="lead_id">
				<td><b><?php echo ucfirst($data['customer_name']) ?> (<?php echo $data['id'] ?>)</b> </td>
					
			</div>
			
		<?php
			}
		?>
		

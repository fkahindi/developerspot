<?php ?>
		<?php foreach($result as $member): ?>
		<blockquote>
			<p><?=$member['firstname']?> <nbsp> 
			<?=$member['lastname']?> <nbsp> 
			<?=$member['email']?><nbsp> 
			<?=$member['date_reg']?> </p>
		</blockquote>
		<?php endforeach;?>



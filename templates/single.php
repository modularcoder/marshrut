<?php include "sidebar.php"; ?>

<div class="content">

	<?php include "breadcrumbs.php"; ?>

	

	<div class="well">
		<h2>
			<?= $route_number ?> 

			<?php 
				if($route_type==1) {
					echo 'երթուղային';
				}
				elseif ($route_type==2) {
					echo 'ավտոբուս';
				}
				else {
					echo 'տրոլեյբուս';
				}
			?>
		</h2>
		<div class="title">
			<?= $title ?>
		</div>
		<hr>
		<p>
			<?= $description ?>
		</p>

		<?= $notes ?>
	</div>

</div>

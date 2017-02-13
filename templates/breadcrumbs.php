<ul class="breadcrumb">
	<?php if($isMakingSearch): ?>
		<li>
			<a href="<?= htmROOT ?>" >
				Գլխավոր
			</a>
		</li>
  		<li class="active">
  			Որոնում. 
  			<strong>
	  			<?php
	  				if(mb_strlen($searchFrom) > 2) {
	  					echo $searchFrom;
	  				}

	  				if(mb_strlen($searchFrom) > 2 && mb_strlen($searchTo) > 2) {
	  					echo ' - ';
	  				}

	  				if(mb_strlen($searchTo) > 2) {
	  					echo $searchTo;
	  				}
	  			?>
  			</strong>
			(<?=$countRoutes ?>)

  		</li>
		

	<?php elseif($isRoute): ?>
		<li>
			<a href="<?= htmROOT ?>" >
				Գլխավոր
			</a>
		</li>
		<li class="active">
			<?= $route_number.' '.$routeTypes[$route_type] ?>
  		</li>

	<?php elseif($isHome): ?>
  		<li class="active">
  			Բոլոր երթուղիները (<?=$countRoutes ?>)
  		</li>
  	<?php elseif($isAbout): ?>
  		<li>
			<a href="<?= htmROOT ?>" >
				Գլխավոր
			</a>
		</li>
		<li class="active">
			Կայքի մասին
  		</li>
	<?php endif; ?>
</ul>
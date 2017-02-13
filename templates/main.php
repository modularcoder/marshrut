<?php include "sidebar.php"; ?>

<div class="content">

	<?php include "breadcrumbs.php"; ?>

	<?php if(count($routes)>0): ?>

		<?php 
			pagination(array(
				'count' => $countPages,
				'baseUrl' => $baseUrl,
			));
		?>

		<table class="table table-bordered table-striped routes-table" >
			<thead>
				<tr>
					<th style="width:115px;">Համար</th>
					<th>Երթուղի</th>
					<th class="span2">Նշումներ</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($routes as $route): extract($route); ?>
					<tr>
						<td class="tc" style="vertical-align:middle; text-align:center; font-size:18px;" >

							<a href="<?= getRouteUrl($route_id, $title) ?>" >			
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
							</a>
						
						</td>
						<td>
							<div class="title">
								<a href="<?= getRouteUrl($route_id, $title) ?>">
									<?= $title ?>
								</a>
							</div>
							<?php
								if(!empty($search_words)) {
									echo highlightWords($description, $search_words); 
								}
								else {
									echo $description;
								}
							?>
						</td>
						<td class="tc" style="vertical-align:middle; text-align:center" >
							<?= $notes ?>
						</td> 
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php 
			pagination(array(
				'count' => $countPages,
				'baseUrl' => $baseUrl,
			));
		?>

	<?php elseif($isMakingSearch): ?>

		<div class="well">
			<h4>
				<?php
					echo 'Ձեր «';
					if(mb_strlen($searchFrom) > 2) {
	  					echo $searchFrom;
	  				}
	  				if(mb_strlen($searchFrom) > 2 && mb_strlen($searchTo) > 2) {
	  					echo ' – ';
	  				}
	  				if(mb_strlen($searchTo) > 2) {
	  					echo $searchTo;
	  				};
					echo '» որոնումով ոչ մի բան չի հայտնաբերվել';
	  			?>
			</h4>
		</div>

	<?php else: ?>

		<div class="well">
			<h3 style="margin-bottom: 20px;">
				Ոչ մի բան չի հայտնաբերվել
			</h3>
		</div>

	<?php endif; ?>

</div>

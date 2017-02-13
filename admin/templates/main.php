<div class="container" >
		
		<?php if(count($routes)>0): ?>


			<?php 
				pagination(array(
					'count' => $countPages,
					'baseUrl' => admURL,
				));
			?>

			<table class="table table-bordered table-striped routes-table" >
				<thead>
					<tr>
						<th style="width:115px;">Համար</th>
						<th>Երթուղի</th>
						<th class="col-sm-2">Նշումներ</th>
						<th class="col-sm-2">Գործողություններ</th>
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
							<td class="actions">
								<a href="?editRoute&id=<?= $route_id ?>" class="btn btn-primary">
									Խմբագրել
								</a>
								<a href="?deleteRoute&id=<?= $route_id ?>" class="btn btn-danger">
									Ջնջել
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php 
				pagination(array(
					'count' => $countPages,
					'baseUrl' => admURL,
				));
			?>

		<?php else: ?>

		<?php endif; ?>
</div>
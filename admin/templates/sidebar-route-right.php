<div class="scrollPaneHeader tc routeWaypointsHeader" >
	<div class="btn-group" data-toggle="buttons">
	  <label class="btn btn-primary active">
	    <input type="radio" name="routeTypeRadio" 
	    	value="direct" checked="checked" > 
	    	Ուղիղ
	  	</label>
	  <label class="btn btn-primary">
	    <input type="radio" name="routeTypeRadio" 
	    	value="back" > 
	    	Հետ
	  </label>
	</div>
</div>
<div class="scrollPane" id="waypointsScrolPane">
	<div class="waypoints" id="waypointsDirect">
		<div class="waypointsContainer">
			<?php $i = 1; ?>
			<?php if(!empty($waypointsDirect)) foreach ($waypointsDirect as $waypoint): ?>
				<?php extract($waypoint); ?>
    			<div class="waypoint  waypoint-<?= $waypoint_id ?>"
    				data-id="<?= $waypoint_id ?>"
    			>
	        		<div class="dragArea">
	        			<span class="glyphicon glyphicon-th" ></span>
	        		</div>
					<div class="number">
						<span class="label label-default">
							<?= $i ?>
						</span>
					</div>
					<div class="closeArea">
						<span class="closeButton waypointRemoveButton
							 label label-danger">
							<i class="glyphicon glyphicon-remove"></i>
						</span>
					</div>
					<div class="data">
						<form>
							<textarea><?= $waypoint_title ?></textarea>
						</form>
					</div>
	        	</div>

	        	<?php $i++ ?>
        	<?php endforeach; ?>
    	</div>
	</div>
	<div class="waypoints" id="waypointsBack">
		<div class="waypointsContainer">
			<?php $i = 1; ?>
			<?php if(!empty($waypointsBack)) foreach ($waypointsBack as $waypoint): ?>
				<?php extract($waypoint); ?>
    			<div class="waypoint  waypoint-<?= $waypoint_id ?>"
    				data-id="<?= $waypoint_id ?>"
    			>
	        		<div class="dragArea">
	        			<span class="glyphicon glyphicon-th" ></span>
	        		</div>
					<div class="number">
						<span class="label label-default">
							<?= $i ?>
						</span>
					</div>
					<div class="closeArea">
						<span class="closeButton waypointRemoveButton
							 label label-danger">
							<i class="glyphicon glyphicon-remove"></i>
						</span>
					</div>
					<div class="data">
						<form>
							<textarea><?= $waypoint_title ?></textarea>
						</form>
					</div>
	        	</div>

	        	<?php $i++ ?>
        	<?php endforeach; ?>
    	</div>
	</div>
</div>
<div class="scrollPaneFooter" style="padding:10px 0">

	<div class="hide">
		
		<div id="waypointTemplate">
    		<div class="dragArea">
    			<span class="glyphicon glyphicon-th" ></span>
    		</div>
			<div class="number">
				<span class="label label-default">

				</span>
			</div>
			<div class="closeArea">
				<span class="closeButton waypointRemoveButton
					 label label-danger">
					<i class="glyphicon glyphicon-remove"></i>
				</span>
			</div>
			<div class="data">

			</div>
    	</div>

	</div>

	<button type="button" id="generateRoute" 
		class="generateRoute btn btn-primary btn-sm">
		Գեներացնել
	</button>

	<button type="button" id="removeRoute" 
		class="removeRoute btn btn-danger btn-sm">
		<span class="glyphicon glyphicon-remove"></span>
	</button>
</div>
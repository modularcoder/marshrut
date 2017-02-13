<div class="sidebar sidebar-admin">
    <div class="sidebarContainer">

    	<div class="scrollPane">

			<div>
				<input class="form-control" id="targetas" type="text" placeholder="Որոնման դաշտ">
			</div>
			
            <div class="title">
              Կետի տվյալներ
            </div>

            <form id="waypointEditorForm"  style="padding-left:20px; padding-right:5px;" >
                <div class="form-group">
	            	<label>Անուն</label>
	                <input type="text" id="waypointTitle" class="form-control" >
	            </div>

	            <div class="form-group">
                	<label>Լայնականություն (LATitude)</label>
                	<input type="text" id="waypointLat" class="form-control" >
	            </div>
	            
	            <div class="form-group">
                	<label>Երկայնություն (LoNGitude)</label>
                	<input type="text" id="waypointLng" class="form-control" >
	            </div>
	            
	            <div class="form-group">
	            	<label>
	            		<input 
                            type="checkbox" id="waypointType" 
                            value="1"
                        >
	            		Հանդիսանո՞ւմ է կանգառ
	            	</label>
	            </div>

	            <input type="hidden" id="waypointId" >

            </form>
        </div>
        <div class="scrollPaneFooter clearfix" 
        	style="	padding-right:5px; 
        			padding-top:10px;
        			padding-left:20px;">

        	<button type="submit" id="removeWaypointButton" 
                class="btn btn-danger pull-left ">
                <span class="glyphicon glyphicon-remove"></span>
                Ջնջել
            </button>

    		<button type="submit" id="saveWaypointButton" 
                class="btn btn-primary pull-right">
                <span class="glyphicon glyphicon-ok"></span>
                Պահպանել
            </button>

    	</div>
        

    </div>
</div>
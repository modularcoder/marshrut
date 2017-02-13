<div class="scrollPaneHeader routeEditorHeader">
	<div>
		<input class="form-control" id="targetas" type="text" placeholder="Որոնում" style="margin: 5px 5px; position: absolute; width: 82px;">
	</div>

	<div class="title">
      Երթուղու տվյալներ
    </div>
</div>
<div class="scrollPane">
	
    <form style="overflow:hidden" id="routeEditorForm">

    	<div class="form-group">
    		<div class="row">
    			<div class="col-md-4">
    				<label>Համար</label>
                    <input type="text" id="routeNumber"
                    	class="form-control tc"  
                        value="<?= $route_number ?>"
                        >
    			</div>
    			<div class="col-md-8">
    				<label>Տիպ</label>
                    <select id="routeType" class="form-control" >
						<option value="1"
							<?php echo ($route_type == 1) ? 'selected="selected"' : '' ?>
						>
							Երթուղային
						</option>

						<option value="2"
							<?php echo ($route_type == 2) ? 'selected="selected"' : '' ?>
                    	>
                    		Ավտոբուս
                    	</option>

						<option value="3"
                    		<?php echo ($route_type == 3) ? 'selected="selected"' : '' ?> 
                    	>
                    		Տրոլեյբուս
                    	</option>
                    </select>
    			</div>
    		</div> 
        </div>

        <div class="form-group">
            <label>Անվանում</label>
            <input type="text" class="form-control" 
                id="routeTitle" 
                value="<?= $title ?>"
                placeholder="Օր.` ԷՐԵԲՈՒՆՈՒ ԶԱՆԳՎԱԾ - ԶԵՅԹՈՒՆ">
        </div>

        <div class="form-group">
            <label>Նկարագրություն</label>
            <textarea class="form-control" id="routeDescription"><?= $description ?></textarea>
        </div>

        <div class="form-group">
            <label>Նշումներ</label>
            <textarea class="form-control" id="routeNotes"><?= $notes ?></textarea>
        </div>

        <input type="hidden" id="routeId" value="<?= $route_id ?>">
    </form>
</div>
<div class="scrollPaneFooter" style="padding:10px 0">
	<button type="button" id="routeSaveButton" 
		class="routeSaveButton btn btn-primary">
		<span class="glyphicon glyphicon-ok"></span>
		Պահպանել տվյալները` ներառելով գծուղին
	</button>
</div>
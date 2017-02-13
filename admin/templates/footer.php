
		<!-- Modal Boxes Start -->

		

		<div class="hide">
			<!-- <div id="gmapControl" class="hide">
				<div class="btn-group">
				  <button type="button" class="btn btn-default" id="aTest">
				  	<span class="glyphicon glyphicon-move"></span>
				  </button>
				  <button type="button" class="btn btn-default">
				  	<span class="glyphicon glyphicon-pencil"></span>
				  </button>
				  <button type="button" class="btn btn-default">
				  	<span class="glyphicon glyphicon-pushpin"></span>
				  </button>
				  <button type="button" class="btn btn-default">
				  	<span class="glyphicon glyphicon-pencil"></span>
				  </button>
				</div>
				
			</div> -->
			
			<div id="modalMsg" >
				<div class="modal-header">

					<button type="button" class="closeMsg" >&times;</button>

					<h4 class="modal-title">
					</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary closeMsg" 
							data-dismiss="modal">
						OK
					</button>
				</div>
			</div>

			<div id="modalConfirm" >
				<div class="modal-header">
					<button type="button" class="closeMsg" >&times;</button>
					<h4 class="modal-title">
					</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary yes">
						Այո
					</button>

					<button type="button" class="btn btn-default no closeMsg" >
						Ոչ
					</button>
				</div>
			</div>
		</div>	

		<!-- Modal Boxes End -->

		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
		<script>window.jQuery || document.write('<script src="'+admDIR+'js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
		<script src="<?= admDIR ?>js/vendor/jquery.fancybox.pack.js"></script>

		<script src="http://maps.google.com/maps/api/js?key=AIzaSyCrs1SpqpDUVdQEmOFJ2mhhTWg7c2_USYs&libraries=places"></script>
		<script src="<?= admDIR ?>js/vendor/gmaps.js"></script>
		<script src="<?= admDIR ?>js/mapsearch.js"></script>
		
		<script src="<?= admDIR ?>js/vendor/bootstrap.min.js"></script>
		<script src="<?= admDIR ?>js/vendor/chosen.jquery.js"></script>

		<script src="<?= admDIR ?>js/plugins.js"></script>
		<script src="<?= admDIR ?>js/main.js"></script>
		<script src="<?= admDIR ?>js/waypoints.js"></script>
		<script src="<?= admDIR ?>js/routes.js"></script>

	</body>
</html>

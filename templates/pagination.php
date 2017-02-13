<?php if($countPages > 1): ?>

	<?php
		$displayFrom = ($activePage - $range > 0) ? $activePage - $range : 1;
		$displayTo = ($activePage + $range <= $countPages) ? $activePage + $range : $countPages;
	?>

	<div>
	  <ul class="pagination">

	    <li>
	    	<span>Էջեր</span>
	    </li>

	    <!-- Display First page if -->
	    <?php if($displayFrom > 1): ?>
		    <li>
	    		<a href="<?= getPageUrl2($baseUrl, 1) ?>" >
					1
	    		</a>
	    	</li>
    	<?php endif; ?>

    	<!-- Display 3 dots befor if -->
    	<?php if($displayFrom > 2): ?>
    		<li class="disabled"><a href="#">...</a></li>
    	<?php endif; ?>

    	<!-- Pagination Loop -->
	    <?php for($i = $displayFrom; $i<= $displayTo; $i++): ?>

	    	<?php if($i == $activePage): ?>
	    		<li class="active">
	    			<a href="<?= getPageUrl2($baseUrl, $i) ?>"><?= $i ?></a>
	    		</li>
			<?php else: ?>
				<li>
		    		<a href="<?= getPageUrl2($baseUrl, $i) ?>" >
		    			<?= $i ?>
		    		</a>
		    	</li>
			<?php endif; ?>

		<?php endfor; ?>

		<!-- Display 3 dots after if -->
		<?php if($displayTo < $countPages-1): ?>
			<li class="disabled"><a href="#">...</a></li>
    	<?php endif; ?>

    	<!-- Display First page if -->
    	<?php if($displayTo < $countPages): ?>
			<li>
	    		<a href="<?= getPageUrl2($baseUrl, $countPages) ?>">
					<?= $countPages ?>
	    		</a>
	    	</li>
    	<?php endif; ?>

	  </ul>
	</div>

<?php endif; ?>
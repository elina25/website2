
 <?php if ($num_of_pages > 1){ ?>

 		<ul class="pagination pull-left">
	        	<?php if($currentPage > 1) { ?>
	        	<li class="page-item"><a class="page-link" href="<?php echo GetPageUrl('page').'&page=1' ?>">Start</a></li>
	        	<li class="page-item"><a class="page-link" href="<?php echo GetPageUrl('page').'&page='.($currentPage-1) ?>">Previous</a></li>
	        	<?php } ?>
	        	<?php for ($i=1; $i <= $num_of_pages; $i++) 
	        	{ 
	        		if (IsNeighbourPage($currentPage, $i, $num_of_pages))  { ?>

	        		<li class="page-item">
	        			<a class="page-link <?php echo ($currentPage == $i ? 'active' : '') ?>" href="<?php echo GetPageUrl('page').'&page='.$i ?>"><?php echo $i ?></a>
	        		</li>

          		<?php } ?> 
          		<?php } ?>
          		<?php if($currentPage < $num_of_pages ) { ?>
          		<li class="page-item"><a class="page-link" href="<?php echo GetPageUrl('page').'&page='.($currentPage+1) ?>">Next</a></li>
          		<li class="page-item"><a class="page-link" href="<?php echo GetPageUrl('page').'&page='.($num_of_pages) ?>">End</a></li>
          		<?php } ?>
	          
	    </ul>
<?php } ?>
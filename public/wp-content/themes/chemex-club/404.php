<?php get_header(); ?>
	<div class="container" id="container-404">
		<div class="row">
			<div class="col-xs-12">
				<p class="title">Oops, looks like your lost.</p>
				<p> 
					<?php if(wp_get_referer() != '') { ?>
					<a href="<?php echo wp_get_referer(); ?>">Go Back</a> or 
					<?php } ?>
					<a href="<?php echo home_url(); ?>">Go Home</a>
				</p>
			</div>
		</div>
	</div>
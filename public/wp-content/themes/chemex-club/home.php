<?php
/**
 * The main template file
 **/
?>

<?php 
	get_header();
?>
<div class="container" id="blogs-listing">
	<div class="row">
		<div class="col-xs-12">
			<div class="category-grid">
				<?php 
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post(); 
							?>
							<div class="item col-padding-custom">
								<div class="blog-entry">
									<img style="width:100%" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>" />
								</div>
							</div>
							<?php
						} 
					} 
				?>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>
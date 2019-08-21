<?php get_header(); ?>


<div class="container-fluid text-center py-5 ">
	<div class="mt-5">
<a href="<?php echo site_url('/blog'); ?>"><h2 class="section-heading">Sustainability</h2></a>
</div></div>

					<section>
						<?php
						$args = array(
							'post_type' => 'post',

						);
						$blogposts = new WP_Query($args);
						while ($blogposts->have_posts()) {
							$blogposts->the_post();
						?>

<div class="card mb-3">
<div class="card-description">
<div class="container-fluid">
<div class="mt-3 px-2">
<p>
	<div class="card-image">
			  <a href="<?php the_permalink(); ?>">
			    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" width="400" height="300" style="max-width: 100%; height: auto; padding: 16px;"></a>

			<h4 class="section-heading ml-3"><?php the_title();?></h4>
			<div class="card-meta ml-2">
				posted by <?php the_author(); ?> <?php the_time('F j, Y') ?> in
				<a href="#"><?php echo get_the_category_list(', ') ?></a><br>
			<p id="texts" class="ml-2"><?php echo wp_trim_words(get_the_excerpt(),40);?></p>
			                    <div class="text-center">
			                    <a href="<?php the_permalink();?>"><button type="button" class="btn btn-outline-primary">Read more</button></a><br><br>
			                  </div>
	</div>
</div>
</div>
</div>
</div>
</div>
<?php }
wp_reset_query();
?>

</section>

<?php get_footer(); ?>

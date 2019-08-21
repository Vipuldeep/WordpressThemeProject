<div class="container-fluid text-center py-5 bg-light">
  <br>
  <div class="row">
    <div class="col-sm-4">
      <img class="img-responsive mb-3 border border-primary imageoverlay" src="wp-content/themes/team04/img/Book.jpg" alt="Sustanability" style="max-width: 100%;" title="Sustanability" >
      <div class="transformations">
      <div class="overlaytext">Education</div>
      </div>
    </div>
    <div class="col-sm-4">
      <img class="img-responsive mb-3 border border-primary imageoverlay" src="wp-content/themes/team04/img/motorbike.jpg" alt="Motorcycling" style="max-width: 100%;" title="motorcycling">
      <div class="transformations">
      <div class="overlaytext">Motorcycling</div>
      </div>
    </div>
    <div class="col-sm-4">
     <img class="img-responsive mb-3 border border-primary imageoverlay" src="wp-content/themes/team04/img/Sus.jpg" alt="Education" style="max-width: 100%;" title="Education">
     <div class="transformations">
     <div class="overlaytext">Sustainability</div>
     </div>
    </div>
  </div>
</div>


<div class="container-fluid text-center py-5">
<a href="<?php echo site_url('/blog'); ?>"><h2 class="section-heading">Sustainability</h2></a>
</div>

          <section>

            <?php
            $args = array(
            	'post_type' => 'post',
            	'posts_per_page' => 2

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
    <div class="card-meta ml-2">
      posted by <?php the_author(); ?> <?php the_time('F j, Y') ?> in
      <a href="#"><?php echo get_the_category_list(', ') ?></a><br>
    </div>
<h3 class="section-heading ml-3"><?php the_title();?></h3>
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
wp_reset_query(); ?>

            </section>

            <div class="container text-center py-5 bg-light rounded">
              <a href="#"><h3 class="section-heading mb-3">Gallery</h3></a>
              <p>Sharing few moments from special event</p>
              <br>
              <div class="row">
                <div class="col-sm-4">
                  <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/2.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events" >
                  <div class="transformations">
                  </div>
                </div>
                <div class="col-sm-4">
                  <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/3.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events">
                  <div class="transformations">
                  </div>
                </div>
                <div class="col-sm-4">
                 <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/4.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events">
                 <div class="transformations">
                 </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/5.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events" >
                  <div class="transformations">
                  </div>
                </div>
                <div class="col-sm-4">
                  <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/6.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events">
                  <div class="transformations">
                  </div>
                </div>
                <div class="col-sm-4">
                 <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/7.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events">
                 <div class="transformations">
                 </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/8.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events" >
                  <div class="transformations">
                  </div>
                </div>
                <div class="col-sm-4">
                  <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/9.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events">
                  <div class="transformations">
                  </div>
                </div>
                <div class="col-sm-4">
                 <img class="img-responsive mb-2 border border-primary imageoverlay rounded" src="wp-content/themes/team04/img/10.jpg" alt="Motorcycling" style="max-width: 100%;" title="motor events">
                 <div class="transformations">
                 </div>
                </div>
              </div>
            </div>




            <section>
              <div class="container-fluid text-center py-5">
              <a href="<?php echo site_url('/blog'); ?>"><h2 class="section-heading">Education</h2></a>
              </div>

  <section>

                          <?php
                          $args = array(
                          	'post_type' => 'project',
                          	'posts_per_page' => 2

                          );
                          $projects = new WP_Query($args);

                          while ($projects->have_posts()) {

                          	$projects->the_post();


                          ?>
              <div class="card mb-3">

                  <div class="card-description">
              <div class="container-fluid">
              <div class="mt-3 px-2">

              <p>
              <div class="card-image">
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" width="400" height="300" style="max-width: 100%; height: auto; padding: 16px;"></a>
                  <div class="card-meta ml-2">
                    posted by <?php the_author(); ?> <?php the_time('F j, Y') ?> in
                    <a href="#"><?php echo get_the_category_list(', ') ?></a><br>
                </div>
              <h3 class="section-heading ml-3"><?php the_title();?></h3>
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
              wp_reset_query(); ?>

  </section>

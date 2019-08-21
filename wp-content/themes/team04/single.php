<?php get_header();
while(have_posts()) {
  the_post();

?>

<?php include("inc/heroimage.inc") ?>

<div class="sidenav">
  <?php dynamic_sidebar('main_sidebar'); ?>
</div>

<div class="sidenavsidecontext">
  <div class="container-fluid text-center mt-5 py-2">
  <a href="#"><h2 class="section-heading"><?php the_title(); ?></h2></a>
  </div>

<div class="card-image container-fluid">
  <?php if(has_post_thumbnail()) { ?>
		<div class="text-center">
<a href="#"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" style="max-width: 40%; height: auto; margin-top: 40px;"></a>
</div>
posted by <?php the_author(); ?> <?php the_time('F j, Y') ?>
<?php if(get_post_type() == 'post') { ?>
in
<a href="#"><?php echo get_the_category_list(', ') ?></a><br>
<?php } ?>
<?php } ?>
<p id="texts">
<?php the_content(); ?>
</p>
</div>


<?php } ?>


<div id="comments-section">
  <?php
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $commenter = wp_get_current_commenter();


	$fields =  array(
  'author' =>
    '<input placeholder="Enter your name" input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'email' =>
    '<input placeholder="Enter your e-mail" input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>',
);

	$args = array(
			'title_reply' => 'Share your Thoughts',
			'fields' => $fields,
			'comment_field' => '<textarea placeholder = " Comment please!" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea>',
		'comment_notes_before' => '<p class="comment-notes">All feilds are neccesary to fill.</p>'
	);
	comment_form($args);
	$comments_number = get_comments_number();
	if($comments_number !=0) {
		?>
		<div class="comments">
			<h3 style="padding-top: 20px;">Write here</h3>
			<ol class="comments"></br>
		<?php
		$comments = get_comments(array(
			'post_id' => $post->ID,
			'status' => 'approve'
		));
		wp_list_comments(array(
			'per_page' => 15
		), $comments);
		?>
	</ol>
</div>
<?php
	}
	?>
</div>
</div>


</div>
</div>
<?php get_footer(); ?>

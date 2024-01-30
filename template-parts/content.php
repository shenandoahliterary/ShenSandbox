<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShenAleph
 */

?>
<div class="row">
<div class="col-md-8 offset-md-2">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			$custom_fields = get_post_custom();
			$prize = $custom_fields['prize'];
			$trigger_warning = $custom_fields['trigger_warning'];
			if (! empty($trigger_warning)) {
				echo <<<TRIGGER
				<button class="btn btn-outline-warning float-right" type="button" data-toggle="collapse" data-target="#collapseTrigger" aria-expanded="false" aria-controls="collapseExample">
				Trigger Warning
			  </button>
TRIGGER;
				echo "<span class='prize'></span>";
				echo <<<TRIGGERWARNINGTEXT
				<div class="collapse" id="collapseTrigger">
				<div class="card card-body">
				$trigger_warning[0]
				</div>
</div>
TRIGGERWARNINGTEXT;
			}


			if (! empty($prize)) {
				echo "<span class='prize'><em>$prize[0]</em></span>";
			}
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<!-- add byline -->
				<?php
				$subtitle = $custom_fields['subtitle'];
				if (! empty($subtitle)) {
					echo "<span class='subtitle'>$subtitle[0]</span> <br />";
				}
				?>
				<p class="workAuthorByline"><?php
/* should add to filter: if filter is empty then only the_author_meta; if filter is not empty, then all authors from filter */
				if (in_category('feature')) {
					echo "";
				}
				else {
			 the_author_meta('display_name');
			 echo "<br />";
			 shenAleph_filter_authors();
		 }
			  ?></p>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php shenAleph_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'shenAleph' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shenAleph' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
<!-- author bio -->
	<hr>
	<?php shenAleph_filter_add_bio(); ?>
	<section class="workAuthorBio"><?php the_author_meta('description') ?></section>
	<!-- add 2nd author bio -->
	<?php

	$my_custom_field = $custom_fields['second_author'];

 if (! empty($my_custom_field)) {

	  foreach ( $my_custom_field as $key => $value ) {
	  	//echo $key . " => " . $value . "<br />";


	      $args_authors = array(

	                   'meta_key' => "last_name",
	                   'meta_value' => "$value",
	                   'meta_compare' => 'LIKE'
	                 );
	        $author_loop = new WP_User_Query($args_authors);
	        $author_names = $author_loop->get_results();


	        if (! empty($author_names)) {

	          foreach ($author_names as $author_name) {
	?>
	<section class="workAuthorBio translatorBio">
	<?php
	            echo "$author_name->description </section>";
	          }
	        }
	          else {echo "No authors found";}


	    }
}

// if does not have tag translated-by-author, then add translatorBio  


if ( has_tag('translated-by-author') ) {

}

else {

$custom_fields = get_post_custom();

$my_custom_field = $custom_fields['translator_lastname'];

  foreach ( $my_custom_field as $key => $value ) {
  	//echo $key . " => " . $value . "<br />";


      $args_authors = array(

                   'meta_key' => "last_name",
                   'meta_value' => "$value",
                   'meta_compare' => 'LIKE'
                 );
        $author_loop = new WP_User_Query($args_authors);
        $author_names = $author_loop->get_results();


        if (! empty($author_names)) {

          foreach ($author_names as $author_name) {
?>
<section class="workAuthorBio translatorBio">
<?php
            echo "$author_name->description </section>";
          }
        }
          else {echo "No authors found";}


    }
}




//extra content that might appears below bio
$extra_content = $custom_fields['extra_content'];
if (! empty($extra_content)) {
	echo "$extra_content[0] <br />";
}

	?>


	




 


	<footer class="entry-footer">
		<?php shenAleph_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>
</div>
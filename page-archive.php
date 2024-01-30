<?php
/* 
Template Name: Archvies 
*/

get_header();
?>
<div class="row volumeIssue">
</div>
</section>
	<div id="primary" class="content-area">
		<main id="main" class="site-main container">

        <h3>Our Authors </h3>
<ul>
    <?php wp_list_authors('exclude_admin=0'); ?>
</ul>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();        

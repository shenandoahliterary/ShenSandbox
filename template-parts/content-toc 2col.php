<?php
/**
 *
 *
 */
?>
<section class="container">
<div class="row cover-row">
	<?php
$uploads = wp_upload_dir();
$upload_path =  $uploads['baseurl'];
/* need to set image in admin dashboard */
	?>
	<div class="col-md-12">
		<div class="text-center">
<img class="" src="<?php echo $upload_path ?>/2022/06/572x700.jpg">
		</div>
<p class="d-flex justify-content-center"><em>[artwork title]</em>,&nbsp;&nbsp; <a href="">[artist name]</a></p>
	</div>
</div>


</section>

<section class="container TOCsection">

	<div class="row justify-content-center">
		<div class="col-md-8 single-space-paragraphs">
			<p><a href="https://shenandoahliterary.org/712/editors-note/">Editor&rsquo;s Note</a><br /><span class="author_name">[Editor Name]</span></p>
		</div>
	</div> 

	<p>&nbsp;</p>

	<div class="row justify-content-center">
		<div class="col-4 TOC-column">
			<h3>Fiction</h3>
		</div>
		
		<div class="col-6">

			<?php
				remove_all_filters('posts_orderby');
				$fiction_args = array(
					'category_name' => 'fiction',
					'order' => 'ASC',
					'meta_key' => 'TOC_order',
					'orderby' => 'meta_value_num',
					'meta_type' => 'NUMERIC',
					'nopaging' => 'true',
				);
				$fiction_loop = new WP_Query($fiction_args);
				$authornames = array();

				while ($fiction_loop->have_posts()) : $fiction_loop->the_post();
					$this_author= get_post_meta($post->ID, 'author_lastname', true);
					$this_author_id =get_the_author_meta('ID');
					$authornames[$this_author_id] = $this_author;

				//print statement of title and author just below worked but put each work and author separately

				endwhile;

				//group posts by author

				foreach ($authornames as $author_id=>$author_lastname) {
					$args = array(
						'category_name' => 'fiction',
						'author' => $author_id,
						'orderby' => 'date',
						'order' => 'asc',
						'nopaging' => 'true'
					);
		
					//start WP loop
					$fiction_loop_single = new WP_Query($args);

					$i = 0;

					//open paragraph for title(s)/author
					echo "<p>";
					while ($fiction_loop_single->have_posts()) : 				
						$fiction_loop_single->the_post();
						//for each author, print title,  author
			
			?>

					<a href="<?php the_permalink(); ?>">

			<?php the_title(); ?>
					
					</a><br/>

			<?php
					//check for author's note

					$custom_fields = get_post_custom();
					$has_author_note = $custom_fields['has_author_note'];

					$i++;
						
					endwhile;
					$custom_fields_test = get_post_custom();
					$has_author_note_test = $custom_fields_test['has_author_note'];

					if (! empty($has_author_note)) {
						$author_note_url = site_url();

						//echo "test: $has_author_note_test[0]";
						echo <<<URLLINK

						<a href="$author_note_url/$has_author_note[0]/">Author's Note</a><br />
						URLLINK;
					}
			?>

					<span class="author_name"><?php the_author(); ?> </span>
					
			<?php
						wp_reset_postdata();
				}
			?>

		</div> <!-- ends 2nd column -->

	</div> <!-- closes row -->

	<p class="text-center p-section-break">▴&nbsp;▴&nbsp;▴</p>

	<div class="row justify-content-center"> <!-- opens row for novel excerpt -->

		<div class="col-4 TOC-column">
			<h3>Novel Excerpt</h3>
		</div>

		<div class="col-6">
			
			<?php
			remove_all_filters('posts_orderby');
			$fiction_args = array(
				'category_name' => 'novel-excerpt',
				'order' => 'ASC',
				'meta_key' => 'TOC_order',
				'orderby' => 'meta_value_num',
				'meta_type' => 'NUMERIC',
				'nopaging' => 'true',

			);
			$fiction_loop = new WP_Query($fiction_args);
				$authornames = array();

					while ($fiction_loop->have_posts()) : $fiction_loop->the_post();
						$this_author= get_post_meta($post->ID, 'author_lastname', true);
						$this_author_id =get_the_author_meta('ID');
						$authornames[$this_author_id] = $this_author;

		//print statement of title and author just below worked but put each work and author separately
			?>

			<?php
					endwhile;

		//below groups posts by author

				foreach ($authornames as $author_id=>$author_lastname) {
						$args = array(
					'category_name' => 'novel-excerpt',
					'author' => $author_id,
					'orderby' => 'date',
					'order' => 'asc',
					'nopaging' => 'true'
					);
			?>
			<?php
					$fiction_loop_single = new WP_Query($args);

					$i = 0;
					//open paragraph for title(s)/author
					echo "<p>";
						while ($fiction_loop_single->have_posts()) : 				$fiction_loop_single->the_post();
						//for each author, print title, title, author
			?>

			<a href="<?php the_permalink(); ?>">

			<?php the_title(); ?>
					
			</a><br />

			<?php
					$i++;
					endwhile;
					//print author outside of the loop
			?>
					<span class="author_name"><?php the_author(); ?> </span>
		<?php
					wp_reset_postdata();
				}
		?>

		</div> <!-- close 2nd column -->
	
	</div> <!-- close row -->

	<p class="text-center p-section-break">▴&nbsp;▴&nbsp;▴</p>

	<div class="row justify-content-center"> <!-- opens row for nonfiction -->

		<div class="col-4 TOC-column">
			<h3>Nonfiction</h3>
		</div>

		<div class="col-6">
			
			<?php
			remove_all_filters('posts_orderby');
			$fiction_args = array(
				'category_name' => 'nonfiction',
				'order' => 'ASC',
				'meta_key' => 'TOC_order',
				'orderby' => 'meta_value_num',
				'meta_type' => 'NUMERIC',
				'nopaging' => 'true',

			);
			$fiction_loop = new WP_Query($fiction_args);
				$authornames = array();

					while ($fiction_loop->have_posts()) : $fiction_loop->the_post();
						$this_author= get_post_meta($post->ID, 'author_lastname', true);
						$this_author_id =get_the_author_meta('ID');
						$authornames[$this_author_id] = $this_author;

		//print statement of title and author just below worked but put each work and author separately
			?>

			<?php
					endwhile;

		//below groups posts by author

				foreach ($authornames as $author_id=>$author_lastname) {
						$args = array(
					'category_name' => 'nonfiction',
					'author' => $author_id,
					'orderby' => 'date',
					'order' => 'asc',
					'nopaging' => 'true'
					);
			?>
			<?php
					$fiction_loop_single = new WP_Query($args);

					$i = 0;
					//open paragraph for title(s)/author
					echo "<p>";
						while ($fiction_loop_single->have_posts()) : 				$fiction_loop_single->the_post();
						//for each author, print title, title, author
			?>

			<a href="<?php the_permalink(); ?>">

			<?php the_title(); ?>
					
			</a><br />

			<?php
					$i++;
					endwhile;
					//print author outside of the loop
			?>
					<span class="author_name"><?php the_author(); ?> </span>
		<?php
					wp_reset_postdata();
				}
		?>

		</div> <!-- close 2nd column -->

	</div> <!-- close row -->

	<p class="text-center p-section-break">▴&nbsp;▴&nbsp;▴</p>

	<div class="row justify-content-center"> <!-- opens row for poetry -->

		<div class="col-4 TOC-column">
			<h3>Poetry</h3>
		</div>

		<div class="col-6">
			
			<?php
			remove_all_filters('posts_orderby');
			$fiction_args = array(
				'category_name' => 'poetry',
				'order' => 'ASC',
				'meta_key' => 'TOC_order',
				'orderby' => 'meta_value_num',
				'meta_type' => 'NUMERIC',
				'nopaging' => 'true',

			);
			$fiction_loop = new WP_Query($fiction_args);
				$authornames = array();

					while ($fiction_loop->have_posts()) : $fiction_loop->the_post();
						$this_author= get_post_meta($post->ID, 'author_lastname', true);
						$this_author_id =get_the_author_meta('ID');
						$authornames[$this_author_id] = $this_author;

		//print statement of title and author just below worked but put each work and author separately
			?>

			<?php
					endwhile;

		//below groups posts by author

				foreach ($authornames as $author_id=>$author_lastname) {
						$args = array(
					'category_name' => 'poetry',
					'author' => $author_id,
					'orderby' => 'date',
					'order' => 'asc',
					'nopaging' => 'true'
					);
			?>
			<?php
					$fiction_loop_single = new WP_Query($args);

					$i = 0;
					//open paragraph for title(s)/author
					echo "<p>";
						while ($fiction_loop_single->have_posts()) : 				$fiction_loop_single->the_post();
						//for each author, print title, title, author
			?>

			<a href="<?php the_permalink(); ?>">

			<?php the_title(); ?>
					
			</a><br />

			<?php
					$i++;
					endwhile;
					//print author outside of the loop
			?>
					<span class="author_name"><?php the_author(); ?> </span>
		<?php
					wp_reset_postdata();
				}
		?>

		</div> <!-- close 2nd column -->

	</div> <!-- close row -->

	<p>&nbsp;</p>

		<div class="row">
			<div class="col-md-8 offset-md-2 single-space-paragraphs">
				<p><a href="https://shenandoahliterary.org/712/masthead/">Masthead</a></p>
				<p><a href="https://shenandoahliterary.org/712/contributors/">List of Contributors</a></p>
			</div>
		</div>

	</section>

	<p>&nbsp;</p>

	<!--  Quote section -->
	<section class="container TOC-quote" style="background-color:lightpink">

		<div class="row justify-content-center">

			<div class="col-md-11">

			<?php
				$args = array(
					'meta_key'			=> 'add-quote-to-toc',
					'meta_value'		=> 'Yes',
					'compare'			=> 'Like',
					'post_type'			=> 'page',
					'post_status'		=> 'publish',
				);

				$query = new WP_Query($args);

				if ($query->have_posts()) :
					while($query->have_posts()) :
						$query->the_post();
			?>

			<?php the_content() ?>

			<?php
					endwhile;
				else:
			?>

			Oops, there is no quote. 

			<?php
				endif;

				wp_reset_postdata();
			?>

			</div> <!-- ends column -->

		</div> <!-- ends row -->

	</section>

	<!--  Features section -->

	</div>
</div>

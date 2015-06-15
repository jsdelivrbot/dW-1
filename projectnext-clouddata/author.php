<?php
/**
 * Author archive template
 * 
 */

get_header(); 
?>
<section>
<?php 
// check if there are any posts at all matching author query
if (have_posts()) : ?>

	<?php
	/* Queue the first post, that way we know
	 * what author we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	the_post();
	?>
	<div class="pn-single-post-header pn-header-emphasis">
		<div class="pn-pcon">
			<header>
				<h1 class="pn-page-title">				
					<div class="flag">
						<div class="flag-img">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
						</div>
						<div class="flag-bd">
              <div class="mlm author-bio">
                <p><?php printf(get_the_author_meta("description")); ?></p>
                <p>
                  <?php printf('<a href="'.get_the_author_meta("url").'">web site</a> | '); ?>
                </p>
              </div>
							<div class="mlm">
                <?php printf( __( 'All content by %s', 'twentytwelve' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>	
							</div>
						</div>
					</div>
				</h1>		
			</header>
			
		</div>
	</div>
	
	<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();
	?>

<?php endif; ?>

	<div class="pn-pcon">

		<div class="pn-columns">

			<div class="pn-col-6-4">
	
				<div class="pn-post-list">
		
					<?php 
					if (have_posts()) : 
						/* Start the loop */
						while (have_posts()) : the_post(); 

					                /* Only list content here if it's not a video, which is not authored
					                 * in the same sense that other content is (ITO) (133477)
							 */
					                if ( get_post_type( get_the_ID())  != 'pnext_video') {

							    echo "<!--". get_post_type( get_the_ID()) . "-->";
   /* 
							     * Include the post format-specific template for the content.
							     */
							    get_template_part( 'partials/listing', get_post_format() ); 

					                } 

						/* End the Loop */
						endwhile; ?>
				
						<div id="page-nav" class="pn-pagination cf">
							<div class="fl"><?php previous_posts_link();?></span></div>
							<div class="fr"><?php next_posts_link(); ?></div>
						</div>

					<?php
					else: 
				
						// No results? Show 'em the "sorry!" content ?>

						<div class="ptxl">
						<?php get_template_part( 'partials/content', 'none_author' ); ?>
						</div>
					
					<?php
					endif; ?>
				</div>
	
			</div>
	
			<div class="pn-col-6-2">
	
				<?php if ( ! have_posts() ) : ?>
				<div class="ptxl">
				<?php endif; ?>
		
					<?php if ( is_active_sidebar('pnext_blog_roll') ) { ?>

						<ul class="pn-widgets pn-widgets-blog-roll">
							<?php dynamic_sidebar('pnext_blog_roll'); ?>
						</ul>

					<?php } ?>

				<?php if ( ! have_posts() ) : ?>
				<div class="ptxl">
				<?php endif; ?>
	
			</div>
	
		</div>
	</div>

</section>

<?php get_footer(); ?>
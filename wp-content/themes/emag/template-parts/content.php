<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package emag
 */

global $emag_customizer_all_values;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) {
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php emag_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$emag_archive_layout = $emag_customizer_all_values['emag-archive-layout'];
		$emag_archive_image_align = $emag_customizer_all_values['emag-archive-image-align'];
		if( 'excerpt-only' == $emag_archive_layout ){
			the_excerpt();
		}
		elseif( 'full-post' == $emag_archive_layout ){
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'emag' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		elseif( 'thumbnail-and-full-post' == $emag_archive_layout ){
			if( 'left' == $emag_archive_image_align ){
				echo "<div class='image-left'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $emag_archive_image_align ){
				echo "<div class='image-right'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('full');
			}
			echo "</a>";
			echo "</div>";/*div end*/
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'emag' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		else{
			if( 'left' == $emag_archive_image_align ){
				echo "<div class='image-left'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $emag_archive_image_align ){
				echo "<div class='image-right'>";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				echo "'<a href= '. get_the_permalink() .' >'";
				echo '<a href="'.esc_url(get_permalink()).'">';
				the_post_thumbnail('full');
			}
			echo "</a>";
			echo "</div>";/*div end*/
			the_excerpt();
		}
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php emag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

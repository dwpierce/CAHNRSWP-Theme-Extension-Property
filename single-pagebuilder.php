<?php get_header(); ?>

	<main class="spine-blank-template">

		<?php get_template_part( 'parts/headers' ); ?>
		<?php get_template_part( 'parts/featured-images' ); ?>

		<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
        
        	<article class="pagebuilder-article post-<?php echo $post->ID;?> post-type-<?php echo $post->post_type;?>">

			<?php $hide_title = get_post_meta( get_the_ID(), '_cahnrswp_hide_title', true ); ?>
            
            <?php if ( ! ( $hide_title || is_front_page() ) ):?><header class="article-header">
                <h1 class="article-title"><?php the_title(); ?></h1>
            </header><?php endif;?>
            <?php the_content();?>

		<?php endwhile; endif; ?>

		<?php get_template_part( 'parts/footers' ); ?>
        
        </article>

	</main>

<?php get_footer(); ?>
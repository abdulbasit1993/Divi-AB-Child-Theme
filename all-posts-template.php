<?php
/*
 * Template Name: All Posts on Single Page Template
 */

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());

?>

<div id="main-content">

<?php if (!$is_page_builder_used): ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif;?>

			<?php while (have_posts()): the_post();?>

								<article id="post-<?php the_ID();?>" <?php post_class();?>>

								<?php if (!$is_page_builder_used): ?>

									<h1 class="entry-title main_title"><?php the_title();?></h1>
								<?php
    $thumb = '';

    $width = (int) apply_filters('et_pb_index_blog_image_width', 1080);

    $height = (int) apply_filters('et_pb_index_blog_image_height', 675);
    $classtext = 'et_featured_image';
    $titletext = get_the_title();
    $thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext, false, 'Blogimage');
    $thumb = $thumbnail["thumb"];

    if ('on' === et_get_option('divi_page_thumbnails', 'false') && '' !== $thumb) {
        print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height);
    }

    ?>

								<?php endif;?>

					<div class="entry-content">
					<?php
the_content();

if (!$is_page_builder_used) {
    wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'Divi'), 'after' => '</div>'));
}

?>

<?php
// the query
$wpb_all_query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1));?>

<?php if ($wpb_all_query->have_posts()): ?>

<ul>

    <!-- the loop -->
    <?php while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();?>
			        <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
			    <?php endwhile;?>
    <!-- end of the loop -->

</ul>

    <?php wp_reset_postdata();?>

<?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
					</div> <!-- .entry-content -->

				<?php
if (!$is_page_builder_used && comments_open() && 'on' === et_get_option('divi_show_pagescomments', 'false')) {
    comments_template('', true);
}

?>

				</article> <!-- .et_pb_post -->

			<?php endwhile;?>

<?php if (!$is_page_builder_used): ?>

			</div> <!-- #left-area -->

			<?php /* get_sidebar();*/?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif;?>

</div> <!-- #main-content -->

<?php

get_footer();

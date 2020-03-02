<?php
/*
 * Template Name: My-Page-Template
 */

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());?>

<div id="main-content">

<?php if (!$is_page_builder_used): ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">



<?php endif;?>

		<?php while (have_posts()): the_post();?>

				<article id="post-<?php the_ID();?>" <?php post_class();?>>

				<?php if (!$is_page_builder_used): ?>

				<h1 class="main_title"><?php the_title();?></h1>
				<hr><br>
				<?php echo "<h3>This is a custom page template</h3>"; ?>
				<br />
				<div style="background-color: blue; text-align: center; padding-top: 30px; padding-bottom: 30px;"><?php echo '<h4 style="color: #fff; font-size: 30px;">The current date is ' . date("l d-m-Y") . '</h4>'; ?></div>
				<br><br>

				<p style="font-size: 25px;"><?php echo "This is a custom page template designed for the Child Theme of Divi."; ?></p>
				<p style="font-size: 25px; line-height: 1.2em;"><?php echo "This Child Theme requires the Divi Theme (preferably Version: 3.22.2) to be installed and activated on your WordPress website."; ?></p>
				<p style="font-size: 25px;"><?php echo "Below is the logo for the Child Theme"; ?></p><br>

				<img src="../wp-content/themes/Divi-AB-Child/screenshot.png">
				<br>

				<div style="text-align: center;"><button style="background-color: #3ED2C4; color: #fff; padding: 10px;" type="button" onclick="alert('Welcome to my Divi Child Theme!')">Click Here!</button></div>


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

    ?>																																						<?php endif;?>
					<div class="entry-content">
					<?php
the_content();

if (!$is_page_builder_used) {
    wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'Divi'), 'after' => '</div>'));
}

?>
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

            <?php /*get_sidebar(); */
echo "<h2>This is the sidebar portion</h2>";
?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif;?>

</div> <!-- #main-content -->

<?php

get_footer();
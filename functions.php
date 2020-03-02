<?php
/*-------------------------------------------------------
 * Divi AB Child Theme Functions.php
------------------ ADD YOUR PHP HERE ------------------*/

function divichild_enqueue_scripts()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'divichild_enqueue_scripts');

// Create a Custom Post Type called 'Books'
function create_posttype()
{
    $args = array(
        'public' => true,
        'label' => 'Books',
    );
    register_post_type('book', $args);
}
// Hooking up function to theme setup
add_action('init', 'create_posttype');

// Register a book post type
function book_init()
{
    $labels = array(
        'name' => _x('Books', 'post type general name', 'your-plugin-textdomain'),
        'singular_name' => _x('Book', 'post type singular name', 'your-plugin-textdomain'),
        'menu_name' => _x('Books', 'admin menu', 'your-plugin-textdomain'),
        'name_admin_bar' => _x('Book', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'book', 'your-plugin-textdomain'),
        'add_new_item' => __('Add New Book', 'your-plugin-textdomain'),
        'new_item' => __('New Book', 'your-plugin-textdomain'),
        'edit_item' => __('Edit Book', 'your-plugin-textdomain'),
        'view_item' => __('View Book', 'your-plugin-textdomain'),
        'all_items' => __('All Books', 'your-plugin-textdomain'),
        'search_items' => __('Search Books', 'your-plugin-textdomain'),
        'parent_item_colon' => __('Parent Books:', 'your-plugin-textdomain'),
        'not_found' => __('No books found.', 'your-plugin-textdomain'),
        'not_found_in_trash' => __('No books found in Trash.', 'your-plugin-textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'your-plugin-textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'book'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );
    register_post_type('book', $args);
}
add_action('init', 'book_init');

// Customizing user messages for custom post type
add_filter('post_updated_messages', 'book_updated_messages');

function book_updated_messages($messages)
{
    $post = get_post();
    $post_type = get_post_type($post);
    $post_type_object = get_post_type_object($post_type);

    $messages['book'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Book updated.', 'your-plugin-textdomain'),
        2 => __('Custom field updated.', 'your-plugin-textdomain'),
        3 => __('Custom field deleted.', 'your-plugin-textdomain'),
        4 => __('Book updated.', 'your-plugin-textdomain'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf(__('Book restored to revision from %s', 'your-plugin-textdomain'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => __('Book published.', 'your-plugin-textdomain'),
        7 => __('Book saved.', 'your-plugin-textdomain'),
        8 => __('Book submitted.', 'your-plugin-textdomain'),
        9 => sprintf(
            __('Book scheduled for: <strong>%1$s</strong>.', 'your-plugin-textdomain'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n(__('M j, Y @ G:i', 'your-plugin-textdomain'), strtotime($post->post_date))
        ),
        10 => __('Book draft updated.', 'your-plugin-textdomain'),
    );

    if ($post_type_object->publicly_queryable && 'book' === $post_type) {
        $permalink = get_permalink($post->ID);

        $view_link = sprintf(' <a href="%s">%s</a>', esc_url($permalink), __('View book', 'your-plugin-textdomain'));
        $messages[$post_type][1] .= $view_link;
        $messages[$post_type][6] .= $view_link;
        $messages[$post_type][9] .= $view_link;

        $preview_permalink = add_query_arg('preview', 'true', $permalink);
        $preview_link = sprintf(' <a target="_blank" href="%s">%s</a>', esc_url($preview_permalink), __('Preview book', 'your-plugin-textdomain'));
        $messages[$post_type][8] .= $preview_link;
        $messages[$post_type][10] .= $preview_link;
    }

    return $messages;
}

// Custom Shortcode
function printTextShortcode()
{
    return "<p style='font-size: 30px;'>This line of text is generated using a Custom Shortcode.</p>";
}

add_shortcode('printText', 'printTextShortcode');

// Custom Shortcode for getting current date and time

function getDateTime()
{
    $date = date('l jS \of F Y');
    date_default_timezone_set("Asia/Karachi");
    $time = date("h:i:sa");
    return "<h1>The current date is: $date</h1><br/><h1>and the current time is $time</h1>";
}

add_shortcode('DateTime', 'getDateTime');

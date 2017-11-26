<?php
/**
 *    Template Name: iventorypage
 **/

get_header();

$args = array(
    'post_type' => 'inventory',
    /*'tax_query' => array(
        array(
            'taxonomy' => 'people',
            'field'    => 'slug',
            'terms'    => 'bob',
        ),
    ),*/
);

// The Query
$the_query = new WP_Query($args);

// The Loop
if ($the_query->have_posts()) {
    echo '<ul>';
    while ($the_query->have_posts()) {
        $the_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
        echo get_field('quantity', get_the_ID());
    }
    echo '</ul>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}

get_footer();
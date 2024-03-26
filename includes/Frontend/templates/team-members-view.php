<?php
$members_to_show = '';

if ( isset( $atts['members_to_show'] ) ) {
    $members_to_show = $atts['members_to_show'];
}

// The Query
$args = array(
    'post_type'      => 'team_member', 
    'posts_per_page' => $members_to_show ? $members_to_show : 3,
);
$query = new WP_Query( $args );
?>

<div class="members-grid">
    <?php
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post(); 
            
            global $wpdb;

            $terms_query = $wpdb->prepare("
                SELECT t.*
                FROM {$wpdb->terms} AS t
                INNER JOIN {$wpdb->term_taxonomy} AS tt ON t.term_id = tt.term_id
                INNER JOIN {$wpdb->term_relationships} AS tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
                WHERE tr.object_id = %d
                AND tt.taxonomy = 'member_type'
            ", get_the_ID());

            // Execute the query
            $terms = $wpdb->get_results($terms_query);
            
            ?>
            <div class="member">
                <?php 
                // Check if post has a thumbnail
                if ( has_post_thumbnail() ) {
                    error_log(print_r(get_permalink(), true));
                    // Get the post thumbnail and wrap it in an anchor tag linking to the post
                    echo '<a href="' . esc_url( get_permalink() ) . '">';
                    the_post_thumbnail();
                    echo '</a>';
                }
                ?>
                <h3>
                    <?php 
                    // Wrap the post title in an anchor tag linking to the post
                    echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>';
                    ?>
                </h3>
                <?php
                // Display taxonomy terms if they exist
                if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                    foreach ( $terms as $term ) {
                        ?>
                        <p><?php echo $term->name; ?></p>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
        wp_reset_postdata(); // Reset post data
    } else {
        ?>
        <p>No team member found!</p>
        <?php
    }
    ?>
</div>
    
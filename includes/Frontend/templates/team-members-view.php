<?php

if ( isset( $atts['members_to_show'] ) ) {
    $members_to_show = $atts['members_to_show'];
}

// The Query
$args = array(
    'post_type' => 'team_member', 
    'posts_per_page' => -1,
);
$query = new WP_Query( $args );

?>

<div class="members-grid">
    <?php
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
            $query->the_post(); 
            $taxonomy_terms = get_the_terms( get_the_ID(), 'member_type');

    ?>
    <div class="member">
        <?php the_post_thumbnail(); ?>
        <h3><?php the_title(); ?></h3>
        <?php
            if ( ! is_wp_error( $taxonomy_terms ) && ! empty( $taxonomy_terms ) ) {
            //     // Terms exist, display them
                foreach ($taxonomy_terms as $term) {    
                    ?>
                    <p><?php echo $term->name; ?></p>
                    <?php
                }
            } ?>
    </div>
    
    <?php
            }
        } else {
            ?>
            <p> No team member found! </p>
            <?php
        }
    ?>

</div>
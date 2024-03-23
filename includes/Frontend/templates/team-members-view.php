<?php

if ( isset( $atts['members_to_show'] ) ) {
    $members_to_show = $atts['members_to_show'];
}



?>

<div class="members-grid">
    <!-- Member 1 -->
    <div class="member">
        <img src="member1-image.jpg" alt="Member 1">
        <h3>Member 1 Name</h3>
        <p>Designation 1</p>
    </div>

    <!-- Member 2 -->
    <div class="member">
        <img src="member2-image.jpg" alt="Member 2">
        <h3>Member 2 Name</h3>
        <p>Designation 2</p>
    </div>

    <!-- Member 3 -->
    <div class="member">
        <img src="member3-image.jpg" alt="Member 3">
        <h3>Member 3 Name</h3>
        <p>Designation 3</p>
    </div>

    <!-- Repeat for each row with 3 members -->
</div>
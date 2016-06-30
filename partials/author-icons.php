<ul class="author-social-icons">

<?php 
    $twitter_profile = get_the_author_meta( 'twitter_profile' );
    if ( $twitter_profile && $twitter_profile != '' ) {
        echo '<li><a href="' . esc_url($twitter_profile) . '" target="_blank"><i class="fa fa-twitter-square"></i></a></li>';
    }
    $facebook_profile = get_the_author_meta( 'facebook_profile' );
    if ( $facebook_profile && $facebook_profile != '' ) {
        echo '<li><a href="' . esc_url($facebook_profile) . '" target="_blank"><i class="fa fa-facebook-official"></i></a></li>';
    }
    $google_profile = get_the_author_meta( 'google_profile' );
    if ( $google_profile && $google_profile != '' ) {
        echo '<li><a href="' . esc_url($google_profile) . '" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>';
    }
    $linkedin_profile = get_the_author_meta( 'linkedin_profile' );
    if ( $linkedin_profile && $linkedin_profile != '' ) {
        echo '<li><a href="' . esc_url($linkedin_profile) . '" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>';
    }
?>

</ul><!-- end .author-social-icons -->
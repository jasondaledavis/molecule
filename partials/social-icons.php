<?php global $capstone_molecule; ?>

<ul class="social-icons">
<?php if ( isset($capstone_molecule['social-twitter']) && '' != $capstone_molecule['social-twitter'] ) { ?>
    <li><a class="social-twitter" href="<?php echo $capstone_molecule['social-twitter']; ?>" title="<?php _e( 'View Twitter Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-twitter-square"></i><div class="tooltip"><span>Twitter</span></div></a></li>
<?php } if ( isset($capstone_molecule['social-facebook']) && '' != $capstone_molecule['social-facebook'] ) { ?>
    <li><a class="social-facebook" href="<?php echo $capstone_molecule['social-facebook']; ?>" title="<?php _e( 'View Facebook Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-facebook-square"></i><div class="tooltip"><span>Facebook</span></div></a></li>
<?php } if ( isset($capstone_molecule['social-linkedin']) && '' != $capstone_molecule['social-linkedin'] ) { ?>
    <li><a class="social-linkedin" href="<?php echo $capstone_molecule['social-linkedin']; ?>" title="<?php _e( 'View Linkedin Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-linkedin-square"></i><div class="tooltip"><span>Linkedin</span></div></a></li>
<?php } if ( isset($capstone_molecule['social-pinterest']) && '' != $capstone_molecule['social-pinterest'] ) { ?>
    <li><a class="social-pinterest" href="<?php echo $capstone_molecule['social-pinterest']; ?>" title="<?php _e( 'View Pinterest Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-pinterest"></i><div class="tooltip"><span>Pinterest</span></div></a></li>
<?php } if ( isset($capstone_molecule['social-googleplus']) && '' != $capstone_molecule['social-googleplus'] ) { ?>
    <li><a class="social-googleplus" href="<?php echo $capstone_molecule['social-googleplus']; ?>" title="<?php _e( 'View Google Plus Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-google-plus"></i><div class="tooltip"><span>Google Plus</span></div></a></li>
<?php } if ( isset($capstone_molecule['social-instagram']) && '' != $capstone_molecule['social-instagram'] ) { ?>
    <li><a class="social-instagram" href="<?php echo $capstone_molecule['social-instagram']; ?>" title="<?php _e( 'View Instagram Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-instagram"></i><div class="tooltip"><span>Instagram</span></div></a></li>
<?php } if ( isset($capstone_molecule['social-youtube']) && '' != $capstone_molecule['social-youtube'] ) { ?>
    <li><a class="social-youtube" href="<?php echo $capstone_molecule['social-youtube']; ?>" title="<?php _e( 'View YouTube Profile', 'molecule' ); ?>" target="_blank"><i class="fa fa-youtube-play"></i><div class="tooltip"><span>YouTube</span></div></a></li>
<?php } ?>
</ul><!-- end .social-icons -->
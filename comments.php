<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package molecule
 */
 
// Do not delete these lines
if ( !empty( $_SERVER[ 'SCRIPT_FILENAME' ]) && 'comments.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) )
die ( 'Please do not load this page directly. Thanks!' );
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php echo __( 'This post is password protected. Enter the password to view comments.', 'molecule' ); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
 
<?php if ( have_comments() ) : ?>

<div id="comments" class="comments-area">

    <p class="comments-info"><?php echo __( 'currently there\'s', 'molecule' ); ?> <span><?php $commentscount = get_comments_number(); echo $commentscount; ?> <?php echo __( 'comment(s)', 'molecule' ); ?></span> <?php echo __( 'Would you like to add', 'molecule' ); ?> <span><?php echo __( 'your thoughts?', 'molecule' ); ?></span></p>
    
<ul class="comments-list">
    <?php wp_list_comments( 'callback=capstone_comments' ); ?>
</ul>
 
<div class="navigation">
    <div class="alignleft"><?php previous_comments_link() ?></div>
    <div class="alignright"><?php next_comments_link() ?></div>
</div>

</div><!-- end #comments -->

<?php else : // this is displayed if there are no comments so far ?>

<?php if ( comments_open() ) : ?>
    <!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->

<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>
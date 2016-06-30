<div class="meta-details">

    <p><?php _e( '<i class="fa fa-clock-o"></i>', 'molecule' ); ?> <span class="post-date updated"><?php the_time( 'F jS Y' ); ?></span> / <?php _e( '<i class="fa fa-folder-open-o"></i> in', 'molecule' ); ?> <span><?php the_category( ' & ' ); ?></span> / <?php _e( '<i class="fa fa-comment-o"></i> with', 'molecule' ); ?> <span><a href="#comments"><?php $commentscount = get_comments_number(); echo $commentscount; ?> <?php _e( 'Comments', 'molecule' ); ?></a></span> / 
            <a href="https://www.facebook.com/sharer/sharer.php?t=<?php the_title(); ?>&amp;u=<?php the_permalink(); ?>" onclick="window.open(this.href,this.target,'width=600,height=400,resizeable,scrollbars');return" target="_blank" ><i class="fa fa-facebook-official"></i></a>
            <a href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php echo the_permalink(); ?>" onclick="window.open(this.href,this.target,'width=600,height=400,resizeable,scrollbars');return" target="_blank" ><i class="fa fa-twitter-square"></i></a>
            <a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" id="google-plus" onclick="window.open(this.href,this.target,'width=500,height=400,resizeable,scrollbars');return" target="_blank" ><i class="fa fa-google-plus-square"></i></a></p>

</div><!-- end .meta-details -->
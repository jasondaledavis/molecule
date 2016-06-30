<form class="searchbar" method="get" action="<?php echo home_url( '/' ); ?>">

	<div class="input-prepend">

		<input type="text" id="prependedInput" name="s" size="100%" placeholder="<?php echo __( 'Enter your search term...', 'molecule' ); ?>" value="<?php the_search_query(); ?>">

	</div><!-- end .input-prepend -->

</form><!-- end .searchbar -->
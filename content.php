<!-- 以下に書き換えます (Twenty Fourteenテーマの場合) -->


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></p>
<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
?>
<p><?php echo mb_substr(get_the_excerpt(), 0, 100); ?></p>

</div>

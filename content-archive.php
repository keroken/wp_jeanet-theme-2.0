<?php
	$cat_info = apt_category_info();
?>
<div class="content_excerpt clearfix">
<?php if (!is_search()) : ?>
			<div class="news_headline">
				<span class="news_date"><?php the_time('Y年m月d日'); ?></span>
				<span class="news_category <?php echo esc_attr($cat_info->slug); ?>"><?php echo esc_html($cat_info->name); ?></span>
			</div>
<?php endif; ?>
	<div class="summary">
		<a href="<?php the_permalink(); ?>"><h3 class="title"><?php the_title(); ?></h3></a>
		<p><?php the_excerpt(); ?></p>
	</div>
	<?php if(has_post_thumbnail()) :?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(array(140,140), array('class' => 'right')); ?></a>		
    <?php endif; ?>
</div><!-- end .content_excerpt -->


<?php get_header(); ?>
<div id="container">

	<div id="main" role="main">
		<div id="content">
	
		<div class="thumbnail_lists">
			<ul>
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<li class="clearfix">
					<?php $cat_info = apt_category_info(); ?>
					<?php if(has_post_thumbnail()) :?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(array(150,150), array('class' => 'left')); ?></a>
					<?php endif; ?>
					<div class="top_content">
					<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>	
					<span class="news_date"><?php the_time('Y年m月d日'); ?></span>
					<span class="news_category <?php echo esc_attr($cat_info->slug); ?>"><?php echo esc_html($cat_info->name); ?></span>
					<div class="summary">
					<p><?php the_excerpt(); ?></p>
					</div>
					</div>
				</li>
				<?php endwhile; endif; ?>	
			</ul>
		</div>
	
<?php get_template_part('page_top_link'); ?>
		</div><!-- end #content -->
	</div><!-- end #main -->
	<?php get_sidebar(); ?>
</div><!-- end #container -->
<?php get_footer(); ?>
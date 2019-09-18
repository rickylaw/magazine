<?php
	if ($_GET['ajax']==true) :
?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); $visit = get_post_meta($post->ID, 'link', true); ?>
			
			<div class="post ajax-post">
				<h1><?php if ($visit) echo '<a href="'.$visit.'" title="Visit" rel="nofollow">'; ?><?php the_title(); ?><?php if ($visit) echo '</a>'; ?></h1>
				<?php
					the_content();
				?>
				<div class="clear"></div>
			</div>
			
		<?php endwhile; endif; ?>
<?php
	else :
?>

	<?php get_header(); ?>
	
	<div id="mainContent">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post">
				<h1><?php the_title(); ?></h1>
			
					<?php
					the_content();
				?>
				
			</div>
		
			
		
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.', 'minicard'); ?></p>
		<?php endif; ?>
		
		<div style="clear:both"></div>
	
	</div>
	
	<?php get_footer(); ?>

<?php endif; ?>
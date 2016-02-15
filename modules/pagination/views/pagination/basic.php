<p class="pagination">

	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first" class="paginate"><?php echo __('First') ?></a>
	<?php else: ?>
		<?php echo __('First') ?>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev" class="paginate"><?php echo __('Previous') ?></a>
	<?php else: ?>
		<?php echo __('Previous') ?>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<a href="<?php echo HTML::chars($page->url($i)) ?>" class="pg_strong paginate"><?php echo $i ?></a>
		<?php else: ?>
			<a href="<?php echo HTML::chars($page->url($i)) ?>" class="paginate"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next" class="paginate"><?php echo __('Next') ?></a>
	<?php else: ?>
		<?php echo __('Next') ?>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last" class="paginate"><?php echo __('Last') ?></a>
	<?php else: ?>
		<?php echo __('Last') ?>
	<?php endif ?>

</p><!-- .pagination -->
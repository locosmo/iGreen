<!--  treeview меню -->
    <?php $this->addJS("templates/{$this->name}/treeview/jquery.treeview.js"); ?>
    <?php $this->addJS("templates/{$this->name}/treeview/treeview_init.js"); ?>
	<?php $this->addCSS("templates/{$this->name}/treeview/jquery.treeview.css"); ?>
<!--  treeview меню -->
<div class="widget_user_avatar">

    <div class="user_info">

        <div class="avatar">
            <a href="<?php echo href_to('users', $user->id); ?>">
                <?php echo html_avatar_image($user->avatar, 'micro'); ?>
            </a>
        </div>

        <div class="name">
            <a href="<?php echo href_to('users', $user->id); ?>">
                <?php html($user->nickname); ?>
            </a>
        </div>

    </div>
    <div id="navigation" class="treview">
        <?php $this->menu( $widget->options['menu'], $widget->options['is_detect'], 'menu', $widget->options['max_items'] ); ?>
    </div>
</div>

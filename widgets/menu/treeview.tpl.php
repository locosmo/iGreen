<!--  treeview ���� -->
    <?php $this->addJS("templates/{$this->name}/treeview/jquery.treeview.js"); ?>
    <?php $this->addJS("templates/{$this->name}/treeview/treeview_init.js"); ?>
	<?php $this->addCSS("templates/{$this->name}/treeview/jquery.treeview.css"); ?>
<!--  treeview ���� -->
<div id="navigation_menu" class="treview">
<?php

    $this->menu( $widget->options['menu'], $widget->options['is_detect'], 'menu', $widget->options['max_items'], true );
?>
</div>
<?php $this->addCSS("templates/{$this->name}/menuv/css/menu_acc.css"); ?>
<?php $this->addCSS("templates/{$this->name}/menuv/css/blue.css"); ?>
<?php $this->addJS("templates/{$this->name}/js/jquery-cookie.js"); ?>
<?php $this->addJS("templates/{$this->name}/menuv/js/jquery.hoverIntent.minified.js"); ?>
<?php $this->addJS("templates/{$this->name}/menuv/js/jquery.dcjqaccordion.2.9.js"); ?>
<?php $this->addJS("templates/{$this->name}/menuv/js/load_accordion_menu.js"); ?>
<div class="blue demo-container">

    <ul class="accordion" id="accordion-1">

        <?php $last_level = 0; $is_visible = false; ?>

        <?php foreach($cats as $id=>$item){ ?>

            <?php
                isset($path[$item['parent_id']]) || $item['ns_level'] == 1;
                if (!isset($item['ns_level'])) { $item['ns_level'] = 1; }
                $item['childs_count'] = ($item['ns_right'] - $item['ns_left']) > 1;
                $url = href_to($ctype_name, $item['slug']);
            ?>

            <?php for ($i=0; $i<($last_level - $item['ns_level']); $i++) { ?>
                </li></ul>
            <?php } ?>

            <?php if ($item['ns_level'] <= $last_level) { ?>
                </li>
            <?php } ?>



            <li>

                <a class="item" href="<?php echo $url; ?>">
                    <?php html($item['title']); ?>
                </a>

                <?php if ($item['childs_count']) { ?><ul><?php } ?>

            <?php $last_level = $item['ns_level']; ?>

        <?php } ?>

        <?php for ($i=0; $i<$last_level; $i++) { ?>
            </li></ul>
        <?php } ?>

</div>
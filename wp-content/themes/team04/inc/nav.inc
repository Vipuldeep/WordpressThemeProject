<div id="slideout-menu">
        <ul>
            <li>
                <a href="<?php echo site_url(''); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo site_url('/blog'); ?>">Sustainability</a>
            </li>
            <li>
                <a href="<?php echo site_url('/projects'); ?>">Education</a>
            </li>
            <li>
                <a href="<?php echo site_url('/about'); ?>">About</a>
            </li>
            <li>
                <input type="text" placeholder="Search Here">
            </li>
        </ul>
    </div>

    <nav>
        <div id="logo-img">
            <a href="<?php echo site_url(''); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/1.png" alt="Ian Kirkwood">
            </a>
        </div>
        <div id="menu-icon">
            <i class="fas fa-bars"></i>
        </div>
        <ul>
            <li>
                <a href="<?php echo site_url(''); ?>"
                  <?php if(is_front_page()) echo 'class="active"' ?>
                  >Home</a>

            </li>
            <li>
                <a href="<?php echo site_url('/blog'); ?>"
                  <?php if(get_post_type() == 'post') echo 'class="active"' ?>
                  >Sustainability</a>
            </li>
            <li>
                <a href="<?php echo site_url('/projects'); ?>"
                  <?php if(get_post_type() == 'project') echo 'class="active"' ?>
                  >Education</a>
            </li>
            <li>
                <a href="<?php echo site_url('/about'); ?>"
                  <?php if(is_page('about')) echo 'class="active"' ?>
                  >About</a>
            </li>

            <li>
                <div id="search-icon">
                    <i class="fas fa-search"></i>
                </div>
            </li>
        </ul>
    </nav>

    <div id="searchbox">
        <input type="text" placeholder="Search Here">
    </div>

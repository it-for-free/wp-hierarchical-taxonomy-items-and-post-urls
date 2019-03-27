<?php

/*
Plugin Name: Hierarchical Taxonomy Items And Post Urls
Plugin URI: https://github.com/it-for-free/wp-hierarchical-taxonomy-items-and-post-urls
Description: Иерархические URL для категорий таксономии и записей в них // wordpress hierarchical urls for taxonomy nested items and posts in them
Version: 0.0.1
Author: vedro-compota
Author URI: https://github.com/it-for-free/wp-hierarchical-taxonomy-items-and-post-urls
*/

use ItForFree\WpAddons\Modules\HierarhicalUrls\HierarhicalUrls;

(new HierarhicalUrls())->init('uslugicat');


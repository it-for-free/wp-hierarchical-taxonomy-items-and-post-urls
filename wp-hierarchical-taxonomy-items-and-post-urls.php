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

//(new HierarhicalUrls())->init('uslugicat');

$options = get_option('htpu_options');

if (!empty($options['checked_taxonomies'])) {
    foreach ($options['checked_taxonomies'] as $taxonomy) {
        (new HierarhicalUrls())->init($taxonomy);
    }
}


// Добавляем пункт подменю для настроек плагнина в Settings menu
add_action('admin_menu', 'htpu_options_menu');

function htpu_options_menu() {
    add_options_page('Module Hierarchical Taxonomy Nested Items and Post urls', 'Hierarchical Taxonomy URLs', 'manage_options', 'htpu-options', 'htpu_options');
    add_action('admin_init', 'htpu_register_settings');
}

// Регистрируем настройки плагина
function htpu_register_settings() {
    register_setting('htpu_options', 'htpu_options', 'htpu_options_validate');

    add_settings_section('htpu_settings', 'Используемые таксономии', 'htpu_section_text', 'htpu-options');
    add_settings_field('htpu_checked_taxonomies', 'Включить плагин для таксономий:', 'htpu_checked_taxonomies', 'htpu-options', 'htpu_settings');
}

// Вывод чекбоксов для таксономий
function htpu_checked_taxonomies() {
    $options = get_option('htpu_options');

    $disabled_taxonomies = array('nav_menu', 'link_category', 'post_format');
    foreach (get_taxonomies() as $tax) : if (in_array($tax, $disabled_taxonomies))
            continue;
        ?>
        <input type="checkbox" name="htpu_options[checked_taxonomies][<?php echo $tax ?>]" value="<?php echo $tax ?>" <?php checked(isset($options['checked_taxonomies'][$tax])); ?> /> <?php echo $tax; ?><br />
    <?php
    endforeach;
}

// Вывод описания раздела
function htpu_section_text() {
    echo '<p>Выберете таксономии, '
    . 'для категориий которых (и записях, относящихся к этим категориям),'
    . ' будет включен данный плагин иерархических ссылок.</p>';
}

// Валидация настроек
function htpu_options_validate($input) {
    return $input;
}

function htpu_options() {
    if (!current_user_can('manage_options'))
        wp_die('You do not have sufficient permissions to access this page.');
    $options = get_option('htpu_options');
    ?>
    <div class="wrap">

        <h2><?php echo 'Hierarchical URLs'; ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('htpu_options'); ?>
            <?php do_settings_sections('htpu-options'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

<?php
/*
  Plugin Name: [WGT] Hierarchical Taxonomy Items And Post Urls
  Plugin URI: https://github.com/it-for-free/wp-hierarchical-taxonomy-items-and-post-urls
  Description: Иерархические URL для категорий таксономии и записей в них // wordpress hierarchical urls for taxonomy nested items and posts in them
  Version: 0.0.1
  Author: vedro-compota
  Author URI: https://github.com/it-for-free/wp-hierarchical-taxonomy-items-and-post-urls
 */

use ItForFree\WpHiUrls\HierarhicalUrls;

use ItForFree\WpAddons\Core\Admin\Settings\SettingsPage\SettingsPage;
use ItForFree\WpAddons\Core\Admin\Settings\SettingsPage\Section\Field\Html\TaxonomiesCheckboxList;

$options = get_option('htpu_options');

if (!empty($options['checked_taxonomies'])) {
    foreach ($options['checked_taxonomies'] as $taxonomy) {
        (new HierarhicalUrls())->init($taxonomy);
    }
}

$Page = new SettingsPage('htpu', 
    "Плагин иерархических URL для элементов таксономии и связанных с ними записей",
    "Плагин иерархических URL");
$Page->createAndAddSettingsEntity()
    ->createAndAddSection('main', 'Настройки плагина', 'Используйте форму ниже, чтобы задать настройки. <br>'
            . 'ВНИМАНИЕ: работа плагина требует, чтобы тип контента с тем же самым slug базовым был зарегистрирован раньше, чем таксономия '
            . '(например. может потребовать правка в модуле CPT UI). ');

$Page->getSectionById('main')->addSectionField(
   new TaxonomiesCheckboxList($Page->getSectionById('main'), 'checked_taxonomies',
        'Выбирите типы такосономий, дя которых следует активировать плагин')
);


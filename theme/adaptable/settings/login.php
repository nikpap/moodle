
<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    theme_adaptable
 * @copyright 2015 Jeremy Hopkins (Coventry University)
 * @copyright 2015 Fernando Acedo (3-bits.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

/* Login Page Settings */
$temp = new admin_settingpage('theme_adaptable_loginsettings', get_string('loginsettings', 'theme_adaptable'));
$temp->add(new admin_setting_heading('theme_adaptable_loginsettings', get_string('loginsettingssub', 'theme_adaptable'),
        format_text(get_string('loginsettingsdesc' , 'theme_adaptable'), FORMAT_MARKDOWN)));

// Set Number of Slides.

$name = 'theme_adaptable/loginbgnumber';
$title = get_string('loginsettings', 'theme_adaptable');
$description = get_string('loginsettingsdesc', 'theme_adaptable');
$default = '1';
$choice = array();
$choice[1] = '1';
$setting = new admin_setting_configselect($name, $title, $description, $default, $choice);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$hasloginbgnum = (!empty($PAGE->theme->settings->loginbgnumber));
if ($hasloginbgnum) {
    $loginbgnum = $PAGE->theme->settings->loginbgnumber;
} else {
    $loginbgnum = '3';
}

foreach (range(1, $loginbgnum) as $i) {
    $name = 'theme_adaptable/loginimage';
    $title = get_string('loginimage', 'theme_adaptable');
    $description = get_string('loginimagedesc', 'theme_adaptable');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
}

$ADMIN->add('theme_adaptable', $temp);
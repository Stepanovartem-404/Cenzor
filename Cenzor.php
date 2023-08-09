<?php
/*
 Plugin Name: Cenzor
 Description: remove obscene words.
 Version: 1.0
 Author: Artem Stepanov

 Copyright 2022  Artem Stepanov  (email: stepanovartem313@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function plugin_dir_path($__FILE__) {}

define('CENZOR_DIR', plugin_dir_path(__FILE__));

function cenzor_filter_the_content($the_content)
{
	static $badwords = array();

	if (empty($badwords)) {
		$badwords = explode(',', file_get_contents(CENZOR_DIR . 'badwords.txt'));
	}
	for ($i = 0, $c = count($badwords); $i < $c; $i++) {
		$the_content = preg_replace('#' . $badwords[$i] . '#iu', '{bad word}', $the_content);
	}
	return $the_content;
}

add_filter('the_content', 'cenzor_filter_the_content');


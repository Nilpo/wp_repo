<?php
/**
 * @package WP-Repo
 * @version 0.1
 */
/*
Plugin Name: WP Repo
Plugin URI: 
Description: <cite>WP Repo</cite> Is a simple plugin that implements repo.js for integrating GitHub repositories into Wordpress posts.
Version: 0.1
Author: Rob "Nilpo" Dunham
Author URI: http://robdunham.info/
License: GPL2
*/

/*  Copyright 2014  Rob "Nilpo" Dunham  (email : contact@robdunham.info)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$loadInFooter = false;

function repo_init() {
    if (!is_admin()) {
        //wp_enqueue_script('jquery');      // should load as a dependency below
        wp_register_script('repojs', '//cdnjs.cloudflare.com/ajax/libs/repo.js/5c0eae0f1b/repo.min.js', array('jquery'), null, $loadInFooter);
        wp_enqueue_script('repojs');
    }
}
add_action('init', 'repo_init');


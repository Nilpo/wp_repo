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

/**
 * Boolean value indicating whether scripts should be loaded in the page footer
 */
$loadInFooter = false;

/**
 * Counts instances on the page
 */
$instance = 0;

/**
 * Loads required scripts in the page
 */
function repo_init() {
    global $loadInFooter;
    
    if (!is_admin()) {
        if (!wp_script_is('jquery')) {
            wp_enqueue_script('jquery', '//code.jquery.com/jquery-latest.min.js', false, null, $loadInFooter);
        }
        wp_register_script('repojs', '//cdnjs.cloudflare.com/ajax/libs/repo.js/5c0eae0f1b/repo.min.js', array('jquery'), null, $loadInFooter);
        wp_register_script('wprepo', plugins_url('wp-repo.js' , dirname(__FILE__)), array('repojs'), null, $loadInFooter);
        wp_enqueue_script('repojs');
        wp_enqueue_script('wprepo');
    }
}

add_action('init', 'repo_init');



// [repo user="user-value" name="name-value" branch="branch-value"]
function repo_handler($attribs, $content = null) {
    global $instance;
    
    $a = shortcode_atts( array(
        'user'   => null,
        'name'   => null,
        'branch' => null
    ), $attribs );
    
    if ($a['user'] === null || $a['name'] === null)
        return $attribs[0];
    
    $branch = (is_null($a['branch'])) ? $a['branch'] : 'master';
    $loading = "Loading...";  //TODO: add loading icon
    //TODO: eliminate branch when not explicitly provided
    $html = '<div id="wp-repo_%s" class="wp-repo" data-user="%s" data-name="%s" data-branch="%s">%s</div>';
    
    return sprintf($html, ++$instance, $a['user'], $a['name'], $branch, $loading);
}

add_shortcode('repo', 'repo_handler');

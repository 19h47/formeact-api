<?php
/**
 * API Forméact functions and definitions
 *
 * PHP version 7.3.8
 *
 * @package Formeact
 * @since   1.0.0
 * @link    https://github.com/19h47/formeact-api
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @see     https://developer.wordpress.org/themes/basics/theme-functions/
 */

require_once get_template_directory() . '/vendor/autoload.php';

use Formeact\{ App };

new App( 'formeact', wp_get_theme()->Version ); // phpcs:ignore

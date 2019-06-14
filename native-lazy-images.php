<?php

/*
  Plugin Name: Native Lazy Images
  Plugin URI: http://marc.tv/
  Description: Adds loading=lazy attribute to all oembed iframnes.
  Version: 1.0
  Author: MarcDK
  Author URI: https://marc.tv
  GitHub Plugin URI: mtoensing/native-lazy-oembed
  License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  your option) any later version.

  This software uses the galleria http://galleria.io framework which uses the MIT License.
  The license is also GPL-compatible, meaning that the GPL permits combination
  and redistribution with software that uses the MIT License.

 */

 add_filter('the_content', 'the_content_lazy_images', 15);  // hook into filter and use


/**
 *
 * Modified from: Sunyatasattva
 * https://wordpress.stackexchange.com/questions/81522/change-html-structure-of-all-img-tags-in-wordpress
 * @param $the_content
 *
 * @return string
 *
 *
 * Initial use of code gave warning: DOMDocument::loadHTML(): Unexpected end tag : p
 * Due to invalid HTML
 *
 * https://stackoverflow.com/questions/11819603/dom-loadhtml-doesnt-work-properly-on-a-server
 *
 * libxml_use_internal_errors(true);
 */


function the_content_lazy_images($the_content) {

    libxml_use_internal_errors(true);

    $post = new DOMDocument();

    $post->loadHTML( '<?xml encoding="utf-8" ?>' . $the_content, 0 | LIBXML_NOENT );

    $imgs = $post->getElementsByTagName('img');

    // Iterate each img tag
    foreach( $imgs as $img ) {


        $img->setAttribute('loading','lazy');


    };

    return $post->saveHTML();
}
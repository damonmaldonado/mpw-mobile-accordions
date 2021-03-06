<?php
/*
Plugin Name: mobile_accordion_sections
Description: put content in an accordion on mobile only, wrap content in <code> < section class='accordion-m'> and add [acco_script] at end of content and will create accordions with headings tags as titles and divs right after headings as contents
Version: 0.2
Author: 
License: GPL2
*/
?>
<?php
/*  Copyright 2015

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
?>
<?php


function enqueue_acco_script () {
    wp_enqueue_script( 'jquery-ui' );
    $mpw_accordion_script = "<style>
.accordion-m .alignright, .accordion-c .align-right {
    margin-bottom: 10px;
}
.mobile-only {display:none;}
@media screen and (max-width:767px){
    .accordion-c ul, .accordion-m ul {clear: both;}
    .mobile-only {display:initial;}
}
</style>
<script>
function jqUpdateSize(){
    // Get the dimensions of the viewport
    var width = jQuery(window).width();
    var height = jQuery(window).height();
    console.log(width);
    return width;
};
var is_accordion = false;
jQuery(document).ready(function(){
    var width = jqUpdateSize();
    if (width < 769){
        console.log('mobile');
        jQuery('.accordion-m').accordion({
            collapsible: true,
            active: false
        });
    is_accordion = true;
    }
    jQuery(window).resize(function() {
        if (jqUpdateSize() < 769 && !is_accordion){
                console.log('resize small no accordion');
            jQuery('.accordion-m').accordion({
                collapsible: true,
                active: false
            });
        is_accordion = true;
        } else if (jqUpdateSize() > 768 && is_accordion){
                            console.log('resize large accordion');
            jQuery('.accordion-m').accordion('destroy');
            is_accordion = false;
        }
    });
});
</script>";
    $cont = $mpw_accordion_script;
    return do_shortcode($cont);
}
add_shortcode('acco_script', 'enqueue_acco_script' );

function enqueue_acco_script_old () {
    wp_enqueue_script( 'jquery-ui' );
    $mpw_accordion_script = "<style>
.accordion .alignright {
    margin-bottom: 10px;
}
.mobile-only {display:none;}
@media screen and (max-width:767px){
    .accordion ul {clear: both;}
    .mobile-only {display:initial;}
}
</style>
<script>
function jqUpdateSize(){
    // Get the dimensions of the viewport
    var width = jQuery(window).width();
    var height = jQuery(window).height();
    console.log(width);
    return width;
};
var is_accordion = false;
jQuery(document).ready(function(){
    var width = jqUpdateSize();
    if (width < 769){
        console.log('mobile');
        jQuery('.accordion').accordion({
            collapsible: true,
            active: false
        });
    is_accordion = true;
    }
    jQuery(window).resize(function() {
        if (jqUpdateSize() < 769 && !is_accordion){
                console.log('resize small no accordion');
            jQuery('.accordion').accordion({
                collapsible: true,
                active: false
            });
        is_accordion = true;
        } else if (jqUpdateSize() > 768 && is_accordion){
                            console.log('resize large accordion');
            jQuery('.accordion').accordion('destroy');
            is_accordion = false;
        }
    });
});
</script>";
    $cont = $mpw_accordion_script;
    return do_shortcode($cont);
}
add_shortcode('acco_script_old', 'enqueue_acco_script_old' );

function mpw_constant_accordion_script () {
        wp_enqueue_script( 'jquery-ui' );
        $cont = "<script>jQuery(document).ready(function(){
            jQuery('.accordion-c').accordion({
            collapsible: true,
            active: false
        });
});
</script>";
    return do_shortcode($cont);
}

add_shortcode('acco_script_c', 'mpw_constant_accordion_script' );



function mpw_acco_scripts_method() {
    wp_register_script(
        'jquery-ui',
        plugins_url( '/js/jquery-ui.js' , __FILE__ ),
        array( 'jquery' ),
        '1.11.4',
        true
    );
    wp_enqueue_style( 'jquery-ui-css', plugins_url( '/css/jquery-ui.css' , __FILE__ ) );
    wp_enqueue_style( 'jquery-structure-css', plugins_url( '/css/jquery-ui.structure.css' , __FILE__ ) );
    wp_enqueue_style( 'jquery-theme-css', plugins_url( '/css/jquery-ui.theme.css' , __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'mpw_acco_scripts_method' );
?>
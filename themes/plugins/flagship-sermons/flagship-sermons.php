<?php
/*
Plugin Name: Flagship Sermon Shortcode
Plugin URI: http://luke.gedeon.name/
Description: Use shortcode [flagship-sermons] to place a list of recent sermons from soundfaith.com
Version: 1.0
Author: lgedeon
Author URI: http://luke.gedeon.name/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2017 Luke Gedeon
*/

add_shortcode( 'flagship-sermons', function() {
        return '<iframe frameborder="0" scrolling="no" allowfullscreen src="https://soundfaith.com/embed/profile/6493921/recent?includePlaylist=true" width="600" height="705"></iframe>';
    });

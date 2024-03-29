<?php
/**
 * Snuffle Event Library
 * Copyright (c) 2013, Andrew Heebner, All rights reserved.
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library.
 */

include '../vendor/autoload.php';

$event = new Snuffle\EventLib();

$event->on('some.event', function() {
    var_dump(func_get_args());
});

$event->emit('some.event', array('foo', 'bar', 'baz'));

?>
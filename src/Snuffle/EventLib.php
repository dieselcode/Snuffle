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

namespace Snuffle;

/**
 * Class EventLib
 * @package Snuffle
 */
class EventLib
{

    /**
     * @var array
     */
    private $listeners = [];

    /**
     * @var null
     */
    private $currEvent = null;

    public function __construct()
    {
    }

    /**
     * on: Set an event callback for a specified event name.
     *
     * @param string   $event
     * @param callable $callback
     */
    public function on($event, callable $callback)
    {
        if (!array_key_exists($event, $this->listeners)) {
            $this->listeners[$event] = [];
        }

        $this->listeners[$event][] = $callback;
        $this->currEvent = $event;
    }

    /**
     * emit: Emit a specified event to be handled.
     *
     * @param string $event
     * @param mixed  $args
     *
     * @return bool
     */public function emit($event, $args)
    {
        if (array_key_exists($event, $this->listeners)) {
            foreach ($this->listeners[$event] as $callback) {
                $args = !is_array($args) ? array($args) : $args;
                call_user_func_array($callback, $args);

                return true;
            }
        }

        return false;
    }

    /**
     * remove: Remove an entire event chain, or all events as a whole.
     *
     * @param mixed $event
     *
     * @return bool
     */public function remove($event = null)
    {
        if (is_null($event)) {
            $this->listeners = [];
            return true;
        } elseif (!is_null($event) && array_key_exists($event, $this->listeners)) {
            unset($this->listeners[$event]);
            return true;
        }

        return false;
    }



}

?>
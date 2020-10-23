<?php

function create($class, $attributies = [], $times = null)
{
    return factory($class, $times)->create($attributies);
}

function make($class, $attributies = [], $times = null)
{
    return factory($class, $times)->make($attributies);
}
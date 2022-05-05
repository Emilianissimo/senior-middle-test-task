<?php

if (! function_exists('env')) {
    function env(?string $name, bool $localOnly = false)
    {
        return getenv($name, $localOnly);
    }
}
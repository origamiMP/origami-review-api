<?php

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('currentUser')) {

    /**
     * @return \App\Models\User
     */
    function currentUser()
    {
        return \Auth::user();
    }
}
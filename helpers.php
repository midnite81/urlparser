<?php

if (! function_exists('urlparse')) {
    /**
     * Return an instance of the URL class.
     *
     * @param string $url
     * @return \Midnite81\UrlParser\Url
     */
    function urlparse(string $url)
    {
        return new \Midnite81\UrlParser\Url($url);
    }
}
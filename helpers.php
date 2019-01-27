<?php

if (! function_exists('urlparse')) {
    /**
     * Return an instance of the URL class.
     *
     * @param string $url
     * @return \Midnite81\UrlParser\Url
     * @throws \Midnite81\UrlParser\Exceptions\MalformedUrlException
     */
    function urlparse(string $url): \Midnite81\UrlParser\Url
    {
        return new \Midnite81\UrlParser\Url($url);
    }
}
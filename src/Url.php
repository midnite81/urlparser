<?php

namespace Midnite81\UrlParser;

use Midnite81\UrlParser\Exceptions\MalformedUrlException;
use Midnite81\UrlParser\Traits\Getters;

class Url
{
    use Getters;

    /** @var string  */
    protected $url;

    /** @var array|null */
    protected $parsedUrl;

    /**
     * Url constructor.
     *
     * @param $url
     * @throws \Exception
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->parsedUrl = parse_url($url);
        $this->checkSafe();
    }

    /**
     * Return all segments
     *
     * @return array
     */
    public function all(): array
    {
        return [
            'scheme'    => ! empty($this->parsedUrl['scheme'])   ? $this->parsedUrl['scheme']    : null,
            'host'      => ! empty($this->parsedUrl['host'])     ? $this->parsedUrl['host']      : null,
            'port'      => ! empty($this->parsedUrl['port'])     ? $this->parsedUrl['port']      : null,
            'user'      => ! empty($this->parsedUrl['user'])     ? $this->parsedUrl['user']      : null,
            'pass'      => ! empty($this->parsedUrl['pass'])     ? $this->parsedUrl['pass']      : null,
            'path'      => ! empty($this->parsedUrl['path'])     ? $this->parsedUrl['path']      : null,
            'query'     => ! empty($this->parsedUrl['query'])    ? $this->parsedUrl['query']     : null,
            'fragment'  => ! empty($this->parsedUrl['fragment']) ? $this->parsedUrl['fragment']  : null,
        ];
    }

    /**
     * Get parameter
     *
     * @param $key
     * @return string|null
     */
    public function get($key): ?string
    {
        if (array_key_exists($key, $this->all())) {
            return $this->all()[$key];
        }
        return null;
    }

    /**
     * Get URL segments
     *
     * @return array
     */
    public function segments()
    {
        return explode('/', $this->get('path'));
    }

    /**
     * Get a segment of the url (path)
     *
     * @param int $key
     * @return mixed|null
     */
    public function segment(int $key): ?string
    {
        return ! empty($this->segments()[$key-1]) ? $this->segments()[$key-1] : null;
    }


    /**
     * Throw exception if parsed url is Malformed
     *
     * @throws MalformedUrlException
     */
    protected function checkSafe()
    {
        if ($this->parsedUrl === false) {
            throw new MalformedUrlException('URL was malformed');
        }
    }
}
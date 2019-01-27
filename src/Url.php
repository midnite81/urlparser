<?php

namespace Midnite81\UrlParser;

use Midnite81\UrlParser\Exceptions\MalformedUrlException;
use Midnite81\UrlParser\Exceptions\ParameterMustBeGreaterThanZeroException;
use Midnite81\UrlParser\Traits\Getters;

class Url
{
    use Getters;

    /** @var string */
    protected $url;

    /** @var array|null */
    protected $parsedUrl;

    /**
     * Url constructor.
     *
     * @param $url
     * @throws MalformedUrlException
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->parseUrl($url);
    }

    /**
     * Factory Create
     *
     * @param string $url
     * @return Url
     * @throws MalformedUrlException
     */
    public static function create(string $url): Url
    {
        return new static($url);
    }

    /**
     * Return all segments
     *
     * @return array
     */
    public function all(): array
    {
        return [
            'scheme' => ! empty($this->parsedUrl['scheme']) ? $this->parsedUrl['scheme'] : null,
            'host' => ! empty($this->parsedUrl['host']) ? $this->parsedUrl['host'] : null,
            'port' => ! empty($this->parsedUrl['port']) ? $this->parsedUrl['port'] : null,
            'user' => ! empty($this->parsedUrl['user']) ? $this->parsedUrl['user'] : null,
            'pass' => ! empty($this->parsedUrl['pass']) ? $this->parsedUrl['pass'] : null,
            'path' => ! empty($this->parsedUrl['path']) ? $this->parsedUrl['path'] : null,
            'query' => ! empty($this->parsedUrl['query']) ? $this->parsedUrl['query'] : null,
            'fragment' => ! empty($this->parsedUrl['fragment']) ? $this->parsedUrl['fragment'] : null,
        ];
    }

    /**
     * Json Encoded segments
     *
     * @return string
     */
    public function json(): string
    {
        return json_encode($this->all());
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
    public function segments(): array
    {
        $path = preg_replace('/(^\/)/', '', $this->get('path'));
        $path = preg_replace('/(\/$)/', '', $path);

        return explode('/', $path);
    }

    /**
     * Get a segment of the url (path)
     *
     * @param int $index
     * @return mixed|null
     */
    public function segment(int $index): ?string
    {
        return ! empty($this->segments()[$index - 1]) ? $this->segments()[$index - 1] : null;
    }

    /**
     * Return an encoded url
     *
     * @param int $times
     * @return string
     * @throws ParameterMustBeGreaterThanZeroException
     */
    public function encode(int $times = 1): string
    {
        $url = $this->url;

        if ($times < 1) {
            throw new ParameterMustBeGreaterThanZeroException('Number of times cannot be less than one');
        }

        for ($i = 0; $i < $times; $i++) {
            $url = urlencode($url);
        }

        return $url;
    }

    /**
     * Get the query string as a key pair set
     *
     * @param string $delimiter
     * @param string $secondDelimiter
     * @return array
     */
    public function queryArray(string $delimiter = '&', string $secondDelimiter = '='): array
    {
        return $this->getKeyPairValues($this->query(), $delimiter, $secondDelimiter);
    }

    /**
     * Get Value from Query String Key
     *
     * @param string $key
     * @param string $delimiter
     * @param string $secondDelimiter
     * @return string|null
     */
    public function getQueryValue(string $key, string $delimiter = '&', string $secondDelimiter = '='): ?string
    {
        if (array_key_exists($key, $this->queryArray($delimiter, $secondDelimiter))) {
            return $this->queryArray($delimiter, $secondDelimiter)[$key];
        }
        return null;
    }

    /**
     * Get Value from Hash Key
     *
     * @param string $key
     * @param string $delimiter
     * @param string $secondDelimiter
     * @return string|null
     */
    public function getHashValue(string $key, string $delimiter = '&', string $secondDelimiter = '='): ?string
    {
        if (array_key_exists($key, $this->fragmentArray($delimiter, $secondDelimiter))) {
            return $this->fragmentArray($delimiter, $secondDelimiter)[$key];
        }
        return null;
    }

    /**
     * Get the fragment as a key pair set
     *
     * @param string $delimiter
     * @param string $secondDelimiter
     * @return array
     */
    public function fragmentArray(string $delimiter = '&', string $secondDelimiter = '='): array
    {
        return $this->getKeyPairValues($this->fragment(), $delimiter, $secondDelimiter);
    }

    /**
     * Double Encode the URL
     *
     * @return string
     * @throws ParameterMustBeGreaterThanZeroException
     */
    public function doubleEncode(): string
    {
        return $this->encode(2);
    }

    /**
     * To string Method
     *
     * @return false|string
     */
    public function __toString(): string
    {
        return json_encode($this->all());
    }


    /**
     * Throw exception if parsed url is Malformed
     *
     * @param string $url
     * @throws MalformedUrlException
     */
    protected function parseUrl(string $url): void
    {
        $this->parsedUrl = parse_url($url);

        if ($this->parsedUrl === false) {
            throw new MalformedUrlException($this->url);
        }
    }

    /**
     * Get key pair values from a url string
     *
     * @param string $item
     * @param string $delimiter
     * @param string $secondDelimiter
     * @return array
     */
    protected function getKeyPairValues(string $item, string $delimiter = '&', string $secondDelimiter = '=')
    {
        $newArray = [];

        $array = explode($delimiter, $item);

        if ( ! empty($array)) {
            foreach ($array as $arrayItem) {
                $split = explode($secondDelimiter, $arrayItem);
                $key = ! empty($split[0]) ? $split[0] : '';
                $value = ! empty($split[1]) ? $split[1] : '';
                $newArray[$key] = $value;
            }
        }

        return $newArray;
    }
}
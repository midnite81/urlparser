<?php

namespace Midnite81\UrlParser\Traits;

trait Getters
{
    /**
     * Get the scheme
     *
     * @return string|null
     */
    public function scheme()
    {
        return $this->get('scheme');
    }

    /**
     * Get the host
     *
     * @return string|null
     */
    public function host()
    {
        return $this->get('host');
    }

    /**
     * Get the port
     *
     * @return string|null
     */
    public function port()
    {
        return $this->get('port');
    }

    /**
     * Get the user
     *
     * @return string|null
     */
    public function user()
    {
        return $this->get('user');
    }

    /**
     * Get the pass
     *
     * @return string|null
     */
    public function pass()
    {
        return $this->get('pass');
    }

    /**
     * Get the path
     *
     * @return string|null
     */
    public function path()
    {
        return $this->get('path');
    }

    /**
     * Get the query
     *
     * @param bool $includeQuestionMark
     * @return string|null
     */
    public function query(bool $includeQuestionMark = false)
    {
        if ($includeQuestionMark) {
            return '?' . $this->get('query');
        }
        return $this->get('query');
    }


    /**
     * Get the query
     *
     * @param bool $includeHash
     * @return string|null
     */
    public function fragment(bool $includeHash = false)
    {
        if ($includeHash) {
            return '#' . $this->get('fragment');
        }
        return $this->get('fragment');
    }
}
<?php

namespace Midnite81\UrlParser\Traits;

trait Getters
{
    /**
     * Get the scheme
     *
     * @return string|null
     */
    public function scheme(): ?string
    {
        return $this->get('scheme');
    }

    /**
     * Get the host
     *
     * @return string|null
     */
    public function host(): ?string
    {
        return $this->get('host');
    }

    /**
     * Get the port
     *
     * @return string|null
     */
    public function port(): ?string
    {
        return $this->get('port');
    }

    /**
     * Get the user
     *
     * @return string|null
     */
    public function user(): ?string
    {
        return $this->get('user');
    }

    /**
     * Get the pass
     *
     * @return string|null
     */
    public function pass(): ?string
    {
        return $this->get('pass');
    }

    /**
     * Get the path
     *
     * @return string|null
     */
    public function path(): ?string
    {
        return $this->get('path');
    }

    /**
     * Returns the 'filename' part of the path
     *
     * @return string|null
     */
    public function fileName(): ?string
    {
        return basename($this->get('path'));
    }

    /**
     * Get the query
     *
     * @param bool $includeQuestionMark
     * @return string|null
     */
    public function query(bool $includeQuestionMark = false): ?string
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
    public function fragment(bool $includeHash = false): ?string
    {
        if ($includeHash) {
            return '#' . $this->get('fragment');
        }
        return $this->get('fragment');
    }
}
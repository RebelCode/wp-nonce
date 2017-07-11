<?php

namespace RebelCode\WordPress\Nonce;

/**
 * Basic functionality for a nonce.
 *
 * @since [*next-version*]
 */
abstract class AbstractNonce
{
    /**
     * The ID of the nonce.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $id;

    /**
     * The nonce code.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $code;

    /**
     * Retrieves the ID of the nonce.
     *
     * @since [*next-version*]
     *
     * @return string
     */
    protected function _getId()
    {
        return $this->id;
    }

    /**
     * Sets the ID of the nonce.
     *
     * @since [*next-version*]
     *
     * @param string $id The new nonce ID.
     *
     * @return $this
     */
    protected function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retrieves the nonce code.
     *
     * @since [*next-version*]
     *
     * @return string
     */
    protected function _getCode()
    {
        return $this->code;
    }

    /**
     * Sets the nonce code.
     *
     * @since [*next-version*]
     *
     * @param string $code The new nonce code.
     *
     * @return $this
     */
    protected function _setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}

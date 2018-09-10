<?php

namespace RebelCode\WordPress\Nonce;

use Dhii\Util\String\StringableInterface as Stringable;

/**
 * A simple, default implementation of a WordPress nonce.
 *
 * @since [*next-version*]
 */
class Nonce extends AbstractNonce implements NonceInterface, Stringable
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string      $id   The ID of the nonce.
     * @param string|null $code The nonce code.
     */
    public function __construct($id, $code)
    {
        $this->_setId($id)
             ->_setCode($code);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getId()
    {
        return $this->_getId();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getCode()
    {
        return $this->_getCode();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function __toString()
    {
        return (string) $this->_getCode();
    }
}

<?php

namespace RebelCode\WordPress\Nonce;

/**
 * Basic functionality for something that is aware of a nonce.
 *
 * @since [*next-version*]
 */
trait NonceAwareTrait
{
    /**
     * The nonce instance.
     *
     * @since [*next-version*]
     *
     * @var NonceInterface
     */
    protected $nonce;

    /**
     * Retrieves the nonce instance.
     *
     * @since [*next-version*]
     *
     * @return NonceInterface
     */
    protected function _getNonce()
    {
        return $this->nonce;
    }

    /**
     * Sets the nonce for this instance.
     *
     * @since [*next-version*]
     *
     * @param NonceInterface $nonce The new nonce instance.
     *
     * @return $this
     */
    protected function _setNonce(NonceInterface $nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }
}

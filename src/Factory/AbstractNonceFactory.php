<?php

namespace RebelCode\WordPress\Nonce\Factory;

use RebelCode\WordPress\Nonce\NonceInterface;

/**
 * Basic functionality for a nonce factory.
 *
 * @since [*next-version*]
 */
abstract class AbstractNonceFactory
{
    /**
     * Creates a new nonce instance.
     *
     * @since [*next-version*]
     *
     * @param string $id   Optional ID for the nonce to be generated.
     * @param array  $args Optional additional arguments.
     *
     * @return NonceInterface
     */
    protected function _make($id = '', $args = [])
    {
        $code = $this->_generateNonceCode($id);

        return $this->_createNonceInstance($id, $code);
    }

    /**
     * Generates a nonce code for a given ID.
     *
     * @since [*next-version*]
     *
     * @param string $id The ID of the nonce for which a code will be generated.
     
     * @return string The generated nonce code.
     */
    protected function _generateNonceCode($id)
    {
        return \wp_create_nonce($id);
    }

    /**
     * Creates a nonce instance.
     *
     * @since [*next-version*]
     *
     * @param string $id   The ID of the nonce.
     * @param string $code The nonce code.
     *
     * @return NonceInterface The created nonce instance.
     */
    abstract protected function _createNonceInstance($id, $code);
}

<?php

namespace RebelCode\WordPress\Nonce\Factory;

use RebelCode\WordPress\Nonce\Nonce;

/**
 * The simple, default implementation of a factory that can create nonce instances.
 *
 * @since [*next-version*]
 */
class NonceFactory extends AbstractNonceFactory implements NonceFactoryInterface
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     */
    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function make($config = [])
    {
        return $this->_make($config);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _createNonceInstance($id, $code)
    {
        return new Nonce($id, $code);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _generateNonceCode($id)
    {
        return \wp_create_nonce($id);
    }
}

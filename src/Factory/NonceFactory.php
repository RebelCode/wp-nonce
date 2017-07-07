<?php

namespace RebelCode\WordPress\Nonce\Factory;

use Dhii\Factory\FactoryInterface;
use RebelCode\WordPress\Nonce\Nonce;
use RebelCode\WordPress\Nonce\NonceInterface;

/**
 * The simple, default implementation of a factory that can create nonce instances.
 *
 * @since [*next-version*]
 */
class NonceFactory extends AbstractNonceFactory implements FactoryInterface
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
     * Creates  a new nonce instance.
     *
     * @since [*next-version*]
     *
     * @param string $id     The ID of the nonce.
     * @param array  $config Optional additional arguments.
     *
     * @return NonceInterface
     */
    public function make($id = '', $config = [])
    {
        return $this->_make($id, $config);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _createNonce($id, $code)
    {
        return new Nonce($id, $code);
    }
}

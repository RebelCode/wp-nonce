<?php

namespace unit\Factory;

use RebelCode\WordPress\Nonce\Factory\DelegatingNonceFactory;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Factory\DelegatingNonceFactory}.
 *
 * @since [*next-version*]
 */
class DelegatingNonceFactoryTest extends TestCase
{
    /**
     * The class name of the nonce class to use for testing.
     *
     * @since [*next-version*]
     */
    const NONCE_CLASSNAME = 'RebelCode\\WordPress\\Nonce\\NonceInterface';

    /**
     * Creates a nonce for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param string $id   The nonce ID.
     * @param string $code The nonce code.
     *
     * @return NonceInterface
     */
    public function createNonce($id = '', $code = '')
    {
        return $this->mock(static::NONCE_CLASSNAME)
                    ->getId($id)
                    ->getCode($code)
                    ->new();
    }

    public function createFactory($nonceId = 'nonce')
    {
        $me = $this;

        $mock = $this->mock('Dhii\\Factory\\FactoryInterface')
            ->make(function($id, $config) use ($me, $nonceId) {
                if ($id !== $nonceId) {
                    return null;
                }

                return $me->createNonce($config['id'], $config['code']);
            })
            ->new();

        return $mock;
    }

    public function testCanBeCreated()
    {
        $factory = $this->createFactory();
        $subject = new DelegatingNonceFactory($factory);

        $this->assertInstanceOf(
            'RebelCode\\WordPress\\Nonce\\Factory\\NonceFactoryInterface', $subject,
            'Subject does not implement expected interface'
        );
    }

    /**
     * Tests the nonce creation method to ensure that the created instance is a valid nonce instance.
     *
     * @since [*next-version*]
     */
    public function testMakeInstanceType()
    {
        $factory = $this->createFactory('wp_nonce');
        $subject = new DelegatingNonceFactory($factory, 'wp_nonce');

        $nonce = $subject->make('');

        $this->assertInstanceOf(
            'RebelCode\\WordPress\\Nonce\\NonceInterface', $nonce,
            'Created nonce is not a valid nonce instance.'
        );
    }

    /**
     * Tests the nonce creation method to ensure that the created nonce has the given ID.
     *
     * @since [*next-version*]
     */
    public function testMakeNonceId()
    {
        $factory = $this->createFactory('wp_nonce');
        $subject = new DelegatingNonceFactory($factory, 'wp_nonce');

        $nonce = $subject->make($id = 'my-nonce');

        $this->assertEquals($id, $nonce->getId());
    }
}

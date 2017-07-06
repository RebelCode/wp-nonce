<?php

namespace unit\Factory;

use RebelCode\WordPress\Nonce\Factory\NonceFactory;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Factory\NonceFactory}.
 *
 * @since [*next-version*]
 */
class NonceFactoryTest extends TestCase
{
    /**
     * The class name of the nonce class to use for testing.
     *
     * @since [*next-version*]
     */
    const NONCE_CLASSNAME = 'RebelCode\\WordPress\\Nonce\\NonceInterface';

    /**
     * Tests whether a valid instance can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new NonceFactory();

        $this->assertInstanceOf(
            'Dhii\\Factory\\FactoryInterface', $subject,
            'Subject does not implement expected interface.'
        );
    }

    /**
     * Tests the nonce creation method to ensure that the created nonce is a valid nonce instance.
     *
     * @since [*next-version*]
     *
     */
    public function testMakeInstanceType()
    {
        $subject = new NonceFactory();
        $nonce   = $subject->make('my-nonce');

        $this->assertInstanceOf(
            static::NONCE_CLASSNAME, $nonce,
            'Created instance is not a valid nonce instance.'
        );
    }

    /**
     * Tests the nonce creation method to ensure that the created nonce has an ID equal to the argument given.
     *
     * @since [*next-version*]
     */
    public function testMakeNonceId()
    {
        $subject = new NonceFactory();
        $nonce   = $subject->make($id = 'my-new-nonce');

        $this->assertEquals($id, $nonce->getId());
    }
}

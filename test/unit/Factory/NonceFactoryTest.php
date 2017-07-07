<?php

namespace unit\Factory;

use RebelCode\WordPress\Nonce\Factory\NonceFactory;
use WP_Mock;
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
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function setUp()
    {
        WP_Mock::setUp();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function tearDown()
    {
        WP_Mock::tearDown();
    }

    /**
     * Tests whether a valid instance can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new NonceFactory();

        $this->assertInstanceOf(
            'RebelCode\\WordPress\\Nonce\\Factory\\NonceFactoryInterface', $subject,
            'Subject does not implement expected interface.'
        );
    }

    /**
     * Tests the nonce creation method to ensure that the created nonce is a valid nonce instance with
     * the expected data.
     *
     * @since [*next-version*]
     */
    public function testMake()
    {
        WP_Mock::userFunction('wp_create_nonce', [
            'times'  => 1,
            'args'   => $id   = 'my-nonce',
            'return' => $code = '1234567890'
        ]);

        $subject = new NonceFactory();
        $nonce   = $subject->make($id);

        $this->assertInstanceOf(
            static::NONCE_CLASSNAME, $nonce,
            'Created instance is not a valid nonce instance.'
        );

        $this->assertEquals(
            $id, $nonce->getId(),
            'Created nonce does not have the expected ID.'
        );

        $this->assertEquals(
            $code, $nonce->getCode(),
            'Created nonce does not have the expected code.'
        );
    }
}

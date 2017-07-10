<?php

namespace unit\Factory;

use RebelCode\WordPress\Nonce\Factory\DelegatingNonceFactory;
use WP_Mock;
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
     * Tests the nonce creation method to ensure that a valid nonce instance is created.
     *
     * @since [*next-version*]
     */
    public function testMake()
    {
        $factory = $this->createFactory();
        $subject = new DelegatingNonceFactory($factory);

        $id     = 'test_nonce';
        $code   = '1234567890';
        $config = [
            'id' => $id
        ];

        WP_Mock::userFunction('wp_create_nonce', [
            'times'  => 1,
            'args'   => $id,
            'return' => $code
        ]);

        $nonce = $subject->make($config);

        $this->assertInstanceOf(
            static::NONCE_CLASSNAME, $nonce,
            'Created instance is not a valid nonce.'
        );

        $this->assertEquals($id, $nonce->getId(),
            'Created nonce does not have the given ID.');

        $this->assertEquals($code, $nonce->getCode(),
            'Created nonce does not have the expected code.');
    }
}

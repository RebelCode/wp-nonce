<?php

namespace RebelCode\WordPress\Nonce\FuncTest;

use RebelCode\WordPress\Nonce\NonceInterface;
use Xpmock\TestCase;
use RebelCode\WordPress\Nonce\NonceAwareTrait;

/**
 * Tests {@see RebelCode\WordPress\Nonce\NonceAwareTrait}.
 *
 * @since [*next-version*]
 */
class NonceAwareTraitTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\WordPress\Nonce\NonceAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     */
    public function createInstance()
    {
        // Methods to mock
        $methods = [];
        // Create mock
        $mock = $this->getMockForTrait(
            static::TEST_SUBJECT_CLASSNAME,  [],
            '',
            true,
            true,
            true,
            $methods
        );

        return $mock;
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
        return $this->mock('RebelCode\\WordPress\\Nonce\\NonceInterface')
            ->getId($id)
            ->getCode($code)
            ->new();
    }

    /**
     * Tests the nonce getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetNonce()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setNonce($nonce = $this->createNonce('some_nonce', '123456'));

        $this->assertSame($nonce, $reflect->_getNonce());
    }
}

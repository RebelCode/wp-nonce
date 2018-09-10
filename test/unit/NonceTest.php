<?php

namespace RebelCode\WordPress\Nonce\UnitTest;

use RebelCode\WordPress\Nonce\Nonce;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Nonce}.
 *
 * @since [*next-version*]
 */
class NonceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new Nonce('', '');

        $this->assertInstanceOf(
            'RebelCode\\WordPress\\Nonce\\NonceInterface',
            $subject,
            'Subject does not implement expected interface.'
        );

        $this->assertInstanceOf(
            'Dhii\\Util\\String\\StringableInterface',
            $subject,
            'Subject does not implement expected interface.'
        );
    }

    /**
     * Tests the ID getter method to ensure the correct value is retrieved.
     *
     * @since [*next-version*]
     */
    public function testGetId()
    {
        $subject = new Nonce($id = 'test_id', '');

        $this->assertEquals($id, $subject->getId());
    }

    /**
     * Tests the code getter method to ensure the correct value is retrieved.
     *
     * @since [*next-version*]
     */
    public function testGetCode()
    {
        $subject = new Nonce('', $code = '12345abcde');

        $this->assertEquals($code, $subject->getCode());
    }

    /**
     * Tests the string conversion to ensure that the resulting string is equal to the nonce code.
     *
     * @since [*next-version*]
     */
    public function testToString()
    {
        $subject = new Nonce('', $code = '12345abcde');

        $this->assertEquals($code, (string) $subject);
    }
}

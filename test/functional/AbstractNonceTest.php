<?php

namespace RebelCode\WordPress\Nonce\FuncTest;

use Xpmock\TestCase;


use RebelCode\WordPress\Nonce\AbstractNonce;

/**
 * Tests {@see RebelCode\WordPress\Nonce\AbstractNonce}.
 *
 * @since [*next-version*]
 */
class AbstractNonceTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\WordPress\Nonce\AbstractNonce';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME, $subject,
            'Subject is not a valid instance'
        );
    }

    /**
     * Tests the ID getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetId()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setId($id = 'some_nonce');

        $this->assertEquals($id, $reflect->_getId());
    }

    /**
     * Tests the code getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetCode()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setCode($code = '123456abcdef');

        $this->assertEquals($code, $reflect->_getCode());
    }
}

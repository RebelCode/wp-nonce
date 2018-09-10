<?php

namespace RebelCode\WordPress\Nonce\Block\UnitTest;

use PHPUnit_Framework_MockObject_MockObject as MockObject;
use RebelCode\WordPress\Nonce\Block\AbstractNonceFieldBlock;
use RebelCode\WordPress\Nonce\NonceInterface;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Block\AbstractNonceFieldBlock}.
 *
 * @since [*next-version*]
 */
class AbstractNonceFieldBlockTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\WordPress\Nonce\Block\AbstractNonceFieldBlock';

    /**
     * The class name of the nonce class to use for testing.
     *
     * @since [*next-version*]
     */
    const NONCE_CLASSNAME = 'RebelCode\\WordPress\\Nonce\\NonceInterface';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param NonceInterface|null $nonce A nonce instance.
     *
     * @return AbstractNonceFieldBlock|MockObject
     */
    public function createInstance($nonce = null)
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->setMethods(['_getNonce', '_render'])
                     ->getMockForAbstractClass();

        if ($nonce === null) {
            $mock->method('_getNonce')->willReturn($nonce);
        }

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
        return $this->mock(static::NONCE_CLASSNAME)
                    ->getId($id)
                    ->getCode($code)
                    ->new();
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
     * Tests the field name getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetFieldName()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $expected = uniqid('field-');

        $reflect->_setFieldName($expected);

        $this->assertEquals($expected, $reflect->_getFieldName());
    }

    /**
     * Tests the use referer flag getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetRefererUrl()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $expected = uniqid('referer-');

        $reflect->_setRefererUrl($expected);

        $this->assertEquals($expected, $reflect->_getRefererUrl());
    }

    /**
     * Tests the use referer flag getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetRefererFieldName()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $expected = uniqid('referer-field-');

        $reflect->_setRefererFieldName($expected);

        $this->assertEquals($expected, $reflect->_getRefererFieldName());
    }
}

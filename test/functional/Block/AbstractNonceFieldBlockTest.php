<?php

namespace RebelCode\WordPress\Nonce\Block\FuncTest;

use Xpmock\TestCase;
use RebelCode\WordPress\Nonce\Block\AbstractNonceFieldBlock;

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
     * @return AbstractNonceFieldBlock
     */
    public function createInstance($nonce = null)
    {
        if ($nonce === null) {
            $nonce = $this->createNonce();
        }

        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_getNonce($nonce)
            ->new();

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

        $reflect->_setFieldName($fieldName = 'my_field');

        $this->assertEquals($fieldName, $reflect->_getFieldName());
    }

    /**
     * Tests the use referer flag getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetUseReferer()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setUseReferer($referer = true);

        $this->assertEquals($referer, $reflect->_getUseReferer());
    }

    /**
     * Tests the render method to ensure that it renders a string.
     *
     * @since [*next-version*]
     */
    public function testRender()
    {
        $subject  = $this->createInstance();
        $reflect  = $this->reflect($subject);
        $rendered = $reflect->_render();

        $this->assertInternalType('string', $rendered);
    }
}

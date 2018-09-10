<?php

namespace RebelCode\WordPress\Nonce\Factory\UnitTest;

use PHPUnit_Framework_MockObject_MockObject as MockObject;
use RebelCode\WordPress\Nonce\Factory\AbstractNonceFactory;
use RebelCode\WordPress\Nonce\NonceInterface;
use WP_Mock;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Factory\AbstractNonceFactory}.
 *
 * @since [*next-version*]
 */
class AbstractNonceFactoryTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\WordPress\Nonce\Factory\AbstractNonceFactory';

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
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractNonceFactory|MockObject
     */
    public function createInstance()
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->setMethods(['_createNonceInstance', '_generateNonceCode'])
                     ->getMockForAbstractClass();

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
     * Tests the nonce creation method without a code to ensure that a valid nonce instance is created with a generated
     * nonce code.
     *
     * @since [*next-version*]
     */
    public function testMakeNoCode()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $id     = 'test_nonce';
        $code   = '1234567890';
        $config = [
            'id' => $id,
        ];

        $subject->expects($this->once())
            ->method('_generateNonceCode')
            ->with($id)
            ->willReturn($code);

        $subject->expects($this->once())
                ->method('_createNonceInstance')
                ->with($id, $code)
                ->willReturn($this->createNonce($id, $code));

        $nonce = $reflect->_make($config);

        $this->assertInstanceOf(
            static::NONCE_CLASSNAME, $nonce,
            'Created instance is not a valid nonce.'
        );

        $this->assertEquals($id, $nonce->getId(),
            'Created nonce does not have the given ID.');

        $this->assertEquals($code, $nonce->getCode(),
            'Created nonce does not have the expected code.');
    }

    /**
     * Tests the nonce creation method with a code to ensure that a valid nonce instance is created with the code taken
     * from the argument config.
     *
     * @since [*next-version*]
     */
    public function testMakeWithCode()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $id     = 'test_nonce';
        $code   = '1234567890';
        $config = [
            'id'   => $id,
            'code' => $code,
        ];

        $subject->expects($this->never())
                ->method('_generateNonceCode');

        $subject->expects($this->once())
                ->method('_createNonceInstance')
                ->with($id, $code)
                ->willReturn($this->createNonce($id, $code));

        $nonce = $reflect->_make($config);

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

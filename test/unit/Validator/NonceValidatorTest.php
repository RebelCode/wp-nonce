<?php

namespace unit\Validator;

use RebelCode\WordPress\Nonce\Validator\NonceValidator;
use WP_Mock;
use Xpmock\TestCase;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Validator\NonceValidator}.
 *
 * @since [*next-version*]
 */
class NonceValidatorTest extends TestCase
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

    /**
     * Tests whether a valid instance can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new NonceValidator();

        $this->assertInstanceOf(
            'Dhii\\Validation\\ValidatorInterface', $subject,
            'Subject does not implement the expected interface.'
        );
    }

    /**
     * Tests the validation method with a valid nonce to ensure that it passes validation.
     *
     * @since [*next-version*]
     */
    public function testValidateOnVerifySuccess()
    {
        $subject = new NonceValidator();

        $id    = 'my-nonce';
        $code  = '1234567890';
        $nonce = $this->createNonce($id, $code);

        WP_Mock::wpFunction('wp_verify_nonce', [
            'times'  => 1,
            'args'   => [$code, $id],
            'return' => true
        ]);

        $subject->validate($nonce);

        $this->assertTrue(true);
    }

    /**
     * Tests the validation method with an invalid nonce code to ensure that validation fails.
     *
     * @since [*next-version*]
     */
    public function testValidateOnVerifyFail()
    {
        $subject = new NonceValidator();

        $id    = 'my-nonce';
        $code  = '1234567890';
        $nonce = $this->createNonce($id, $code);

        WP_Mock::wpFunction('wp_verify_nonce', [
            'times'  => 1,
            'args'   => [$code, $id],
            'return' => false
        ]);

        $this->setExpectedException('Dhii\\Validation\\Exception\\ValidationFailedExceptionInterface');

        $subject->validate($nonce);
    }
}

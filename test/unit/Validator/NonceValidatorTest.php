<?php

namespace unit\Validator;

use RebelCode\WordPress\Nonce\Validator\NonceValidator;
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
    public function testValidate()
    {
        $id    = 'my-nonce';
        $code  = \wp_create_nonce($id);
        $nonce = $this->createNonce($id, $code);
        $subject = new NonceValidator();

        $subject->validate($nonce);

        $this->assertTrue(true);
    }

    /**
     * Tests the validation method with an invalid nonce code to ensure that validation fails.
     *
     * @since [*next-version*]
     */
    public function testValidateInvalidCode()
    {
        $id    = 'my-nonce';
        $code  = 'foobar-code';
        $nonce = $this->createNonce($id, $code);
        $subject = new NonceValidator();

        $this->setExpectedException('Dhii\\Validation\\Exception\\ValidationFailedExceptionInterface');

        $subject->validate($nonce);
    }

    /**
     * Tests the validation method with an invalid argument to ensure that validation fails.
     *
     * @since [*next-version*]
     */
    public function testValidateNotNonceInstance()
    {
        $subject = new NonceValidator();

        $this->setExpectedException('Dhii\\Validation\\Exception\\ValidationFailedExceptionInterface');

        $subject->validate('not-a-nonce');
    }
}

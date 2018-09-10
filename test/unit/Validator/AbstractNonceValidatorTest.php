<?php

namespace RebelCode\WordPress\Nonce\Validator\UnitTest;

use Xpmock\TestCase;
use RebelCode\WordPress\Nonce\Validator\AbstractNonceValidator;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Validator\AbstractNonceValidator}.
 *
 * @since [*next-version*]
 */
class AbstractNonceValidatorTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\WordPress\Nonce\Validator\AbstractNonceValidator';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param bool $verification Whether the verification passes (true) or fails (false).
     *
     * @return AbstractNonceValidator
     */
    public function createInstance($verification = true)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_verifyNonce($verification)
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
        return $this->mock('RebelCode\\WordPress\\Nonce\\NonceInterface')
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
     * Tests the validation errors method with a valid nonce to ensure that no errors are returned.
     *
     * @since [*next-version*]
     */
    public function testGetValidationErrors()
    {
        $subject = $this->createInstance(true);
        $reflect = $this->reflect($subject);
        $nonce   = $this->createNonce('', '');
        $errors  = $reflect->_getValidationErrors($nonce);

        $this->assertEmpty($errors);
    }

    /**
     * Tests the validation errors method to ensure that an error is returned when verification of  the
     * nonce fails.
     *
     * @since [*next-version*]
     */
    public function testGetValidationErrorsVerifyFail()
    {
        $subject = $this->createInstance(false);
        $reflect = $this->reflect($subject);
        $nonce   = $this->createNonce('', '');
        $errors  = $reflect->_getValidationErrors($nonce);

        $this->assertCount(1, $errors);
    }

    /**
     * Tests the validation errors method with an invalid argument to ensure that an error is returned.
     *
     * @since [*next-version*]
     */
    public function testGetValidationErrorsNonNotice()
    {
        $subject = $this->createInstance(true);
        $reflect = $this->reflect($subject);
        $errors  = $reflect->_getValidationErrors('not_a_nonce');

        $this->assertCount(1, $errors);
    }
}

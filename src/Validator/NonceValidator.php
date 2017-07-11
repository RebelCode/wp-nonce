<?php

namespace RebelCode\WordPress\Nonce\Validator;

use Dhii\Validation\ValidatorInterface;
use RebelCode\WordPress\Nonce\NonceInterface;

/**
 * The default simple implementation of a nonce validator.
 *
 * @since [*next-version*]
 */
class NonceValidator extends AbstractNonceValidator implements ValidatorInterface
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     */
    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _verifyNonce(NonceInterface $nonce)
    {
        $result = \wp_verify_nonce($nonce->getCode(), $nonce->getId());

        // Return value of \wp_verify_nonce(), according to WordPress docs:
        //   Boolean false if the nonce is invalid. Otherwise, returns an integer with the value of:
        //   int 1 – if the nonce has been generated in the past 12 hours or less.
        //   int 2 – if the nonce was generated between 12 and 24 hours ago.

        return !($result === false);
    }
}

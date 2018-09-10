<?php

namespace RebelCode\WordPress\Nonce\Validator;

use Dhii\I18n\StringTranslatingTrait;
use Dhii\Validation\AbstractValidatorBase;
use RebelCode\WordPress\Nonce\NonceInterface;

/**
 * Basic functionality for something that can validate nonces.
 *
 * @since [*next-version*]
 */
abstract class AbstractNonceValidator extends AbstractValidatorBase
{
    /* @since [*next-version*] */
    use StringTranslatingTrait;

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _getValidationErrors($subject)
    {
        if (!$subject instanceof NonceInterface) {
            return [
                $this->__('Subject is not a nonce instance.'),
            ];
        }

        if (!$this->_verifyNonce($subject)) {
            return [
                $this->__('Subject nonce instance is not valid, or is expired.'),
            ];
        }

        return [];
    }

    /**
     * Verifies that a nonce is correct and unexpired.
     *
     * @since [*next-version*]
     *
     * @param NonceInterface $nonce The nonce instance to verify.
     *
     * @return bool True if the nonce is correct and unexpired, false otherwise.
     */
    abstract protected function _verifyNonce(NonceInterface $nonce);
}

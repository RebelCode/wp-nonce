<?php

namespace RebelCode\WordPress\Nonce\Block;

use RebelCode\WordPress\Nonce\NonceAwareTrait;

/**
 * Basic functionality for a block that outputs an HTML hidden nonce field.
 *
 * @since [*next-version*]
 */
abstract class AbstractNonceFieldBlock
{
    use NonceAwareTrait;

    /**
     * The field's HTML name attribute value.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $fieldName;

    /**
     * The referer URL.
     *
     * @since [*next-version*]
     *
     * @var string|null
     */
    protected $refererUrl;

    /**
     * The referer field's HTML name attribute value.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $refererFieldName;

    /**
     * Retrieves the HTML field's name attribute value.
     *
     * @since [*next-version*]
     *
     * @return string
     */
    protected function _getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Sets the HTML field's name attribute value.
     *
     * @since [*next-version*]
     *
     * @param string $fieldName The name attribute value.
     *
     * @return $this
     */
    protected function _setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Retrieves the referer URL, if any.
     *
     * @since [*next-version*]
     *
     * @return string|null The referer URL or null if not using the referer.
     */
    protected function _getRefererUrl()
    {
        return $this->refererUrl;
    }

    /**
     * Sets the referer URL or disables the inclusion of the referer.
     *
     * @since [*next-version*]
     *
     * @param string|null $refererUrl The referer URL or null to disable inclusion of the referer.
     *
     * @return $this
     */
    protected function _setRefererUrl($refererUrl)
    {
        $this->refererUrl = $refererUrl;

        return $this;
    }

    /**
     * Retrieves the refer field HTML name attribute value.
     *
     * @since [*next-version*]
     *
     * @return string
     */
    protected function _getRefererFieldName()
    {
        return $this->refererFieldName;
    }

    /**
     * Sets the refer field HTML name attribute value.
     *
     * @since [*next-version*]
     *
     * @param string $refererFieldName The name attribute value for the referer field.
     *
     * @return $this
     */
    protected function _setRefererFieldName($refererFieldName)
    {
        $this->refererFieldName = $refererFieldName;

        return $this;
    }

    /**
     * Renders the nonce field.
     *
     * @since [*next-version*]
     *
     * @return string
     */
    protected function _render()
    {
        $output = sprintf(
            '<input type="hidden" id="%1$s" name="%1$s" value="%2$s" />',
            $this->_getFieldName(),
            $this->_getNonce()->getCode()
        );

        $refererUrl = $this->_getRefererUrl();

        if ($refererUrl !== null) {
            $output .= sprintf(
                '<input type="hidden" name="%1$s" value="%2$s" />',
                $this->_getRefererFieldName(),
                $refererUrl
            );
        }

        return $output;
    }
}

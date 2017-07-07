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
     * Whether or not to use the referer.
     *
     * If true, a second hidden field will be used to specify the referer.
     *
     * @since [*next-version*]
     *
     * @var bool
     */
    protected $useReferer;

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
     * Retrieves whether or not to use the referer.
     *
     * @since [*next-version*]
     *
     * @return bool True if the referer is used, false if not.
     */
    protected function _getUseReferer()
    {
        return $this->useReferer;
    }

    /**
     * Sets whether or not to use the referer.
     *
     * @since [*next-version*]
     *
     * @param bool $useReferer True to use the referer in the field, false to not.
     *
     * @return $this
     */
    protected function _setUseReferer($useReferer)
    {
        $this->useReferer = $useReferer;

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

        if ($this->_getUseReferer()) {
            $output .= sprintf(
                '<input type="hidden" name="%1$s" value="%2$s" />',
                $this->_getRefererFieldName(),
                $this->_getRefererUrl()
            );
        }

        return $output;
    }

    /**
     * Determines the URL to use as the referer URL.
     *
     * @since [*next-version*]
     *
     * @return string
     */
    abstract protected function _getRefererUrl();
}

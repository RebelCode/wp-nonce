<?php

namespace RebelCode\WordPress\Nonce\Factory;

use Dhii\Factory\FactoryInterface;

/**
 * A nonce factory implementation that delegates to another generic factory.
 *
 * @since [*next-version*]
 */
class DelegatingNonceFactory extends AbstractNonceFactory implements FactoryInterface
{
    /**
     * The config array key to use to pass the nonce code to the delegate factory.
     *
     * @since [*next-version*]
     */
    const K_CONFIG_ID = 'id';

    /**
     * The config array key to use to pass the nonce code to the delegate factory.
     *
     * @since [*next-version*]
     */
    const K_CONFIG_CODE = 'code';

    /**
     * The default ID used by the delegate factory for nonces.
     *
     * @since [*next-version*]
     */
    const DEFAULT_DELEGATE_ID = 'nonce';

    /**
     * The factory instance to which nonce instance creation will be delegated to.
     *
     * @since [*next-version*]
     *
     * @var FactoryInterface
     */
    protected $delegateFactory;

    /**
     * The ID for nonces in the delegate factory.
     *
     * @since [*next-version*]
     *
     * @var string
     */
    protected $delegateId;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param FactoryInterface $factory    The factory to which to delegate nonce creation to.
     * @param string           $delegateId The ID for nonces in the delegate factory.
     */
    public function __construct(FactoryInterface $factory, $delegateId = self::DEFAULT_DELEGATE_ID)
    {
        $this->_setDelegateFactory($factory)
            ->_setDelegateId($delegateId);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function make($id, array $config = [])
    {
        return $this->_make($id, $config);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _createNonce($id, $code)
    {
        return $this->_getDelegateFactory()->make($this->_getDelegateId(), [
            static::K_CONFIG_ID   => $id,
            static::K_CONFIG_CODE => $code,
        ]);
    }

    /**
     * Retrieves the delegate factory instance.
     *
     * @since [*next-version*]
     *
     * @return FactoryInterface
     */
    protected function _getDelegateFactory()
    {
        return $this->delegateFactory;
    }

    /**
     * Sets the factory instance to which nonce creation will be delegate to.
     *
     * @since [*next-version*]
     *
     * @param FactoryInterface $factory The delegate factory instance.
     *
     * @return $this
     */
    protected function _setDelegateFactory(FactoryInterface $factory)
    {
        $this->delegateFactory = $factory;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _getDelegateId()
    {
        return $this->delegateId;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _setDelegateId($delegateId)
    {
        $this->delegateId = $delegateId;

        return $this;
    }
}

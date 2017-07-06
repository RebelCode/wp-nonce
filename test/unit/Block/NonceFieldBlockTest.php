<?php

namespace RebelCode\WordPress\Nonce\UnitTest\Block;

use RebelCode\WordPress\Nonce\Block\NonceFieldBlock;
use Xpmock\TestCase;

class NonceFieldBlockTest extends TestCase
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
        $nonce   = $this->createNonce();
        $subject = new NonceFieldBlock($nonce);

        $this->assertInstanceOf(
            'RebelCode\\WordPress\\Nonce\\NonceAwareInterface', $subject,
            'Subject does not implement the expected interface.'
        );

        $this->assertInstanceOf(
            'Dhii\\Block\\BlockInterface', $subject,
            'Subject does not implement the expected interface.'
        );
    }

    /**
     * Tests the nonce getter method to ensure correct instance retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetNonce()
    {
        $nonce   = $this->createNonce('my-nonce', '123abc');
        $subject = new NonceFieldBlock($nonce);

        $this->assertSame($nonce, $subject->getNonce(),
            'Retrieved nonce is not the same instance given in constructor.'
        );
    }

    /**
     * Tests the render method to ensure that it correctly renders the field.
     *
     * @since [*next-version*]
     */
    public function testRender()
    {
        $id        = 'my-nonce';
        $code      = \wp_create_nonce($id);
        $fieldName = 'my-field';
        $nonce     = $this->createNonce($id, $code);
        $subject   = new NonceFieldBlock($nonce, $fieldName, true);

        $rendered = $subject->render();

        $this->assertContains(sprintf('value="%s"', $code), $rendered);
        $this->assertContains(sprintf('name="%s"', $fieldName), $rendered);
        $this->assertContains('value="dev/referer"', $rendered);
    }

    /**
     * Tests the render method to ensure that it correctly renders the field.
     *
     * @since [*next-version*]
     */
    public function testRenderNoReferer()
    {
        $id        = 'my-nonce';
        $code      = \wp_create_nonce($id);
        $fieldName = 'my-field';
        $nonce     = $this->createNonce($id, $code);
        $subject   = new NonceFieldBlock($nonce, $fieldName, false);

        $rendered = $subject->render();

        $this->assertContains(sprintf('value="%s"', $code), $rendered);
        $this->assertContains(sprintf('name="%s"', $fieldName), $rendered);
        $this->assertNotContains('value="dev/referer"', $rendered);
    }

    /**
     * Tests if the block can be cast into a rendered string of the field.
     *
     * @since [*next-version*]
     */
    public function testCanBeCastToString()
    {
        $id        = 'my-nonce';
        $code      = \wp_create_nonce($id);
        $fieldName = 'my-field';
        $nonce     = $this->createNonce($id, $code);
        $subject   = new NonceFieldBlock($nonce, $fieldName, true);

        $casted = (string) $subject;

        $this->assertInternalType('string', $casted);
        $this->assertContains(sprintf('value="%s"', $code), $casted);
        $this->assertContains(sprintf('name="%s"', $fieldName), $casted);
        $this->assertContains('value="dev/referer"', $casted);
    }
}

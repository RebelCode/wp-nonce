<?php

namespace RebelCode\WordPress\Nonce\UnitTest\Block;

use RebelCode\WordPress\Nonce\Block\NonceFieldBlock;
use Xpmock\TestCase;
use \WP_Mock;

class NonceFieldBlockTest extends TestCase
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
        WP_Mock::passthruFunction( 'wp_unslash');
        WP_Mock::passthruFunction( 'esc_attr');

        // Create nonce
        $id         = 'my-nonce';
        $code       = '123456';
        $nonce      = $this->createNonce($id, $code);
        $refererUrl = 'my://referer/url';
        // Field names
        $fName      = 'my-field';
        $fReferName = NonceFieldBlock::REFERER_FIELD_NAME;
        // Set up test subject instance
        $subject    = new NonceFieldBlock($nonce, $fName, $refererUrl);

        $rendered = $subject->render();

        $this->assertContains(sprintf('value="%s"', $code), $rendered);
        $this->assertContains(sprintf('name="%s"', $fName), $rendered);
        $this->assertContains(sprintf('value="%s"', $refererUrl), $rendered);
        $this->assertContains(sprintf('name="%s"', $fReferName), $rendered);
    }

    /**
     * Tests the render method to ensure that it correctly renders the field.
     *
     * @since [*next-version*]
     */
    public function testRenderNoReferer()
    {
        WP_Mock::passthruFunction( 'wp_unslash');
        WP_Mock::passthruFunction( 'esc_attr');

        // Create nonce
        $id         = 'my-nonce';
        $code       = '123456';
        $nonce      = $this->createNonce($id, $code);
        // Field names
        $fName      = 'my-field';
        $fReferName = NonceFieldBlock::REFERER_FIELD_NAME;
        // Set up test subject instance
        $subject    = new NonceFieldBlock($nonce, $fName, null);

        $rendered = $subject->render();

        $this->assertContains(sprintf('value="%s"', $code), $rendered);
        $this->assertContains(sprintf('name="%s"', $fName), $rendered);
        $this->assertNotContains(sprintf('name="%s"', $fReferName), $rendered);
    }

    /**
     * Tests if the block can be cast into a rendered string of the field.
     *
     * @since [*next-version*]
     */
    public function testCastToString()
    {
        WP_Mock::passthruFunction( 'wp_unslash');
        WP_Mock::passthruFunction( 'esc_attr');

        // Create nonce
        $id         = 'my-nonce';
        $code       = '123456';
        $nonce      = $this->createNonce($id, $code);
        $refererUrl = 'my://referer/url';
        // Field names
        $fName      = 'my-field';
        $fReferName = NonceFieldBlock::REFERER_FIELD_NAME;
        // Set up test subject instance
        $subject    = new NonceFieldBlock($nonce, $fName, $refererUrl);

        $rendered = (string) $subject;

        $this->assertContains(sprintf('value="%s"', $code), $rendered);
        $this->assertContains(sprintf('name="%s"', $fName), $rendered);
        $this->assertContains(sprintf('name="%s"', $fReferName), $rendered);
    }
}

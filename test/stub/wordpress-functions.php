<?php

function wp_create_nonce($id)
{
    return \sha1(time());
}

function wp_nonce_field( $action = -1, $name = "_wpnonce", $useReferer = true ) {
    return '';
}

<?php

function wp_verify_nonce($code, $id = -1) {
    $expected = \wp_create_nonce($id);

    return hash_equals($expected, $code);
}

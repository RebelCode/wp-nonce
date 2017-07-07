<?php

function wp_create_nonce($nonceId)
{
    $uid   = 1;
    $token = 'ABCDEFGHIJKLM'; // session token
    $tick  = ceil(time() / 43200);

    return substr(
        hash_hmac(
            'md5',
            sprintf('%1$s|%1$s|%1$s|%1$s|', $tick, $nonceId, $uid, $token),
            '' // salt
        ),
        -12,
        10
    );
}

function wp_verify_nonce($code, $id = -1) {
    $expected = \wp_create_nonce($id);

    return hash_equals($expected, $code);
}

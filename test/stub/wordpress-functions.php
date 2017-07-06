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

function wp_nonce_field( $action = -1, $name = "_wpnonce", $referer = true) {
    $nonce_field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . wp_create_nonce($action) . '" />';

    if ($referer) {
        $nonce_field .= wp_referer_field();
    }

    return $nonce_field;
}

function wp_referer_field() {
    $referer_field = '<input type="hidden" name="_wp_http_referer" value="dev/referer" />';

    return $referer_field;
}

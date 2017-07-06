<?php

function wp_create_nonce($id)
{
    return \sha1(time());
}

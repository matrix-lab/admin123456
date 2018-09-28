<?php

if (!function_exists('avatar')) {
    function avatar($email)
    {
        echo 'https://secure.gravatar.com/avatar/'.md5($email).'?size=128';
    }
}

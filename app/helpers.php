<?php

if (!function_exists('avatar')) {
    function avatar($email)
    {
        return 'https://secure.gravatar.com/avatar/'.md5($email).'?size=72';
    }
}

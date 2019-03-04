<?php

return [
    'user.passwordSalt' => '4f9b3d1ee4b760052716d1f64b7c9f70',
    'user.passwordResetTokenExpire' => 3600,
    'user.randomPasswordLength' => 11,
    'review.shouldBeModerated' => true,
    'supportEmail' => 'noreply@localhost',
    'host' => isset($_SERVER['SERVER_PROTOCOL']) ? stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST']: '',
];

<?php

return [
    'update_notifications' => 'If you no longer wish to receive these notifications, you can modify your preferences in your account settings.',
    'thank' => 'Best regards',
    'token_expiring' => [
        'subject' => 'API Token Expiring',
        'welcome' => 'Hello',
        'expire_message' => 'Your API token "**:token_name**" will expire in **:daysUntilExpiration** days.',
        'details' => 'Token Details',
        'details_name' => 'Name',
        'details_created_at' => 'Created on',
        'details_expired_at' => 'Expires on',
        'warning' => 'To avoid any service interruption, we recommend renewing your token before its expiration.',
        'button_handle_tokens' => 'Manage My Tokens',
        'ignore_message' => 'If you no longer wish to use this token, you can simply ignore it or delete it from your dashboard.',
        'security_message' => '**Security Note**: If you did not create this token or notice any suspicious activity, please immediately revoke the token and contact our support.',
        'thank' => 'Thank you',
    ],
    'secret_accessed' => [
        'subject' => 'Your Secret Has Been Accessed',
        'viewed_with_ip' => 'Your secret has been viewed from the IP address',
        'remaining_view' => 'Remaining :remainingViews view(s) available.',
        'expire_at' => 'This secret will expire on',
        'button_see' => 'View Secret',
        'thank' => 'Best regards',
    ],
    'secret_expired' => [
        'subject' => 'Your Secret Has Expired',
        'message' => 'Your secret expired on :expired_at without being viewed.',
        'info' => 'It is no longer accessible for viewing.',
        'button_see' => 'View Details',
    ],
];

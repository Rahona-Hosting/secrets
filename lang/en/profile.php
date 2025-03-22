<?php

return [
    'title' => 'My Account',
    'member_from' => 'Member since',
    'account_sso' => 'SSO Account',
    'account_local' => 'Local Account',
    'delete' => [
        'title' => 'Danger Zone',
        'warning' => 'Deleting your account is permanent. All your data will be erased.',
        'button' => 'Delete my account',
        'confirm' => [
            'title' => 'Confirm Deletion',
            'warning' => 'Are you sure you want to delete your account? This action is irreversible.',
            'text' => 'Please enter your email address to confirm deletion',
            'text_placeholder' => 'Your email',
            'button' => 'Delete permanently',
            'error' => 'Invalid email address, please try again',
        ],
    ],
    'notifications' => [
        'title' => 'Notification Preferences',
        'subtitle' => 'Customize the notifications you want to receive.',
        'token_expiration' => 'API Token Expiration Notification',
        'secret_expired' => 'Expired Secrets Notification',
        'secret_access' => 'Secret Access Notification',
        'notifications_updated' => 'Notification preferences have been updated.',
    ],
    'password' => [
        'title' => 'Change Password',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'confirm_password' => 'Confirm New Password',
        'button' => 'Update Password',
        'success' => 'Password updated successfully',
    ],
];

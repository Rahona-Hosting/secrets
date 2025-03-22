<?php

return [
    'title' => 'API Management',
    'addBtn' => 'New API Key',
    'add' => [
        'title' => 'Create a New API Key',
        'name' => 'Key Name',
        'placeholder' => 'Ex: Production API',
        'expireDate' => 'Expiration Date (optional)',
        'success' => 'New API key generated',
        'warning' => 'Copy this key now. You will not be able to see it again.',
    ],
    'list' => [
        'title' => 'Your API Keys',
        'name' => 'Name',
        'last_usage' => 'Last Usage',
        'created_at' => 'Created on',
        'expire_at' => 'Expires on',
        'status' => 'Status',
        'actions' => 'Actions',
        'never_used' => 'Never used',
        'never_expire' => 'No expiration',
        'active' => 'Active',
        'expired' => 'Expired',
        'empty' => 'No active API keys',
    ],
    'delete' => [
        'title' => 'Confirm Deletion',
        'message' => 'Are you sure you want to revoke this API key? This action is irreversible.',
        'success' => 'API successfully deleted!',
    ],
];

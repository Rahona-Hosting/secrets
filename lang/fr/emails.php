<?php

return [
    'update_notifications' => 'Si vous ne souhaitez plus recevoir ces notifications, vous pouvez modifier vos préférences dans les paramètres de votre compte.',
    'thank' => 'Cordialement',
    'token_expiring' => [
        'subject' => 'Token API en expiration',
        'welcome' => 'Bonjour',
        'expire_message' => 'Votre token API "**:token_name**" va expirer dans **:daysUntilExpiration** jours.',
        'details' => 'Détails du token',
        'details_name' => 'Nom',
        'details_created_at' => 'Crée le',
        'details_expired_at' => 'Expire le',
        'warning' => 'Pour éviter toute interruption de service, nous vous recommandons de renouveler votre token avant son expiration.',
        'button_handle_tokens' => 'Gérer mes tokens',
        'ignore_message' => "Si vous ne souhaitez plus utiliser ce token, vous pouvez simplement l'ignorer ou le supprimer depuis votre tableau de bord.",
        'security_message' => "**Note de sécurité**: Si vous n'êtes pas à l'origine de ce token ou si vous remarquez une activité suspecte, veuillez immédiatement révoquer le token et contacter notre support.",
        'thank' => 'Merci',
    ],
    'secret_accessed' => [
        'subject' => 'Votre secret a été consulté',
        'viewed_with_ip' => "Votre secret a été consulté depuis l'adresse IP",
        'remaining_view' => 'Il reste :remainingViews consultation(s) disponible(s).',
        'expire_at' => 'Ce secret expirera le',
        'button_see' => 'Voir le Secret',
        'thank' => 'Cordialement',
    ],
    'secret_expired' => [
        'subject' => 'Votre secret a expiré',
        'message' => 'Votre secret a expiré le :expired_at sans avoir été consulté.',
        'info' => "Il n'est plus accessible pour consultation.",
        'button_see' => 'Voir le détail',
    ],
];

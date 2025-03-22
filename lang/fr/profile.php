<?php

return [
    'title' => 'Mon Compte',
    'member_from' => 'Membre depuis le',
    'account_sso' => 'Compte SSO',
    'account_local' => 'Compte local',
    'delete' => [
        'title' => 'Zone dangereuse',
        'warning' => 'La suppression de votre compte est définitive. Toutes vos données seront effacées.',
        'button' => 'Supprimer mon compte',
        'confirm' => [
            'title' => 'Confirmer la suppression',
            'warning' => 'Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.',
            'text' => 'Merci de renseigner votre adresse email pour confirmer la suppression',
            'text_placeholder' => 'Votre email',
            'button' => 'Supprimer définitivement',
            'error' => 'Adresse email invalide, merci de réessayer',
        ],
    ],
    'notifications' => [
        'title' => 'Préférences de notification',
        'subtitle' => 'Personnalisez les notifications que vous souhaitez recevoir.',
        'token_expiration' => "Notification d'expiration des tokens API",
        'secret_expired' => 'Notification des secrets expirés',
        'secret_access' => "Notification d'accès aux secrets",
        'notifications_updated' => 'Les préférences de notification ont été mises à jour.',
    ],
    'password' => [
        'title' => 'Changer le mot de passe',
        'current_password' => 'Mot de passe actuel',
        'new_password' => 'Nouveau mot de passe',
        'confirm_password' => 'Confirmer le nouveau mot de passe',
        'button' => 'Mettre à jour le mot de passe',
        'success' => 'Mot de passe mis à jour avec succès',
    ],
];

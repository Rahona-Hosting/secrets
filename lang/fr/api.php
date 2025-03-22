<?php

return [
    'title' => 'Gestion des APIs',
    'addBtn' => 'Nouvelle clé API',
    'add' => [
        'title' => 'Créer une nouvelle clé API',
        'name' => 'Nom de la clé',
        'placeholder' => 'Ex: API Production',
        'expireDate' => "Date d'expiration (optionnel)",
        'success' => 'Nouvelle clé API générée',
        'warning' => 'Copiez cette clé maintenant. Vous ne pourrez plus la voir ensuite.',
    ],
    'list' => [
        'title' => 'Vos clés API',
        'name' => 'Nom',
        'last_usage' => 'Dernière utilisation',
        'created_at' => 'Créée le',
        'expire_at' => 'Expire le',
        'status' => 'Statut',
        'actions' => 'Actions',
        'never_used' => 'Jamais utilisé',
        'never_expire' => "Pas d'expiration",
        'active' => 'Actif',
        'expired' => 'Expiré',
        'empty' => 'Aucune clé API active',
    ],
    'delete' => [
        'title' => 'Confirmer la suppression',
        'message' => 'Êtes-vous sûr de vouloir révoquer cette clé API ? Cette action est irréversible.',
        'success' => 'API supprimée avec succès !',
    ],
];

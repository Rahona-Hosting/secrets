<?php

return [
    'title' => 'Fiókom',
    'member_from' => 'Tag óta',
    'account_sso' => 'SSO Fiók',
    'account_local' => 'Helyi Fiók',
    'delete' => [
        'title' => 'Veszélyzóna',
        'warning' => 'A fiók törlése végleges. Minden adata törlésre kerül.',
        'button' => 'Fiók törlése',
        'confirm' => [
            'title' => 'Törlés megerősítése',
            'warning' => 'Biztosan törölni akarja fiókját? Ez a művelet nem visszavonható.',
            'text' => 'Kérjük, adja meg email-címét a törlés megerősítéséhez',
            'text_placeholder' => 'Az Ön email-címe',
            'button' => 'Végleges törlés',
            'error' => 'Érvénytelen email-cím, kérjük próbálja újra',
        ],
    ],
    'notifications' => [
        'title' => 'Értesítési beállítások',
        'subtitle' => 'Szabja testre a fogadni kívánt értesítéseket.',
        'token_expiration' => 'API Token lejárati értesítés',
        'secret_expired' => 'Lejárt titkos kulcsok értesítése',
        'secret_access' => 'Titkos kulcs hozzáférési értesítés',
        'notifications_updated' => 'Az értesítési beállítások frissültek.',
    ],
    'password' => [
        'title' => 'Jelszó módosítása',
        'current_password' => 'Jelenlegi jelszó',
        'new_password' => 'Új jelszó',
        'confirm_password' => 'Új jelszó megerősítése',
        'button' => 'Jelszó frissítése',
        'success' => 'Jelszó sikeresen frissítve',
    ],
];

<?php

return [
    'title' => 'API Kezelés',
    'addBtn' => 'Új API kulcs',
    'add' => [
        'title' => 'Új API kulcs létrehozása',
        'name' => 'Kulcs neve',
        'placeholder' => 'Pl: Termelési API',
        'expireDate' => 'Lejárati dátum (opcionális)',
        'success' => 'Új API kulcs generálva',
        'warning' => 'Másolja le most a kulcsot. Később nem tudja újra megtekinteni.',
    ],
    'list' => [
        'title' => 'Az Ön API kulcsai',
        'name' => 'Név',
        'last_usage' => 'Utolsó használat',
        'created_at' => 'Létrehozva',
        'expire_at' => 'Lejár',
        'status' => 'Állapot',
        'actions' => 'Műveletek',
        'never_used' => 'Soha nem használt',
        'never_expire' => 'Nincs lejárat',
        'active' => 'Aktív',
        'expired' => 'Lejárt',
        'empty' => 'Nincsenek aktív API kulcsok',
    ],
    'delete' => [
        'title' => 'Törlés megerősítése',
        'message' => 'Biztosan vissza akarja vonni ezt az API kulcsot? Ez a művelet nem visszavonható.',
        'success' => 'API sikeresen törölve!',
    ],
];

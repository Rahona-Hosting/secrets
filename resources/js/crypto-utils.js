export class CryptoUtils {
    static async encrypt(text, password) {
        try {
            const hashedPassword = await crypto.subtle.digest(
                'SHA-256',
                new TextEncoder().encode(password)
            );

            const key = await crypto.subtle.importKey(
                'raw',
                hashedPassword,
                'AES-GCM',
                false,
                ['encrypt']
            );

            const encrypted = await crypto.subtle.encrypt(
                {
                    name: 'AES-GCM',
                    iv: new Uint8Array(12)
                },
                key,
                new TextEncoder().encode(text)
            );

            return btoa(String.fromCharCode(...new Uint8Array(encrypted)));
        } catch (error) {
            throw new Error('Erreur de chiffrement');
        }
    }

    static async decrypt(encryptedData, password) {
        try {
            const hashedPassword = await crypto.subtle.digest(
                'SHA-256',
                new TextEncoder().encode(password)
            );

            const key = await crypto.subtle.importKey(
                'raw',
                hashedPassword,
                'AES-GCM',
                false,
                ['decrypt']
            );

            const decrypted = await crypto.subtle.decrypt(
                {
                    name: 'AES-GCM',
                    iv: new Uint8Array(12)
                },
                key,
                new Uint8Array(atob(encryptedData).split('').map(char => char.charCodeAt(0)))
            );

            return new TextDecoder().decode(decrypted);
        } catch (error) {
            throw new Error('Déchiffrement échoué. Mot de passe incorrect.');
        }
    }
}

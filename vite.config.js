import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs-extra';

const copyFontAwesomeFonts = () => {
    const srcDir = 'node_modules/@fortawesome/fontawesome-free/webfonts';
    const destDir = 'public/webfonts';
    fs.copySync(srcDir, destDir);
};

copyFontAwesomeFonts();

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/crypto-utils.js',
                'resources/js/home.js',
                'resources/js/auth/2fa.js',
                'resources/js/auth/login.js',
                'resources/js/auth/register.js',
                'resources/js/user/profile.js',
                'resources/js/user/secret.js',
                'resources/js/secret/unlock.js',
                'resources/js/secret/encrypt.js',
                'resources/js/secret/decrypt.js'
            ],
            refresh: true,
        }),
    ],
});

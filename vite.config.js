import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            _input: ['resources/css/app.css', 'resources/js/app.js'],
            get input() {
                return this._input;
            },
            set input(value) {
                this._input = value;
            },
            refresh: true,
        }),
    ],
});

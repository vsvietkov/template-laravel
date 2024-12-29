import './bootstrap.ts';

import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { LaravelReactI18nProvider } from 'laravel-react-i18n';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.tsx`, import.meta.glob('./Pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(
            <LaravelReactI18nProvider locale={'en'} fallbackLocale="en" files={import.meta.glob('/lang/*.json')}>
                <App {...props} />
            </LaravelReactI18nProvider>,
        );
    },
});

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Toaster } from '@/components/ui/sonner';
import { TooltipProvider } from '@/components/ui/tooltip';
import { initializeTheme } from '@/hooks/use-appearance';
import AppLayout from '@/layouts/app-layout';
import AuthLayout from '@/layouts/auth-layout';
import SettingsLayout from '@/layouts/settings/layout';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

void createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => {
        // eslint-disable-next-line @typescript-eslint/no-explicit-any
        const pages = import.meta.glob<any>([
            './pages/**/*.tsx',
            '../../Modules/*/resources/js/pages/**/*.tsx',
        ]);

        // Halaman modul ditulis dengan format NamaModul::nama-halaman
        if (name.includes('::')) {
            const [module, page] = name.split('::');

            return resolvePageComponent(
                `../../Modules/${module}/resources/js/pages/${page}.tsx`,
                pages,
            );
        }

        return resolvePageComponent(`./pages/${name}.tsx`, pages);
    },
    layout: (name) => {
    switch (true) {
        // Halaman ini membungkus dirinya sendiri dengan <AppLayout>
        case name === 'welcome' || name === 'dashboard' || name.includes('::'):
            return null;
        case name.startsWith('auth/'):
            return AuthLayout;
        case name.startsWith('settings/'):
            return [AppLayout, SettingsLayout];
        default:
            return AppLayout;
    }
},
    strictMode: true,
    withApp(app) {
        return (
            <TooltipProvider delayDuration={0}>
                {app}
                <Toaster />
            </TooltipProvider>
        );
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on load...
initializeTheme();
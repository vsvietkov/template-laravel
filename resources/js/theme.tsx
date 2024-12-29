import { ReactNode, useEffect, useState } from 'react';
import { ThemeProvider } from '@mui/material';

interface Props {
    children: ReactNode;
}

export default function AppTheme({ children }: Props) {
    const [theme, setTheme] = useState({});

    useEffect(() => {
        const getTheme = async () => {
            // Accessible only on build time (and pnpm run dev)
            const identifier = import.meta.env.VITE_THEME;

            // Dynamically load the default theme in order to make VITE move module into a separate chunk.
            // If we import it statically and use in useState, VITE will bundle it additionally to the main chunk and give a warning.
            // Also, we need to follow the dynamic import pattern for VITE https://github.com/rollup/plugins/tree/master/packages/dynamic-import-vars#limitations
            const themeModule = !identifier
                ? await import(`./Themes/default/index.tsx`)
                : await import(`./Themes/${identifier}/index.tsx`);

            // Make sure to return the default export from the module
            return themeModule.default;
        };
        getTheme().then(setTheme);
    }, []);

    return <ThemeProvider theme={theme}>{children}</ThemeProvider>;
}

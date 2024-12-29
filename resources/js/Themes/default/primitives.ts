import { createTheme } from '@mui/material';
import { TypographyOptions } from '@mui/material/styles/createTypography';
import { ColorSystemOptions, DefaultColorScheme } from '@mui/material/styles/createThemeWithVars';
import { Shadows } from '@mui/material/styles/shadows';

// Create instance to use utility functions (defaultTheme.typography.pxToRem etc.)
const defaultTheme = createTheme();

export const shadows = [...defaultTheme.shadows] as Shadows;
// Override shadows here

export const colorSchemes: Partial<Record<DefaultColorScheme, boolean | ColorSystemOptions>> = {
    light: {
        palette: {
            text: {},
            primary: {},
            secondary: {},
            error: {},
        },
    },
};

export const typography: TypographyOptions = {
    fontFamily: ['"Roboto"', '"sans-serif"'].join(','),
    h1: {},
    h2: {},
    h3: {},
    h4: {},
    h5: {},
    h6: {},
    subtitle1: {},
    subtitle2: {},
    body1: {},
    body2: {},
    caption: {},
};

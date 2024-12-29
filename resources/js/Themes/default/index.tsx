import { createTheme } from '@mui/material/styles';
import { typography, colorSchemes, shadows } from './primitives';
import { cssbaseline } from './components/cssbaseline.ts';

export default createTheme({
    colorSchemes,
    typography,
    shadows,
    components: {
        ...cssbaseline,
        // ...buttons, etc.
    },
});

import { useTheme } from '@mui/material';
import Paper from '@mui/material/Paper';
import Stack from '@mui/material/Stack';
import Typography from '@mui/material/Typography';

export default function Welcome() {
    const theme = useTheme();

    return (
        <Stack spacing={2}>
            <Typography variant="h2">Welcome!</Typography>
            <Paper sx={{ width: 'fit-content', p: '20px', backgroundColor: 'primary.main' }}>
                <Typography variant="body1" color={theme.palette.primary.contrastText}>
                    This is a simple page that demonstrates how to use MUI with Inertia.js.
                </Typography>
            </Paper>
        </Stack>
    );
}

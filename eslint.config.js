import globals from 'globals';
import pluginJs from '@eslint/js';
import tseslint from 'typescript-eslint';
import pluginReact from 'eslint-plugin-react';
import importPlugin from 'eslint-plugin-import';
import reactHooks from 'eslint-plugin-react-hooks';
import jsxA11y from 'eslint-plugin-jsx-a11y';
import prettierConfig from 'eslint-plugin-prettier/recommended';

export default [
    pluginJs.configs.recommended,
    ...tseslint.configs.recommended,
    pluginReact.configs.flat.recommended,
    importPlugin.flatConfigs.recommended,
    prettierConfig, // Should be the last of plugins

    { files: ['**/*.{js,mjs,cjs,ts,jsx,tsx}'] },
    {
        languageOptions: {
            globals: globals.browser,
            ecmaVersion: 2024,
        },
    },
    { ignores: ['**/vendor', '**/build'] },
    {
        settings: {
            react: { version: '19' },
            'import/resolver': {
                typescript: true,
                node: true,
            },
        },
    },
    {
        plugins: {
            'react-hooks': reactHooks,
            'jsx-a11y': jsxA11y,
        },
        rules: {
            'react/react-in-jsx-scope': 'off',
            'import/no-dynamic-require': 'warn',
            'import/no-nodejs-modules': 'warn',
            'import/no-unresolved': ['error', { ignore: ['\\.svg\\?react$'] }],
            'react-hooks/rules-of-hooks': 'error',
            'react-hooks/exhaustive-deps': 'warn',
            'jsx-a11y/anchor-is-valid': 'warn',
            'jsx-a11y/alt-text': 'error',
        },
    },
];

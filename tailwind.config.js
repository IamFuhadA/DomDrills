import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                // DomDrills Brand Palette
                brand: {
                    DEFAULT: '#C96A1B',
                    hover:   '#B25D18',
                    light:   '#F0E0CE',
                    muted:   '#E8C5A0',
                },
                ivory: {
                    DEFAULT: '#F8F6F2',
                    alt:     '#EFE8DF',
                },
                charcoal: {
                    DEFAULT: '#2D2A26',
                    muted:   '#6B625A',
                },
                border: {
                    DEFAULT: '#DED8D0',
                    light:   '#EDE8E2',
                },
                state: {
                    success: '#4D8A5C',
                    warning: '#C68B2C',
                    error:   '#B44A3A',
                },
            },

            fontFamily: {
                heading: ['Manrope', ...defaultTheme.fontFamily.sans],
                body:    ['Inter',   ...defaultTheme.fontFamily.sans],
                sans:    ['Inter',   ...defaultTheme.fontFamily.sans],
            },

            fontSize: {
                '2xs': ['0.625rem', { lineHeight: '1rem' }],
                'xs':  ['0.75rem',  { lineHeight: '1.125rem' }],
                'sm':  ['0.875rem', { lineHeight: '1.375rem' }],
                'base':['1rem',     { lineHeight: '1.625rem' }],
                'lg':  ['1.125rem', { lineHeight: '1.75rem' }],
                'xl':  ['1.25rem',  { lineHeight: '1.875rem' }],
                '2xl': ['1.5rem',   { lineHeight: '2rem' }],
                '3xl': ['1.875rem', { lineHeight: '2.375rem' }],
                '4xl': ['2.25rem',  { lineHeight: '2.75rem' }],
                '5xl': ['3rem',     { lineHeight: '1.15' }],
                '6xl': ['3.75rem',  { lineHeight: '1.1' }],
                '7xl': ['4.5rem',   { lineHeight: '1.05' }],
                '8xl': ['6rem',     { lineHeight: '1' }],
                '9xl': ['8rem',     { lineHeight: '1' }],
            },

            spacing: {
                '18': '4.5rem',
                '22': '5.5rem',
                '26': '6.5rem',
                '30': '7.5rem',
                '34': '8.5rem',
                '68': '17rem',
                '72': '18rem',
                '76': '19rem',
                '80': '20rem',
                '88': '22rem',
                '96': '24rem',
                '104': '26rem',
                '112': '28rem',
                '120': '30rem',
            },

            borderRadius: {
                'sm':  '0.25rem',
                'DEFAULT': '0.5rem',
                'md':  '0.625rem',
                'lg':  '0.75rem',
                'xl':  '1rem',
                '2xl': '1.25rem',
                '3xl': '1.5rem',
                '4xl': '2rem',
            },

            boxShadow: {
                'xs':   '0 1px 2px 0 rgba(45,42,38,0.04)',
                'sm':   '0 1px 3px 0 rgba(45,42,38,0.06), 0 1px 2px -1px rgba(45,42,38,0.04)',
                'DEFAULT': '0 4px 6px -1px rgba(45,42,38,0.07), 0 2px 4px -2px rgba(45,42,38,0.05)',
                'md':   '0 6px 12px -2px rgba(45,42,38,0.08), 0 3px 6px -3px rgba(45,42,38,0.06)',
                'lg':   '0 10px 24px -3px rgba(45,42,38,0.09), 0 4px 8px -4px rgba(45,42,38,0.06)',
                'xl':   '0 20px 40px -4px rgba(45,42,38,0.10), 0 8px 16px -6px rgba(45,42,38,0.07)',
                '2xl':  '0 25px 50px -12px rgba(45,42,38,0.18)',
                'brand':'0 4px 14px 0 rgba(201,106,27,0.25)',
                'brand-lg':'0 8px 24px 0 rgba(201,106,27,0.30)',
                'inner':'inset 0 2px 4px 0 rgba(45,42,38,0.05)',
                'none': 'none',
            },

            animation: {
                'fade-in':       'fadeIn 0.5s ease-out both',
                'fade-up':       'fadeUp 0.6s ease-out both',
                'fade-up-slow':  'fadeUp 0.8s ease-out both',
                'slide-in-left': 'slideInLeft 0.5s ease-out both',
                'pulse-soft':    'pulseSoft 3s ease-in-out infinite',
                'float':         'float 6s ease-in-out infinite',
                'flow':          'flow 20s linear infinite',
            },

            keyframes: {
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInLeft: {
                    '0%':   { opacity: '0', transform: 'translateX(-24px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                pulseSoft: {
                    '0%, 100%': { opacity: '0.6' },
                    '50%':      { opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-10px)' },
                },
                flow: {
                    '0%':   { backgroundPosition: '0% 50%' },
                    '50%':  { backgroundPosition: '100% 50%' },
                    '100%': { backgroundPosition: '0% 50%' },
                },
            },

            transitionTimingFunction: {
                'out-expo':   'cubic-bezier(0.19, 1, 0.22, 1)',
                'in-out-expo':'cubic-bezier(0.87, 0, 0.13, 1)',
            },

            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'gradient-conic':  'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
            },

            maxWidth: {
                '8xl': '88rem',
                '9xl': '96rem',
            },

            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100',
            },
        },
    },

    plugins: [forms],
};

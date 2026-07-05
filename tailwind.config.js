import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                daraz: {
                    50: '#fff7ed',
                    100: '#ffeed4',
                    200: '#ffd9a8',
                    300: '#ffbc71',
                    400: '#ff9533',
                    500: '#f85606',
                    600: '#e94d04',
                    700: '#c13b06',
                    800: '#992f0d',
                    900: '#7c290f',
                },
                warm: {
                    50: '#fef8f0',
                    100: '#fef0dc',
                    200: '#fcddb5',
                    300: '#f9c485',
                    400: '#f5a34e',
                    500: '#f2882a',
                    600: '#e36d1a',
                    700: '#bd5515',
                    800: '#964418',
                    900: '#793a17',
                },
                midnight: {
                    50: '#f5f6fa',
                    100: '#ebecf4',
                    200: '#d3d6e7',
                    300: '#adb3d1',
                    400: '#818bb6',
                    500: '#636d9d',
                    600: '#4e5683',
                    700: '#40466b',
                    800: '#383c59',
                    900: '#1a1a2e',
                },
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-up': 'slideUp 0.5s ease-out',
                'slide-down': 'slideDown 0.3s ease-out',
                'scale-in': 'scaleIn 0.3s ease-out',
                'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
                'float': 'float 3s ease-in-out infinite',
                'shimmer': 'shimmer 2s infinite linear',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                slideDown: {
                    '0%': { transform: 'translateY(-10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                scaleIn: {
                    '0%': { transform: 'scale(0.95)', opacity: '0' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
                pulseSoft: {
                    '0%, 100%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.05)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
        },
    },

    plugins: [forms],
};

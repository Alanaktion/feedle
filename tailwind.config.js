const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.vue'],

    theme: {
        extend: {
            //
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
    },

    plugins: [require('@tailwindcss/ui')],
};

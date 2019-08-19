const { colors, fontFamily } = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        colors: {
            transparent: colors.transparent,
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            red: colors.red,
            yellow: colors.yellow,
            teal: colors.teal,
            blue: colors.blue,
            purple: colors.purple,

            primary: colors.indigo,
        },
        spacing: {
            px: '1px',
            '0': '0',
            '1': '0.25rem',
            '2': '0.5rem',
            '3': '1rem',
            '4': '1.5rem',
            '5': '3rem',
            '6': '6rem',
        },
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
        },
        fontFamily: {
            sans: fontFamily.sans,
            mono: fontFamily.mono,
        },
        fontWeight: {
            light: '300',
            normal: '400',
            medium: '500',
            semibold: '600',
            bold: '700',
        },
        width: {
            auto: 'auto',
            full: '100%',
            '0': '0',
            '1': '0.25rem',
            '2': '0.5rem',
            '3': '1rem',
            '4': '1.5rem',
            '5': '3rem',
            '6': '6rem',
            '7': '12rem',
            '8': '24rem',
            '9': '32rem',
            '10': '48rem',
            screen: '100vw',
        },
        container: {
            center: true,
            padding: '1rem',
        },
        extend: {}
    },
    variants: {
        appearance: [],
        backgroundAttachment: [],
        backgroundColor: ['hover', 'focus'],
        backgroundPosition: [],
        backgroundRepeat: [],
        backgroundSize: [],
        borderCollapse: [],
        borderColor: ['hover', 'focus'],
        borderRadius: [],
        borderStyle: [],
        borderWidth: [],
        boxShadow: ['hover', 'focus'],
        cursor: [],
        fill: [],
        fontFamily: [],
        fontSize: [],
        fontSmoothing: [],
        fontStyle: [],
        fontWeight: [],
        opacity: ['hover', 'focus'],
        outline: ['focus'],
        placeholderColor: [],
        pointerEvents: [],
        stroke: [],
        textColor: ['hover', 'focus'],
        textDecoration: ['hover', 'focus'],
        textTransform: [],
        userSelect: [],
        whitespace: [],
    },
    plugins: [],
    corePlugins: {
        float: false,
        placeholderColor: false,
    }
}

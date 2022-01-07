const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                themeColor: '#FF839C',
                green: colors.emerald,
                yellow: colors.amber,
                purple: colors.violet,
                gray: colors.neutral,
            },
            screens: {
                'print': {'raw': 'print'},
            },
        },
    },
    plugins: [],
}

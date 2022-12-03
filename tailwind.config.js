const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Source Sans Pro', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                'dark-800': '#232326',
                'dark-900': '#232326',
            }
        },
    },
    plugins: [],
}

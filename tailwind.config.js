const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        // App
        "./resources/**/*.blade.php",
        "./resources/**/*.js",

        // Wire UI
        './vendor/wire-elements/pro/config/wire-elements-pro.php',
        './vendor/wire-elements/pro/**/*.blade.php',
    ],
    theme: {
        extend: {
            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
            },
            colors: {
                primary: colors.green,
                success: colors.emerald,
                warning: colors.yellow,
                danger: colors.rose,
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                instrument: ['"Instrument Sans"', "sans-serif"],
            },
            colors: {
                golden: "#BC9313",
                gray: "#55535F",
            },
        },
    },
    plugins: [],
};

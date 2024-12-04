/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./*.{html,js}", "./css/**/*.{html,js}"], // Scan root and css folder
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

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
                questrial: ["Questrial", "sans-serif"],
            },
            colors: {
                CloudWhite: "#E2E0D7",
                FresoRed: "#B64C13",
                FresoGreen: "#44D150",
                FresoBlue: "#4A78D3",
                FresoPink: "#CC96DB",
                FresoLime: "#A9D689",
            },
            boxShadow: {
                "white-glow": "0 0 15px 5px rgba(255, 255, 255, 0.7)",
            },
        },
    },
    plugins: [require("tailwind-scrollbar")],
};

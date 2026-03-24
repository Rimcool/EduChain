import { default as flattenColorPalette } from "tailwindcss/lib/util/flattenColorPalette";
import forms from "@tailwindcss/forms";

export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.ts",
        "./resources/**/*.tsx",
    ],
    theme: {
        extend: {
            colors: {
                "primary": "#ec5b13",
                "accent": "#a855f7",
                "background-light": "#f8f6f6",
                "background-dark": "#120b08",
                
                // Existing Blade variables mapped
                "edu-bg": "#080c14",
                "edu-bg2": "#0d1220",
                "edu-surface": "#161d2e",
                "edu-border": "#1e2d45",
                "edu-green": "#00ff88",
                "edu-blue": "#4d9eff",
                "edu-red": "#ff4d6a",
                "edu-amber": "#ffb940",
            },
            fontFamily: {
                "display": ["Space Grotesk", "sans-serif"],
                "sans": ["DM Sans", "sans-serif"],
                "syne": ["Syne", "sans-serif"],
                "mono": ["Space Mono", "monospace"],
            },
            borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
        },
    },
    plugins: [forms],
};

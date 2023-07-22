const plugin = require("tailwindcss/plugin")

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html.twig',
    'assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'tutomarkspurple': '#8E26E8',
      }
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["winter", "night"],
    darkTheme: "night",
    utils: true,
  },
}


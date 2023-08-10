const plugin = require("tailwindcss/plugin")

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html.twig',
    'assets/js/**/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      {
        tutomarks: {
          "primary": "#42BDFB",
          "secondary": "#8E26E8",
          "accent": "#e83e8c",
          "neutral": "#20374c",
          "base-100": "#ffffff",
          "info": "#93e6fb",
          "success": "#5cb85c",
          "warning": "#ffc107",
          "error": "#d9534f",
        },
      },
      "night",
    ],
    darkTheme: "night",
    utils: true,
  },
  safelist: [
      'w-8',
      'group-hover:text-white'
  ]
}


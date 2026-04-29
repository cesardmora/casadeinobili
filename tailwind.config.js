/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./public/js/**/*.js",
  ],
  theme: {
    extend: {
      maxWidth: {
        // '12xl': '96rem',
        "12xl": "95%", // ~1536px — used as wide content wrapper
      },
    },
  },
  plugins: [],
};

const forms = require('@tailwindcss/forms');
const lineClamp = require('@tailwindcss/line-clamp');

module.exports = {
  content: [
    './blocks/**/*.{php,js}',
  ],
  theme: {
    container: {
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '0rem',
      },
    },
  },
  plugins: [forms, lineClamp],
};

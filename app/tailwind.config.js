module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    screens: {
      'xs': '285px',
      // => @media (min-width: 285px) { ... }
      
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }
    },
    extend: {
      outline: {
        blue: '1px solid #0000ff',
      },
      colors: {}
    }
  },
  variants: {
    extend: {
      outline: ["focus"],
      opacity: ['disabled'],
    }
  },
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio')]
}

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/*.{html,js}"],
  theme: {
    extend: {
      padding: {
        '110': '149px',
        '100': '141px', // Custom padding
        '174': '174px',
        '160': '137px',
      },
      colors: {
        'dla': '#073937', // Tambahkan warna dla dengan kode warna yang diinginkan
        'dlr': '#588157',
        'abu': '#636364',
        'white': '#ffffff',
        'customBeige': '#F3ECDC'
      },
    },
  },
  variants: {},
  plugins: [],
}


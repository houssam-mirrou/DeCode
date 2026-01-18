module.exports = {
  content: ["./**/*.{html,js,php}"], // I added 'php' so it scans your view files too
  theme: {
    extend: {
      colors: {
        library: {
          sand: '#E5D6B9',
          cream: '#FDFBF7',
          coffee: '#4A4036',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'), // <--- ADD THIS LINE
  ],
}
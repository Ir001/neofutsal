module.exports = {
    purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors : {
            primary : '#3FD0C9',
            secondary : '#C1F6ED',
            info : '#2EAF7D',
            success : '#449342',
            dark : '#02353C',
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

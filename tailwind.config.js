module.exports = {
    purge: [
    './resources/view/theme/**/*.blade.php',
    './resources/view/user/**/*.blade.php',
    './resources/view/components/**/*.blade.php',
    './resources/js/**/*.js',
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
    extend: {
      // ...
     overflow: ['hover', 'focus'],
    }
  },
  plugins: [],
}

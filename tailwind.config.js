import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
          colors: {
            //button = black
            bgcolor : '#FAF6F0', //putih
            primary: '#F4DFC8', //footer 
            secondary: '#F4EAE0', //card / container
            
          },
  
          width: {
            '128': '32rem',
            '160': '40rem',
            '200': '50rem',
  
          },

          fontFamily: {
            poppins: ["Poppins", "sans-serif"],
            
          }
  
        },
      },

    plugins: [forms],
};

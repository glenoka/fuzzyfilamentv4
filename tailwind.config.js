/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // Ambil semua path dari @source di file CSS Anda dan letakkan di sini
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/views/livewire/**/*.blade.php',
    './resources/js/**/*.js',
  ],

  theme: {
    extend: {
      // Definisikan screen custom Anda di sini
      screens: {
        'lg_992': '992px',
      },
    },
  },

  plugins: [],
}
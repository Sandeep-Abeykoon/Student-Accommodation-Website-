module.exports = {
    proxy: 'localhost:3000', // Assuming your PHP server runs on port 3000
    files: ['**/*.php'], // Watch PHP files for changes
    ignore: [], // Add any files to ignore
    reloadDelay: 0, // Delay in milliseconds before reloading
    ui: false, // Disable BrowserSync UI
    notify: false // Disable notifications
  };
  
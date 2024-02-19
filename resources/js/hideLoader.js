// resources/js/hideLoader.js

document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.svg-loader-container');
    if (loader) {
        loader.style.display = 'none';
    }
});

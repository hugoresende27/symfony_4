// loader.js

// Version parameter for cache busting
const version = '1.0.0'; // Update this version when you make changes


// List of scripts to load
const scripts = [
    'header.js',
    'users.js',
    'bitcoin.js',
    // Add more script paths as needed
];

const path = '/js/scripts/';

// Function to load each script with the version parameter
function loadScripts(scriptList) {
    scriptList.forEach(script => {
        const scriptElement = document.createElement('script');
        scriptElement.src = path + `${script}?v=${version}`;
        scriptElement.async = false; // Load scripts in order, set to true if order doesn't matter
        document.head.appendChild(scriptElement);
    });
}

// Call the function with the list of scripts
loadScripts(scripts);

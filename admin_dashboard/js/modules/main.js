// admin_dashboard/js/main.js
import { userModule } from './UserModule.js';
import { packageModule } from './PackageModules.js';

// No DOMContentLoaded wrapper needed anymore!
const mainContentCanvas = document.getElementById('main-content');
const userManagementBtn = document.getElementById('user-management');
const bundleManagementBtn = document.getElementById('bundle-management')
const logoutBtn = document.getElementById('logout');

userManagementBtn.addEventListener('click', () => {
    mainContentCanvas.innerHTML = userModule.renderTemplate();
    userModule.fetchAndRender();
});

bundleManagementBtn.addEventListener('click', () => {
    mainContentCanvas.innerHTML = packageModule.renderTemplate();
    packageModule.fetchAndRender();
});

logoutBtn.addEventListener('click', () => {
    if (confirm("Confirm session termination?")) {
        window.location.href = '../logout.php'; 
    }
});

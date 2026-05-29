// admin_dashboard/js/modules/PackageModule.js

export const packageModule = {
    renderTemplate() {
        return `
            <div class="module-card">
                <h2>Internet Package Bundles</h2>
                <!-- This wrapper container will house our horizontal scroll grid -->
                <div class="packages-scroll-container" id="packages-cards-holder">
                    <p class="loading-text">Pulling active bundles...</p>
                </div>
            </div>
        `;
    },

    async fetchAndRender() {
        try {
            const response = await fetch('./api/router.php?action=get_packages');
            if (!response.ok) throw new Error('API routing failure');

            const bundles = await response.json();
            const cardsHolder = document.getElementById('packages-cards-holder');

            cardsHolder.innerHTML = '';

            if (bundles.length === 0) {
                cardsHolder.innerHTML = `<p class="loading-text">No active bundles created yet.</p>`;
                return;
            }

            // Map each row item out into a clean semantic product card layout
            cardsHolder.innerHTML = bundles.map(bundle => `
                <div class="bundle-card">
                    <div class="bundle-header">
                        <h3>${this.escapeHtml(bundle.bundle_name)}</h3>
                    </div>
                    <div class="bundle-body">
                        <p>${this.escapeHtml(bundle.bundle_description)}</p>
                    </div>
                    <div class="bundle-footer">
                        <span class="price-tag">KES ${this.escapeHtml(bundle.bundle_price)}</span>
                    </div>
                </div>
            `).join('');

        } catch (error) {
            document.getElementById('packages-cards-holder').innerHTML = 
                `<p style="color:red; padding: 20px;">Error generating card layout: ${error.message}</p>`;
        }
    },

    escapeHtml(str) {
        if (!str) return '';
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
    }
};

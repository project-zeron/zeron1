export const userModule = {
//build the HTML template for the user management module
renderTemplate() {
    return `
        <div class="module-card">
            <h2>Network Users Registry</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Email Address</th>
                        <th>Date Created</th>
                    </tr>
                </thead>

                <tbody id="users-table-rows">
                    <tr><td colspan="2">Awaiting connection cascade...</td></tr>
                </tbody>
            </table>
        </div>
    `;
},

async fetchAndRender() {
    try {
        const response = await fetch('./api/router.php?action=get_users');
        if (!response.ok) throw new Error('Authentication barrier tripped');
        
        const users = await response.json();
        const tableBody = document.getElementById('users-table-rows');

        // 1. Wipe out the initial "Fetching records" placeholder text
        tableBody.innerHTML = ''; 

        if (users.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="2">No records found.</td></tr>`;
            return;
        }

        // 2. Loop through every single data record item sequentially
        for (const user of users) {
            
            // Create a physical row node element in memory
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${this.escapeHtml(user.email)}</td>
                <td>${this.escapeHtml(user.created_at)}</td>
            `;

            // Append the new row node visually directly onto the DOM table tree
            tableBody.appendChild(row);

            // 3. The Magical Delay Pause Switch
            // Blocks execution of the loop for exactly 500ms before handling the next entry
            await new Promise(resolve => setTimeout(resolve, 150));
        }

    } catch (error) {
        document.getElementById('users-table-rows').innerHTML = 
            `<tr><td colspan="2" style="color:red;">Error cascading layout: ${error.message}</td></tr>`;
    }
},

    escapeHtml(str) {
        if (!str) return '';
        return str
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

}

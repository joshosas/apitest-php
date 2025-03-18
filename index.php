<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h2>Users</h2>
    <table id="usersTable">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registered</th>
        </tr>
    </table>
    <button onclick="exportCSV('users')">Export Users to CSV</button>

    <h2>Pages</h2>
    <table id="pagesTable">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
        </tr>
    </table>
    <button onclick="exportCSV('pages')">Export Pages to CSV</button>

    <h2>Posts</h2>
    <table id="postsTable">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
        </tr>
    </table>
    <button onclick="exportCSV('posts')">Export Posts to CSV</button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('./fetch_data.php') // Ensure correct relative path
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    populateTable('usersTable', data.users, ['ID', 'user_login', 'user_email', 'user_registered']);
                    populateTable('pagesTable', data.pages, ['ID', 'post_title', 'post_date']);
                    populateTable('postsTable', data.posts, ['ID', 'post_title', 'post_date']);
                })
                .catch(error => console.error('Fetch Error:', error));
        });

        function populateTable(tableId, data, fields) {
            const table = document.getElementById(tableId);
            data.forEach(row => {
                const tr = document.createElement('tr');
                fields.forEach(field => {
                    const td = document.createElement('td');
                    td.textContent = row[field] || ''; // Handle undefined fields gracefully
                    tr.appendChild(td);
                });
                table.appendChild(tr);
            });
        }

        function exportCSV(type) {
            window.location.href = `export_csv.php?type=${type}`;
        }
    </script>

</body>

</html>
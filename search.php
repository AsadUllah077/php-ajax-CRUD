<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-ajax";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$search = htmlspecialchars($_POST['search']);

// Query the database
$res = mysqli_query($conn, "SELECT * FROM `usertable` WHERE email LIKE '%$search%' OR name1 LIKE '%$search%'");

$out = '';

if (mysqli_num_rows($res) > 0) {
    // Create table header
    $out .= '
    <table class="table-fixed min-w-full divide-y divide-gray-200 border border-gray-300">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">';

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($res)) {
        $out .= '
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row['name1']) . '</td>
            <td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($row['email']) . '</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <button data-id="' . $row['id'] . '" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 delete-btn">Delete</button>
                <button data-id="' . $row['id'] . '" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-red-700 dark:focus:ring-blue-900 edit-btn">Edit</button>
            </td>
        </tr>';
    }

    // Close table
    $out .= '</tbody></table>';
}


// Close connection
mysqli_close($conn);
echo $out;
// Output the result

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
$id = $_POST['id'];
// Query the database
$res = mysqli_query($conn, "SELECT * FROM `usertable` where `id` ='$id'");

$out = '';

if (mysqli_num_rows($res) > 0) {
    // Create table header
    $out .= '
    <div class="bg-white rounded-lg shadow dark:bg-gray-700 max-w-md mx-auto p-4">
        <div class="flex justify-between items-center border-b border-gray-300 pb-3">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Modal Title</h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="py-4">';

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($res)) {
        $out .= '
        <form id="modalForm">
            <div class="mb-5">
                <label for="modalEmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="email" value="' . htmlspecialchars($row['email']) . '" name="email" id="modalEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
            </div>
            <div class="mb-5">
                <label for="modalName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                <input type="text" value="' . htmlspecialchars($row['name1']) . '" name="name" id="modalName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                <input type="hidden" value="' . htmlspecialchars($row['id']) . '" name="id" id="modalid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
        </form>';
    }

    // Close table
    $out .= '</div>
        <div class="flex justify-end pt-2">
            <button id="closeModalBottom" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
            <button id="submitModalForm" class="ml-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
        </div>
    </div>';
}

// Close connection
mysqli_close($conn);
echo $out;
?>

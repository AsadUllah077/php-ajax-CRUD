<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud PHP Ajax</title>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-500">

    <div id="myModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50">

    </div>

    

    <form id="dataForm" class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="insert">Submit</button>
    </form>
    <div class="flex justify-end items-end  mr-5 mt-5">
        <input type="search" id="search" name="search" placeholder="Search..." class="p-2 rounded">
    </div>
    <div class="container mx-auto p-4">
        <!-- <div class="relative">
            <div class="absolute top-0 right-0">
                <input type="submit" id="load" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Load Data">
            </div>
        </div> -->
        <div id="main" class="mt-4 flex justify-center">
            <!-- The table will be inserted here by AJAX -->
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            load_data();

            function load_data() {
                $.ajax({
                    url: "load.php",
                    type: "GET",
                    success: function(response) {
                        $("#main").html(response);
                    }
                });
            }
            $(document).on("click", ".delete-btn", function(e) {
                var id = $(this).data("id");
                if (id) {
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            load_data();
                        }
                    });
                } else {
                    alert("Error Deleting Data");
                    return false;
                }
            });
            $(document).on("click", ".edit-btn", function(e) {
                $('#myModal').show();
                var id = $(this).data("id");
                if (id) {
                    $.ajax({
                        url: "edit.php",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#myModal").html(response);
                        }
                    });
                } else {
                    alert("Error Editing Data");
                    return false;
                }
            });
            $(document).on("click", "#submitModalForm", function(e) {
                var email = $("#modalEmail").val();
                var name = $("#modalName").val();
                var id = $("#modalid").val();
                if (email == "" || name == "") {
                    alert("Please fill all fields");
                    return false;
                } else {
                    $.ajax({
                        url: "update.php",
                        type: "POST",
                        data: {
                            email: email,
                            name: name,
                            id: id
                        },
                        success: function(response) {
                            load_data();
                            $("#myModal").hide();

                        }
                    });
                }
            });

            $(document).on("click", "#closeModalBottom", function(e) {
                $("#myModal").hide();
            });

            $("#search").on("keyup",function(e) {
                var val = $(this).val();
                $.ajax({
                    url: "search.php",
                    type: "POST",
                    data: {
                        search: val
                    },
                    success: function(response) {
                        $("#main").html(response);
                    }
                });
            });
            $("#dataForm").on("submit", function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var name = $("#name").val();
                if (email == "" || name == "") {
                    alert("Please fill all fields");
                    return false;
                } else {
                    $.ajax({
                        url: "insert.php",
                        type: "POST",
                        data: {
                            email: email,
                            name: name
                        },
                        success: function(response) {
                            load_data();
                            $('#dataForm').trigger('reset');
                            // $('#dataForm')[0].reset();
                            // alert(response);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
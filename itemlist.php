<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Project List</title>

    <link rel="shortcut icon" href="assets/img/bd-logo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="assets/img/logo.maIn.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <script src="assets/js/layout.js" type="3aab8abce64812a656bcb864-text/javascript"></script>


    <style>
        .round-img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>

</head>

<body>

    <div class="main-wrapper">
        <div class="header header-one">
            <div class="main-logo d-inline float-start d-lg-flex align-items-center d-none d-sm-none d-md-none">
                <div class="logo-white">
                    <a href="add-quotations.php">
                        <img src="assets/img/bd-logo.png" class="img-fluid logo-blue" alt="Logo">
                    </a>
                    <a href="add-quotations.php">
                        <img src="assets/img/bd-logo.png" class="img-fluid logo-small" alt="Logo">
                    </a>
                </div>
                <div class="logo-color">
                    <a href="add-quotations.php">
                        <img src="assets/img/bd-logo.png" class="img-fluid logo-blue" alt="Logo" width="100px">
                    </a>
                    <a href="add-quotations.php">
                        <img src="assets/img/bd-logo.png" class="img-fluid logo-small" alt="Logo">
                    </a>
                </div>
            </div>

            <a href="javascript:void(0);" id="toggle_btn">
                <span class="toggle-bars">
                    <span class="bar-icons"></span>
                    <span class="bar-icons"></span>
                    <span class="bar-icons"></span>
                    <span class="bar-icons"></span>
                </span>
            </a>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <div class="position-fixed" style="top: 10px; right:100px; z-index: 11; padding-left: 15px;">
                <div id="passwordToast" class="toast align-items-center text-white bg-success border-0" role="alert"
                    aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body">
                            Password changed successfully!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs user-menu">
                <li>
                    <button class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#changePasswordModal"
                        style="display: flex; align-items: center; justify-content: center; padding: 10px;">
                        <i class="fas fa-key" style="font-size: 18px; color: red;"></i></button>
                </li>
                <li class="nav-item has-arrow dropdown-heads">
                    <a href="javascript:void(0);" class="win-maximize">
                        <i class="fe fe-maximize"></i>
                    </a>
                </li>

            </ul>

        </div>



        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul class="sidebar-vertical">

                        <li class="menu-title"><span>Main</span></li>

                        <ul class="sidebar-vertical">
                            <li class="submenu">
                                <a href="#"><i class="fe fe-home"></i> <span>Projects</span> <span
                                        class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="add-quotations.php">Add Project</a></li>
                                    <li><a href="display.php">Project List</a></li>
                                    <li><a href="itemlist.php">Items List</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                            </li>
                        </ul>
                </div>
            </div>
        </div>

        <?php
            include('db.php');
            $message = "";
            if (isset($_POST['add_item'])) {
               
                $item_name = $con->real_escape_string($_POST['item_name']);
                $stock = $con->real_escape_string($_POST['stock']); 
                $price = $con->real_escape_string($_POST['price']);  

               
                $insert_sql = "INSERT INTO add_item (item_name, stock,price) VALUES ('$item_name', '$stock','$price')";

                if ($con->query($insert_sql) === TRUE) {
                    $message = "Item added successfully.";
                } else {
                    $message = "Error: " . htmlspecialchars($con->error);
                }
            }

          
            if (isset($_POST['update'])) {
                $item_id = (int)$_POST['item_id']; 
                $item_name = $con->real_escape_string($_POST['item_name']);  
                $stock = $con->real_escape_string($_POST['stock']); 
                $price = $con->real_escape_string($_POST['price']); 

             
                $update_sql = "UPDATE add_item SET item_name = '$item_name',  stock = '$stock', price = '$price' WHERE id = $item_id";

               if ($con->query($update_sql) === TRUE) {
                    $message = "Item updated successfully.";
                } else {
                    $message = "Error: " . htmlspecialchars($con->error);
                }
            }

       
            $filter_name = isset($_GET['name']) ? $con->real_escape_string($_GET['name']) : '';
            $filter_date = isset($_GET['date']) ? $con->real_escape_string($_GET['date']) : '';

            $sql = "SELECT * FROM add_item WHERE item_name LIKE '%$filter_name%'";

            if (!empty($filter_date)) {
                $sql .= " AND DATE(date_column) = '$filter_date'"; 
            }

            $result = $con->query($sql);
        ?>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_GET['message']) && $_GET['message'] === 'delete_success'): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Your item has been deleted successfully.',
                        confirmButtonText: 'OK'
                    }).then(() => {

                        window.history.replaceState(null, null, window.location.pathname);
                    });
            <?php elseif(!empty($message)): ?>
                    Swal.fire({
                        icon: <?php echo strpos($message, 'Error') === false ? "'success'" : "'error'"; ?>,
                            title: '<?php echo strpos($message, 'Error') === false ? "Success" : "Error"; ?>',
                                text: '<?php echo addslashes($message); ?>',
                                    confirmButtonText: 'OK'
            }).then(() => {

                window.history.replaceState(null, null, window.location.pathname);
            });
            <?php endif; ?>
           });
        </script>

        <script>
            function confirmDelete(itemId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        window.location.href = 'itemlistdelete.php?delete=' + itemId;
                    }
                });
            }
        </script>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="display: inline;">
                        <form method="POST" action="">
                            <div class="mb-3 position-relative">
                                <label for="new_password" class="form-label">New Password</label>
                                <div style="position: relative; display: inline-block; width: 100%;" class="pass-group">
                                    <input type="password" class="form-control pass-input" name="new_password"
                                        style="width: 100%; padding-right: 40px;" id="new_password" required>
                                    <span class="fas fa-eye toggle-password"
                                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></span>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Item List</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Filter">
                                    <span class="me-2"><img src="assets/img/icons/filter-icon.svg"
                                            alt="filter"></span>Filter
                                </a>
                            </li>
                            <li>
                                <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Download">

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="d-block">
                                            <li>
                                                <a class="d-flex align-items-center download-item"
                                                    href="download.php?format=pdf" download>
                                                    <i class="far fa-file-pdf me-2"></i>PDF
                                                </a>
                                            </li>
                                            <li>
                                                <a class="d-flex align-items-center download-item"
                                                    href="download.php?format=csv" download>
                                                    <i class="far fa-file-text me-2"></i>CSV
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- <a class="btn-filters" href="javascript:void(0);" onclick="window.print();"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print">
                                        <span><i class="fe fe-printer"></i></span>
                                    </a> -->
                            </li>
                            <li>
                                <!--   <button type="submit" id="delete_button" class='btn btn-primary w-auto'> <i
                                            class='fas fa-trash'></i></button>-->

                            </li>
                            <li>
                                <a class="btn btn-primary w-auto" data-bs-toggle="modal"
                                    data-bs-target="#quotationModal">Add item</a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="filter_inputs" class="card filter-card">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="input-block mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--   <form method="POST" action="select_item_delete.php" id="itemDeleteForm">-->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-center table-hover datatable" id="salesTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <!-- <th><input type="checkbox" id="select_all"
                                                                class="select-all-checkbox"></th>-->
                                                <th>S.No</th>
                                                <th>Item Name</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        if ($result->num_rows > 0) {
                                                            $sno = 1;
                                                            while ($row = $result->fetch_assoc()) {
                                                                $item_id = $row['id'];
                                                                $item_name = $row['item_name'];
                                                                $stock = $row['stock'];
                                                                $price = $row['price'];

                                                                $stock_color = $stock < 0 ? 'style="color: red;"' : '';

                                                                echo "<tr>";

                                                                echo "<td>" . htmlspecialchars($sno) . "</td>";
                                                                echo "<td>" . htmlspecialchars($item_name) . "</td>";
                                                                echo "<td $stock_color>" . htmlspecialchars($stock) . "</td>";
                                                                echo "<td>" . htmlspecialchars($price) . "</td>";
                                                                echo "<td>
                                                                        <div class='d-flex justify-content-center'>
                                                                            <a href='javascript:void(0);' class='btn btn-primary btn-sm me-2' data-bs-toggle='modal' data-bs-target='#updateModal' 
                                                                                data-id='" . urlencode($item_id) . "' 
                                                                                data-name='" . htmlspecialchars($item_name) . "' 
                                                                                data-stock='" . htmlspecialchars($stock) . "'
                                                                                data-price='" . htmlspecialchars($price) . "'>
                                                                                <i class='fas fa-edit' style='color:gold;'></i>
                                                                            </a>
                                                                            <a href='javascript:void(0);' class='btn btn-primary btn-sm' onclick='confirmDelete(" . json_encode($item_id) . ")'>
                                                                                <i class='fas fa-trash' style='color:gold;'></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>";
                                                                echo "</tr>";
                                                                $sno++;
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='5' class='text-center'>No items found.</td></tr>";
                                                        }
                                                     ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </form>
            <div class="modal fade" id="quotationModal" tabindex="-1" aria-labelledby="quotationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="quotationModalLabel">Add Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="itemlist-submit.php" method="post">
                                <div class="mb-3">
                                    <label for="item_name" class="form-label">Item Name:</label>
                                    <input type="text" id="item_name" name="item_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price:</label>
                                    <input type="number" id="price" name="price" class="form-control" required
                                        step="0.01" min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock Quantity:</label>
                                    <input type="number" id="stock" name="stock" class="form-control" required min="1">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Update Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="itemlist.php" method="post">
                                <input type="hidden" name="item_id" id="update_item_id">
                                <div class="mb-3">
                                    <label for="update_item_name" class="form-label">Item Name:</label>
                                    <input type="text" id="update_item_name" name="item_name" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="update_stock" class="form-label">Stock:</label>
                                    <input type="number" id="update_stock" name="stock" class="form-control" required
                                        step="0.01" min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="update_price" class="form-label">Price:</label>
                                    <input type="number" id="update_price" name="price" class="form-control" required
                                        step="0.01" min="0">
                                </div>
                                <button type="submit" name="update" class="btn btn-primary">Update Item</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const updateModal = document.getElementById('updateModal');
                    updateModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const itemId = button.getAttribute('data-id');
                        const itemName = button.getAttribute('data-name');
                        const itemStock = button.getAttribute('data-stock');
                        const itemPrice = button.getAttribute('data-price');


                        const modalItemId = updateModal.querySelector('#update_item_id');
                        const modalItemName = updateModal.querySelector('#update_item_name');
                        const modalItemStock = updateModal.querySelector('#update_stock');
                        const modalItemPrice = updateModal.querySelector('#update_price');


                        modalItemId.value = itemId;
                        modalItemName.value = itemName;
                        modalItemStock.value = itemStock;
                        modalItemPrice.value = itemPrice;
                    });
                });
            </script>
        </div>
    </div>

    <?php
        $con->close();
        ?>

    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Filter</h5>
                <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
            </div>
            <div class="sidebar-body">
                <form method="GET" action="">
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Filter Your Quotation
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control member-search-dropdown"
                                                    id="member_search1" name="search" placeholder="Filter Here">
                                                <span><img src="assets/img/icons/search.svg" alt="img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-buttons">
                        <button type="button" onclick="resetAndRedirect()"
                            class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('member_search1').addEventListener('input', function () {
            var input = this.value.toUpperCase();
            var table = document.getElementById('salesTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                var td = tr[i].getElementsByTagName('td');
                var rowContainsInput = false;

                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        var txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(input) > -1) {
                            rowContainsInput = true;
                            break;
                        }
                    }
                }

                if (rowContainsInput) {
                    tr[i].style.display = '';
                }
            }
        });

        function resetAndRedirect() {
            document.getElementById('member_search1').value = '';
            var table = document.getElementById('salesTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) {
                tr[i].style.display = '';
            }
        }
    </script>
    <script src="assets/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/js/script.js" type="text/javascript"></script>
    <script src="./cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="da4f9371b8a44478d6db867d-|49" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    include('db.php');
    $message = ''; 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password'])) { 
  
    $username = $_SESSION['username'] ?? ''; 
    $newPassword = $_POST['new_password'];

    if ($username && !empty($newPassword)) {
       
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

       
        $updateSql = "UPDATE login SET password=? WHERE username=?";
        $stmt = $con->prepare($updateSql);
        $stmt->bind_param("ss", $hashedPassword, $username);

        if ($stmt->execute()) {
            $message = "success|Password changed successfully!"; 
        } else {
            $message = "error|Error updating password."; 
        }

    
        $_SESSION['passwordMessage'] = $message;

        $stmt->close();
    }
}
?>
    <script>
    <?php if (isset($_SESSION['passwordMessage'])): ?>
        const [type, text] = "<?php echo $_SESSION['passwordMessage']; ?>".split('|');
        if (type === "success") {
            const toastEl = document.getElementById('passwordToast');
            toastEl.querySelector('.toast-body').textContent = text;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
        <?php unset($_SESSION['passwordMessage']); ?>
            window.history.replaceState(null, null, window.location.pathname);
    <?php endif; ?>
    </script>
    <script>
            function updateStock(qtyInput, initialStock) {
                const qty = parseInt(qtyInput.value) || 0;
                const stockDisplay = document.getElementById('stockDisplay');
                const newStock = initialStock - qty;
                stockDisplay.textContent = newStock >= 0 ? newStock : "Out of Stock";
                if (newStock < 0) {
                    alert("Not enough stock available!");
                    qtyInput.value = initialStock;
                    stockDisplay.textContent = 0;
                }
            }
    </script>
</body>

</html>
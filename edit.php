<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
   
    $sql = "SELECT * FROM admin WHERE id = $id";
    $result = $con->query($sql);
    $adminData = $result->fetch_assoc();

   
    $sql2 = "SELECT * FROM admin2 WHERE quotation_id = $id";
    $result2 = $con->query($sql2);
    $admin2Data = $result2->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Invalid Quotation ID.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $quotationNo = $_POST['quotationNo'];
    $quotationTo = $_POST['quotationTo'];
    $mobileno = $_POST['mobileno'];
    $quotationAmount = $_POST['quotationAmount'];
    $subtotal = $_POST['subtotal'];
    $profit = $_POST['profit'];
    $loss = $_POST['loss'];

    
    $updateadminSql = "UPDATE admin SET date='$date', `quotation No`='$quotationNo', `quotation To`='$quotationTo', `mobileno`='$mobileno', `quotation Amount`='$quotationAmount', subtotal='$subtotal', profit='$profit', loss='$loss' WHERE id=$id";
    
    if ($con->query($updateadminSql) === TRUE) {
        foreach ($admin2Data as $index => $item) {
            $itemValue = isset($_POST['item'][$index]) ? $_POST['item'][$index] : null;
            $price = isset($_POST['price'][$index]) ? $_POST['price'][$index] : null;
            $qty = isset($_POST['qty'][$index]) ? $_POST['qty'][$index] : null;
            $total = isset($_POST['total'][$index]) ? $_POST['total'][$index] : null;

           
            if (empty($itemValue) && empty($price) && empty($qty) && empty($total)) {
                
                $stockReturnSql = "UPDATE add_item SET stock = stock + " . $item['qty'] . " WHERE item_name = '" . $item['item'] . "'";
                $con->query($stockReturnSql);

                $deleteadmin2Sql = "DELETE FROM admin2 WHERE id = " . $item['id'];
                if (!$con->query($deleteadmin2Sql)) {
                    echo "Error deleting item: " . $con->error;
                }
            } else {
           
                $oldQty = $item['qty']; 
                $stockDiff = $oldQty - $qty;

                $updateStockSql = "UPDATE add_item SET stock = stock + $stockDiff WHERE item_name = '" . $item['item'] . "'";
                $con->query($updateStockSql);

            
                $updateadmin2Sql = "UPDATE admin2 SET item='$itemValue', price='$price', qty='$qty', total='$total' WHERE id=" . $item['id'];
                if (!$con->query($updateadmin2Sql)) {
                    echo "Error updating item: " . $con->error;
                }
            }
        }

      
        for ($i = count($admin2Data); isset($_POST['item'][$i]); $i++) {
            $itemValue = $_POST['item'][$i];
            $price = $_POST['price'][$i];
            $qty = $_POST['qty'][$i];
            $total = $_POST['total'][$i];

            if ($itemValue || $price || $qty || $total) {
            
                $updateStockSql = "UPDATE add_item SET stock = stock - $qty WHERE item_name = '$itemValue'";
                $con->query($updateStockSql);

            
                $insertadmin2Sql = "INSERT INTO admin2 (quotation_id, item, price, qty, total) VALUES ($id, '$itemValue', '$price', '$qty', '$total')";
                if (!$con->query($insertadmin2Sql)) {
                    echo "Error inserting new item: " . $con->error;
                }
            }
        }

        
        $_SESSION['success_message'] = 'Record updated successfully!';
        header("Location: display.php?message=update_success");
        exit;
    } else {
        echo "<p>Error updating record: " . $con->error . "</p>";
    }
}
?>


    <!DOCTYPE html>
    <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"data-sidebar-image="none">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Editproject </title>

    <link rel="shortcut icon" href="assets/img/bd-logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="assets/css/style.css">




    <style>
    .select2-results {
    max-height: 200px; 
    overflow-y: auto; 
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
         
            <ul class="nav nav-tabs user-menu">
                <li>
                <!-- <button class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#changePasswordModal" style="display: flex; align-items: center; justify-content: center; padding: 10px;">
                <i class="fas fa-key" style="font-size: 18px; color: red;"></i></button> -->
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
                    <nav class="greedys sidebar-horizantal">
                        <ul class="list-inline-item list-unstyled links">
                            <li><a href="inventory.html"><i class="fe fe-user"></i> <span>Inventory</span></a></li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-file-plus"></i><span>Signature</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="signature-list.html"><i class="fe fe-clipboard"></i> <span>List of Signature</span></a></li>
                                    <li><a href="signature-invoice.html"><i class="fe fe-box"></i> <span>Signature Invoice</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <ul class="sidebar-vertical">
                        <li class="menu-title"><span>Main</span></li>
                        <li class="submenu">
                            <a href="#"><i class="fe fe-home"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="add-quotations.php">Add Project</a></li>
                                <li><a href="display.php">List of Project</a></li>
                                <li><a href="itemlist.php">List of All Items</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

      <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <nav class="greedys sidebar-horizantal">
                        <ul class="list-inline-item list-unstyled links">
                      <li>
                                <a href="inventory.html"><i class="fe fe-user"></i> <span>Inventory</span></a>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-file-plus"></i><span>Signature</span> <span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="signature-list.html"><i class="fe fe-clipboard"></i> <span>List of
                                                Signature</span></a></li>
                                    <li><a href="signature-invoice.html"><i class="fe fe-box"></i> <span>Signature
                                                Invoice</span></a></li>
                                </ul>
                            </li>
                   
                       
                       </nav>
                    <ul class="sidebar-vertical">

                        <li class="menu-title"><span>Main</span></li>
                        <li class="submenu">
                            <a href="#"><i class="fe fe-home"></i> <span>Projects</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                            <li><a href="add-quotations.php"> Add Project</a></li>
                                <li><a href="display.php">Project List</a></li>
                                <li><a href="itemlist.php">Item list</a></li>
                            </ul>
                        </li>
                        <li>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                    </li>

                </div>
            </div>
        </div>
        
        <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-body">
                <div class="page-header">
                    <div class="content-page-header">
                        <h5>Edit Project</h5>
                    </div>
                </div>
             
                <form id="quotationForm" method="POST" action="edit.php?id=<?php echo $id; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="quotation-card">
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="date"><i class="fas fa-calendar-alt"></i> Date:</label>
                                                <input type="date" id="date" name="date" class="form-control" value="<?php echo htmlspecialchars($adminData['date']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="quotationNo"><i class="fas fa-file-alt"></i> Project No:</label>
                                                <input type="text" id="quotationNo" name="quotationNo" class="form-control" value="<?php echo htmlspecialchars($adminData['quotation No']); ?>" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="quotationTo"><i class="fas fa-user"></i> Customer Name:</label>
                                                <input type="text" id="quotationTo" name="quotationTo" class="form-control" value="<?php echo htmlspecialchars($adminData['quotation To']); ?>" required  pattern="^[A-Za-z\s]+$" maxlength="100" title="Please enter a valid name (letters and spaces only)." placeholder="Enter name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="mobileno"><i class="fa fa-phone" aria-hidden="true"></i> Phone No:</label>
                                                
                                                <input type="tel" id="mobileno" name="mobileno" class="form-control"value="<?php echo htmlspecialchars($adminData['mobileno']); ?>" required pattern="^\d{10}$" maxlength="10" title="Please enter a valid 10-digit phone number."placeholder="Enter 10-digit phone number"> 
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="quotationAmount">₹ Project Amount:</label>
                                                <input type="number" id="quotationAmount" name="quotationAmount" class="form-control" value="<?php echo htmlspecialchars($adminData['quotation Amount']); ?>" oninput="calculateTotal()"   required min="0" step="0.01"  placeholder="Enter quotation amount" title="Please enter a positive number.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <form onupdate="return validateForm()">
                                <div class="form-group-item">
                                    <div class="card-table">
                                        <div class="card-body">
                                            <table id="adminTable" class="table table-center table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                     <tbody id="quotationItems">
                                                    <?php foreach ($admin2Data as $index => $item) { ?>
                                                        <tr data-id="<?php echo $item['id']; ?>">
                                                            <td class="serial"><?php echo $index + 1; ?></td>
                                                            <td>
                                                                <select name="item[]" class="form-control form-control-lg" style="width: 100px;" onchange="updatePrice(this)"required>
                                                                    <option value="<?php echo htmlspecialchars($item['item']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>"><?php echo htmlspecialchars($item['item']); ?></option>
                                                                    <?php
                                                                  
                                                                    $sql = "SELECT item_name, price ,stock FROM add_item";
                                                                    $result = $con->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo "<option value='" . htmlspecialchars($row['item_name']) . "' data-stock='" . htmlspecialchars($row['stock']) . "' data-price='" . htmlspecialchars($row['price']) . "'>" . htmlspecialchars($row['item_name']) . "</option>";

                                                                        }
                                                                    } else {
                                                                        echo "<option value=''>No items available</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="number" name="price[]" class="form-control form-control-mb price" style="width: 100px;" value="<?php echo htmlspecialchars($item['price']); ?>" readonly required ></td>
                                                            <td><input type="number" name="qty[]" class="form-control form-control-mb qty" style="width: 100px;" value="<?php echo htmlspecialchars($item['qty']); ?>" oninput="calculateRowTotal(this)" required  min="1"></td>
                                                            <td><input type="number" name="total[]" class="form-control form-control-mb total" style="width: 150px;" value="<?php echo htmlspecialchars($item['total']); ?>" oninput="trackManualTotal(this)" required min="1"></td>
                                                            <td><button type="button" class="btn btn-primary" onclick="removeRow(this, <?php echo $item['id']; ?>)"> <i class="fa fa-trash" style="border:none; background:none;"></i> </button></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn btn-primary" onclick="addNewRow()"> <i class="fas fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-item border-0 mb-0">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="subtotal">Subtotal:</label>
                                                <input type="number" id="subtotal" class="form-control" readonly value="<?php echo htmlspecialchars($adminData['subtotal']); ?>">
                                                <input type="hidden" id="subtotalInput" name="subtotal" value="<?php echo htmlspecialchars($adminData['subtotal']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="profit">Profit:</label>
                                                <input type="number" id="profit" class="form-control" readonly value="<?php echo htmlspecialchars($adminData['profit']); ?>">
                                                <input type="hidden" id="profitInput" name="profit" value="<?php echo htmlspecialchars($adminData['profit']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label for="loss">Loss:</label>
                                                <input type="number" id="loss" class="form-control" readonly value="<?php echo htmlspecialchars($adminData['loss']); ?>">
                                                <input type="hidden" id="lossInput" name="loss" value="<?php echo htmlspecialchars($adminData['loss']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>


<script>

$('#adminTable select').select2({
    placeholder: "Select Item",
    allowClear: true,
    tags: true,
    width: '100%',
    matcher: function(params, data) {
   
        if ($.trim(params.term) === '') {
            return data;
        }

        
        if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
            return data;
        }

        
        return null;
    }
});



function updatePrice(select) {
    const row = select.closest('tr');
    const price = select.options[select.selectedIndex].dataset.price;
    const priceInput = row.querySelector('.price');
    priceInput.value = price;
    calculateRowTotal(priceInput);  
    calculateTotal();  
}


function calculateRowTotal(input) {
    const row = input.closest('tr');
    const price = parseFloat(row.querySelector('.price').value) || 0;
    const qty = parseFloat(row.querySelector('.qty').value) || 0;
    const totalInput = row.querySelector('.total');
    

    let total = price * qty;
    totalInput.value = total.toFixed(2); 
    
    calculateTotal();  
}


function trackManualTotal(input) {
    input.dataset.manual = 'true';  
    calculateTotal();  
}




function calculateTotal() {
    let subtotal = 0;
    const rows = document.querySelectorAll('#adminTable tbody tr');

    rows.forEach(row => {
        let total = parseFloat(row.querySelector('.total').value) || 0;
        subtotal += total; 
    });

    document.getElementById('subtotal').value = subtotal.toFixed(2);
    document.getElementById('subtotalInput').value = subtotal.toFixed(2);

    const quotationAmount = parseFloat(document.getElementById('quotationAmount').value) || 0;
    const profit = Math.max(0, quotationAmount - subtotal); 
    const loss = Math.max(0, subtotal - quotationAmount); 

    const profitField = document.getElementById('profit');
    const lossField = document.getElementById('loss');

    profitField.value = profit.toFixed(2);
    document.getElementById('profitInput').value = profit.toFixed(2);
    lossField.value = loss.toFixed(2);
    document.getElementById('lossInput').value = loss.toFixed(2);

    if (profit > 0) {
        profitField.style.color = 'green';
    } else {
        profitField.style.color = ''; 

    if (loss > 0) {
        lossField.style.color = 'red';
    } else {
        lossField.style.color = ''; 
    }
}
}

function addNewRow() {
    const tbody = document.getElementById('quotationItems');
    const rowCount = tbody.rows.length + 1;

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td class="serial">${rowCount}</td>
        <td>
            <select name="item[]" class="form-control form-control-lg" style="width: 100px;" onchange="updatePrice(this)">
                <option value="">Select Item</option>
                <?php
                $sql = "SELECT item_name, price FROM add_item";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['item_name']) . "' data-price='" . htmlspecialchars($row['price']) . "'>" . htmlspecialchars($row['item_name']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No items available</option>";
                }
                ?>
            </select>
        </td>
        <td><input type="number" name="price[]" class="form-control form-control-mb price" style="width: 100px;" readonly /></td>
        <td><input type="number" name="qty[]" class="form-control form-control-mb qty" style="width: 100px;" oninput="calculateRowTotal(this.closest('tr'))" required min="1"/></td>
        <td><input type="number" name="total[]" class="form-control form-control-mb total" style="width: 150px;" oninput="trackManualTotal(this)" required min="1" /></td>
        <td><button type="button" class="btn btn-primary" onclick="removeRow(this)"> <i class="fa fa-trash" style="border:none; background:none;"></i> </button></td>
    `;
    tbody.appendChild(newRow);
    updateSerialNumbers();

$('#adminTable select').select2({
    placeholder: "Select Item",
    allowClear: true,
    tags: true,
    width: '100%',
    matcher: function(params, data) {
    
        if ($.trim(params.term) === '') {
            return data;
        }

     
        if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
            return data;
        }

 
        return null;
    }
});

}


function updateSerialNumbers() {
    const rows = document.querySelectorAll('#adminTable tbody tr');
    rows.forEach((row, index) => {
        const serialCell = row.querySelector('.serial');
        if (serialCell) {
            serialCell.textContent = index + 1;
        }
    });
}


function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    updateSerialNumbers();
    calculateTotal(); 
}


window.onload = function() {
    calculateTotal(); 
};
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function updatePrice(select) {
        const row = select.closest('tr');
        const priceInput = row.querySelector('.price');
        const qtyInput = row.querySelector('.qty');
        const totalInput = row.querySelector('.total');
        const selectedItem = select.value;

      
        if (!selectedItem) {
            priceInput.value = "";  
            qtyInput.value = 0;     
            totalInput.value = 0;   
            calculateTotal();      
            return;
        }

        
        const price = select.options[select.selectedIndex]?.dataset.price || '0';
        priceInput.value = price;

     
        qtyInput.value = 0;
        totalInput.value = 0;

        calculateTotal(); 

        
        const allRows = document.querySelectorAll('#quotationItems select');
        let isDuplicate = false;

        allRows.forEach(rowSelect => {
            if (rowSelect !== select && rowSelect.value === selectedItem) {
                isDuplicate = true;
            }
        });

        if (isDuplicate) {
        
            Swal.fire({
                icon: 'warning',
                title: 'Duplicate Item',
                text: 'You have already selected this item.',
                confirmButtonText: 'OK',
            }).then(() => {
            
                select.value = "";  
                priceInput.value = "";  
                qtyInput.value = 0;  
                totalInput.value = 0;  
                calculateTotal();
            });
        }
    }
</script>
<script src="assets/js/bootstrap.bundle.min.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/plugins/datatables/datatables.min.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/plugins/select2/js/select2.min.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/plugins/moment/moment.min.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/js/jquery-ui.min.js" type="da4f9371b8a44478 d6db867d-text/javascript"></script>
<script src="assets/js/theme-settings.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/js/greedynav.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="assets/js/script.js" type="da4f9371b8a44478d6db867d-text/javascript"></script>
<script src="./cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="da4f9371b8a44478d6db867d-|49" defer></script>
</body>
</html>

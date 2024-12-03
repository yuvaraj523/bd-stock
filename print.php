
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {

    $sql = "SELECT * FROM admin WHERE id = $id";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        $adminData = $result->fetch_assoc();

      
        $sql2 = "SELECT * FROM admin2 WHERE quotation_id = $id";
        $result2 = $con->query($sql2);
        $admin2Data = $result2->fetch_all(MYSQLI_ASSOC);
        
 
        $overallTotal = 0;
        $subtotal = 0;

      
        foreach ($admin2Data as $item) {
            $subtotal += $item['total']; 
    
            $overallTotal = $subtotal;
        }

    } else {
        echo "Quotation not found.";
        exit;
    }
} else {
    echo "Invalid Quotation ID.";
    exit;
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <title>Print</title>
  <link rel="stylesheet" href="assets1/css/style.css">
  <style>

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.tm_semi_bold {
    font-weight: 600;
}

.tm_white_color {
    color: white;
}

.tm_accent_bg {
    background-color: #007bff;
}

.tm_text_right {
    text-align: right;
}

.tm_text_center {
    text-align: center;
}

.tm_width_1 {
    width: 15%;
}

  </style>
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="assets/img/bd-logo.png" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Projects</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Project Amount: </b><?php echo htmlspecialchars($adminData['quotation Amount']); ?></div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Project No:<b><?php echo htmlspecialchars($adminData['quotation No']); ?></b></p>
              <p class="tm_invoice_date tm_m0">Date: <b><?php echo htmlspecialchars( date("d-m-Y", strtotime($adminData["date"]))); ?></b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Customer Name:</b></p>
              <p>
              <?php echo htmlspecialchars($adminData['quotation To']); ?>
              </p>
            </div>
           
          </div>
          <div class="tm_table tm_style1">
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_accent_bg">
                        <th class="tm_semi_bold tm_white_color">S.No</th>
                        <th class="tm_semi_bold tm_white_color">Item</th>
                        <th class="tm_semi_bold tm_white_color">Price</th>
                        <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                        <th class="tm_semi_bold tm_white_color tm_text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody id="quotationItems">
                        <?php foreach ($admin2Data as $index => $item) { ?>
                            <tr>
                                <td class="tm_text_center"><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($item['item']); ?></td>
                                <td class="tm_text_right"><?php echo htmlspecialchars($item['price']); ?></td>
                                <td class="tm_text_center"><?php echo htmlspecialchars($item['qty']); ?></td>
                                <td class="tm_text_right"><?php echo htmlspecialchars($item['total']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer">
               
              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Subtoal</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">₹<?php echo htmlspecialchars($adminData['subtotal']); ?></td>
                    </tr>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">Profit <span class="tm_ternary_color"></span></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right">₹<?php echo htmlspecialchars($adminData['profit']); ?></td>
                    </tr>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">Loss<span class="tm_ternary_color"></span></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right">₹<?php echo htmlspecialchars($adminData['loss']); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
          <div class="tm_note tm_text_center tm_font_style_normal">
            <hr class="tm_mb15">
            <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <p class="tm_m0">All claims relating to quantity or shipping errors shall be waived by Buyer unless made in writing to <br>Seller within thirty (30) days after delivery of goods to the address stated.</p>
          </div>
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>

        <a href="display.php" class="tm_invoice_btn tm_color1">
            <span class="tm_btn_icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <path d="M328 112L184 256l144 144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                </svg>
             </span>

          <span class="tm_btn_text">Back</span>
        </a>
      </div>
    </div>
  </div>
  <script src="assets1/js/jquery.min.js"></script>
  <script src="assets1/js/jspdf.min.js"></script>
  <script src="assets1/js/html2canvas.min.js"></script>
  <script src="assets1/js/main.js"></script>
</body>
</html>
<?php
session_start();
include("../db.php");

error_reporting(0);
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
  $order_id = $_GET['order_id'];

  /*this is delet query*/
  mysqli_query($con, "delete from orders where order_id='$order_id'") or die("delete query is incorrect...");
}

///pagination
$page = $_GET['page'];

if ($page == "" || $page == "1") {
  $page1 = 0;
} else {
  $page1 = ($page * 10) - 10;
}

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Orders / Page <?php echo $page; ?> </h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table table-hover tablesorter " id="">
              <thead class=" text-primary">
                <tr>
                  <th>Customer Name</th>
                  <th>Products</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Amount</th>
                  <!--<th>Shipping</th>
                  <th>Time</th>*-->
                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($con, "select first_name, product_title,  mobile, address1, address2, product_price, qty from orders, orders_info, products,user_info where orders.product_id=products.product_id and user_info.user_id=orders_info.user_id Limit $page1,10") or die("query 1 incorrect.....");

                while (list($cus_name, $pro_title, $contact_no, $address,  $quantity) = mysqli_fetch_array($result)) {
                  echo "<tr><td>$cus_name</td><td>$pro_title</td><td>$contact_no</td><td>$address<br></td><td>$quantity</td>


                  <td>
                  <a class=' btn btn-danger' href='orders.php?order_id=$order_id&action=confirm'>Confirm</a>
                  </td></
                        </tr>";
                }

                ?>
              </tbody>
            </table>

            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
include "footer.php";
?>
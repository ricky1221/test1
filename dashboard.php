<?php
include('conn.php');
include('navigations.php');

if (!isset($_SESSION["username"])) {
    header("location:index.php");
}

$username = $_SESSION["username"];
$sql = "SELECT buss_designation FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$assigned_bus = $row['buss_designation'];

$query = "SELECT d_id FROM bus_data WHERE busnumber = '$assigned_bus'";
$resulta = mysqli_query($conn, $query); // Fix: Use $query instead of $sql
$rowa = mysqli_fetch_assoc($resulta); // Fix: Use $rowa to store the second query's result

$darayber = $rowa['d_id'];
// if (isset($_GET['insertedIds'])) {
//     $insertedIdsString = $_GET['insertedIds'];
//     $insertedIds = explode(',', $insertedIdsString);

//     // Use the inserted primary keys as needed
//     foreach ($insertedIds as $id) {
//         // Do something with the primary key value
//         echo "Inserted ID: $id<br>";
//     }
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bus Seat Numbers</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    .seat {
        text-align: center;
        margin-bottom: 10px;
        width: 100%;
        transition: background-color 0.3s;
    }

    .seat-container {
    display: flex;
 
}

    .seat-container .col:nth-child(1),
    .seat-container .col:nth-child(2),
    .seat-container .col:nth-child(3) {
        flex: 1;
    }

    .align-row7 .col:nth-child(1),
    .align-row7 .col:nth-child(2) {
        flex: 1;
    }
    
    .align-row7 .col:nth-child(3) {
        flex-grow: 3;
    }

    .raise-btn {
        margin-bottom: 10px;
    }
    .btn-check:checked+.btn-primary {
            background-color: red;
        }
        .btn-check[disabled]+.btn-primary{
            background-color: green;
        }

        
       

</style>
</head>
<body>
<p id="successMessage"></p>

    <div class="container">
        <center><h1 class="mt-5">Bus Seat Numbers</h1></center>
       
        <div class="row">
        <center>
            <div style="margin-left: 1em;" class="col-md-4" id="seatContainer"> 
                <form action="" method="POST">
                <div class="seat-container">
                        <div class="col align-row7">
                            
                        </div>
                        <div class="col align-row7">
                            
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat3" value="3">
                            <label class="btn btn-primary seat" for="seat3">3</label>
                        </div>
                    </div>

                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat1" value="1">
                            <label class="btn btn-primary seat" for="seat1">1</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat2" value="2">
                            <label class="btn btn-primary seat" for="seat2">2</label>
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat6" value="6">
                            <label class="btn btn-primary seat" for="seat6">6</label>
                        </div>
                    </div>
                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat4" value="4">
                            <label class="btn btn-primary seat" for="seat4">4</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat5" value="5">
                            <label class="btn btn-primary seat" for="seat5">5</label>
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <!-- <input type="checkbox" class="btn-check seat" name="seat[]" id="seatex" value="pick_up">
                            <label class="btn btn-primary seat" for="seatex">pick up</label> -->
                        </div>
                    </div>
                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat7" value="7">
                            <label class="btn btn-primary seat" for="seat7">7</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat8" value="8">
                            <label class="btn btn-primary seat" for="seat8">8</label>
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat9" value="9">
                            <label class="btn btn-primary seat" for="seat9">9</label>
                        </div>
                    </div>
                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat10" value="10">
                            <label class="btn btn-primary seat" for="seat10">10</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat11" value="11">
                            <label class="btn btn-primary seat" for="seat11">11</label>
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat12" value="12">
                            <label class="btn btn-primary seat" for="seat12">12</label>
                        </div>
                    </div>
                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat13" value="13">
                            <label class="btn btn-primary seat" for="seat13">13</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat14" value="14">
                            <label class="btn btn-primary seat" for="seat14">14</label>
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat15" value="15">
                            <label class="btn btn-primary seat" for="seat15">15</label>
                        </div>
                    </div>
                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat16" value="16">
                            <label class="btn btn-primary seat" for="seat16">16</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat17" value="17">
                            <label class="btn btn-primary seat" for="seat17">17</label>
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat18" value="18">
                            <label class="btn btn-primary seat" for="seat18">18</label>
                        </div>
                    </div>

                    <div class="seat-container">
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat19" value="19">
                            <label class="btn btn-primary seat" for="seat19">19</label>
                        </div>
                        <div class="col align-row7">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat20" value="20">
                            <label class="btn btn-primary seat" for="seat20">20</label>
                        </div>
                        <div class="col">
                        <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat21" value="21">
                            <label class="btn btn-primary seat" for="seat21">21</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="btn-check seat seat-trigger" name="seat[]" id="seat22" value="22">
                            <label class="btn btn-primary seat" for="seat22">22</label>
                        </div>
                    </div>
           </div></center><br><br>
          <center>
           
        <div class="col-md-4" style="margin-top: 2%; margin-left: 2%;">
        <div style="display: flex; justify-content: space-between;">
        
</button>
<a href="dashboard2.php"><button type="button" class="btn btn-secondary" >Depart</button></a>
<button type="button" class="btn btn-danger" id="resetButton">Arrived</button></div></center>
<div class="col-md-12"></div>
            <!-- Modal --> 
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">BABTSC</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div id="print_content">
            <div class="card mb-3" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-8">
                  <div class="card-body">
                  <div id="print_content">
                    <div class="row">
                      <div class="col-md-">
                        <span id="date"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="time"></span><br>
                        <span>
                          <span>Trip Number</span>
                          <?php
                          $sql = "SELECT MAX(trip_number) AS max_trip_number FROM tiket WHERE bus_id = '$assigned_bus' GROUP BY bus_id";
                          $result = mysqli_query($conn, $sql);
                          $max_trip_number = 1; // Set the default value to 1

                          if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $max_trip_number = $row['max_trip_number'];
                          }
                          ?>
                          <input type="text" style="width: 20px;" name="trip_number" id="trip_number" value="<?php echo $max_trip_number ?>">
                        </span>
                        <span style="float: right">Bus no. <input style="max-width: 20px;" type="text" id="bus_namber" name="bus_namber" value="<?php echo $assigned_bus; ?>"> </span><br>
                        <input style="max-width: 20px;" type="hidden" id="bus_driver" name="bus_driver" value="<?php echo $darayber; ?>"> </span><br>
                       
                        <span>Quantity: <span id="count">0</span> </span>
                        <span style="float: right; margin-right: 20%;">Fare:<span id="totalValue">0</span>
                        </span><br>
                        <span>Ticket no/s:&nbsp;&nbsp;<span id="insertedIds"></span></span><br>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br><center>
          <span><strong>Cash: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 70px;" id="cashInput"></strong></span><br><br>
          <span><strong>Change: <span id="changeValue">0.00</span></strong></span> <br><br>
          <button type="button" class="btn btn-primary" id="saveButton">Print</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         </center>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
    <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">BABTSC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
                <div class="modal-body">
        <div class="col-md-12">
          <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
              <div class="col-md-12">
                <div class="card-body">
                  <div class="row" style="display: flex; justify-content:space-between">
                    <div class="col">
                      <h5>Ticket type</h5>
                      <?php 
                      $sql = "SELECT * FROM route";
                      $result = mysqli_query($conn, $sql);
                      ?>
                      <select name="ticketType" id="ticketType" style="width: 100px">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['fee'] ?>" required><?php echo $row['fee']?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col">
                      <center><h5>Discount</h5>
                      <?php 
                      $sql = "SELECT * FROM discount";
                      $result = mysqli_query($conn, $sql);
                      ?>
                      <select name="discount" id="discount" style="width: 100px">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['disID'] ?>"><?php echo $row['passenger']?></option>
                        <?php } ?>
                      </select>
                      </center>
                    </div>
                    <!-- <div class="col"> -->
                      <center>
                        <!-- <h5>Trip Number</h5> -->
                      <?php
                      $sql = "SELECT MAX(trip_number) AS max_trip_number FROM tiket WHERE bus_id = '$assigned_bus' GROUP BY bus_id";
                      $result = mysqli_query($conn, $sql);
                      $max_trip_number = 1; // Set the default value to 1

                      if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $max_trip_number = $row['max_trip_number'];
                      }
                      ?>
                      <input type="hidden" style="width: 20px;" name="trip_number" id="trip_number" value="<?php echo $max_trip_number ?>">
                      </center>
                    <!-- </div> -->
                    <center><br><br>
                    <button style="margin-left: 5%;" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">
  Enter
</button></center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></form>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.btn-check.seat-trigger');

    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('click', toggleModal);
    });

    // Function to toggle the modal
    function toggleModal() {
      $('#contentModal').modal('toggle');
    }
  });

  document.addEventListener('DOMContentLoaded', () => {
    const resetButton = document.getElementById('resetButton');
    const successMessage = document.getElementById('successMessage');
    const tripNumberInput = document.getElementById('trip_number');
    // Get the count element
    const countElement = document.getElementById('count');

    const saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', () => {
      const selectedCheckboxes = Array.from(checkboxes).filter(
        checkbox => checkbox.checked && !checkbox.disabled
      );

      selectedCheckboxes.forEach(checkbox => {
        if (checkbox.type !== 'radio') {
          checkbox.disabled = true;
          count = 0;
          // countElement.textContent = count;
        }
      });

      // Send the form data to the server using AJAX
      const formData = new FormData();
      selectedCheckboxes.forEach(checkbox => {
        formData.append('selectedSeats[]', checkbox.value);
      });
      formData.append('ticketType', document.getElementById('ticketType').value);
      formData.append('discount', document.getElementById('discount').value);
      formData.append('bus_namber', document.getElementById('bus_namber').value);
      formData.append('bus_driver', document.getElementById('bus_driver').value);

      formData.append('trip_number', tripNumberInput.value);

      function displayInsertedIds() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_data.php');
        xhr.onload = function() {
          if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            const insertedIds = response.insertedIds.join(', ');
            const successMessage = response.message;

            // Display the inserted IDs
            const insertedIdsElement = document.getElementById('insertedIds');
            insertedIdsElement.textContent = insertedIds;

            // Display the success message
            const successMessageElement = document.getElementById('successMessage');
            successMessageElement.textContent = successMessage;
            // Remove the message after 5 seconds
            setTimeout(function() {
              successMessageElement.textContent = '';
              insertedIdsElement.textContent = '';
            }, 5000);
          }
        };
        xhr.send(formData);
      }

      // Call the function initially
      displayInsertedIds();

      // Print the content after a delay
      setTimeout(() => {
        printContent();
      }, 1000);
    });

    function printContent() {
      var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
      disp_setting += "scrollbars=yes,width=1000,height=600,left=25,top=25";
      var content_value = document.getElementById("print_content").innerHTML;

      var printWindow = window.open("", "_blank", disp_setting);
      printWindow.document.open();
      printWindow.document.write('<html><head><title>BABTSC</title>');
      printWindow.document.write('</head><body onLoad="window.print()" style="width: 40%; font-size:12px; font-family:arial;">');
      printWindow.document.write(content_value);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.focus();
      setTimeout(function () {
        printWindow.print();
        printWindow.close();
      }, 750);
    }

    resetButton.addEventListener('click', () => {
      // Increment the trip number
      tripNumberInput.value = parseInt(tripNumberInput.value) + 1;

      // Reset checkboxes, count, and total price
      deselectCheckboxes();

      checkboxes.forEach(checkbox => {
        checkbox.disabled = false;
        checkbox.checked = false;
        count = 0;
      });

      // Reset the success message
      successMessage.style.display = 'none';
    });

    // Get the seat container and checkboxes
    const seatContainer = document.getElementById('seatContainer');
    const checkboxes = seatContainer.querySelectorAll('input[type="checkbox"]');

    // Get the ticket type select element
    const ticketTypeSelect = document.getElementById('ticketType');

    // Get the total price element
    const totalPriceElement = document.getElementById('totalValue');

    // Get the discount select element
    const discountSelect = document.getElementById('discount');

    // Initialize the count and total price
    let count = 0;
    let totalPrice = 0;

    // Add event listeners to checkboxes
    checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', () => {
        // Update the count based on the checkbox state
        if (!checkbox.disabled) {
          if (checkbox.checked) {
            count++;
          } else {
            count--;
          }
        }

        // Update the count display
        countElement.textContent = count;

        // Calculate the total price
        calculateTotalPrice();
      });
    });

    // Add event listener to the ticket type select element
    ticketTypeSelect.addEventListener('change', () => {
      // Calculate the total price
      calculateTotalPrice();
    });

    // Add event listener to the discount select element
    discountSelect.addEventListener('change', () => {
      // Calculate the total price
      calculateTotalPrice();
    });

    // Function to calculate the total price based on the selected checkboxes, ticket type, and discount
    function calculateTotalPrice() {
      // Calculate the total price based on the selected checkboxes and ticket type
      const ticketPrice = parseInt(ticketTypeSelect.value);

      // Check if the discount value is 2
      const discountValue = parseInt(discountSelect.value);
      if (discountValue === 2) {
        // Deduct 20% from the total price
        totalPrice = (count * ticketPrice) * 0.8;
      } else {
        totalPrice = count * ticketPrice;
      }

      // Update the total price display
      totalPriceElement.textContent = totalPrice;
    }

    // Reset the checkboxes and count to the initial state
    function deselectCheckboxes() {
      checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
      });

      // Reset the count value and update the display
      count = 0;
      countElement.textContent = count;

      // Reset the total price
      totalPrice = 0;
      totalPriceElement.textContent = totalPrice;
    }

    function updateDateTime() {
      var dateElement = document.getElementById("date");
      var timeElement = document.getElementById("time");
      var currentDateTime = new Date();

      var currentDate = currentDateTime.toLocaleDateString();
      dateElement.innerText = "Date: " + currentDate;

      var currentTime = currentDateTime.toLocaleTimeString();
      timeElement.innerText = "Time: " + currentTime;
    }

    // Update date and time every second
    setInterval(updateDateTime, 1000);
  });

  const cashInput = document.getElementById('cashInput');
  const totalValueElement = document.getElementById('totalValue');
  const changeValueElement = document.getElementById('changeValue');

  // Reset cash and change values when modal is hidden
  $('#myModal').on('hidden.bs.modal', function () {
    cashInput.value = '';
    changeValueElement.textContent = '0.00';
  });

  cashInput.addEventListener('input', function() {
    const cashValue = parseFloat(cashInput.value);
    const totalValue = parseFloat(totalValueElement.textContent);

    if (!isNaN(cashValue)) {
      const changeValue = cashValue - totalValue;
      // Update the change value on the page
      changeValueElement.textContent = changeValue.toFixed(2);
    } else {
      // Reset the change value if the cash input is not a valid number
      changeValueElement.textContent = '0.00';
    }
  });

  // Get all the checkboxes
  const checkboxes = document.querySelectorAll('.btn-check');

  // Function to check if any checkbox is selected
  function isAnyCheckboxSelected() {
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked && !checkboxes[i].disabled) {
        return true;
      }
    }
    return false;
  }

  // Function to show or hide ticketType and discount sections
  function updateTicketTypeAndDiscountSection() {
    if (isAnyCheckboxSelected()) {
      ticketTypeSection.style.display = 'block';
      discountSection.style.display = 'block';
      // setTimeout(() => {
      //   ticketTypeSection.style.display = 'none';
      //   discountSection.style.display = 'none';
      // }, 10000); // 10 seconds timeout
    } else {
      ticketTypeSection.style.display = 'none';
      discountSection.style.display = 'none';
    }
  }

  // Loop through each checkbox
  checkboxes.forEach(checkbox => {
    // Add change event listener
    checkbox.addEventListener('change', () => {
      if (checkbox.disabled) {
        ticketTypeSection.style.display = 'none';
        discountSection.style.display = 'none';
      } else {
        updateTicketTypeAndDiscountSection();
      }
    });
  });

  // Initial check
  updateTicketTypeAndDiscountSection();

  // Loop through each checkbox
  checkboxes.forEach(checkbox => {
    // Add click event listener
    checkbox.addEventListener('click', () => {
      updateTicketTypeAndDiscountSection();
    });
  });

  // Initial check
  updateTicketTypeAndDiscountSection();
</script>


</body>
</html>

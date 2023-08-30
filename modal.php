<?php
include('conn.php');
include('navigations.php');


// if (!isset($_SESSION["username"])) {
//     header("location:index.php");
// }

$username = $_SESSION["username"];
$sql = "SELECT buss_designation FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$assigned_bus = $row['buss_designation'];

$query = "SELECT d_id FROM bus_data WHERE busnumber = '$assigned_bus'";
$resulta = mysqli_query($conn, $query);
$rowa = mysqli_fetch_assoc($resulta);

$darayber = $rowa['d_id'];

$successMessage = "";


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: white;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 100%;
}

.close {
    color: green;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

/* Button Style */
button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

    </style>
</head>
<body>
    <?php
    $sqr = "SELECT * FROM bus_data";
    $result = $conn->query($sqr);

    if ($result) {
        // $result->free();
        $result = $conn->query($sqr);
    } else {
        echo "Error executing query: " . $conn->error;
    }
    ?>
    
<label for="selectedBusId">Bus No:</label>
<select id="selectedBusId">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <option value="" disabled selected>Select bus...</option>
        <option value="<?php echo $row['bus_id']; ?>">
            <?php echo $row['busnumber']; ?>
        </option>
    <?php } ?>
</select><br><br></br>
<?php
    $sqrl = "SELECT ticket_type, fee FROM route";
    $result = $conn->query($sqrl);

    if ($result) {
        $pipty = 0;
        $trenta = 0;
        $sinko = 0;

        while ($row = $result->fetch_assoc()) {
            $ticketType = $row['ticket_type'];
            $fee = $row['fee'];

            if ($ticketType === 't_type_1') {
                $pipty += $fee;
            } elseif ($ticketType === 't_type_2') {
                $trenta += $fee;
            } elseif ($ticketType === 't_type_3') {
                $sinko += $fee;
            }
        }

        $result->free(); // Free the result set

    } else {
        echo "Error executing query: " . $conn->error;
    }
?>
 <?php
        $sqrl = "SELECT fee FROM route";
        $result = $conn->query($sqrl);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $fee = $row['fee'];
                echo "<button class='openModalButton' data-modal='modal1' data-fee='$fee'>$fee</button><br><br>";


            }
            $result->free(); // Free the result set
        } else {
            echo "Error executing query: " . $conn->error;
        }
    ?>
   
   <!-- <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"> -->
   <div class="modal" id="modal1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">BABTSC</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <label for="selectedBusInputModal1">Bus No:</label>
                        <input style="width: 25px;" type="text" name="selected_bus_id_modal1" id="selectedBusInputModal1" value="" readonly>

                        <label for="feeInputModal1">Fee:</label>
                        <input style="width: 25px;" type="text" name="feeInput" id="feeInputModal1">
                        
                        <!-- Rest of your form content ... -->

                        <div class="seat-container">
                            <div class="col">
                                <div>
                                    <input type="button" name="button_pickup" class="btn btn-primary btn-lg" id="pickupButton" value="PICK UP">
                                    <input type="hidden" name="seatnumber" value="PICK UP">
                                </div>
                            </div>
                        </div>

                        <!-- Other form inputs ... -->
                        <div class="row">
                    <div class="col-md-4">
                        <center>
                            <h5>Discount</h5>
                            <?php
                            $sql = "SELECT * FROM discount";
                            $result = mysqli_query($conn, $sql);
                            ?>
                            <select name="discount" id="discount" style="width: 100px">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $row['disID'] ?>"><?php echo $row['passenger'] ?></option>
                                <?php } ?>
                            </select>
                        </center>
                    </div>

                    <div class="col-md-4">
                        <center>
                            <h5>Trip Number</h5>
                            <?php
                            $sql = "SELECT MAX(trip_number) AS max_trip_number FROM tiket WHERE bus_id = '$assigned_bus' GROUP BY bus_id";
                            $result = mysqli_query($conn, $sql);
                            $max_trip_number = 1; // Set the default value to 1

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $max_trip_number = $row['max_trip_number'];
                            }
                            ?>
                            <input type="text" style="width: 20px;" name="trip_number" id="trip_number" value="<?php echo $max_trip_number ?>" required>
                        </center>
                    </div>
                    <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <span id="date"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span id="time"></span>
                                            <span style="float: right">Bus no. <input style="max-width: 20px;" type="text" id="bus_namber" name="bus_namber" value="<?php echo $assigned_bus;?>"> </span><br>
                                            <input style="max-width: 20px;" type="hidden" id="bus_driver" name="bus_driver" value="<?php echo $darayber;?>"> </span><br>
                                            <span>Quantity: <span id="buttonCounter" class="ms-2">0</span> </span>
                                            <input type="hidden" name="buttonCounter" id="buttonCounterField">
                                            <span style="float: right; margin-right: 20%;">Fare:<span id="totalValue">0</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                 </div>  
            <!-- </div> -->
            </div> <br>
            <!-- <button type="button" class="btn btn-danger" style="float: right;" onclick="deselectCheckboxes()">Cancel</button> -->
            <span><strong>Cash: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width: 70px;" id="cashInput"></strong></span><br><br>
            <span><strong>Change: <span id="changeValue">0.00</span></strong></span> <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save" class="btn btn-primary">Print</button>
                        <a href="dashboard.php" class="btn btn-secondary">Back</a>
                        <button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script>
    var modals = document.querySelectorAll(".modal");
    var openButtons = document.querySelectorAll(".openModalButton");
    var closeButtons = document.querySelectorAll(".close");
    var selectElement = document.getElementById("selectedBusId");

    openButtons.forEach(function (button) {
        button.onclick = function () {
            var modalId = this.getAttribute("data-modal");
            var fee = this.getAttribute("data-fee"); // Get the fee from the button's data-fee attribute
            var modal = document.getElementById(modalId);
            var selectedBusInput = modal.querySelector("#selectedBusInputModal1");
            var feeInput = modal.querySelector("#feeInputModal1");

            selectedBusInput.value = selectElement.value; // Populate the selected bus number
            feeInput.value = fee; // Populate the fee input with the fee value
            modal.style.display = "block";
        };
    });

    // Event handlers for close buttons and outside click
    modals.forEach(function (modal) {
        modal.addEventListener("click", function (event) {
            if (event.target === modal || event.target.closest(".close")) {
                modal.style.display = "none";
            }
        });
    });
    const pickupButton = document.getElementById('pickupButton');
const buttonCounterElement = document.getElementById('buttonCounter');
const ticketTypeSelect = document.getElementById('feeInputModal1');
const saveButton = document.getElementById('saveButton');
const cancelButton = document.getElementById('cancelButton');
const cashInput = document.getElementById('cashInput');
const totalValueElement = document.getElementById('totalValue');
const changeValueElement = document.getElementById('changeValue');
const discountSelect = document.getElementById('discount');

let buttonCounter = localStorage.getItem('buttonCounter') || 0;

buttonCounterElement.textContent = buttonCounter;

pickupButton.addEventListener('click', function() {
  buttonCounter++;
  buttonCounterElement.textContent = buttonCounter;

  // Store the updated button counter value in localStorage
  localStorage.setItem('buttonCounter', buttonCounter);

  // Multiply the ticketType value
  let ticketTypeValue = parseFloat(ticketTypeSelect.value);
  let multipliedValue = ticketTypeValue * buttonCounter;

  // Update the fare value on the page
  totalValueElement.textContent = multipliedValue.toFixed(2);

  // Recalculate the total price
  calculateTotalPrice();
});


saveButton.addEventListener('click', function() {
  document.getElementById('buttonCounterField').value = buttonCounter;

  localStorage.setItem('buttonCounter', buttonCounter);
  buttonCounter = 0;
  buttonCounterElement.textContent = buttonCounter;

  localStorage.setItem('buttonCounter', buttonCounter);
});

ticketTypeSelect.addEventListener('change', function() {
  calculateTotalPrice();
});

discountSelect.addEventListener('change', function() {
  calculateTotalPrice();
});

// Function to calculate the total price based on the selected checkboxes, ticket type, and discount
function calculateTotalPrice() {
  // Get the selected ticketType value and count
  const ticketPrice = parseFloat(ticketTypeSelect.value);
  const selectedCount = parseInt(buttonCounterElement.textContent);

  // Calculate the total price without any discount
  let totalPrice = selectedCount * ticketPrice;

  // Check if the discount value is valid
  const discountValue = parseInt(discountSelect.value);

  if (!isNaN(discountValue) && discountValue === 2) {
    // Deduct 20% from the total price
    totalPrice *= 0.8;
  }

  // Update the total price display
  totalValueElement.textContent = totalPrice.toFixed(2);
}

cancelButton.addEventListener('click', function() {
  buttonCounter = 0;
  buttonCounterElement.textContent = buttonCounter;
  totalValueElement.textContent = "0";
  localStorage.setItem('buttonCounter', buttonCounter);
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

        discountSelect.addEventListener('change', () => {
  calculateTotalPrice();
});

// Function to calculate the total price based on the selected checkboxes, ticket type, and discount
function calculateTotalPrice() {
  // Get the selected ticketType value and count
  const ticketPrice = parseFloat(ticketTypeSelect.value);
  const selectedCount = parseInt(buttonCounterElement.textContent);

  // Calculate the total price without any discount
  let totalPrice = selectedCount * ticketPrice;

  // Check if the discount value is valid
  const discountValue = parseInt(discountSelect.value);

  if (!isNaN(discountValue) && discountValue === 2) {
    // Deduct 20% from the total price
    totalPrice *= 0.8;
  }

  // Update the total price display
  totalValueElement.textContent = totalPrice.toFixed(2);
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

</script>

</body>
</html>

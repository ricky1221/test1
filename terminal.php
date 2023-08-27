<?php
include('conn.php');
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
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
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

    // Check if the query executed successfully
    if ($result) {
        // Free the result set
        $result->free();

        // Reset the result pointer to the beginning for the select options
        $result = $conn->query($sqr);
    } else {
        echo "Error executing query: " . $conn->error;
    }
    ?>

    <select id="selectedBusId">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <option value="<?php echo $row['bus_id']; ?>">
                <?php echo $row['bus_id']; ?>
            </option>
        <?php } ?>
    </select>

    <button class="openModalButton" data-modal="modal1">Ticket for 50</button>
    <button class="openModalButton" data-modal="modal2">Ticket for 40</button>
    <button class="openModalButton" data-modal="modal3">Ticket for 30</button>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <button class="close" data-modal="modal1">&times;</button>
            <form action="" method="post">
                <input type="text" name="selected_bus_id_modal1" id="selectedBusInputModal1" value="" readonly>
                <!-- Rest of your form content ... -->
            </form>
        </div>
    </div>

    <div id="modal2" class="modal">
        <div class="modal-content">
            <button class="close" data-modal="modal2">&times;</button>
            <form action="" method="post">
                <input type="text" name="selected_bus_id_modal2" id="selectedBusInputModal2" value="" readonly>
                <!-- Rest of your form content ... -->
            </form>
        </div>
    </div>

    <div id="modal3" class="modal">
        <div class="modal-content">
            <button class="close" data-modal="modal3">&times;</button>
            <form action="" method="post">
                <input type="text" name="selected_bus_id_modal3" id="selectedBusInputModal3" value="" readonly>
                <!-- Rest of your form content ... -->
            </form>
        </div>
    </div>

    <script>
    // Get all modal elements
    var modals = document.querySelectorAll(".modal");

    // Get all buttons that open modals
    var openButtons = document.querySelectorAll(".openModalButton");

    // Loop through each button and add click event listeners
    openButtons.forEach(function (button) {
        button.onclick = function () {
            var modalId = this.getAttribute("data-modal");
            var modal = document.getElementById(modalId);
            modal.style.display = "block";
        };
    });

    // When the user clicks anywhere outside of a modal, close it
    window.onclick = function (event) {
        modals.forEach(function (modal) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    };

    // Get the select element
    var selectElement = document.getElementById("selectedBusId");

    // Update the input field with the selected value
    selectElement.addEventListener("change", function () {
        // Get the selected value
        var selectedValue = selectElement.value;

        // Determine which modal is currently open
        var activeModal = document.querySelector(".modal[style*='display: block']");

        // Set the value of the corresponding input field based on the active modal
        if (activeModal) {
            var inputElement = activeModal.querySelector("input[type='text']");
            if (inputElement) {
                inputElement.value = selectedValue;
            }
        }
    });
</script>

</body>
</html>

<?php
include("connect.php");

$creditcardTypeFilter = isset($_GET['creditCardType']) ? $_GET['creditCardType'] : '';
$aircraftTypeFilter = isset($_GET['aircraftType']) ? $_GET['aircraftType'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';

$flightLogQuery = "SELECT * FROM flightlogs";

if ($creditcardTypeFilter != '' || $aircraftTypeFilter != '') {
  $flightLogQuery = $flightLogQuery . " WHERE";

  if ($creditcardTypeFilter != '') {
    $flightLogQuery = $flightLogQuery . " creditCardType='$creditcardTypeFilter'";
  }

  if ($creditcardTypeFilter != '' && $aircraftTypeFilter != '') {
    $flightLogQuery = $flightLogQuery . " AND";
  }

  if ($aircraftTypeFilter != '') {
    $flightLogQuery = $flightLogQuery . " aircraftType='$aircraftTypeFilter'";
  }
}

if ($sort != '') {
  $flightLogQuery = $flightLogQuery . " ORDER BY $sort";

  if ($order != '') {
    $flightLogQuery = $flightLogQuery . " $order";
  }
}

$flightLogQueryResults = executeQuery($flightLogQuery);

$creditCardTypeQuery = "SELECT DISTINCT(creditCardType) FROM flightlogs";
$creditcardTypeResults = executeQuery($creditCardTypeQuery);

$aircraftTypeQuery = "SELECT DISTINCT(aircraftType) FROM flightlogs";
$aircraftTypeResults = executeQuery($aircraftTypeQuery);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PUP Airport Flight Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="images/icon.png">
  <style>
    body {
      background: linear-gradient(135deg, #074769, #191a30);
      color: #00abf0;
      background-size: cover;
      background-attachment: fixed;
    }

    h1.display-6, h5.card-title {
      color: #00abf0;
      font-weight: bold;
    }

    label, select, th, td {
      color: #00abf0;
    }

    .card {
      background-color: #191a30;
      border: 1px solid #074769;
    }

    .btn-primary {
      background-color: #074769;
      border-color: #074769;
    }

    .btn-primary:hover {
      background-color: #00abf0;
      border-color: #00abf0;
    }
  </style>
</head>

<body>
  <div class="container my-5">
    <div class="text-center mb-5">
      <h1 class="display-6" >PUP Airport Flight Logs</h1>
    </div>

    <div class="card p-4 shadow-sm mb-4 rounded-5">
      <h5 class="card-title text-center">Filter Options</h5>
      <form>
        <div class="row gy-3 align-items-center">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="creditcardTypSelect" class="form-label pt-4">Credit Card Type</label>
            <select id="creditcardTypSelect" name="creditCardType" class="form-select text-center">
              <option value="">Any</option>
              <?php
              if (mysqli_num_rows($creditcardTypeResults) > 0) {
                while ($creditcardTypeRow = mysqli_fetch_assoc($creditcardTypeResults)) {
                  ?>
                  <option <?php if ($creditcardTypeFilter == $creditcardTypeRow['creditCardType'])
                    echo "selected"; ?>
                    value="<?php echo $creditcardTypeRow['creditCardType']; ?>">
                    <?php echo $creditcardTypeRow['creditCardType']; ?>
                  </option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 pt-4">
            <label for="airCraftSelect" class="form-label">Aircraft Type</label>
            <select id="airCraftSelect" name="aircraftType" class="form-select text-center">
              <option value="">Any</option>
              <?php
              if (mysqli_num_rows($aircraftTypeResults) > 0) {
                while ($airCraftRow = mysqli_fetch_assoc($aircraftTypeResults)) {
                  ?>
                  <option <?php if ($aircraftTypeFilter == $airCraftRow['aircraftType'])
                    echo "selected"; ?>
                    value="<?php echo $airCraftRow['aircraftType']; ?>">
                    <?php echo $airCraftRow['aircraftType']; ?>
                  </option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 pt-4">
            <label for="sort" class="form-label">Sort By</label>
            <select id="sort" name="sort" class="form-select text-center">
              <option value="">None</option>
              <option <?php if ($sort == "flightNumber") echo "selected"; ?> value="flightNumber">Flight Number</option>
              <option <?php if ($sort == "airlineName") echo "selected"; ?> value="airlineName">Airline Name</option>
              <option <?php if ($sort == "aircraftType") echo "selected"; ?> value="aircraftType">Aircraft Type</option>
              <option <?php if ($sort == "flightDurationMinutes") echo "selected"; ?> value="flightDurationMinutes">Flight Duration</option>
              <option <?php if ($sort == "pilotName") echo "selected"; ?> value="pilotName">Pilot Name</option>
              <option <?php if ($sort == "creditCardType") echo "selected"; ?> value="creditCardType">Credit Card Type</option>
              <option <?php if ($sort == "ticketPrice") echo "selected"; ?> value="ticketPrice">Ticket Price</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 pt-4">
            <label for="order" class="form-label">Order</label>
            <select id="order" name="order" class="form-select text-center">
              <option <?php if ($order == "ASC") echo "selected"; ?> value="ASC">Ascending</option>
              <option <?php if ($order == "DESC") echo "selected"; ?> value="DESC">Descending</option>
            </select>
          </div>
        </div>
        <div class="col text-center">
            <button type="submit" class="btn btn-primary mt-md-4">Apply</button>
        </div>
      </form>
    </div>

    <div class="card shadow-sm pt-3">
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th class="columnName py-4">Flight Number</th>
              <th class="columnName py-4">Airline Name</th>
              <th class="columnName py-4">Aircraft Type</th>
              <th class="columnName py-4">Flight Duration</th>
              <th class="columnName py-4">Pilot Name</th>
              <th class="columnName py-4">Credit Card Type</th>
              <th class="columnName py-4">Ticket Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($flightLogQueryResults) > 0) {
              while ($flightLogRow = mysqli_fetch_assoc($flightLogQueryResults)) {
                ?>
                <tr>
                  <td><?php echo $flightLogRow['flightNumber']; ?></td>
                  <td><?php echo $flightLogRow['airlineName']; ?></td>
                  <td><?php echo $flightLogRow['aircraftType']; ?></td>
                  <td><?php echo $flightLogRow['flightDurationMinutes'] . " minutes"; ?></td>
                  <td><?php echo $flightLogRow['pilotName']; ?></td>
                  <td><?php echo $flightLogRow['creditCardType']; ?></td>
                  <td><?php echo $flightLogRow['ticketPrice']; ?></td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
  </script>
</body>

</html>
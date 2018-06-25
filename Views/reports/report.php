<?php
require_once '../../Models/user.php';
session_start();
if (!isset($_SESSION['current_user'])) {
    header('location: ../../index.php');
} else {
    $currentUser = $_SESSION['current_user'];
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!--Bootsrtap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    </head>
    <body>
        <!--   //////  Require Default Header  ///////  -->
        <?php require_once '../header.php'; ?>
        <article class="container">
            <br/>
            <h3 class="mainH1">Dear Employees, Welcome to booka Report Section.
                Please fill the needed information, to help us help you.</h3>
            <div class="successCont">
                <?php
                if (isset($_POST['sendBTN'])) {
                    //////// unnecessary validation via PHP filter just to excercise.. JS validation at this case is surely enough.
                    if ($_POST['reporter_age'] != "") {
                        $filters = array("reporter_age" => array(
                                "filter" => FILTER_VALIDATE_INT,
                                "options" => array(
                                    "min_range" => 18,
                                    "max_range" => 90
                                )
                            )
                        );
                        foreach ((filter_input_array(INPUT_POST, $filters)) AS $key) {
                            if ($key > 0) {
                                $needZero = 0;
                            } else {
                                $needZero = "1";
                            };
                        }
                    } else {
                        $needZero = 0;
                    };
                    if ($needZero === 0) {
                        ////////// If it happens Here we will put the Submit in our DB / send email if needed.
                        echo '<h5 class="success">Sent!</h5>';
                    } else {
                        ///////// In case didn't use JS, it would send this if age is wrong.......
                        echo '<h5 class="failure">Didn'."'".'t sent! Age is wrong.</h5>';
                    };
                };
                ?>
            </div>
            <div class="row">
                <form id="report-form" class="control-panelCont col-12" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Fill In The next Fields:</h2>
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input required="required" name="reporter_name"  type="text" class="form-control" id="name" placeholder="Your Full Name" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="city">Choose Branch:</label>
                        <select id="city" name="reporter_city" class="selectpicker form-control" data-live-search="true">
                            <option selected="true" disabled="disabled">Choose Branch..</option>
                            <?php
                            ///////// Place Cities In Branch Options....
                            $citiesXML = simplexml_load_file('https://data.gov.il/dataset/3fc54b81-25b3-4ac7-87db-248c3e1602de/resource/a68209f0-8b97-47b1-a242-690fba685c48/download/yeshuvim20180401.xml');
                            foreach ($citiesXML AS $row) {
                                $city = str_replace(')', '(', $row->שם_ישוב);
                                echo "<option dir='rtl'>" . htmlspecialchars($city) . "</option>";
                            }
                            ?>
                        </select>
                        <span id="report-city-select"><strong>Please Choose City!</strong></span>
                    </div>
                    <div class="form-group">
                        <label for="report-reason">What Happened?</label>
                        <textarea maxlength="1000" required="required" name="report_reason" class="form-control" id="report-reason" placeholder="Tell us" value=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" name="reporter_age" class="form-control" id="age" placeholder="18-90" value=""/>
                        <span id="report-age-select"><strong>Age Most to be between 18 and 90.</strong></span>
                    </div>
                    <button id="reportBTN" type="submit" name="sendBTN" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </article>
    </body>
    <script>
        var myReportBTN = document.getElementById('reportBTN');
        var citySelect = document.getElementById('city');
        var cityErr = document.getElementById('report-city-select');
        var ageInput = document.getElementById('age');
        var ageErr = document.getElementById('report-age-select');
        myReportBTN.addEventListener("click", function (e) {
            if (citySelect.value === "Choose Branch..") {
                e.preventDefault();
                cityErr.style.display = "block";
            }
            if (ageInput.value.length > 0 && ageInput.value < 18 || ageInput.value > 90) {
                e.preventDefault();
                ageErr.style.display = "block";
            };
        });
        citySelect.addEventListener("click", function () {
            cityErr.style.display = "none";
        });
        ageInput.addEventListener("click", function () {
            ageErr.style.display = "none";
        });
    </script>
</html>

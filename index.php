<html>
    <body>

        <?php
            $ageList = $_POST["ageListField"];  //Modifying this variable modifys the corresponding hidden input
            //read form if it is not empty and has valid age
            if($_POST["fname"] != '' && $_POST["lname"] != '') {
                $count = $_POST["count"];
                if($_POST["age"] > 0 && $_POST["age"] < 120) {
                    if($_POST["age"] >= 14) {
                        //record report
                        $count++;

                        //configure the age list for averages
                        if(empty($ageList)){
                            $ageList = array($_POST["age"]);
                        }else{
                            $ageList = explode(",", $ageList);
                            array_push($ageList,$_POST["age"]);
                        }
                    }else{
                        $ageList = explode(",", $ageList);
                    }
                }else{
                    $ageList = explode(",", $ageList);
                }

            }
        ?>

        <form action="index.php" method="post">
            <!-- Hidden input values used to keep track for live values -->
            <input type="hidden" name="ageListField" value="<?php echo (empty($ageList)) ? "" : implode(",", $ageList); ?>">
            <input type="hidden" name="count" value="<?php echo (empty($ageList)) ? "0" : count($ageList); ?>">
            <input type="hidden" name="langList" value="<?php echo (empty($langList)) ? "" : implode(",", $langList); ?>">

            <!-- Shown input values-->
            First Name: <input type="text" name="fname"><br>
            Last Name:  <input type="text" name="lname"><br>
            Age:&emsp;&emsp;&emsp;<input type="number" name="age"><br>
            Languages:  <textarea name="langs"></textarea><br>
            <input type="submit">
        </form>

        <?php
            if($_POST["fname"] != '' && $_POST["lname"] != '') {
                $average = 0;
                $minor = 0;
                $senior = 0;
                foreach($ageList as $a){
                    $average += intval($a);
                    if(intval($a) >= 65)
                        $senior++;
                    else if(intval($a) < 18)
                        $minor++;
                }
                $average = round($average/$count,2);

                if($_POST["age"] > 0 && $_POST["age"] < 120) {
                    if($_POST["age"] < 14) {
                        echo 'ERR: INVALID AGE, You\'re a minor';
                    }else{
                        echo 'Number of participants: ' . $count;
                        echo '<br>';
                        echo 'Average age of participants: ' . $average;
                        echo '<br>';
                        echo 'Number of participants under 18: '.$minor;
                        echo '<br>';
                        echo 'Number of participants over 65: '.$senior;
                        echo '<br>';}
                }else{
                    echo 'ERR: INVALID AGE, Enter a value between 0 and 120 exclusive';
                }



            }
        ?>
    </body>
</html>


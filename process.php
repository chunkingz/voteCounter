<?php require_once('conn.php'); ?>
<?php

            if(isset($_POST["save"])){
                $errors = array();
                $state = trim($_POST["state"]);
                $apc = trim($_POST["apc"]);
                $pdp = trim($_POST["pdp"]);                                        
                $id = '';

                $find = $pdo->query("select * from votes where state = '$state'");  
                $find->execute();       
                $rowCount = $find->fetch();

                
                // validating the recieved form input

                (empty($state) || empty($apc) || empty($pdp) ) ? array_push($errors,"All Fields are required") : "";
                ($rowCount > 0) ?  array_push($errors,"The state you entered already exist") : "";

                $no_of_errors = count($errors);

                // checking if errors exists or not
                if($no_of_errors > 0 ){
                    // displaying errors found
                    echo '<div class="alert alert-danger">';
                            for($x=0;$x<$no_of_errors;$x++){
                                echo '<li>'.$errors[$x].'</li>';
                            }
                    echo '</div>';
                } else {
                                            
                $insert_user = $pdo->prepare("Insert into votes (state, apc, pdp) Values('$state', '$apc', '$pdp')");       
                $insert_user->execute();
				
                header('Location:index.php');			
            
        }
    }
?>
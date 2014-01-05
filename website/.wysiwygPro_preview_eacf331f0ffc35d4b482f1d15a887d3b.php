<?php
if ($_GET['randomId'] != "ckKxbpc6XNmMDCX3cEQIXaW8fPRYcXmqS5XOIiKgmLdA3AISmJTIQUNNbsl4BtNJ") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  

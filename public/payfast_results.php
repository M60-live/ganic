<?php
// Notify PayFast that information has been received
header( 'HTTP/1.0 200 OK' );
flush();

// Posted variables from ITN
$pfData = $_POST;

$myfile = fopen("postedData.txt", "w+");
fwrite($myfile, "****************** Start\n");
fwrite($myfile, "--- ".$pfData['payment_status']."\n");
fwrite($myfile, "--- ".$pfData['m_payment_id']."\n");
fwrite($myfile, "--- ".$pfData['pf_payment_id']."\n");
fwrite($myfile, "--- ".$pfData['item_name']."\n");
fwrite($myfile, "--- ".$pfData['amount_gross']."\n");
fwrite($myfile, "--- ".$pfData['amount_fee']."\n");
fwrite($myfile, "--- ".$pfData['amount_net']."\n\n");
fwrite($myfile, "--- Details:\n".json_encode($pfData));

$user_id = $pfData['m_payment_id'];
$payment_id = $pfData['pf_payment_id'];

$SQL = 'UPDATE cart SET dt_successful=now(), pf_payment_id="'.$payment_id.'", status_id=1 WHERE user_id='.$user_id.' AND dt_successful IS NULL AND dt_checkout IS NOT NULL';
fwrite($myfile, "\nSQL:".$SQL."\n");

//**** update db
switch( $pfData['payment_status'] )
{
    case 'COMPLETE':
        // If complete, update your application, email the buyer and process the transaction as paid
        // ****- connect to DB -****
        $conn = mysqli_connect('localhost','ganicrootsco_root','G@nicroots-123','ganicrootsco_ganics');
        if($conn)
        {
            mysqli_query($conn,$SQL);
            fwrite($myfile, "--- DB updated :)!\n");
        }
        else
        {
            fwrite($myfile, "--- Failed to connect to DB");
        }
        break;
    case 'FAILED':
        // There was an error, update your application
        break;
    default:
        // If unknown status, do nothing (safest course of action)
        break;
}

fwrite($myfile, "------------------------------ end --------------------------\n\n");
?>
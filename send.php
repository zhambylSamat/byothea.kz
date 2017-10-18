<?php
    if (isset($_POST['submit'])){
        $to = "zhambyl.9670@gmail.com, info@byothea.kz, aiym.usserbayeva@gmail.com";
        $subject = "Request from byothea.kz";
        $message = "
        <html>
        <head>
        <title>Request</title>
        </head>
        <body>
        <table>
        <tr>
        <th>Phone</th>
        </tr>
        <tr>
        <td>".$_POST['phone']."</td>
        </tr>
        </table>
        </body>
        </html>";
        $headers = "MIME-Version: 1.0" . "\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\n";

        // More headers
        $headers .= 'From: <byothea.kz>' . "\n";
        $headers .= 'Cc: from byothea.kz' . "\n";

        mail($to,$subject,$message,$headers);
        header("Location:index.php?result=success");
    }
    else{
        header("Location:index.php?result=fail");
    }
?>
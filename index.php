<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>SWA SNS</title>
    </head>
    <body>
          <form name="message" method="POST" action="">
           <label>Message:</label>
           <br>
           <textarea name="message" cols="40"></textarea>
           <br>
           <input type="submit" name="send" value="Send">
         </form>
        <?php
          if(isset($_POST['message'])){
           if (trim($_POST['message']) !=='' )
            {
              include 'send.php';
            }
             else {echo "<p><b><font color=red>Empty message! Enter message!</font></b>";}             
          }
        ?>
    </body>
</html>

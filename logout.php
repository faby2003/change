<?php
   session_start();
   session_unset();
   if(session_destroy()) {
        header("Location: home.html");
        echo '<script language="javascript">';
        echo 'alert("Logout successful")';
        echo '</script>';

   }
?>
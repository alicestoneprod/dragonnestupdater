<?php
session_start();
echo $_SESSION['AccountID'];
session_destroy();
echo "<script>window.location.href='index.html'</script>";
?>
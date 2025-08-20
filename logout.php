<?php
session_start();
session_destroy();
echo "<script>
                    alert('You are no longer signed in!');
                    window.location.href = 'index2.php';
                </script>";
//header("Location: login.php");
?>
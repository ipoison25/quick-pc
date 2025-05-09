<?php
session_start();
session_unset();
session_destroy();

// Optional: redirect to login or home
header("Location: /quick-pc1/");
exit;

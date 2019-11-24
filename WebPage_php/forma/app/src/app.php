<?php
if(isset($_POST['submit'])){
$vardas = trim($_POST['vardas']);
$pavarde = trim($_POST['pavarde']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

if(!empty($vardas) && !empty($pavarde) && !empty($email) && !empty($message)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $from = "$email";
        $to = "redas.kardauskas@mediq.com";
        $subject = "Nauja žinutė";
        $autorius = 'Nuo: ' . $vardas . ', ' . $email;
        $zinute = htmlspecialchars($message);
        mail($to, $subject, $autorius, $zinute, $from);
        echo "<script>alert('Dėkojame. Jūsų žinutė gauta. Netrukus susisieksime.');</script>";
    }
}
    include('db.php');
}

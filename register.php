<?php 
    require_once "inc/header.php";
    require_once "app/classes/User.php";

    if($user->is_logged()){
        header("Location: index.php");
        exit();
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

         // Dodajte filter_var za dodatnu validaciju
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Sva polja moraju biti popunjena";
        header("Location: register.php");
        exit();
    }

    // Validacija e-mail adrese
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Nevažeća e-mail adresa";
        header("Location: register.php");
        exit();
    }

    $user->beginTransaction();

    try {
        // Izvrši sve operacije unutar transakcije
        $created = $user->create($name, $username, $email, $password);

        if ($created) {
            // Uspješno završi transakciju
            $user->commit();

            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['text'] = "Uspešno ste se registrovali";
            header("Location: index.php");
            exit();
        } else {
            // Poništi transakciju u slučaju neuspjeha
            $user->rollBack();

            $_SESSION['message']['type'] = "danger";
            $_SESSION['message']['text'] = "Greška";
            header("Location: register.php");
            exit();
        }
    } catch (Exception $e) {
        // Uhvati iznimku i poništi transakciju u slučaju greške
        $user->rollBack();

        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Greška: " . $e->getMessage();
        header("Location: register.php");
        exit();
    }
}

        
    
?>

        <h1 class="mt-5 mb-3"> Registracija </h1>
        <form method="post" action="">
            <div class="form-group mb-3">
                <label for="name"> Ime </label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-3">
                <label for="uesrname"> Korisnicko ime</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mb-3">
                <label for="email"> Email </label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password"> Lozinka </label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary"> Registruj se</button>
        </form>
   
<?php require_once 'inc/footer.php';  ?>
<?php
session_start(); 

$host = 'localhost';
$db = 'quiz_app';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['register_submit'])) {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: index-page.html");
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $email, $passwordHash]);

    header("Location: quiz-page.html");
    exit();
}

if (isset($_POST['login_submit'])) {
    $login_user = $_POST['login_email'] ?? '';
    $login_password = $_POST['login_password'] ?? '';

    if (empty($login_user) || empty($login_password)) {
        $_SESSION['error'] = "Email and Password are required.";
        header("Location: index-page.html");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$login_user]);
    $user = $stmt->fetch();

    if ($user && password_verify($login_password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = htmlspecialchars($user['firstname']);
        header("Location: quiz-page.html");
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: index-page.html");
        exit();
    }
}
?>

<?php
include __DIR__ . '/../Models/user_model.php';

class AuthController
{
    private UserModel $userModel;

    public function __construct(PDO $conn)
    {
        $this->userModel = new UserModel($conn);
    }

    public function loginForm()
    {
       include __DIR__ . '/../Views/auth/login.php';
    }

    public function index()
{
    $this->loginForm();
}


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $_SESSION['error'] = 'Vui lòng nhập email và mật khẩu';
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }

        $user = $this->userModel->login($email, $password);

        if ($user) { //truyen bien session 
            $_SESSION['user'] = [
                'id'   => $user['user_id'],
                'name' => $user['name'],
                'role' => $user['role'],
                'email'=> $user['email'],
                'phone'=> $user['phone'],
                'address'=> $user['address'],
            ];

            // phân quyền // điều hướng cho admin và user không có trang khác vào đc admin khi biết url
            if ($user['role'] == 1) {
                header('Location: index.php'); //=> buộc đăng nhập & quyền admin mới vào đc trang admin
            } else {
                header('Location: index.php?controller=product&action=index');
            }
            exit;
        }

        $_SESSION['error'] = 'Sai email hoặc mật khẩu';
        header('Location: index.php?controller=auth&action=loginForm');
        exit;
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }

        // Prefer fresh data from DB to ensure email/phone/address are available
        $sessionUser = $_SESSION['user'];
        $user = $this->userModel->findById((int) $sessionUser['id']);

        if (!$user) {
            // If user not found (deleted), log out
            session_destroy();
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }

        include __DIR__ . '/../Views/client/profile.php';
    }
}

<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() {
      # Periksa apakah pengguna sudah login, jika ya, arahkan ke halaman kategori
        if (isset($_SESSION['user'])) {
            header("Location: " . url('admin/category'));
            exit;
        }

        # Periksa apakah form login telah disubmit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = $this->userModel->verifyLogin($username, $password);

            # Jika login berhasil, simpan data pengguna ke session dan arahkan ke halaman kategori
            if ($user) {
              # Simpan data pengguna ke session
                $_SESSION['user'] = [
                    'id'           => $user['id'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap']
                ];
                # Set flash message untuk menyambut pengguna
                set_flash('success', 'Selamat datang, ' . $user['nama_lengkap']);
                header("Location: " . url('admin/category'));
                exit;
            } else {
                set_flash('danger', 'Username atau password salah!');
                header("Location: " . url('admin/auth/login'));
                exit;
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
      # Hapus data pengguna dari session dan arahkan ke halaman login
        unset($_SESSION['user']);
        session_destroy();
        session_start();
        set_flash('success', 'Anda telah berhasil logout.');
        header("Location: " . url('admin/auth/login'));
        exit;
    }
}
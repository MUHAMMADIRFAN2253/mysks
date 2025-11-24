<?php

class Auth extends Controller
{
    private $ADMIN_ID = 'admin123'; 
    private $PUBLIC_PASSWORD_HASH = '$2y$10$9PcwSoQOvX7uAhexQJXDpuPfhaQXL0Q70bnMc0arBubc0KWkepYj2';
    private $SECRET_PASSWORD_HASH = '$2y$10$eLUA4zkixD64yERECMl.l.h4t/GkEdnfAnYfILIVIwJjIb1ot/ZAq';
    private $ADMIN_NAME = 'Administrator Sistem';

    public function index()
    {
        $data['judul'] = 'Login My SKS';

        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer');
    }

    public function login()
    {
        $id = $_POST['nim'];
        $password = $_POST['password'];

        $userModel = $this->model('User_model');
        $user = false;

        if ($id === $this->ADMIN_ID) {
            if (password_verify($password, $this->PUBLIC_PASSWORD_HASH)) {
                $user = [
                    'nip' => $this->ADMIN_ID,
                    'nama' => $this->ADMIN_NAME,
                    'role' => 'admin',
                ];
            }
        }

        if (!$user) {
            $user = $userModel->getUserByNIM($id);
        }

        if (!$user) {
            $user = $userModel->getUserByNIP($id);
        }

        if ($user) {
            $is_password_valid = true;
            if ($user['role'] !== 'admin') {
                $is_password_valid = password_verify($password, $user['password']);
            }

            if ($is_password_valid) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_id'] = $id;
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];

                header('Location: ' . BASEURL . '/Akademik/index');
                exit;
            }
        }

        $_SESSION['login_error'] = 'NIP / NIM atau Password salah.';
        header('Location: ' . BASEURL . '/Auth');
        exit;
    }

    public function verifyAdminPassword()
    {
        if (!isset($_POST['password'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Password tidak dikirim.']);
            exit;
        }
        
        $password_input = $_POST['password'];

        if (password_verify($password_input, $this->SECRET_PASSWORD_HASH)) { 
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Password Verifikasi salah.']);
        }
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/Auth');
        exit;
    }
}

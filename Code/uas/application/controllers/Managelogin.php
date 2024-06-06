<?php

class Managelogin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loadcaptcha');
        
    }
    public function index()
    {
        //jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user 
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email',
            [
                'required' => 'Email Harus diisi!!',
                'valid_email' => 'Email Tidak Benar!!'
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Password Harus diisi'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Form Login';
            $data['user'] = '';
            $code['captcha'] = $this->loadcaptcha->generate();
            //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header 
            $this->load->view('management/auto_header', $data);
            $this->load->view('management/login', $code);
            $this->load->view('management/auto_footer');
        } else {
            $this->_login();
        }
    }

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', ['required' => 'Nama Belum diis!!']);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', ['valid_email' => 'Email Tidak Benar!!', 'required' => 'Email Belum diisi!!', 'is_unique' => 'Email Sudah Terdaftar!']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password Tidak Sama!!', 'min_length' => 'Password Terlalu Pendek']);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Registrasi Member';
            $code['captcha'] = $this->loadcaptcha->generate();
            $this->load->view('management/auto_header', $data);
            $this->load->view('management/registrasi', $code);
            $this->load->view('management/auto_footer');
        } else {
            $email = $this->input->post('email', true);
            $inputcaptcha = $this->input->post('code', true);
            $sesscaptcha = $this->session->userdata('sess_captcha');
            $data = ['nama' => htmlspecialchars($this->input->post('nama', true)), 'email' => htmlspecialchars($email), 'image' => 'default.jpg', 'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), 'role_id' => 2, 'is_active' => 0, 'tanggal_input' => time()];
            //cek captcha
            if ($inputcaptcha == $sesscaptcha) {
                $this->ModelUser->simpanData($data);
                //menggunakan model 
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
                redirect('managelogin');
            } else {
                //captcha tidak sesuai
                $this->session->set_flashdata('validate_captcha', '<div class="alert alert-danger alert-message" role="alert">Captcha Tidak Sesuai!</div>');
                redirect('managelogin/registrasi');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda telah logout!!</div>');
        redirect('management');
    }


    public function blok()
    {
        $this->load->view('management/blok');
    }

    public function gagal()
    {
        $this->load->view('management/gagal');
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cekData(['email' => $email])->row_array();
        $inputcaptcha = $this->input->post('code', true);
        $sesscaptcha = $this->session->userdata('sess_captcha');
        //jika usernya ada 
        if ($user) {
            //jika user sudah aktif 
            if ($user['is_active'] == 1) {
                //cek password 
                if ($password == $user['password']) {
                    //cek captcha
                    if ($inputcaptcha == $sesscaptcha) {
                        $data = ['email' => $user['email'], 'role_id' => $user['role_id']];
                        $this->session->set_userdata($data);
                        if ($user['role_id'] == 3) {
                            redirect('management');
                        } else {
                            if ($user['image'] == 'default.jpg') {
                                $this->session->set_flashdata(
                                    'pesan',
                                    '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda</div>'
                                );
                            }
                            redirect('management');
                        }
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Captcha Tidak Sesuai!</div>');
                        redirect('managelogin');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Tidak Sesuai!</div>');
                    redirect('managelogin');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
                redirect('managelogin');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
            redirect('managelogin');
        }
    }
}

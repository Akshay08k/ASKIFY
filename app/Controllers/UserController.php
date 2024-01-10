<?php
/*
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    public function __construct()  {
       helper(['form','url','session']);
       $this->users = new User();
       $this->session = session();
    }
    public function index(){
        return view('register');
    }
    public function create(){
        $inputs = $this->validate([
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]']);
            if(!$inputs){
                return view('register',['validation => $this->validator']);
                $this->user->save([
                    'name' => $this->request->getvar('name'),
                    'email' => $this->request->getvar('email'),
                    'password' => password_hash($this->request->getvar(PASSWORD_DEFAULT))
                ]);
            }
                session()->setFlashdata('sucesss');
                return redirect()->to(site_url('/register'));
               }
    
    public function login(){  
         $inputs->$this->validate([
        'email'    => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
        'password' => 'required|min_length[6]|max_length[200]']);
        if(!$inputs){
            return view('login',['validation => $this->validator']);
            $this->user->save([
                'name' => $this->request->getvar('name'),
                'email' => $this->request->getvar('email'),
                'password' => $this->request->getvar('password')
            ]);
            $user=$this->user->where('email',$email)->first();
            if($user){
                $pass=$user['password'];
                $authPassword=password_verify($password,$pass);
                if($authPassword){
                    $sesstionData = [
                        'id'=> $user['id'],
                    'name'=> $user['name'],
                    'email'=> $user['email'],
                    'loggedin' => 'true'
                    ];
           $this->session()->set($sesstionData);
           return redirect()->to('dashboard');
                }
                session()->setFlashdata('failed','Incorrenct Password!!');
                return redirect()->to(site_url('/login'));
            }
            
            session()->setFlashdata('failed','Incorrenct Email!!');
            return redirect()->to(site_url('/login'));
        }

    }
    public function loginwa(){
        return view('login');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function logout(){
        $sesstion = session()->$sesstion->destroy();
        return redirect()->to(site_url('/withoutlogin'));


    }
}
    */
    namespace App\Controllers;

    use App\Controllers\BaseController;
    use App\Models\User;
    use CodeIgniter\Controller;
    use Config\Services;  // Add this use statement
    
    class UserController extends BaseController
    {
        public function index()
        {
            return view("/register");
        }
    
        public function register()
        {
            $model = new User();
            $password = $this->generateRandomPassword();
            $data = [
                'name' => $this->request->getPost('name'),  // Changed getpost to getPost
                'email' => $this->request->getPost('email'),  // Changed getpost to getPost
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            $model->insert($data);
            $this->sendPasswordEmail($data['email'], $password);
            return redirect()->to('/register')->with('success', 'Account Created Successfully. Check Your Email For Login Details');
        }
    
        private function generateRandomPassword()
        {
            $length = 8;
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstvuwyz1234567890@#$&*()';
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $password;
        }
    
        private function sendPasswordEmail($emailAddress, $password)
        {
            
            $email = Services::email();  // Corrected the namespace
            $email->setTo($emailAddress);
            $email->setSubject('Your Password For login');
            $email->setMessage("Here is your password: $password");
        if(!$email->send()){
            echo "nhi hau";
        }else{
            echo "done";
        }
        }
          
        }
    
   
   
    

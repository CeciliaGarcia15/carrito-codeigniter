<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User;


class Usuarios extends Controller{

    public function login()
    {   $mensaje = session('mensaje');
        $message = session('message');
        return view('back/usuarios/login',["mensaje"=>$mensaje,"message"=>$message]);
    }

    public function login2()
    {
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $usuario = new User();
        $datosUsuario = $usuario->where('email',$email)->first();
        /* var_dump($datosUsuario['perfil_id']);
        die(); */
        if(count($datosUsuario) > 0 && password_verify($pass,$datosUsuario['pass'] )){ 
            if($datosUsuario['perfil_id'] == 2){
                $datos = [
                    "email" =>$datosUsuario['email'],
                    "admin" =>$datosUsuario['usuario'],
                ];
            }else{
                $datos = [
                    "email" =>$datosUsuario['email'],
                    "usuario" =>$datosUsuario['usuario']
                ];
            }
            

            //creo la sesion
            $session = session();
            //guardamos dentro de la session el array de datos
            $session->set($datos);
            //redireccionamos
            return redirect()->to(base_url('/'))->with('mensaje','Bienvenido');
        }else{
            return redirect()->to(base_url('/login'))->with('mensaje','El email ingresado no se encuentra.');
        }
    }
    public function logout() {
        // Cerrar la sesión del usuario
        $session = session();
        if ($session->has('usuario')) {
            $session->remove('usuario');
        }
        
        if ($session->has('email')) {
            $session->remove('email');
        }
        
        if ($session->has('admin')) {
            $session->remove('admin');
        }
        return redirect()->to('/login')->with('message', 'Cierre de sesión exitoso');
    }
    public function register()
    {
        return view('back/usuarios/register');
    }

    public function index()
    {
        //este Users es el del modelo
        $user = New User();
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['users'] = $user->orderBy('id','ASC')->findAll();
        return view('back/usuarios/index',$datos);
    }

    public function store()
    {
        // Obtener los datos enviados desde el formulario
       $nombre = $this->request->getPost('nombre');
       $apellido = $this->request->getPost('apellido');
       $email = $this->request->getPost('email');
       $password = $this->request->getPost('password');
       $user = $this->request->getPost('user');

       // Crear un nuevo usuario en el modelo
       $userModel = new User();
       $userModel->save([
           'nombre' => $nombre,
           'apellido' => $apellido,
           'email' => $email,
           'usuario' => $user,
           'pass' => password_hash($password, PASSWORD_DEFAULT),
           'baja' => 'NO'
        ]);

       // Redirigir al usuario a la página de inicio de sesión
       return redirect()->to('/login')->with('message', 'Registro exitoso. Por favor, inicia sesión.');
        /* $user = New User();
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['users'] = $user->orderBy('id','ASC')->findAll();
        return view('principal',$datos); */
    }

}
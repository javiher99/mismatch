<?php
class Func{
    //comprobar si esta logeado o no
    public static function checkLogin($dbh){
        if(!isset($_SESSION[`user_id`])){
            session_start();
        }

        if(isset($_COOKIE['user_id']) && isset($_COOKIE['token']) && !isset($_SESSION['user_id'])){
            // Hacemos un checking, creando 3 variables
            // Preparamos una sentencia de la tabla sesiones con la base de datos
            // Preguntar que nos devuelve el resulset
            
            /*
            $user_id = $_COOKIE['user_id'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $stmt = PDO::prepare("SELECT * FROM sessions WHERE session_userId = :userid and session_token = :token and session_serial = :serial");
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':userId'=>$userId, ':token'=>$token, 'serial'=>$serial));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row['session_userid'] > 0) {

                func::createSession($_COOKIE['user_id'],$_COOKIE['token'], $_COOKIE['serial']);
                return true;

            } 
        } else {
            if (isset($_SESSION['user_id'] )){
                $user_id = $_SESSION['user_id'];
                $token = $_SESSION['token'];
                $serial = $_SESSION['serial'];

                $stmt = PDO::prepare("SELECT * FROM sessions WHERE session_userId = :userid and session_token = :token and session_serial = :serial");
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(':userId'=>$userId, ':token'=>$token, 'serial'=>$serial));

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row['session_userid'] == $_SESSION['user_id'] && $row['session_token'] == $_SESSION['token'] && $row['session_serial'] == $_SESSION['serial']){
                    
                }
            }
            
        }
        */    
        
            
            if( $row['session_userId'] > 0 ){
                // Al entrara aqui recogemos la persistencia de un logeo anterior
                if (
                    $row['session_userid'] == $_COOKIE['user_id'] &&
                    $row['session_token'] == $_COOKIE['token'] &&
                    $row['session_serial'] == $_COOKIE['serial']
                ) {
                // Si tenemos una sesion persistente anterior, logeamos y luego cambiamos el token
                    if ( 
                        // Match the session variable
                        $row['session_userid'] == $_COOKIE['user_id'] &&
                        $row['session_token'] == $_COOKIE['token'] &&
                        $row['session_serial'] == $_COOKIE['serial']
                    ) {
                        return true;
                    } else {
                        // Hacemos la sesion persistente
                        func::createSession($_COOKIE['user_id'],$_COOKIE['username'],$_COOKIE['token'],$_COOKIE['serial']);
                        return true;
                    }
                }else {
                    return false;
                }

            } else {
                return false;
            }

        return true;
        }
        
    }

    public static function createCookie ($user_id, $user_username, $token, $serial){

        setCookie('user_id', $user_id, time() + (3600 + 24 *7), "/");
        setCookie('user_username', $user_username, time() + (3600 + 24 *7), "/");
        setCookie('token', $token, time() + (3600 + 24 *7), "/");
        setCookie('serial', $serial, time() + (3600 + 24 *7), "/");

    }

    public static function deleteCookie () {

        setCookie('user_id', '', time() - 3600, "/");
        setCookie('user_username', '', time() - 3600, "/");
        setCookie('token', '', time() - 3600, "/");
        setCookie('serial', '', time() - 3600, "/");
        
    }

    public static function recordSession($dbh, $user_id, $user_username, $remember){
        // Establece la session
        // 1. Se borra la sesion anterior que hay generada con la funcion createSerial

        $dbh->prepare("DELETE FROM session WHERE session_userid = :session_userid")->execute(array(':session_userid'=>$user_id));

        $token = func::createSerial(32);
        $serial = func::createSerial(32);

        // Crea la sesion y ademas la hace persistente
        if ($remember == 1){
            func::createCookie($user_id, $username, $token, $serial);
        }

        func::createSession($user_id, $user_username, $token, $serial);
        // Restaura la sesion en la BD con los nuevos datos
        $stmt = $dbh->preapre("INSERT INTO sessions '('session_id', 'session_token', 'session_serial', 'session_date', 'session_userid') VALUES (NULL, :token, :serial, now(), :session_userid=>$user_id)");
        $stmt->execute(array(':token'=>$token, 'serial'=>$serial, ':session_userid'=>$user_id));
    }

    public static function createSession($user_id, $token, $serial, $username){

        // Si la sesion no esta creada
        if  (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['user_id'] = $user_id;
        $_SESSION['token'] = $token;
        $_SESSION['serial'] = $serial;
        $_SESSION['username'] = $username;
    }

    public static function makePersistent($con, $user_id, $username){
        // Hay que borrar la tubla de la sesion antigua
        // Generamos un nuevo token y nuevo serial
        // Creamos la cookies de sesion q hacen la conexion persistente
        // Creamos nueva tupla con los datos de sesion

    }

    //devolver una cadena de caracteres
    public static function createSerial($long){
        $phrase = "En un lugar de la Mancha de cuyo nombre no quiero acordarme";

        $sinespacios = str_replace(' ', '', $phrase);
        $max = strlen($sinespacios);
        $string = "";
        for($i = 0; $i < $long; $i++){
            $string .=$sinespacios[rand(0, $max-1)]; 
        }

        return $string;
    }
}


    // public static function createSerialMode($long){
    //     $phrase = "lo que sea";
    //     $string = ''; $serial = '';
    //     // mt_srand_(time());
    //     // return substr(str_shirffle($phase),0.32);
    //     for($i = 0; $i < $long; $i++){
    //         $string .=$sinespacios[rand(0, $max-1)]; 
    //     }

    //     return $string;
    // }
?>
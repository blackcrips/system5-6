<?php

class  Controller extends Model
{
    public function checkCredentials()
    {
        if(!isset($_POST['username'])){
            header("LOCATION: ../index.php");
            exit();
        }

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if(!$this->validLogin($username,$password)){
            echo "<script>alert('Invalid username or password')</script>";
            echo "<script>window.location.href = '../index.php'</script>";
            exit();
        } else {
            if(!isset($_POST['remember'])){
                $this->loginDocumentation();
                $this->createSession($username);
                header("LOCATION: ../homePage.php");
                exit();
            }else {
                $this->loginDocumentation();
                $this->createCookie($username);
                $this->createSession($username);
                header("LOCATION: ../homePage.php");
                exit();
            }
        }
    }

    private function loginDocumentation()
    {
        $systemDetect = $_SERVER['HTTP_USER_AGENT'];
        $userDevice = '';

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$systemDetect)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($systemDetect,0,4))){
            $userDevice = 'Mobile';
            $ipAddress = $this->getIpAddress();
            $location = $this->getLocation($ipAddress);
            return $this->insertLoginAction($userDevice,$ipAddress,$location);
        } else {
            $userDevice = 'Desktop';
            $ipAddress = $this->getIpAddress();
            $location = $this->getLocation($ipAddress);
            return $this->insertLoginAction($userDevice,$ipAddress,$location);
        }

    }

    private function getIpAddress()
    {
        $ipAddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipAddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipAddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipAddress = 'UNKNOWN';
            return $ipAddress;
    }

    public function getLocation($ipAddress)
    {
        $settings = [
            "apiKey" => 'efaa63c29d0645349e3ae1127107842f',
            'ip' => $ipAddress,
            'lang' => 'en',
            "fields" => '*',

        ];

        $url = "https://api.ipgeolocation.io/ipgeo?";

        foreach ($settings as $k => $v) {$url .= urlencode($k) . "=" . urlencode($v) . "&";}
        $url = substr($url, 0, -1);


        // CURL INIT
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // CURL FETCH
        $result = curl_exec($ch);
        if(curl_errno($ch)){
            echo curl_error($ch);
        } else {
            $result = json_decode($result, 1);
            return $this->createStringAddress($result);
        }

        curl_close($ch);
    }

    private function createStringAddress($result)
    {   
        if($result['message']){
            return 'private';
        } else {
            $createAddress = $result['district'] . ' ' . $result['city'] . " ". $result['state_prov'] . " ". $result['continent_name'] . " " . $result['country_name'] . " " . $result['zipcode'];
            
            return $createAddress;
        }
    }

    private function createSession($email)
    {
        if(!isset($_SESSION)){
            session_start();
        }

        $privilege = $this->getPrivilege($email);
        $_SESSION['login-details'] = 
            [
              'user-email' => $email,
              'privilege' => $privilege['privilege']
            ];

        return $_SESSION['login-details'];
    }

    private function createCookie($username)
    {
        setcookie('email',$username, time() + (604800 * 30), "/");
    }

    public function redirectUser()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_COOKIE['email']) && !isset($_SESSION['login-details'])){
            return;
        } elseif(isset($_SESSION['login-details'])) {
            header("LOCATION: homePage.php");
            exit();
        } elseif(isset($_COOKIE['email'])) {
            if($_COOKIE['email'] == ''){
                header("REFRESH: 0");
                exit();
            } else {
                $this->createSession($_COOKIE['email']);
                header("LOCATION: homePage.php");
                exit();
            }
        }

    }

    public function redirectForeignUser()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    
        if(!isset($_SESSION['login-details'])){
            header("LOCATION: index.php");
            exit();
        }
    }

    public function logout()
    {
        if(!isset($_POST['logout'])){
            header("LOCATION: ../index.php");
        }

        if(!isset($_SESSION)){
            session_start();
        }

        unset($_SESSION['login-details']);
        session_destroy();
        unset($_COOKIE['email']);
        setcookie('email', '', time() - 3600, '/');
        header("LOCATION: ../index.php");
        exit();

    }
}
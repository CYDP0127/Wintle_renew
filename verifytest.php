<?phpclass GoogleRecaptcha {    /* Google recaptcha API url */    private $google_url = "https://www.google.com/recaptcha/api/siteverify";    private $secret = '6LcZwyATAAAAAFzPeCoBRL-ptF9gnGs-tP5-Bdik';    public function VerifyCaptcha($response)    {        $url = $this->google_url."?secret=".$this->secret."&response=".$response;        $curl = curl_init();        curl_setopt($curl, CURLOPT_URL, $url);        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);        curl_setopt($curl, CURLOPT_TIMEOUT, 15);        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);         $curlData = curl_exec($curl);        curl_close($curl);                $res = json_decode($curlData, TRUE);        if($res['success'] == 'true')             return TRUE;        else            return FALSE;    }}$message = 'Google reCaptcha';if($_SERVER["REQUEST_METHOD"] == "POST"){    $response = $_POST['g-recaptcha-response'];        if(!empty($response))    {          $cap = new GoogleRecaptcha();          $verified = $cap->VerifyCaptcha($response);                    if($verified) {            $message = "Captcha Success!";          } else {            $message = "Please reenter captcha";          }    }    echo $message;}echo "end";?><!DOCTYPE HTML><html><head><title>Google new reCaptcha</title><meta charset="UTF-8" /><link type='text/css' rel='stylesheet' href='../../Downloads/google-recaptcha/css/reset.css' /><link type='text/css' rel='stylesheet' href='../../Downloads/google-recaptcha/css/structure.css' /><script src="https://www.google.com/recaptcha/api.js"></script></head><body><form class="box login" method="post" action=""><fieldset class="boxBody">  <label id="msg"><?php echo $message; ?></label>  <label>Username</label>  <input type="text" tabindex="1" name="username" value="demo" required>  <label>  <a href="#" class="rLink" tabindex="5">Forget your password?</a>Password  </label>  <input type="password" name="password" tabindex="2" value="demo" required></fieldset><div class="g-recaptcha" data-sitekey="6LcZwyATAAAAACFru_oAaZX_UCjGySRbcPFiN9Ye"></div><footer>  <input type="submit" class="btnLogin" value="Login" tabindex="4"></footer></form><footer id="main"></footer></body></html>
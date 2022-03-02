<?php
error_reporting(0);
$api = json_decode(file_get_contents("http://ip-api.com/json"),1);
$zone = $api["timezone"];
if($zone){
date_default_timezone_set($zone);}

$master = ["iewil","bitcoinfaucetx","1.0","5"];//master,title,versi,short
$n = "\n";$n2 = "\n\n";$t = "\t";$r="\r                              \r";
$line=col(str_repeat('═',56),'u').$n;

$disable="
\tScript mati karena web ".col('update / scam!','m')."
\tSupport Channel saya dengan cara
\tSubscribe ".col('https://www.youtube.com/c/iewil','k')."
\tkarena subscribe itu gratis :D
\tUntuk mendapatkan info Script terbaru
\tJoin grub via telegram ~> ".col('https://t.me/Iewil_G','b')."
\tðŸ‡®ðŸ‡© ".col('Family-Team-Function-INDO','h')."

";

// ShortLink & Password1
$script = file_get_contents('https://pastebin.com/raw/RZxwy6dr');
$status = trim(explode('#',explode('#'.trim($master[1]).':',$script)[1])[0]);
$short = json_decode(file_get_contents('https://pastebin.com/raw/EiKBhp8U'),1);
$link = file_get_contents($short[$master[3]]['url']);
$pass = trim(explode(' ',explode('Password: ',$link)[1])[0]);
if($status == "on"){
}elseif($status == "off" or $status == null){bn();
echo col(" The script is disabled","rr").$n2;
echo Slow($disable).$n;
exit;}


//Bot
bn();
cookie:
$cookie=Save('Cookie');
$user_agent=Save('User_Agent');
$wallet = Save('Wallet_Faucetpay');
bn();

$ua[]="user-agent: ".$user_agent;
$ua[]="cookie: ".$cookie;

$info=info();

Ket('Username',$info[0]);
Ket('Balance',$info[1]);
Ket('Energy',$info[2]);
echo $line;
menu:
echo col("1","p").col(" ≽ ","m").col("Faucet ","b").$n;
echo col("2","p").col(" ≽ ","m").col("Ptc","b").$n;
echo col("3","p").col(" ≽ ","m").col("Withdraw","b").$n;
echo col("4","p").col(" ≽ ","m").col("Update Cookie ","b").$n;
$pil=readline(col("Input Number","h").col(" ≽ ","m"));
cetak("#","line");
if($pil==1){goto faucet;
}elseif($pil==2){goto ptc;
}elseif($pil==3){goto wd;
}elseif($pil==4){unlink('Cookie');goto cookie;
}else{echo col("Bad number you selected!","m").$n;echo $line;goto menu;}

faucet:
while(true){
	$r1=Run('https://bitcoinfaucetx.com/faucet',$ua);
	$sec=sec($r1);
	$cf=$sec[0];
	$fw=$sec[1];
	if($cf||$fw==1){
		goto faucet;
		}
	$left=explode('/',explode('<p class="lh-1 mb-1 font-weight-bold">',$r1)[3])[0];
	if($left=='0'){
		echo col('you reach max claim! come back tomorrow','m').$n.$line;
		goto menu;
		}
		$leftt=$left-1;
		$tmr=explode(';',explode('var wait=',$r1)[1])[0];//2328-1;
		if($tmr){
			tmr($tmr);goto faucet;
			}
		
		echo col('bypasss','k');
		$bot=explode('" rel=\"',$r1);
		$bot1=explode('\"',$bot[1])[0];
		$bot2=explode('\"',$bot[2])[0];
		$bot3=explode('\"',$bot[3])[0];
		
		$csrf=explode('">',explode('_token_name" id="token" value="',$r1)[1])[0];//8626444245754dde619ea5f114ffa25b
		$token=explode('">',explode('name="token" value="',$r1)[1])[0];
		
		$data="antibotlinks=+".$bot2."+".$bot3."+".$bot1."&csrf_token_name=".$csrf."&token=".$token."&captcha=recaptchav2&g-recaptcha-response=";
		$r2=Run('https://bitcoinfaucetx.com/faucet/verify',$ua,$data);
		
		if(preg_match('/Good job/',$r2)){
			echo $r;
			$ss=explode("'",explode("Swal.fire('Good job!', '",$r2)[1])[0];
			ket('Success',$ss);
			Ket('C left',$leftt-1);
			Ket('Balance',info()[1]);
			echo $line;
			}else{
				$wr= explode('</div>',explode('<div class="alert text-center alert-danger"><i class="fas fa-exclamation-circle"></i> ',$r2)[1])[0];//Invalid Claim
				echo $r;
				echo col($wr,'m');
				sleep(2);
				echo $r;
				}
	}
ptc:
while(true){
	$r1=Run('https://bitcoinfaucetx.com/ptc',$ua);
	$sec=sec($r1);
	$cf=$sec[0];
	$fw=$sec[1];
	if($cf||$fw==1){
		goto ptc;
		}
	$id=explode("'",explode('ptc/view/',$r1)[1])[0];
	if($id){
		$r2=Run('https://bitcoinfaucetx.com/ptc/view/'.$id,$ua);
		$tmr=explode(';',explode('var timer = ',$r2)[1])[0];//15;
		if($tmr){
			tmr($tmr);
			}
		$csrf=explode('">',explode('_token_name" value="',$r2)[1])[0];//8626444245754dde619ea5f114ffa25b
		$token=explode('">',explode('name="token" value="',$r2)[1])[0];
		
		$data= "captcha=recaptchav2&g-recaptcha-response=&csrf_token_name=".$csrf."&token=".$token;
		$r3=Run('https://bitcoinfaucetx.com/ptc/verify/'.$id,$ua,$data);
		if(preg_match('/Good job/',$r3)){
			$ss=explode("'",explode("Swal.fire('Good job!', '",$r3)[1])[0];
			ket('Success',$ss);
			Ket('Balance',info()[1]);
			echo $line;
			}else{
				echo col("invalid claim",'m');
				sleep(5);
				echo $r;
			}
		}else{
			echo col('ptc has finished','m').$n.$line;
			goto menu;
			}
	}
wd:
$bal = str_replace('tokens','',info()[1]);
$r = Run("https://bitcoinfaucetx.com/dashboard",$ua);
$csrf = explode('"',explode('<input type="hidden" name="csrf_token_name" value="',$r)[1])[0];
$wall = str_replace('@','%40',$wallet);
$data = 'csrf_token_name='.$csrf.'&method=2&amount='.$bal.'&wallet='.$wall;
$r = Run('https://bitcoinfaucetx.com/dashboard/withdraw',$ua,$data);
if(preg_match('/Good job/',$r)){
	$ss=explode("'",explode("'Good job!', '",$r)[1])[0];
	ket('Success',$ss);
	}else{
		echo col("invalid claim",'m');
		sleep(5);
	}
echo $line;
goto menu;

function info(){global $ua;
	$url=Run("https://bitcoinfaucetx.com/dashboard",$ua);
	$user=explode('</h5>',explode('<h5 class="font-size-15 text-truncate">',$url)[1])[0];
	$arr=explode('<h4 class="mb-0">',$url);
	$bal=explode('</h4>',$arr[1])[0];
	$en=explode('</h4>',$arr[2])[0];
	return array($user,$bal,$en);}

//curl
function Run($url, $httpheader = 0, $post = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	//curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
	//curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
	if($post){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if($httpheader){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	}
	if($proxy){
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		//curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$response = curl_exec($ch);
	$httpcode = curl_getinfo($ch);
	if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
		$header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($header, $body)[1];
	}
}
/** Standard function **/
function c(){system('clear');}
function col($str,$color){
	if($color==5){$color=['h','k','b','u','m'][array_rand(['h','k','b','u','m'])];}
	$war=array('rw'=>"\033[107m\033[1;31m",'rt'=>"\033[106m\033[1;31m",'ht'=>"\033[0;30m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'rr'=>"\033[101m\033[1;37m",'rg'=>"\033[102m\033[1;34m",'ry'=>"\033[103m\033[1;30m",'rp1'=>"\033[104m\033[1;37m",'rp2'=>"\033[105m\033[1;37m");return $war[$color].$str."\033[0m";}
function Save($namadata){
	if(file_exists($namadata)){$datauser=file_get_contents($namadata);}else{$datauser=readline(col("Input ".$namadata,"rp1").col(' ≽','m')."\n");file_put_contents($namadata,$datauser);}
	return $datauser;}
function ket($msg1,$msg2){
	$var=9;
	$a=strlen($msg1);
	$b=$var-$a;
	$c=str_repeat(' ',4);
	if($msg1=="Error"){
		echo $c.col($msg1,'m').str_repeat(' ',$b).col(" ~> ",'p').col($msg2,'m');
	}else{
		echo $c.col($msg1,'k').str_repeat(' ',$b).col(" ~> ",'h').col($msg2,'p')."\n";
	}
}
function Slow($msg){$slow = str_split($msg);
	foreach( $slow as $slowmo ){ echo $slowmo; usleep(70000);}}
function tmr($tmr){$timr=time()+$tmr;while(true):
	echo "\r                       \r";$res=$timr-time(); 
	if($res < 1){break;}
	echo col(date('H:i:s',$res),5);sleep(1);endwhile;}
function cetak($msg, $tipe){
	$u="\033[1;35m";$h="\033[1;32m";$p="\033[1;37m";$m="\033[1;31m";$k="\033[1;33m";$b="\033[1;34m";$c="\033[1;36m";$len = 56;$var = $u.'═';
	if(strpos($msg, "|") == ""){$title = ((($len-strlen($msg))/2)-1);
		if($tipe=="line"){echo str_repeat($var,$len)."\n";
			}elseif($tipe=="title"){echo $var.str_repeat(" ", $title).$h.strtoupper($msg).str_repeat(" ", $title).$var."\n".str_repeat($var,$len)."\n";
				}elseif($tipe=="warn"){echo str_repeat($var,$len)."\n".$var.str_repeat(" ", $title).$p.strtoupper($msg).str_repeat(" ", $title).$var."\n";}}
	if(strpos($msg, "|") != ""){$msg1 = explode("|",$msg)[0];$msg2 = explode("|",$msg)[1];$gar= 10-strlen($msg1);$isi1 = strlen($msg1.str_repeat(" ",$gar)." ~> ".$msg2);$isi2 =($len-$isi1)-3;
		if ($tipe=="isi"){echo $var." ".$k.$msg1,str_repeat(" ",$gar).$p." ~> ".$k.$msg2.str_repeat(" ",$isi2).$var."\n";
			}else if($tipe=="request"){echo $var." ".$c.$msg1.str_repeat(" ",$gar).$p." ~> ".$c.$msg2.str_repeat(" ",$isi2).$var."\n";
				}else if($tipe=="date"){echo $var." ".$b."Date"."      ".$c." ~> ".$p.date('d/m/Y').str_repeat(" ",4).$var." ".$b."Scipt"."\t".$c." ~> ".$h."Online".str_repeat(" ",5).$var."\n";echo $var." ".$b."Time"."      ".$c." ~> ".$p.date('H:i:s').str_repeat(" ",6).$var." ".$b."Versi"."\t".$c." ~> ".$p.$msg1.str_repeat(" ",8).$var."\n";}}}
/** CF & FW **/
function sec($res){
	$r = "/r                   /r";
	if(preg_match('/Cloudflare/',$res)){
		echo col('Cloudflare detect','m');
		sleep(10);echo $r;
		$a=1;
		}
	if(preg_match('/Firewall/',$res)){
		echo col('Firewall detect','m');
		sleep(10);echo $r;
		$b=1;
		}
	return array($a,$b);}
$sec=sec($r1);
$cf=$sec[0];
$fw=$sec[1];
if($cf||$fw==1){
	//cek ulang
	}
/** Banner **/
function bn(){c();global $master;
	cetak("#","line");
	cetak($master[1], "title");
	cetak($master[2]."|", "date");
	cetak("#","line");
	cetak("Author|iewil", "isi");
	cetak("Youtube|https://www.youtube.com/c/iewil", "isi");
	cetak("Support|all-team-function", "isi");
	cetak("SCRIPT GRATIS - RESIKO DI TANGGUNG USER ", "warn");
	cetak("#","line");
	echo "\n\n";}

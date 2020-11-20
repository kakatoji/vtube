<?php


/**
*Thanks to my friends
*script version buchin
*by kakatoji
*need error code
*done all 
**/

function strip(){
  echo "===============================================\n";}
function saveas($data,$data_post){
 if(!file_exists($data)){file_put_contents($data,"[]"); }
 $json=json_decode(file_get_contents($data),1);
$arr=array_merge($json,$data_post);
file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));}
function rata($parse,$rate){
$runs= strlen($parse);
if($runs < $rate ){ 
$guns= $rate-$runs; 
$parse= $parse.str_repeat(" ",$guns);}
elseif( $runs > $rate ){ 
$parse = substr($parse,0,$rate);}
 return $parse;}
function kakatoji(){
  $red="\e[1;31m";$ijo="\e[1;32m";$cx="\e[0m";$kuning="\e[1;33m";$pur="\e[1;35m";$cyn="\e[1;36m";$w="\e[1;37m";
  $ban="
{$red}██╗░░░██╗████████╗██╗░░░██╗██████╗░███████╗
██║░░░██║╚══██╔══╝██║░░░██║██╔══██╗██╔════╝
╚██╗░██╔╝░░░██║░░░██║░░░██║██████╦╝█████╗░░
{$cyn}░╚████╔╝░░░░██║░░░██║░░░██║██╔══██╗██╔══╝░░
░░╚██╔╝░░░░░██║░░░╚██████╔╝██████╦╝███████╗
░░░╚═╝░░░░░░╚═╝░░░░╚═════╝░╚═════╝░╚══════╝\n";
echo $ban;
echo $pur."kakatoji{$cx}\n";}
function crl($set_baner){system("clear");

echo $set_baner."\n";}
////////////////////////////////////
$versi="1.1"; $config="config.json";

class Vtube{
  
  public function __construct(){
    $this->server="https://app.v-tube.biz";
    $this->cfg="config.json";
    $this->versi="2.0.8";
    $this->config=[
      "user-agent"=>"Dart/2.8(dart:io)",
      "content-type"=>"application/json;charset=utf-8"];
    $this->api=[
      "image"=> "/api/getGraphAuthCode",
      "todayvideo"=>"/api/todayVideoCount",
      "getcat"=>"/api/getCategories", 
      "record"=>"/api/getAuthRecord",
      "level"=>"/api/transferToExchangeLevel",
      "week"=>"/api/getMyWeekTotal",
      "meter"=>"/api/getUserMatter",
      "userinfo"=>"/api/getUserInfo",
      "absen"=>"/api/registration",
      "watch"=>"/api/completeAWatch"
      ];
      $this->akun=["userid"=>"","token"=>""];}
  private function curl($url,$data_post){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->head() );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1   );
    curl_setopt($ch, CURLOPT_TIMEOUT,30          );
    curl_setopt($ch, CURLOPT_VERBOSE, 0          );
    if(strlen($data_post) > 0 ){ // POST METHOD
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS,    $data_post ); }
    if(strlen($proxy)   > 0 ){ // settings proxy
    curl_setopt($ch, CURLOPT_PROXY,         $proxy   ); }
    $result = curl_exec($ch);
    $info   = curl_getinfo($ch);
    curl_close($ch);
    if($info["http_code"]==302){
    return $info["redirect_url"];}else{return $result;} 
 }
  
  private function head(){
    foreach($this->config as $head=>$main){
      $ma[]=$head.":".$main;
      return $ma;}
  }
  
  public function saveas($data_post){
    $data=$this->cfg;
    if(!file_get_contents($data)){file_put_contents($data,"[]");}
    $json=json_decode(file_get_contents($data),1);
    $arr=array_merge($json,$data_post);
    file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));}
  private function stamp(){return time().rand(100,999);}
  public function nologin($nologin){
 $url  = $this->server.$this->api[$nologin];
 $data_post = [
  "virtualDeviceId" => $this->akun["device"],
  "timestamp"       => $this->stamp(),
  "version"         => $this->versi ];
 $json = json_encode($data_post);  
 return json_decode($this->curl($url,$json),1);}
  public function login($no,$pass,$auth){
    $url=$this->server."/api/login";
    $data_post=[
      "mobile"=>$no,
      "password"=>md5($pass),
      "authCode"=>$auth,
      "virtualDeviceId"=>$this->akun["device"],
      "timstamp"=>$this->stamp(),
      "version"=>$this->versi];
      $run=json_encode($data_post);
      return json_decode($this->curl($url,$run),1);}
public function request($nologin){
 $url  = $this->server.$this->api[$nologin];
 $data_post = [
  "userId"          => $this->akun["userid"],
  "sessionToken"    => $this->akun["token"],
  "virtualDeviceId" => $this->akun["device"],
  "timestamp"       => $this->stamp(),
  "version"         => $this->versi ];
 $json = json_encode($data_post);  
 return json_decode($this->curl($url,$json),1);}
 public function users($nologin){
 $url  = $this->server.$this->api[$nologin];
 $data_post = [
  "targetId"        => $this->akun["userid"],
  "userId"          => $this->akun["userid"],
  "sessionToken"    => $this->akun["token"],
  "virtualDeviceId" => $this->akun["device"],
  "timestamp"       => $this->stamp(),
  "version"         => $this->versi ];
 $json = json_encode($data_post);  
 return json_decode($this->curl($url,$json),1);}
  public function systemtask(){
    $url=$this->server."/api/getSystemTasks";
    $data_post=[
      "userid"=>$this->akun["userid"],
      "sessionToken"=>$this->akun["token"],
      "virtualDeviceId"=>$this->akun["device"],
      "timestamp"=>$this->stamp(),
      "version"=>$this->versi];
      $data=json_encode($data_post);
      return json_decode($this->curl($url,$data),1);}
  public function mytask(){
   $url  = $this->server."/api/getMyTasks";
   $data_post = [  
  "type"=> "1",
  "page"=> "1",
  "size"=> "100",
  "userId"=> $this->akun["userid"],
  "sessionToken"=>$this->akun["token"],
  "virtualDeviceId"=>$this->akun["device"],
  "timestamp"=> $this->stamp(),
  "version"=> $this->versi ]; 
 $json = json_encode($data_post); 
 return json_decode($this->curl($url,$json),1);}
 public function starttask($task_id){
 $url  = $this->server."/api/startTask";
 $data_post = [  
  "taskId"          => $task_id,
  "userId"          => $this->akun["userid"],
  "sessionToken"    => $this->akun["token"],
  "virtualDeviceId" => $this->akun["device"],
  "timestamp"       => $this->stamp(),
  "version"         => $this->versi ];
 $json = json_encode($data_post); 
 return json_decode($this->curl($url,$json),1);}
 public function buytask($task_id,$id_tr){
 $url  = $this->server."/api/buyTask";
 $data_post = [  
  "taskId"          => $task_id,
  "pwd2nd"          => md5($id_tr),
  "userId"          => $this->akun["userid"],
  "sessionToken"    => $this->akun["token"],
  "virtualDeviceId" => $this->akun["device"],
  "timestamp"       => $this->stamp(),
  "version"         => $this->versi ];
 $json = json_encode($data_post); 
 return json_decode($this->curl($url,$json),1);} 
 public function claim($claim){
 $url  = $this->server."/api/getTodayReward";
 $data_post = [  
  "userId"          => $this->akun["userid"],
  "authCode"        => $claim,
  "sessionToken"    => $this->akun["token"],
  "virtualDeviceId" => $this->akun["device"],
  "timestamp"       => $this->stamp(),
  "version"         => $this->versi ];
 $json = json_encode($data_post);   
 return json_decode($this->curl($url,$json),1); }
 public function captcha(){
 $tmp = $this->request("image");
 if(!$tmp["value"]){ readline($tmp["message"]); return false; }
 file_put_contents("img.svg",$tmp["value"]);
 shell_exec("convert img.svg img.png");
 #$auto = autosolve();
 if($gsl["token"]){ 
 shell_exec("rm -rf img.*");
 return strtolower($gsl["token"]); 
 }else{
 shell_exec("termux-open img.png"); 
 $ms = readline("image text: ");
 shell_exec("rm -rf img.*");
 return strtolower($ms);}}
 public function cap(){
 $tmp = $this->nologin("image");
 if(!$tmp["value"]){ readline($tmp["message"]); return false; }
 file_put_contents("img.svg",$tmp["value"]);
 shell_exec("convert img.svg img.png");
 shell_exec("termux-open img.png"); 
 $ms = readline("image text: ");
 #shell_exec("rm -rf img.*");
 return strtolower($ms);}
 public function set_config($json){
 $this->akun["token"]  = $json["token"];
 $this->akun["userid"] = $json["userid"];
 $this->akun["device"] = md5($this->stamp());}
}
function timer($rst,$tmr){
  $timr=time()+$tmr;
  while(true):
  echo "\r                           \r";
  $res=$timr-time();
  if($res < 1){break;}
  echo $rst."".date('H:i:s',$res);
  sleep(1);
  endwhile;}

function input($config){
  $input=["userid","token"];
  foreach($input as $in){
    $id[$in]=readline($in." : ");}
    foreach($id as $head=>$main){
      if(!$main){return false;}}
  $data=json_encode(file_get_contents($config),1);
  $tmp="user-".$id["userid"];
  $data_post=$data[$tmp]["login"];
  if(!$data_post){$data_post=array();}
  saveas($confog,[$tmp=>array_merge($id,$data_post)]);return $id;}
$r="\r";$t="\t";$re="\e[1;31m";$ij="\e[1;32m";$cx="\e[0m";$kg="\e[1;33m";$pr="\e[1;35m";$cy="\e[1;36m";$w="\e[1;37m";$n="\n";
/////////////////////////////
error_reporting(0);
$set_baner=kakatoji();
$vtb=new Vtube();
while(true):crl($set_baner);
$swin=json_decode(file_put_contents($config),1);
if(!$swin){ $result=0;}else{$result=count($swin);}
echo $set_baner;
echo $ijo."jumlah akun vtube ".$cyn."({$result})".$n;
echo "{$re}[{$w}1{$re}]{$cx} Input akun baru{$n}";
echo "{$re}[{$w}2{$re}]{$cx} cek info profile{$n}";
echo "{$re}[{$w}3{$re}]{$cx} Daily mission{$n}";
echo "{$re}[{$w}4{$re}]{$cx} Klaim bonus mission{$n}";
echo "{$re}[{$w}5{$re}]{$cx} Beli misi bintang{$n}";
$opsi=readline("option: ");
switch($opsi){
case 1:
 echo "{$re}[{$kg}1{$re}]{$cx} login phone and  password{$n}";
$menu=readline("input => ");
if($menu == 1){
  $vtb->set_config($json);
  $no1=readline("phone :62");
  $pass=readline("password: ");
  $code=$vtb->cap();
  $exs=$vtb->login($no,$pass,$code);
  if($exs["message"]){echo "login invalid".$exs["message"].$n;}
  elseif($exs["value"]){
    $dtx=$exs["value"]["userid"];
    $token=$exs["value"]["sessionToken"];
    $data_post=["user-$dtx"=>[
      "userid"=>$dtx,"token"=>$token,
      "phone"=>$no1]];
    echo $ij."login success".$exs["value"]["nickname"].$n;
    saveas($config,$data_post);}}
break;
case 2:
$data=json_decode(file_get_contents($config),1);
foreach($data as $head=>$json){
  $vtb->set_config($json);
  strip();
  $appx=$vtb->users("userinfo");
  if($appx["message"]){
    $no1=$json["phone"];
    echo $appx["message"]."=>$no1".$n;
    continue;
  }
$datax= $appx["value"]["userId"];
$dastr= $appx["value"]["nickname"];
$blt2= $appx["value"]["parentId"];
$spy= $appx["value"]["level"];
$no1= $appx["value"]["mobile"];
$cnn= $appx["value"]["has2ndPwd"];
$json["phone"]=$no1;
saveas($config,[$head=>$json]);
if($cnn){$cvg=$ij."OK";}else{$cvg=$re."not-set";}
echo "{$ij}Welcome{$cy} $dastr{$ij} level=>{$spy}{$n}";
strip();
echo "{$w}]~>{$ij}upline :{$kg}{$blt2}{$n}";
echo "{$w}]~>{$ij}phone :{$kg}{$no1}{$n}";
echo "{$w}]~>{$ij}password2nd :{$cvg}{$n}";
$post_mr=$vtb->users("meter");
if($post_mr["message"]){
  exit($post_mr["message"]);}
foreach($post_mr["value"] as $head=>$main){
$head=rata($head,14);
echo "{$ij}{$head} : {$main}{$n}";}
$post_bs=$vtb->mytask();
if($post_bs["message"]){echo $ij.$post_bs["message"].$n;}else{
  if($post_bs["value"]){
    foreach($post_bs["value"] as $head=>$main){
      if($main["status"]){
        $post_x=$main["task"]["title"];
        $clik=$main["clicks"];
        $cekx=$main["taskCycle"];
        echo $ij."running{$pr} ".$post_x."$cy $clik/$cekx".$n;
      }else{
        //aktifkan misi
        $post_x=$main["task"]["title"];
        $task_id=$main["id"];
        $prx=$vtb->starttask($task_id);
        if($prx["value"]){
          echo "{$kg}Misi bintang{$w}{$post_x}{$ij} Aktif{$n}";}
         }
       }
     }
    }
  }
strip();
break;
case 3:
strip();
$jls=json_decode(file_get_contents($config),1);
foreach($jls as $json){
$vtb->set_config($json);
$appx=$vtb->users("userinfo");
if($appx["message"]){
echo $appx["message"].$n; continue;}
$dastr=$appx["value"]["nickname"];
$blt2=$appx["value"]["parentId"];
$spy=$appx["value"]["level"];
$dastr=rata($dastr,14);
$uud=$ij."account{$cy} ".$dastr;
$idrx=$vtb->users("absen");
if($idrx["message"]){echo $uud.$kg.$idrx["message"].$n;}
else{
  echo $uud.$cy."daily-cekin-success".$n;}}
strip();
while(true):
$idm=0;$xtub=1;$kni=count($jls);
foreach($jls as $json){
$vtb->set_config($json);
$appx=$vtb->users("userinfo");
if($appx["message"]){
$no1=$json["phone"];
echo $appx["message"]."~>$no1".$n;$idm++;
$resul=round(10/count($jls),3);
timer($ij."next ads timer".$resul*60);
continue;}
$dastr=$appx["value"]["nickname"];
$blt2=$appx["value"]["parentId"];
$spy=$appx["value"]["level"];
$uud=$ij."akun {$xtube}/{$kni}{$cy} {$dastr}{$w}level{$kg}{$spy}".$n;

$sni=$vtb->request("todayvideo");
if($sni["message"]){exit($sni["message"]);}
$redult=$sni["value"]["count"];
$xxx=$sni["value"]["isComplete"];
if($redult == 10){
  if(!$xxx){
    echo $uud.$ij."- misi hari ini selesai {$pr} belum di claim !".$n;}
    else{
      echo $uud.$ij."- misi hari ini selesai{$kg} sudah di claim!".$n;}
$idm++;
$resul=round(10/count($jls),3);
timer($ij."next ads timer".$resul*60);}
else{
  $lem=$vtb->users("watch");
  if($lem["value"]){
    $les=$redult+1;
  echo $uud.$w."watch ads{$cy}".$les."/10{$ij} success!".$n;
if($les == 10){$idm++;}
$resul=round(10/count($jls),3);
timer($ij."next ads timer ".$resul*60);}
else{
$rst=$lem["message"];
if(strpos($rst."min")){
  $resul= (int) filter_var($rst,FILTER_SANITIZE_NUMBER_INT);
$resul=round($resul/count($jls),3);
timer($ij."next ads timer ".$resul*60);}
else{
  echo $uud.$re.$rst.$n;$idm++;
$resul=round(10/count($jls),3);
timer($ij."next ads timer ".$resul*60);}}}
$xtub++;}
strip();
if($idm >= count($jls)){break;}
sleep(1);
endwhile;
break;
case 4:
$jls=json_decode(file_get_contents($config),1);
$lur=1;$boga=count($jls);
foreach($jls as $json){
$vtb->set_config($json);
strip();
$appx=$vtb->users("userinfo");
if($appx["message"]){
  echo $appx["message"].$n;continue;}
$datax=$appx["value"]["userId"];
$dastr=$appx["value"]["nickname"];
$spy=$appx["value"]["level"];
echo $ij."account {$lur}/{$boga}{$cy} {$dastr} level {$spy}".$n;
$sni=$vtb->request("todayvideo");
if($sni["message"]){exit($sni["message"]);}
$redult=$sni["value"]["count"];
$xxx=$sni["value"]["isComplete"];
if($redult < 10){
echo $ij."watch video{$pr} {$redult}/10".$n;}
elseif($xxx){echo $kg."status sudah di claim".$n; }
else{
  while(true):
  $ms= $vtb->captcha();
  if($ms){
  $tsm=$vtb->claim($ms);
  if(!$tsm or $tsm["message"]){
    echo $re."system error{$kg} ".$tsm["message"].$n;}
else{
  echo $ij."success claim daily bonus".$n;
  break;}}
  endwhile;}
//mytask
$post_bs=$vtb->mytask();
if($post_bs["message"]){
  echo $ij.$post_bs["message"].$n;}
else{
  if($post_bs["value"]){
foreach($post_bs["value"] as $head=>$main){
if($main["status"]){
$post_x=$main["task"]["title"];
$clik=$main["clicks"];
$cekx=$main["taskCycle"];
echo $kg."running{$ij} {$post_x} {$cy}{$clik}/{$cekx}".$n;}}}}
$lur++;}
break;
case 5:
$jls=json_decode(file_get_contents($config),1);
$lur=1;$boga=count($jls);
foreach($jls as $json){
$vtb->set_config($json);
strip();
$appx=$vtb->users("userinfo");
if($appx["message"]){
echo $appx["message"].$n;continue;}
$datax=$appx["value"]["userid"];
$dastr=$appx["value"]["nickname"];
$spy=$appx["value"]["level"];
echo $ij."account {$lur}/{$boga} {$kg} {$dastr} {$w} level{$re} {$spy}".$n;
$post_mr=$vtb->users("meter");
if($post_mr["message"]){
  exit($post_mr["message"]);}
$tbr=$post_mr["value"]["viewPoint"];
echo $ij."viewPoint:{$re}".$tbr.$n;
strip();
$btg=readline("access account y/n: ");
if($btg == "y"){
  $yes=1;
  $bab=$vtb->systemtask();
if($bab["message"]){exit($bab["message"]);}
foreach($bab["value"] as $gg){
  $kucik=$gg["taskLevel"];
  $abc_1=$gg["price"];
  $abc_2=($gg["maxRun"]-$gg["nowCount"]);
  $rst=$w.$vtx.$ij."misi bintang{$kg} {$kucik} ";
  echo $rst."harga {$abc_1}{$kg} VP({$abc_2})".$n;
  $yes++;}strip();
$vtx_1=readline("pilih produk: ");
if($vtx_1){
  $vtx_1=$vtx_1-1;
  $data_post=$bab["value"][$vtx_1];
  $task_id=$data_post["id"];
  $kucik=$data_post["taskLevel"];
  $id_tr=readline("password2nd: ");
  $vtx_2=$vtb->buytask($task_id,$id_tr);
  if($vtx_2["message"]){
    echo $vtx_2["message"].$n;}
  elseif($vtx_2["value"]){
    echo $ij."sukses beli misi bintang{$pr} {$kucik} ".$n;

$post_bs=$vtb->mytask();
if($post_bs["message"]){
  echo $post_bs["message"].$n;}
else{
  if($post_bs["value"]){
    foreach($post_bs["value"] as $head=>$main){
      if(!$main["startTime"]){
        $task_id=$main["id"];
        $prx=$vtb->starttask($task_id);
        if($prx["value"]){
          echo $ij."misi bintang{$kg} {$kucik} {$ij} Aktif".$n;}}}}}}}}
$lur++;}
break;
}
readline("continue enter");
endwhile;

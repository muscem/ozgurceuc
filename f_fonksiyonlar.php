<?php
 // db.php
//Veritabani ile iletisime geçilmesini saglayan modül dosyasi

//$dbhost = "sql209.byethost33.com";  //'localhost';
//$dbuser = "b33_4051882";       //'user'; 
//$dbpass = "5030mci";           //'password';


	//www.tayangu.com.tr adresinde çalıştırılacak kod
//$dbhost = "sql.byethost23.org";  //'localhost';
//$dbuser = "tayangud_qazwsx";       //'user'; 
//$dbpass = "503052006";           //'password';



$dbhost = "localhost";  //'localhost';
$dbuser = "root";       //'user'; 
$dbpass = "";           //'password';

function dbConnect($db='') {
	//$db="b33_4051882_".$db;
	//$db="tayangud_db";
	//$db="tayangud_fromto";
	//$db="tayangud_fromto"; //deneme sitesinin veritabanı www.ozgurceuc.com/v?
	//$db="tayangud_ozgurceuc"; //asıl sitenin veritabanı www.ozgurceuc.com

	$db="ozgurceuc_v3";
	//$db="site_hepsi";
	
	//www.tayangu.com.tr adresinde çalıştırılacak kod
//	if ($db=="std_db") {
//	$db="tayangud_db";
//	}
//	else if($db=="std_forum_db"){
//	$db="tayangud_forum";
//	}
	
//	if ($db=="std_forum_db") {
//	$dbuser = "admin";       //'user'; 
//	$dbpass = "5030mci";           //'password';
//	}


    global $dbhost, $dbuser, $dbpass;
    
    $dbcnx = @mysql_connect($dbhost, $dbuser, $dbpass)
        or die('Su an veritabani ile ilgili bir sorun yasanmakta! Lütfen sonra tekrar deneyiniz. Sorun devam ederse lütfen bildiriniz: platform@tayangu.com.tr');

    if ($db!='' and !@mysql_select_db($db))
        die('Su anda veritabanina ulasilamiyor! Lütfen sonra tekrar deneyiniz. Sorun devam ederse lütfen bildiriniz: platform@tayangu.com.tr');
		
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

    return $dbcnx;
}



//ip öğrenme fonksiyonu
function ipogren(){
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
{
$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
{
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}



//dizi sıralama fonksiyonu
function sort2d ($array, $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE) 
    {
        if(is_array($array) && count($array)>0) 
        {
           foreach(array_keys($array) as $key) 
               $temp[$key]=$array[$key][$index];
               if(!$natsort) 
                   ($order=='asc')? asort($temp) : arsort($temp);
              else 
              {
                 ($case_sensitive)? natsort($temp) : natcasesort($temp);
                 if($order!='asc') 
                     $temp=array_reverse($temp,TRUE);
           }
           foreach(array_keys($temp) as $key) 
               (is_numeric($key))? $sorted[]=$array[$key] : $sorted[$key]=$array[$key];
           return $sorted;
      }
      return $array;
    } 



function ip_ara($ip){
$ip_aranacak_site="http://www.viewdns.info/iplocation/?ip=".$ip;

//$ip_aranacak_site="http://www.viewdns.info/iplocation/?ip=95.14.5.206";
$ch_ip = curl_init();
curl_setopt ($ch_ip, CURLOPT_URL, $ip_aranacak_site);
curl_setopt ($ch_ip, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch_ip, CURLOPT_FOLLOWLOCATION, 0);
$ip_data=curl_exec($ch_ip);



$k1=strpos($ip_data, $ip , 0);
$k1=strpos($ip_data, "City:" , $k1);
$k2=strpos($ip_data, "<br>" , $k1);
$ip_city=trim(strip_tags(substr($ip_data, $k1+5,$k2-$k1-5)));

while (stristr($ip_city,"&nbsp;")==true){
$ip_city=str_replace("&nbsp;","",$ip_city);
}
//echo "<hr>city=".$ip_city;

$k1=strpos($ip_data, "Country" , $k2);
$k2=strpos($ip_data, "<br>" , $k1);
$ip_country_code=trim(strip_tags(substr($ip_data, $k1+13,$k2-$k1-13)));
//echo "<br>ip_country_code=".$ip_country_code;

$k1=strpos($ip_data, "Country" , $k2);
$k2=strpos($ip_data, "<br>" , $k1);
$ip_country=trim(strip_tags(substr($ip_data, $k1+13,$k2-$k1-13)));
//echo "<br>ip_countr=".$ip_country."<hr>";

$ip_sonuc[0]=$ip_city;
$ip_sonuc[1]=$ip_country;
$ip_sonuc[2]=$ip_country_code;

return $ip_sonuc;
//print "|".htmlentities($ip_city)."-".htmlentities($ip_country)."-".htmlentities($ip_country_code)."|";
}

function eposta_kontrol($d_eposta){
$dek=explode("@", $d_eposta); //değişken eposta kontrol (dek)
if (count ($dek)==2 and strlen($dek[0])>0 and strlen($dek[1])>0){
return false; //Eposta adresi geçerli demek
}
else{
return true; //Eposta adresi geçersiz demek
}
}



//function ulke_listele(){
//$sql_ulke=mysql_query("SELECT * FROM `countries` ORDER BY `country_tr` ASC ");
//while ($ulke = mysql_fetch_array($sql_ulke, MYSQL_ASSOC)) {	
//echo "<option value=\"".$ulke["country_id"]."\">".$ulke["country_tr"]."</option>"; 
//}
//}

function ulke_listele($id,$type){//$id=ülke id'si, $typeçıktı türü
if ($id=="" and $type==0){
$sql_ulke=mysql_query("SELECT * FROM `countries` ORDER BY `country_tr` ASC ");
while ($ulke = mysql_fetch_array($sql_ulke, MYSQL_ASSOC)) {	
echo "<option value=\"".$ulke["country_id"]."\">".$ulke["country_tr"]."</option>"; 
}
}
elseif($id!="" and $type==0){
$sql_ulke=mysql_query("SELECT * FROM `countries` ORDER BY `country_tr` ASC ");
while ($ulke = mysql_fetch_array($sql_ulke, MYSQL_ASSOC)) {	
echo "<option value=\"".$ulke["country_id"]."\"";
if ($ulke["country_id"]==$id) echo " selected=\"selected\"";
echo " >".$ulke["country_tr"]."</option>"; 
}

}

}



//Firmaların sayfalarından aldığım bilgileri tabloda göstermek için oluşturduğum değişkenleri, veritabanına yerleştirmek için gereken dönüşümü yapıyor
//label etiketi için gerekli değişiklikler sadece (<br /> etiketine göre aktramalara bölünecek)
//<label title=\"Ekonomi-Fırsat\">EF</label><br /><label title=\"Ekonomi-Fırsat\">EF</label> gibi
//<a href=\"//www.atlasjet.com.tr ... şeklindeki linklerin başındaki //'leri temizler
function vt_deg($vt){
//echo "<hr>".htmlentities($vt);
$vt2=explode("<br />",$vt);
//echo "<br>".htmlentities($vt2[0]).htmlentities($vt2[1]);
//echo "<br />count=".count($vt2);

for($i=0;$i<count($vt2);$i++){
if ($vt2[$i]!=""){
$k1=strpos($vt2[$i],"\"",0);
//echo "<br />vt2i".$vt2[$i];
$k2=strpos($vt2[$i],"\"",$k1+1);

if ($k1>0){
$vt3[$i][0]=trim(substr($vt2[$i], $k1+1,$k2-$k1-1));
}
else{	//Uçuş no ve sınıf bilgilerinde a etiketi olmadığından
$vt3[$i][0]=trim($vt2[$i]);
}

while(stristr($vt3[$i][0],"/")){
$vt3[$i][0]=str_replace("/","",$vt3[$i][0]);
}
$vt3[$i][1]=trim(strip_tags($vt2[$i]));
}
}
return $vt3;
}


//<label title="29.07.2011">06:30</label> şeklindeki tarihleri
//2011-07-29 06:30:00
function vt_tar($vt){
$vt2=explode("<br />",$vt);
for($i=0;$i<count($vt2);$i++){
$k1=strpos($vt2[$i],"\"",0);
$k2=strpos($vt2[$i],"\"",$k1+1);
$vt3[$i][0]=trim(substr($vt2[$i], $k1+1,$k2-$k1-1));
$vt4=explode(".",$vt3[$i][0]);
$vt3[$i][1]=trim(strip_tags($vt2[$i]));
$vt5[$i]=$vt4[2]."-".$vt4[1]."-".$vt4[0]." ".$vt3[$i][1].":00";
//print "<hr/>vt5[$i]=".$vt5[$i]."<hr/>";
}
return $vt5;
}



function tarih_duzelt($vt){
$vt2=explode("<br />",$vt);
for($i=0;$i<count($vt2);$i++){
$k1=strpos($vt2[$i],"\"",0);
$k2=strpos($vt2[$i],"\"",$k1+1);
$vt3[$i][0]=trim(substr($vt2[$i], $k1+1,$k2-$k1-1));
$vt3[$i][0]=str_replace("/",".",$vt3[$i][0]);	//	/ işareti olan tarihler . ile değiştiriliyor
$k1=strpos($vt2[$i],">",0);
$k2=strpos($vt2[$i],"<",$k1+1);
$vt3[$i][1]=trim(substr($vt2[$i], $k1+1,$k2-$k1-1));
//$vt3[$i][1]=str_replace("/",".",$vt3[$i][1]);
}

return $vt3;
}





function sonuc_bulma_kontrol($hatali_firma){

//Bir firmanın seçillmiş olmasına, benim veritabanıma göre o güzergahta uçtuğu bilinmesine ve arama yapılmasına rağmen sonuç bulup bulmadığının kontrolü, bulunmadıysa bana eposta ile bildirilmesi
global $sonuclar, $sonuclar2, $fly, $kabin, $adult, $child, $infant, $datefrom, $dateto, $airport_from, $airport_to, $pegasus,$turkish_airlines, $sunexpress, $atlasjet, $borajet, $onurair, $skyairlines, $yolcular3, $para, $dil, $havayollari_hepsi2, $hy_turkey2;


if($sonuclar[0]==$sonuclar2[0] and $sonuclar[1]==$sonuclar2[1] and $sonuclar[2]==$sonuclar2[2]){
require_once('../_php/class.phpmailer.php');
$mail = new PHPMailer(); // defaults to using php "mail()"
$mail->CharSet  ="utf-8";
$mail->Encoding="base64";

$body='<body style="margin: 10px;">';
$body.='<div>';
$body.='<h2 align="center">www.ozgurceuc.com arama sayfasında yapılan aramadan, bir firmaya ait, bilet bulunması gerekirken, sonuç bulunamamış!</h2>';
$body.='<table>';
$body.='<tr><td><strong>Arama sonucu vermeyen firma</strong></td><td>: '.$hatali_firma.'</td></tr>';
$body.='<tr><td colspan="2">Arama bilgileri</td></tr>';
$body.='<tr><td><strong>Uçuş tipi</strong></td><td>: '.$fly.'</td></tr>';
$body.='<tr><td><strong>Nereden</strong></td><td>: '.$airport_from." - ".yer_bul($airport_from).'</td></tr>';
$body.='<tr><td><strong>Nereye</strong></td><td>: '.$airport_to.' - '.yer_bul($airport_to).'</td></tr>';
$body.='<tr><td><strong>Gidiş tarihi</strong></td><td>: '.$datefrom.'</td></tr>';
$body.='<tr><td><strong>Dönüş tarihi (varsa)</strong></td><td>: '.$dateto.'</td></tr>';
$body.='<tr><td><strong>Seçilen firmalar</strong></td><td>:</td></tr>';
$body.='<tr><td colspan="2">'.$havayollari_hepsi2.', '.$hy_turkey2.', '.$atlasjet.', '.$borajet.', '.$onurair.', '.$pegasus.', '.$sunexpress.', '.$skyairlines.', '.$turkish_airlines.'</td></tr>';
$body.='<tr><td><strong>Kabin</strong></td><td>: '.$fly.'</td></tr>';
$body.='<tr><td><strong>Para birimi</strong></td><td>: '.$para.'</td></tr>';
$body.='<tr><td><strong>Arama sayfanın dili</strong></td><td>: '.$dil.'</td></tr>';
$body.='<tr><td><strong>Yolcu sayıları</strong></td><td>:</td></tr>';
$body.='<tr><td><strong>Yetişkin</strong></td><td>: '.$adult.'</td></tr>';
$body.='<tr><td><strong>Çocuk</strong></td><td>: '.$child.'</td></tr>';
$body.='<tr><td><strong>Bebek</strong></td><td>: '.$infant.'</td></tr>';
$body.='<tr><td><strong>Genç</strong></td><td>: '.$yolcular3[5].'</td></tr>';
$body.='<tr><td><strong>Öğrenci</strong></td><td>: '.$yolcular3[2].'</td></tr>';
$body.='<tr><td><strong>60+</strong></td><td>: '.$yolcular3[0].'</td></tr>';
$body.='<tr><td><strong>65+</strong></td><td>: '.$yolcular3[1].'</td></tr>';
$body.='<tr><td><strong>Asker</strong></td><td>: '.$yolcular3[3].'</td></tr>';
$body.='<tr><td><strong>Denizci</strong></td><td>: '.$yolcular3[4].'</td></tr>';
$body.='</table>';
$body.='</div>';
$body.='</body>';

$body = eregi_replace("[\]",'',$body);

//$mail->AddReplyTo("muscem44@hotmail.com","Cem");
$mail->SetFrom('arama@ozgurceuc.com', 'Arama formu');
$mail->AddReplyTo("mci@tayangu.com.tr","Cem");
//$address = "muscem44@hotmail.com";
$address = "mci@tayangu.com.tr";
$mail->AddAddress($address, "Cem");
$mail->Subject    = "www.ozgurceuc.com arama sayfasında, seçilen firmanın, bulunması gerekirken, sonuç bulunamaması nedeniyle gönderildi!";
$mail->AltBody    = "Bu mesajı görebilmek için HTML kodu göstermeye uygun e-posta gösterici bir program kullanmalısınız!"; // optional, comment out and test

$mail->MsgHTML($body);
$mail->Send();

}

}




function country_olustur($sql_search_country, $country){
if ($sql_search_country==""){
$sql_search_country="(NULL , 'search_id', (SELECT `countries`.`country_id` FROM `countries` WHERE `countries`.`country_code`='$country'))";	
}
else{
$sql_search_country=$sql_search_country.", (NULL , 'search_id', (SELECT `countries`.`country_id` FROM `countries` WHERE `countries`.`country_code`='$country'))";	
}
return $sql_search_country;
}






//Arama için gönderilen hava laanı adları airports_from ve airports_to değerlerini sadece iata olacak şekilde düzenlemek için kullanılan fonksiyon
function find_iata($kod, $dil="tr"){
$k1=strpos($kod, "(");
$k2=strpos($kod, ")",$k1);

//Eğer iata kodu kullanılmışsa veya başka bir değişle, 
//otomatik tanımlamada belirttiğim şekilde kullanılmışsa: 	"havalanaı adı (iata) ülke"
if ($k1>0 and $k2>0 and $k2-$k1==4){
$iata=substr($kod,$k1+1,3);
return $iata;
}
else{
	//Eğer iata kodu kullanılmamışsa
	//veritabanından birden fazla değer dönebilir!!!
	$airport_name="airport_name_".$dil;	
	$aname=explode(" ", $kod); //airport name: "İstanbul Sabiha Gökçen"
	unset($sql_aname);
	for ($i=0; $i<count($aname); $i++){
		if ($sql_aname==""){
		$sql_aname=" WHERE ".$airport_name." LIKE '%".$aname[$i]."%'";
		}
		else{
		$sql_aname=$sql_aname." or ".$airport_name." LIKE '%".$aname[$i]."%'";
		}
	}
	
	
	$sql="SELECT * FROM airports".$sql_aname;
	$sql_result=mysql_query($sql);
	
	if (mysql_num_rows($sql_result)==1){
		return mysql_result($sql_result,0,"iata");
	}
	elseif (mysql_num_rows($sql_result)!=1 and $dil!="en") {
		
		//Eğer birden farklı değer dönmüş ise 
		$airport_name="airport_name_en";	
		$aname=explode(" ", $kod); //airport name: "İstanbul Sabiha Gökçen"
		unset($sql_aname);
		for ($i=0; $i<count($aname); $i++){
			if ($sql_aname==""){
			$sql_aname=" WHERE ".$airport_name." LIKE '%".$aname[$i]."%'";
			}
			else{
			$sql_aname=$sql_aname." or ".$airport_name." LIKE '%".$aname[$i]."%'";
			}
		}
		
		
		$sql="SELECT * FROM airports".$sql_aname;
		$sql_result=mysql_query($sql);
		
		if (mysql_num_rows($sql_result)==1){
		return mysql_result($sql_result,0,"iata");
		}
		else{
		return false;
		}
	
	
	return false;
	}
}
}	//function find_iata($kod){
	
function find_country($iata){

$sql="SELECT * FROM airports WHERE iata='".$iata."'";
$sql_result=mysql_query($sql);
if (mysql_num_rows($sql_result)==1){
//echo "<br>country_id=".mysql_result($sql_result,0,"country_id");
return mysql_result($sql_result,0,"country_id");
}
}


function visit_record($ip, $page, $lang){
$ref = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
$ip_sonuc=ip_ara($ip);
$sql_visit="INSERT INTO `visits` (`visit_id`, `page`, `language`, `ip`, `ip_city`, `ip_country`, `referrer`) VALUES
('', '$page', (SELECT language_id FROM languages WHERE `language_code`= '".$lang."'), '$ip', '".$ip_sonuc[0]."', '".$ip_sonuc[1]."', '$ref')";
//echo $sql_visit;
mysql_query($sql_visit);
}
	
	
?>

var sonuclar_gidis =[[[]]];
var sonuclar_gidis_ucus=[];
var sonuc_gidis_u = [];
var sonuclar_donus =new Array();
var sonuclar_gidis_donus =new array();
var sorun=0;
function aramaBaglantisi(){
var yazli;
var airport_from=$("#airport_from").val();
var airport_to=$("#airport_to").val();
var datefrom=$("#date_from").val();
var dateto=$("#date_to").val();
yazli='<li class="ui-li" data-theme="a" data-wrapperels="div" data-shadow="false" data-corners="false"><h4 align="center">';
yazli=yazli+$("#airport_from option:selected").text()+' - ';
yazli=yazli+$("#airport_to option:selected").text();
yazli=yazli+', '+datefrom+' tarihinde gidiş, ';
if($("#fly_single").attr("checked")){
var fly=1;
}
else{
var fly=2;
yazli=yazli+' '+dateto+' tarihinde dönüş, ';
}
var adult=$("#adult").val();
var child=$("#child").val();
var infant=$("#infant").val();
var yolcular2= new Array();
yolcular2[0]=$("#yolcular0").val();
yolcular2[1]=$("#yolcular1").val();
yolcular2[2]=$("#yolcular2").val();
yolcular2[3]=$("#yolcular3").val();
yolcular2[4]=$("#yolcular4").val();
yolcular2[5]=$("#yolcular5").val();
yazli=yazli+adult+' yetişkin';
if (child>0) yazli=yazli+', '+child+' çocuk';
if (infant>0) yazli=yazli+', '+infant+' bebek';
if (yolcular2[0]>0) yazli=yazli+', '+yolcular2[0]+' 60 üstü';
if (yolcular2[1]>0) yazli=yazli+', '+yolcular2[1]+' 65 üstü';
if (yolcular2[2]>0) yazli=yazli+', '+yolcular2[2]+' öğrenci';
if (yolcular2[3]>0) yazli=yazli+', '+yolcular2[3]+' asker';
if (yolcular2[4]>0) yazli=yazli+', '+yolcular2[4]+' denizci';
if (yolcular2[5]>0) yazli=yazli+', '+yolcular2[5]+' genç';
yazli=yazli+' için bulunan sonuçlar</h4></li>';
$("#arama_sonuclar").append(yazli);
$("#sonuclar").trigger( "create" );
var atlasjet="";
if($("#atlasjet").attr("checked")){
atlasjet="atlasjet";
}
var borajet="";
if($("#borajet").attr("checked")){
borajet ="borajet";
}
var onurair="";
if($("#onurair").attr("checked")){
onurair ="onurair";
}
var pegasus="";
if($("#pegasus").attr("checked")){
pegasus ="pegasus";
}
var sunexpress="";
if($("#sunexpress").attr("checked")){
sunexpress ="sunexpress";
}
var turkish_airlines="";
if($("#turkish_airlines").attr("checked")){
turkish_airlines ="turkish_airlines";
}
var kabin=$("#kabin").val();
var para=$("#para").val();
$.ajax({
type: "POST",
url: urldeger+"/mobil/_xml_results.php",
timeout: 260000,
data: {	airport_from: airport_from, 
airport_to: airport_to,
datefrom: datefrom,
dateto: dateto,
fly: fly,
adult: adult,
child: child,
infant: infant,
yolcular2: yolcular2,
atlasjet: atlasjet,
borajet: borajet,
onurair: onurair,
pegasus: pegasus,
sunexpress: sunexpress,
turkish_airlines: turkish_airlines,
kabin: kabin,
para: para,
uAgent: navigator.userAgent,
srch: 'search',
ver: ozgurceucVersion,
dname: dname,
dplatform: dplatform,
duuid: duuid,
dversion: dversion},
success: function(xml) {
var i;
var a=[];
var yaz;
var sonucVar;
var tarih;
var airport_from, airport_to, datefrom, dateto;
airport_from=$("#airport_from").val();
airport_to=$("#airport_to").val();
datefrom=$("#date_from").val();
dateto=$("#date_to").val();
var son2 = ["gidis", "donus", "gidis_donus"];//
for (i_sonuc=0;i_sonuc<son2.length;i_sonuc++){
sonucVar=0;
if (son2[i_sonuc]=="gidis_donus"){
var sonuclar=son2[i_sonuc];
i="0";
yaz="";
yaz=yaz+'<li class="ui-li ui-li-static ui-btn-up-c" data-theme="c" data-wrapperels="div" data-shadow="false" data-corners="false" id="'+sonuclar+'_sonuclar">';
yaz=yaz+'<h4 align="center">'+$("#airport_from option:selected").text()+' - '+$("#airport_to option:selected").text()+', '+datefrom+' tarihindeki gidiş,';
yaz=yaz+' '+dateto+' tarihindeki dönüş uçuşları</h4>';
yaz=yaz+'<ul id="'+sonuclar+'_ucuslar" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-role="listview" data-inset="true">';
$(xml).find(sonuclar+'_sonuc').each(function(){
sonucVar=1;
a["ucret"]=$(this).find("ucret").text();
a["ucret_turu"]=$(this).find("ucret_turu").text();
a["ucret_orjinal"]=$(this).find("ucret_orjinal").text();
a["ucret_orjinal_turu"]=$(this).find("ucret_orjinal_turu").text();
a["sinif"]=$(this).find("sinif").text();
a["havayolu"]=$(this).find("havayolu").text();
a["havayolu_adres"]=$(this).find("havayolu_adres").text();
a["gidis_aktarma"]=$(this).find("gidis_aktarma").text();
a["gidis_kalkis"]=$(this).find("gidis_kalkis").text();
a["gidis_kalkis_kod"]=$(this).find("gidis_kalkis_kod").text();
a["gidis_varis"]=$(this).find("gidis_varis").text();
a["gidis_varis_kod"]=$(this).find("gidis_varis_kod").text();
a["gidis_kalkis_saat"]=$(this).find("gidis_kalkis_saat").text();
a["gidis_kalkis_tarih"]=$(this).find("gidis_kalkis_tarih").text();
a["gidis_varis_saat"]=$(this).find("gidis_varis_saat").text();
a["gidis_varis_tarih"]=$(this).find("gidis_varis_tarih").text();
a["donus_aktarma"]=$(this).find("donus_aktarma").text();
a["donus_kalkis"]=$(this).find("donus_kalkis").text();
a["donus_kalkis_kod"]=$(this).find("donus_kalkis_kod").text();
a["donus_varis"]=$(this).find("donus_varis").text();
a["donus_varis_kod"]=$(this).find("donus_varis_kod").text();
a["donus_kalkis_saat"]=$(this).find("donus_kalkis_saat").text();
a["donus_kalkis_tarih"]=$(this).find("donus_kalkis_tarih").text();
a["donus_varis_saat"]=$(this).find("donus_varis_saat").text();
a["donus_varis_tarih"]=$(this).find("donus_varis_tarih").text();
yaz=yaz+'<li id="'+sonuclar+i+'" class="ui-li" data-theme="c" data-wrapperels="div" data-shadow="false" data-corners="false"';
yaz=yaz+' data-sort-ucret="'+a["ucret"]+'" data-sort-havayolu="'+a["havayolu"]+'" data-sort-sinif="'+a["sinif"]+'" data-sort-gidisaktarma="'+a["gidis_aktarma"]+'" data-sort-gidiskalkissaat="'+a["gidis_kalkis_tarih"]+' '+a["gidis_kalkis_saat"]+'" data-sort-gidisvarissaat="'+a["gidis_varis_tarih"]+' '+a["gidis_varis_saat"]+'" data-sort-donusaktarma="'+a["donus_aktarma"]+'" data-sort-donuskalkissaat="'+a["donus_kalkis_tarih"]+' '+a["donus_kalkis_saat"]+'" data-sort-donusvarissaat="'+a["donus_varis_tarih"]+' '+a["donus_varis_saat"]+'">';
yaz=yaz+'<label for="radio-choice-'+i+'">';
if(a["ucret_turu"]!=a["ucret_orjinal_turu"]){
yaz=yaz+'<a href="#" onClick="msgAlert(\''+a['ucret_orjinal']+' '+a['ucret_orjinal_turu']+'\')">'+a["ucret"]+' '+a["ucret_turu"]+'</a>';
}
else{
yaz=yaz+a["ucret"]+' '+a["ucret_turu"];	
}
yaz=yaz+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="msgAlert(\''+a['havayolu_adres']+'\')">'+a["havayolu"]+'</a></label>';
yaz=yaz+'<hr>';
yaz=yaz+'<div class="ui-grid-b">';
yaz=yaz+'<div class="ui-block-a"><a href="#" onClick="msgAlert(\'Aktarma Sayısı\')">'+a["gidis_aktarma"]+'</a></div>';
yaz=yaz+'<div class="ui-block-b"><a href="#" onClick="msgAlert(\''+a['gidis_kalkis']+'\')">'+a["gidis_kalkis_kod"]+'</a></div>';
yaz=yaz+'<div class="ui-block-c"><a href="#" onClick="msgAlert(\''+a['gidis_varis']+'\')">'+a["gidis_varis_kod"]+'</a></div></div>';
yaz=yaz+'<div class="ui-grid-b">';
yaz=yaz+'<div class="ui-block-a"><a href="#" onClick="msgAlert(\'Sınıf\')">'+a["sinif"]+'</a></div>';
yaz=yaz+'<div class="ui-block-b"><a href="#" onClick="msgAlert(\''+a['gidis_kalkis_tarih']+'\')">'+a["gidis_kalkis_saat"];
if(datefrom!=a['gidis_kalkis_tarih']){
yaz=yaz+' !';
}
yaz=yaz+'</a></div>';
yaz=yaz+'<div class="ui-block-c"><a href="#" onClick="msgAlert(\''+a['gidis_varis_tarih']+'\')">'+a["gidis_varis_saat"];
if(datefrom!=a['gidis_varis_tarih']){
yaz=yaz+' !';
}
yaz=yaz+'</a></div></div>';
yaz=yaz+'<hr>';
yaz=yaz+'<div class="ui-grid-b">';
yaz=yaz+'<div class="ui-block-a"><a href="#" onClick="msgAlert(\'Aktarma Sayısı\')">'+a["donus_aktarma"]+'</a></div>';
yaz=yaz+'<div class="ui-block-b"><a href="#" onClick="msgAlert(\''+a['donus_kalkis']+'\')">'+a["donus_kalkis_kod"]+'</a></div>';
yaz=yaz+'<div class="ui-block-c"><a href="#" onClick="msgAlert(\''+a['donus_varis']+'\')">'+a["donus_varis_kod"]+'</a></div></div>';
yaz=yaz+'<div class="ui-grid-b">';
yaz=yaz+'<div class="ui-block-a"><a href="#" onClick="msgAlert(\'Sınıf\')">'+a["sinif"]+'</a></div>';
yaz=yaz+'<div class="ui-block-b"><a href="#" onClick="msgAlert(\''+a['donus_kalkis_tarih']+'\')">'+a["donus_kalkis_saat"];
if(dateto!=a['donus_kalkis_tarih']){
yaz=yaz+' !';
}
yaz=yaz+'</a></div>';
yaz=yaz+'<div class="ui-block-c"><a href="#" onClick="msgAlert(\''+a['donus_varis_tarih']+'\')">'+a["donus_varis_saat"];
if(dateto!=a['donus_varis_tarih']){
yaz=yaz+' !';
}
yaz=yaz+'</a></div></div>';
yaz=yaz+'</li>';
i++
})
yaz=yaz+'</ul>';
var sayfaSay=Math.ceil(i/gss);
if(sayfaSay>1){
yaz=yaz+'<div data-role="controlgroup" data-type="horizontal" align="center" id="'+sonuclar+'lerSayfalar">';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Onceki" class="ui-disabled"><</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sayfa" class="ui-disabled">1 / '+sayfaSay+'</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sonraki">></a>';
yaz=yaz+'</div>';
yaz=yaz+'<input type="button" value="Hepsini Göster" id="'+sonuclar+'lerGoster" />';
}
yaz=yaz+'</li>';
if(sonucVar==1){
$("#arama_sonuclar").append(yaz);
$("#sonuclar").trigger( "create" );
}
}
else{
var sonuclar=son2[i_sonuc];
i="0";
yaz="";
yaz=yaz+'<li class="ui-li ui-li-static ui-btn-up-';
if(sonuclar=="gidis"){
yaz=yaz+'d" data-theme="d';
}
else{ 
yaz=yaz+'f" data-theme="f'; 
};
yaz=yaz+'" data-wrapperels="div" data-shadow="false" data-corners="false" id="'+sonuclar+'_sonuclar">';
if(i_sonuc==0){
yaz=yaz+'<h4 align="center">'+$("#airport_from option:selected").text()+' - '+$("#airport_to option:selected").text()+', '+datefrom+' tarihindeki uçuşlar</h4>';
}
else{
yaz=yaz+'<h4 align="center">'+$("#airport_to option:selected").text()+' - '+$("#airport_from option:selected").text()+', '+dateto+' tarihindeki uçuşlar</h4>';
}
yaz=yaz+'<fieldset data-role="controlgroup" data-mini="true" id="'+sonuclar+'_fieldset">';
yaz=yaz+'<ul id="'+sonuclar+'_ucuslar" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-role="listview" data-inset="true">';
$(xml).find(sonuclar+'_sonuc').each(function(){
sonucVar=1;
a["aktarma"]=$(this).find("aktarma").text();
a["ucret"]=$(this).find("ucret").text();
a["ucret_turu"]=$(this).find("ucret_turu").text();
a["ucret_orjinal"]=$(this).find("ucret_orjinal").text();
a["ucret_orjinal_turu"]=$(this).find("ucret_orjinal_turu").text();
a["biletleme_ucreti"]=$(this).find("biletleme_ucreti").text();
i2=0;
yaz2="";
yaz3="";
$(xml).find(sonuclar+'[name='+i+']').each(function(){
a["havayolu"]=$(this).find("havayolu").text();
a["havayolu_adres"]=$(this).find("havayolu_adres").text();
a["ucus_no"]=$(this).find("ucus_no").text();
a["kalkis"]=$(this).find("kalkis").text();
a["kalkis_kod"]=$(this).find("kalkis_kod").text();
a["varis"]=$(this).find("varis").text();
a["varis_kod"]=$(this).find("varis_kod").text();
a["kalkis_saat"]=$(this).find("kalkis_saat").text();
a["kalkis_tarih"]=$(this).find("kalkis_tarih").text();
a["varis_saat"]=$(this).find("varis_saat").text();
a["varis_tarih"]=$(this).find("varis_tarih").text();
a["sinif"]=$(this).find("sinif").text();
if (yaz3==""){
yaz3=' data-sort-havayolu="'+a["havayolu"]+'" data-sort-ucusno="'+a["ucus_no"]+'" data-sort-kalkiskod="'+a["kalkis_kod"]+'" data-sort-variskod="'+a["varis_kod"]+'" data-sort-kalkissaat="'+a["kalkis_tarih"]+' '+a["kalkis_saat"]+'" data-sort-varissaat="'+a["varis_tarih"]+' '+a["varis_saat"]+'" data-sort-sinif="'+a["sinif"]+'"';
}
yaz2=yaz2+'<hr>';
yaz2=yaz2+'<div class="ui-grid-c">';
yaz2=yaz2+'<div class="ui-block-a"><a href="#" onClick="msgAlert(\''+a['havayolu_adres']+'\')">'+a["havayolu"]+'</a></div>';
yaz2=yaz2+'<div class="ui-block-b"></div>'
yaz2=yaz2+'<div class="ui-block-c"><a href="#" onClick="msgAlert(\''+a['kalkis']+'\')">'+a["kalkis_kod"]+'</a></div>';
yaz2=yaz2+'<div class="ui-block-d"><a href="#" onClick="msgAlert(\''+a['varis']+'\')">'+a["varis_kod"]+'</a></div></div>';
yaz2=yaz2+'<div class="ui-grid-c">';
yaz2=yaz2+'<div class="ui-block-a"><a href="#" onClick="msgAlert(\'Uçuş Numarası\')">'+a["ucus_no"]+'</a></div>';
yaz2=yaz2+'<div class="ui-block-b">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="msgAlert(\'Sınıf\')">'+a["sinif"]+'</a></div>';
yaz2=yaz2+'<div class="ui-block-c"><a href="#" onClick="msgAlert(\''+a['kalkis_tarih']+'\')">'+a["kalkis_saat"];
datecomp=datefrom;
if(datecomp!=a['kalkis_tarih']){
yaz2=yaz2+' !';
}
yaz2=yaz2+'</a></div>';
yaz2=yaz2+'<div class="ui-block-d"><a href="#" onClick="msgAlert(\''+a['varis_tarih']+'\')">'+a["varis_saat"];
if(datecomp!=a['varis_tarih']){
yaz2=yaz2+' !';
}
yaz2=yaz2+'</a></div></div>';
i2++;
})
yaz=yaz+'<li id="'+sonuclar+i+'" class="ui-li" data-theme="c" data-wrapperels="div" data-shadow="false" data-corners="false"';
yaz=yaz+' data-sort-ucret="'+a["ucret"]+'" data-sort-aktarma="'+a["aktarma"]+'"'+yaz3;
yaz=yaz+'>';
yaz=yaz+'<input type="radio" name="radio-choice" id="radio-choice-'+i+'" value="choice-'+i+'" onclick="toplamHesaplama(\''+sonuclar+'|'+a["havayolu"]+'|'+a["ucret"]+'|'+a["biletleme_ucreti"]+'|'+a["ucret_turu"]+'\')"/>';
yaz=yaz+'<label for="radio-choice-'+i+'">';
if(a["ucret_turu"]!=a["ucret_orjinal_turu"]){
yaz=yaz+'<a href="#" onClick="msgAlert(\''+a['ucret_orjinal']+' '+a['ucret_orjinal_turu']+'\')">'+a["ucret"]+' '+a["ucret_turu"]+'</a>';
}
else{
yaz=yaz+a["ucret"]+' '+a["ucret_turu"];	
}
yaz=yaz+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="msgAlert(\'Aktarma Sayısı\')">'+a["aktarma"]+'</a></label>';
yaz=yaz+yaz2
yaz=yaz+'</li>';
i++;
})
yaz=yaz+'</ul></fieldset>';
var sayfaSay=Math.ceil(i/gss);
if(sayfaSay>1){
yaz=yaz+'<div data-role="controlgroup" data-type="horizontal" align="center" id="'+sonuclar+'lerSayfalar">';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Onceki" class="ui-disabled"><</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sayfa" class="ui-disabled">1 / '+sayfaSay+'</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sonraki">></a>';
yaz=yaz+'</div>';
yaz=yaz+'<input type="button" value="Hepsini Göster" id="'+sonuclar+'lerGoster" />';
}
yaz=yaz+'</li>';
if(sonucVar==1){
$("#arama_sonuclar").append(yaz);//
$("#sonuclar").trigger( "create" );
}
}
}
yaz="";
sonucVar=0;
$(xml).find('firma').each(function(){
sonucVar=1;
a["firma"]=$(this).find("ad").text();
a["adres"]=$(this).find("adres").text();
if(yaz!="") yaz=yaz+", ";
yaz=yaz+'<a href="#" onClick="msgAlert(\''+a['adres']+'\')">'+a["firma"]+'</a>';
})
if(sonucVar==1){
yaz='<li class="ui-li ui-li-static ui-btn-up-d" data-theme="d" data-wrapperels="div" data-shadow="false" data-corners="false"><h4 align="center">Seçtiğiniz güzergahte uçuş gerçekleştiren firmalar</h4><p align="center">'+yaz+'</p></li>';
$("#arama_sonuclar").append(yaz);
$('#arama_sonuclar_loading').remove();
$("#sonuclar").trigger( "create" );
}
yaz="";
sonucVar=0;
$(xml).find('hatalar').each(function(){
sonucVar=1;
a["hata"]=$(this).find("hata").text();
yaz=yaz+'<li class="ui-li ui-li-static ui-btn-up-d" data-theme="d" data-wrapperels="div" data-shadow="false" data-corners="false"><h4 align="center"><p align="center">'+a["hata"]+'</p></li>';
})
if(sonucVar==1){
$("#arama_sonuclar").append(yaz);
}
$('#arama_sonuclar_loading').remove();
$("#sonuclar").trigger( "create" );
sorun=0;
},
beforeSend: function() {
sorun=1;
var yazli;
yazli='<li id="arama_sonuclar_loading" class="ui-li" data-theme="f" data-wrapperels="div" data-shadow="false" data-corners="false" style="text-align:center"><br><center><img src=\"images/ajax-loader.gif\" /><br>Uçuşlar aranmaktadır.<br><br>Lütfen bekleyiniz!'+reklam+'</center></li>';
$("#arama_sonuclar").append(yazli);
$("#sonuclar").trigger( "create" );
},
complete: function() {
cal();
if(sorun==1){
}
$('#arama_sonuclar_loading').remove();
$("#sonuclar").trigger( "create" );
}
}).done(function( msg ) {
$('#arama_sonuclar_loading').remove();
$("#sonuclar").trigger( "create" );
});
}
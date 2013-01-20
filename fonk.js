//var son =new Array(new Array(new Array(new Array())));
var sonuclar_gidis =[[[]]];
var sonuclar_gidis_ucus=[];
var sonuc_gidis_u = [];
var sonuclar_donus =new Array();
var sonuclar_gidis_donus =new array();

function aramaBaglantisi(){
var yazli;
var airport_from=$("#airport_from").val();
var airport_to=$("#airport_to").val();
var datefrom=$("#date_from").val();
var dateto=$("#date_to").val();

yazli='<li class="ui-li" data-theme="a" data-wrapperels="div" data-shadow="false" data-corners="false"><h4 align="center">'
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

yazli=yazli+adult+' yetişkin';
if (child>0) yazli=yazli+', '+child+' çocuk';
if (infant>0) yazli=yazli+', '+infant+' bebek';
if (yolcular2[0]>0) yazli=yazli+', '+yolcular2[0];
if (yolcular2[1]>0) yazli=yazli+', '+yolcular2[1];
if (yolcular2[2]>0) yazli=yazli+', '+yolcular2[2];
if (yolcular2[3]>0) yazli=yazli+', '+yolcular2[3];
if (yolcular2[4]>0) yazli=yazli+', '+yolcular2[4];

yazli=yazli+' için bulunan sonuçlar</h4></li>';
$("#arama_sonuclar").append(yazli);

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
			para: para },
  dataType: "xml",
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
araCiftYon(xml, son2[i_sonuc]);	//Gidis ve Dönüs sonuçlarinin birlikte oldugu promosyonlu uçuslarin aranmasi








var sonuclar=son2[i_sonuc];
i="0";
yaz="";




yaz=yaz+'<li class="ui-li ui-li-static ui-btn-up-c" data-theme="c" data-wrapperels="div" data-shadow="false" data-corners="false" id="'+sonuclar+'_sonuclar">';


yaz=yaz+'<h4 align="center">'+$("#airport_from option:selected").text()+' - '+$("#airport_to option:selected").text()+', '+datefrom+' tarihindeki gidiş,';
yaz=yaz+' '+dateto+' tarihindeki dönüş uçuşları</h4>';


//yaz=yaz+'<fieldset data-role="controlgroup" data-mini="true" id="'+sonuclar+'_fieldset">';
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


//yaz=yaz+'<input type="radio" name="radio-choice" id="radio-choice-'+i+'" value="choice-'+i+'" />';
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


yaz=yaz+'</ul>';//</fieldset>

var sayfaSay=Math.ceil(i/gss);

if(sayfaSay>1){
yaz=yaz+'<div data-role="controlgroup" data-type="horizontal" data-mini="true" align="center" id="'+sonuclar+'lerSayfalar">';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Onceki" class="ui-disabled"><</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sayfa" class="ui-disabled">1 / '+sayfaSay+'</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sonraki">></a>';
yaz=yaz+'</div>';

yaz=yaz+'<input type="button" value="Hepsini Göster" data-mini="true" id="'+sonuclar+'lerGoster" />';
}

yaz=yaz+'</li>';


if(sonucVar==1){
//$("#"+sonuclar+"_sonuclar").append(yaz);//.listview('refresh');;
//alert(yaz);
$("#arama_sonuclar").append(yaz);//
}


















}
else{
//araTekYon(xml, sonuclar[i_sonuc]);	//Sadece gidis veya sadece dönüs uçuslarinin oldugu uçuslarin aranmasi

var sonuclar=son2[i_sonuc];
i="0";
yaz="";


yaz=yaz+'<li class="ui-li ui-li-static ui-btn-up-';

if(sonuclar=="gidis"){ yaz=yaz+'d" data-theme="d'; }
else{ yaz=yaz+'f" data-theme="f'; }; //if(sonuclar=="donus")

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

//var datecomp;
datecomp=datefrom;
//if (sonuclar=="donus") datecomp=dateto;

if(datecomp!=a['kalkis_tarih']){
yaz2=yaz2+' !';
}
yaz2=yaz2+'</a></div>';

yaz2=yaz2+'<div class="ui-block-d"><a href="#" onClick="msgAlert(\''+a['varis_tarih']+'\')">'+a["varis_saat"];

//datecomp=datefrom;
//if (sonuclar=="donus") datecomp=dateto;

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
	
yaz=yaz+'<div data-role="controlgroup" data-type="horizontal" data-mini="true" align="center" id="'+sonuclar+'lerSayfalar">';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Onceki" class="ui-disabled"><</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sayfa" class="ui-disabled">1 / '+sayfaSay+'</a>';
yaz=yaz+'<a href="#" data-role="button" id="'+sonuclar+'Sonraki">></a>';
yaz=yaz+'</div>';

yaz=yaz+'<input type="button" value="Hepsini Göster" data-mini="true" id="'+sonuclar+'lerGoster" />';
}

yaz=yaz+'</li>';

if(sonucVar==1){
//$("#"+sonuclar+"_sonuclar").append(yaz);//.listview('refresh');;
//alert(yaz);
$("#arama_sonuclar").append(yaz);//
}





















}	//else


}	//for (i_sonuc=0;i_sonuc<sonuclar.length;i_sonuc++){
$("#sonuclar").trigger( "create" );	//sonuclar sayfasi//	
}
}).done(function( msg ) {
  //alert( "Data Saved: " + msg );
cal();
$.mobile.changePage( $("#sonuclar") , { transition: "slide"} );

});

}




function araCiftYon(sonuclar){
//Gidis ve Dönüs sonuçlarinin birlikte oldugu promosyonlu uçuslarin aranmasi
}

function araTekYon(xml, sonuclar){
//Sadece gidis veya sadece dönüs uçuslarinin oldugu uçuslarin aranmasi

}




function sonuc_yaz(){
//alert("cem11");
var yaz;	
yaz='<fieldset data-role="controlgroup" data-mini="true">';


for(i=0;i<sonuclar_gidis.length;i++){
//alert("cem12");
//alert(i+". sonuclar "+". ucus ucret sonra"+sonuclar_gidis[i][0]["ucret"]);


//alert("sonuclar_gidis["+i+"][0][havayolu] sayisi="+sonuclar_gidis[i][0]["havayolu"].length);

//yaz='<li class="ui-li" data-theme="a" data-wrapperels="div" data-shadow="false" data-corners="false">    <input type="radio" name="radio-choice" id="radio-choice-'+i+'" value="choice-'+i+'"  /> <label for="radio-choice-'+i+'"><a href="#popupBasicUcret'+i+'" data-rel="popup">'+sonuclar_gidis[i][0]["ucret"]+' '+sonuclar_gidis[i][0]["ucret"]+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#popupBasicAktarma" data-rel="popup">'+sonuclar_gidis[i][0]["aktarma"]+'</a></label><hr>';

//alert("yaz1="+yaz);
for (i2=0;i2<sonuclar_gidis[i].length;i2++){
//alert("cem13");
//alert("i="+i+" i2="+i2);
//alert("sonuclar_gidis sayisi="+sonuclar_gidis.length);
//alert("sonuclar_gidis["+i+"]["+i2+"] sayisi="+sonuclar_gidis[i][i2].length);
//alert("sonuclar_gidis["+i+"]["+i2+"][0] sayisi="+sonuclar_gidis[i][i2][0].length);
//alert("sonuclar_gidis["+i+"]["+i2+"][0][0] sayisi="+sonuclar_gidis[i][i2][0][0].length);
//alert("cem10");

//alert("sonuclar_gidis sayisi="+sonuclar_gidis.length);
//alert("sonuclar_gidis["+i+"] sayisi="+sonuclar_gidis[i].length);
//alert("sonuclar_gidis["+i+"]["+i2+"] sayisi="+sonuclar_gidis[i][i2].length);
//alert("sonuclar_gidis["+i+"]["+i2+"][0][havayolu] sayisi="+sonuclar_gidis[i][i2][0]["havayolu"].length);

//alert("i="+i+" i2="+i2+" havayolu= "+sonuclar_gidis[i]["ucus"][i2]["havayolu"]);

//yaz=yaz+'<div class="ui-grid-c">	<div class="ui-block-a"><a href="#popupBasic'+sonuclar_gidis[i][i2][0]["havayolu"]+'" data-rel="popup">'+sonuclar_gidis[i][i2][0]["havayolu"]+'</a></div><div class="ui-block-b"></div><div class="ui-block-c"><a href="#popupBasic'+sonuclar_gidis[i][i2][0]["kalkis_kod"]+'" data-rel="popup">'+sonuclar_gidis[i][i2][0]["kalkis_kod"]+'</a></div>	<div class="ui-block-d"><a href="#popupBasic'+sonuclar_gidis[i][i2][0]["varis_kod"]+'" data-rel="popup">'+sonuclar_gidis[i][i2][0]["varis_kod"]+'</a></div><div class="ui-block-a"><a href="#popupBasicUcusNo" data-rel="popup">'+sonuclar_gidis[i][i2][0]["ucus_no"]+'</a></div><div class="ui-block-a">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#popupBasicSinif" data-rel="popup">'+sonuclar_gidis[i][i2][0]["sinif"]+'</a></div>	<div class="ui-block-b"><a href="#popupBasicTarih'+i+'_'+i2+'" data-rel="popup">'+sonuclar_gidis[i][i2][0]["kalkis_saat"]+'</a></div>	<div class="ui-block-c"><a href="#popupBasicTarih'+i+'_'+i2+'" data-rel="popup">'+sonuclar_gidis[i][i2][0]["varis_saat"]+'</a></div></div><!-- /grid-b -->			</li>';
//alert("cem11");
}
//alert("cem14");
}

yaz=yaz+'</fieldset>';
//alert("yaz2="+yaz);
//var sonuc=document.createElement("arama_sonuclar");
var sonuc=document.getElementById("arama_sonuclar");								   
//sonuc.innerHTML="<h3>"+yaz+"</h3>"; 
sonuc.appendChild(yaz);
//alert("cem5");	
}




<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="utf-8">
	<title>www.ozgurceuc.com</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="jquery.mobile-1.2.0.min.css" />
	<script src="jquery-1.8.3.min.js"></script>
	<script src="jquery.mobile-1.2.0.min.js"></script>
    
    <link rel="stylesheet" href="jquery.ui.datepicker.mobile.css" /> 
  <script src="jQuery.ui.datepicker.js"></script>
  <script src="jquery.ui.datepicker.mobile.js"></script>
  
<script src="jquery.tinysort.js"></script>
<script src="jquery.jqmts.js"></script>
  
<script src="fonk.js"></script>

<script type="text/javascript">

var gss=2; //her sayfada Görüntülenecek Sonuç Sayısı
var tarihBugun;
var urldeger="http://www.ozgurceuc.com";	//İnternete yüklenecek hali
//var urldeger="..";
$.datepicker.setDefaults($.datepicker.regional['tr']);

function tarih_kontrol (){}



function xml_country(selectId){
$(document).ready(function(){

$.ajax({
  type: "GET",
  url: urldeger+"/_php/xml_country.php",
  dataType: "xml",
success: function(xml) {

var selectOption='';

$(xml).find('menu').each(function(){

var value = $(this).find("value").text();
var name = $(this).find("name").text();

document.getElementById(selectId).options[document.getElementById(selectId).length]=new Option(name, value);	


//Açılışta her zaman Türkiye seçili olacak
if (value=="tr"){
document.getElementById(selectId).options[document.getElementById(selectId).length-1].selected = true;

$('#'+selectId).trigger("change");	//Ülke değiştiğinde havaalanlarını değiştirmek için
//$('#'+selectId).selectmenu('refresh');	//JQM bununla seçeneği gösterir hale geliyor.

}

});


}
}).done(function( msg ) {
 //alert( "Data Saved: " + msg );
$.mobile.loading('hide');
});



});

}



function xml_airport(selectId, code){

$(document).ready(function(){

$.ajax({
  type: "GET",
  url: urldeger+"/_php/xml_airport.php?c="+code,
  dataType: "xml",
success: function(xml) {

var selectOption='';
$(xml).find('menu').each(function(){

var value = $(this).find("value").text();
var name = $(this).find("name").text()+" ("+value+")";

document.getElementById(selectId).options[document.getElementById(selectId).length]=new Option(name, value);

});


}
}).done(function( msg ) {
 //alert( "Data Saved: " + msg );
$.mobile.loading('hide');
});



});

}




$( "#airport_from_country" ).live("change", function() {
var code=$("#airport_from_country option:selected").val();
document.getElementById("airport_from").length=1;
xml_airport("airport_from", code);
});

$( "#airport_to_country" ).live("change", function() {
var code=$("#airport_to_country option:selected").val();
document.getElementById("airport_to").length=1;
xml_airport("airport_to", code);
});

$( "#fly_single" ).live("change", function() {
$( "#return" ).hide();	//attr("style", "visibility: hidden");
$( "#date_to" ).hide();	//attr("style", "visibility: hidden");
/*$("#fly_single").checkboxradio("refresh");
$("#fly_return").checkboxradio("refresh");*/
});

$( "#fly_return" ).live("change", function() {
$( "#return" ).show();	//attr("style", "visibility: visible");
$( "#date_to" ).show();	//attr("style", "visibility: visible");
/*$("#fly_single").checkboxradio("refresh");
$("#fly_return").checkboxradio("refresh");*/
});


$(document).ready(function(){
//$.mobile.showPageLoadingMsg();
/*$.mobile.loading( 'show', {
	text: 'foo',
	textVisible: true,
	theme: 'a',
	html: "<center><img src=\"logo_ozgurceuc.png\" /><br><h1>www.ozgurceuc.com</h1><br><img src=\"ajax-loader.gif\" /><br>Şu anda gerekli bilgiler kontrol ediliyor. Lütfen bekleyiniz.</center>"
});*/

//$.mobile.showPageLoadingMsg("b", "This is only a test", true);
baslangic();
//$.mobile.hidePageLoadingMsg();
});

function yukleniyor(msgY){

if( msgY=="" || msgY=="undefined" ) msgY="<center><img src=\"logo_ozgurceuc.png\" /><br><h1>www.ozgurceuc.com</h1><br><img src=\"ajax-loader.gif\" /><br>Şu anda gerekli bilgiler kontrol ediliyor. Lütfen bekleyiniz.</center>";

//alert("msg="+msgY);

$.mobile.loading( 'show', {
	text: 'foo',
	textVisible: true,
	theme: 'a',
	html: msgY
});

}


function xml_acilis(){

$(document).ready(function(){
$.ajax({
type: "GET",
url: urldeger+"/mobil/_xml_mobile_acilis.php",
dataType: "xml",
success: function(xml) {
var icerik;
tarihBugun = $(xml).find("tarih").text();	//Tarihi öğrenmek için kullanacağım.
//alert("tarih="+tarih);

//$("#ana_sayfa_icerik").html("");

$(xml).find('bilgi').each(function(){

var bilgi = $(this).text();
icerik=$("#ana_sayfa_icerik").html()+'<br><div class="ui-bar ui-bar-d ui-corner-all">'+bilgi+'</div>';
//alert(icerik);
$("#ana_sayfa_icerik").html(icerik);
});

icerik=$("#ana_sayfa_icerik").html()+'<br><div class="ui-bar ui-bar-d ui-corner-all"><img src="'+$(xml).find("resim").text()+'" /></div>';

$("#ana_sayfa_icerik").html(icerik);

$("#ana_sayfa").trigger( "create" );	




}
});
});


}


function baslangic(){
yukleniyor("");
//xml_country("airport_from_country");
yukleniyor("");
//xml_country("airport_to_country");

xml_acilis();
//$( "#datepicker" ).datepicker({ minDate: +1, maxDate: "+1M +10D" });
//$(function() {
//$("#date_from").datepicker();
//$("#date_from").datepicker("setDate", "20.01.2013");
//$( "#date_from" ).datepicker( "option", "minDate", '+0d' );
//$( "#date_to" ).datepicker( "option", "minDate", '+0d' );
//$.mobile.loading('hide');
//alert("açılış");
//})

}


function form_kontrol(){

if ($("#airport_from").val()=="" || $("#airport_from").val()=="0"){
msgAlert("Kalkış havaalanını seçiniz lütfen!");
return false;
}

else if ($("#airport_to").val()=="" || $("#airport_to").val()=="0"){
msgAlert("Varış havaalanını seçiniz lütfen!");
return false;
}

else if ($("#airport_from").val() == $("#airport_to").val()){
msgAlert("Kalkış ve varış havaalanlarını aynı seçmişsiniz. Değiştirin lütfen!");
return false;
}

else if ($("#date_from").val()==""){
msgAlert("Kalkış tarihini seçiniz lütfen!");
return false;
}

else if ($("#date_to").val()==""){
msgAlert("Varış tarihini seçiniz lütfen!");
return false;
}

else if ( $("#adult").val()==0 && $("#yolcular0").val()==0 && $("#yolcular1").val()==0 && $("#yolcular2").val()==0 && $("#yolcular3").val()==0 && $("#yolcular4").val()==0 && $("#yolcular5").val()==0){
msgAlert("En az bir yetişkin yolcu seçmelisiniz!");
return false;
}

else if ( !$("#hy_hepsi").attr("checked") && !$("#hy_turkey").attr("checked") && !$("#atlasjet").attr("checked") && !$("#borajet").attr("checked") && !$("#onurair").attr("checked") && !$("#pegasus").attr("checked") && !$("#sunexpress").attr("checked") && !$("#turkish_airlines").attr("checked") ){
msgAlert("En azından bir havayolu seçmelisiniz!");
return false;
}

//tarih_kontrol ();
return true;
}



function ara(){
var kontrol;
kontrol=form_kontrol();
//alert("cem kontrol="+kontrol);
if(kontrol){
$("#arama_sonuclar").html("");
aramaBaglantisi();
//cal();
$.mobile.changePage( $("#sonuclar") , { transition: "slide"} );
}
}






var msgAlert=function(msg){

$("<div class='ui-loader ui-overlay-shadow ui-body-a ui-corner-all'><h3>"+msg+"</h3></div>")
.css({ display: "block",
opacity: 0.90,
position: "fixed",
padding: "5px", "text-align": "center",
width: "250px",
left: ($(window).width() - 264)/2,
top: $(window).height()/2 })
.appendTo( $.mobile.pageContainer ).delay( 1500 )
			
.fadeOut( 400, function(){
$(this).remove();
});

}




$( "#donuslerGoster" ).live("click", function() {
hepsiniGoster("donus");
});

$( "#gidislerGoster" ).live("click", function() {
hepsiniGoster("gidis");
});

$( "#gidis_donuslerGoster" ).live("click", function() {
hepsiniGoster("gidis");
});


function hepsiniGoster(ucus){
if($("#"+ucus+"lerGoster").prev('.ui-btn-inner').children('.ui-btn-text').html()=="Hepsini Göster"){
$("#"+ucus+"_ucuslar li").show();
$("#"+ucus+"lerGoster").prev('.ui-btn-inner').children('.ui-btn-text').html('Gösterme');
$("#"+ucus+"lerSayfalar").hide();
}
else{
$("#"+ucus+"lerGoster").prev('.ui-btn-inner').children('.ui-btn-text').html('Hepsini Göster');
$("#"+ucus+"lerSayfalar").show();

var liSay, liSayfa;
liSay=$("#"+ucus+"_ucuslar > li").length;
liSayfa=Math.ceil((liSay-1)/gss);
$("#"+ucus+"_ucuslar li").slice(gss+1,liSay).hide();
//alert(ucus+"="+liSay+"="+liSayfa);

$("#"+ucus+"Sayfa .ui-btn-text").html('1/'+liSayfa);
$("#"+ucus+"Onceki").addClass("ui-disabled");
}
$("#"+ucus+"Onceki").button("refresh");
$("#"+ucus+"Sayfa").button("refresh");
$("#"+ucus+"lerGoster").button("refresh");
$("#"+ucus+"lerSayfalar").button("refresh");
}


$( "#donusOnceki" ).live("click", function() {
ucusOnceki("donus");
});

$( "#gidisOnceki" ).live("click", function() {
ucusOnceki("gidis");
});

$( "#gidis_donusOnceki" ).live("click", function() {
ucusOnceki("gidis");
});

function ucusOnceki(ucus){

$("#"+ucus+"Onceki").trigger( "focusout" );	
var dSayfa=$("#"+ucus+"Sayfa .ui-btn-text").html().split("/");
if(dSayfa[0]>1){
$("#"+ucus+"_ucuslar li").hide();
$("#"+ucus+"_ucuslar li:nth-child(1)").show();

var goster1=(dSayfa[0]-2)*gss+1;
var goster2=goster1+gss;
$("#"+ucus+"_ucuslar li").slice(goster1*1,goster2*1).show();

var goster3=dSayfa[0]*1-1;
if(goster3==1){
$("#"+ucus+"Onceki").addClass("ui-disabled");
}

goster3=goster3+"/"+dSayfa[1];
$("#"+ucus+"Sayfa .ui-btn-text").html(goster3);
$("#"+ucus+"Sonraki").removeClass("ui-disabled");
}

}




$( "#donusSonraki" ).live("click", function() {
ucusSonraki("donus");
});

$( "#gidisSonraki" ).live("click", function() {
ucusSonraki("gidis");
});

$( "#gidis_donusSonraki" ).live("click", function() {
ucusSonraki("gidis");
});

function ucusSonraki(ucus){
$("#"+ucus+"Sonraki").trigger( "focusout" );											
var dSayfa=$("#"+ucus+"Sayfa .ui-btn-text").html().split("/");

if(dSayfa[1]*1>dSayfa[0]*1){
$("#"+ucus+"_ucuslar li").hide();	
$("#"+ucus+"_ucuslar li:nth-child(1)").show();
	
var goster1=dSayfa[0]*gss+1;
var goster2=goster1+gss;

var goster3=dSayfa[0]*1+1;
if(goster3==dSayfa[1]){
goster2=$("#"+ucus+"_ucuslar li").length;
$("#"+ucus+"Sonraki").addClass("ui-disabled");
}

//alert(goster1+"-"+goster2);
$("#"+ucus+"_ucuslar li").slice(goster1*1,goster2*1).show();

goster3=goster3+"/"+dSayfa[1];
$("#"+ucus+"Sayfa .ui-btn-text").html(goster3);
$("#"+ucus+"Onceki").removeClass("ui-disabled");
}
}




function sonucSinirla(sonuclar){
var eLen, eSayfa;
eLen=$("#"+sonuclar+"_ucuslar li").length;
eSayfa=Math.ceil((eLen-1)/gss);
$("#"+sonuclar+"_ucuslar li").show();
$("#"+sonuclar+"_ucuslar li").slice(gss+1,eLen).hide();
$("#"+sonuclar+"Sayfa .ui-btn-text").html('1/'+eSayfa);
$("#"+sonuclar+"Onceki").addClass("ui-disabled");
$("#"+sonuclar+"Sonraki").removeClass("ui-disabled");
}
					

function cal(){
/*$( document ).delegate("#sonuclar", "pagebeforecreate", function() {
  alert('A page with an id of "aboutPage" is about to be created by jQuery Mobile!');*/
//alert("cem");
$(document).ready(function(){

var ucus_say;
ucus_say=$('#gidis_ucuslar li').length;
//alert("gidis="+ucus_say);
if(ucus_say>1){		//Yoksa veya bir tane varsa sırlama yapmak için tuşa gerek yok çünkü
$('#gidis_ucuslar').jqmts({
					useNativeMenu: false,
					showCounts: true,
					attributes: {ucret: 'Ücret', aktarma: 'Aktarma', havayolu: 'Havayolu', ucusno:'Uçuş Numarası', kalkiskod: 'Kalkış', variskod: 'Varış', kalkissaat: 'Kalkış Saat', varissaat: 'Varış Saat', sinif: 'Sınıf'}
				});
if(ucus_say>gss) sonucSinirla("gidis");
}
liStyleChanger("gidis");		


ucus_say=$('#donus_ucuslar li').length;
//alert("donus="+ucus_say);
if(ucus_say>1){ 		//Yoksa veya bir tane varsa sırlama yapmak için tuşa gerek yok çünkü
$('#donus_ucuslar').jqmts({
					useNativeMenu: false,
					showCounts: true,
					attributes: {ucret: 'Ücret', aktarma: 'Aktarma', havayolu: 'Havayolu', ucusno:'Uçuş Numarası', kalkiskod: 'Kalkış', variskod: 'Varış', kalkissaat: 'Kalkış Saat', varissaat: 'Varış Saat', sinif: 'Sınıf'}
				});
if(ucus_say>gss) sonucSinirla("donus");
 }		
liStyleChanger("donus");


ucus_say=$('#gidis_donus_ucuslar li').length;
//alert("gidis_donus="+ucus_say);
if(ucus_say>1){ 		//Yoksa veya bir tane varsa sırlama yapmak için tuşa gerek yok çünkü
$('#gidis_donus_ucuslar').jqmts({
					useNativeMenu: false,
					showCounts: true,
					attributes: {ucret: 'Ücret', havayolu: 'Havayolu', sinif: 'Sınıf', gidisaktarma: 'Gidiş Aktarma', gidiskalkissaat: 'Gidiş Kalkış Saat', gidisvarissaat: 'Gidiş Varış Saat', donusaktarma: 'Dönüş Aktarma', donuskalkissaat: 'Dönüş Kalkış Saat', donusvarissaat: 'Dönüş Varış Saat'}
				});	
if(ucus_say>gss) sonucSinirla("gidis_donus");
}
liStyleChanger("gidis_donus");


});
$("#sonuclar").trigger( "create" );
//	alert("cem1004");					  


}

function popupGoster(bilgi){
msgAlert(bilgi+"!");

}

var grVal, drVal;
function toplamHesaplama(radioVal){
//alert("cem toplam");
var rVal;
rVal=radioVal.split("|");
if(rVal[0]=="gidis") grVal=rVal;

if(rVal[0]=="donus") drVal=rVal;

if(grVal && drVal){


//alert(grVal[0]+" "+grVal[1]+" "+grVal[2]+" "+grVal[3]+" "+grVal[4]+" "+drVal[0]+" "+drVal[1]+" "+drVal[2]+" "+drVal[3]+" "+drVal[4]);





//value değerlerindeki durum 
//Firma adı|Biletin herşey dahil fiyatı|Biletleme ücreti|Ücret tipi
//ucuştipi (gidis veya donus)|Sunexpress|84.99|10|TRY


//1000 ile çarpıp bölünerek matematik işlemi sonucu virgül sonrası bol sıfır yazması engelleniyor
//if (radio_gidis_sonuclar[0]==radio_donus_sonuclar[0]){
//if ((radio_gidis_sonuclar[0]==radio_donus_sonuclar[0]) && (radio_gidis_sonuclar[2]==radio_donus_sonuclar[2])){

//gdiş ve dönüş için aynı firma seçildiyse
//THY'nin sitesinden gelen uçuşlarda THY veya Anadolujet veya her ikisi birden yazabiliyor
//Bunu göz önüne alarak ek if şartı uzuyor
if(grVal[1]==drVal[1] || ((grVal[1].indexOf("THY")>0 || grVal[1].indexOf("Anadolujet")>0) && (drVal[1].indexOf("THY")>0 || drVal[1].indexOf("Anadolujet")>0))){

//Aynı firmalar seçildiğinde gidiş veya dönüş için bir biletleme ücreti alınıyor
//THY ve Anadolujet için, busines varsa o, yoksa promosyon, o da yoksa premium olanın biletleme ücreti alınıyor (pahalı olan Busines>Premium>Poromosyon)
//premium ekonomi esnek oldu



var g=parseFloat(grVal[3].replace(",","."));
var d=parseFloat(drVal[3].replace(",","."));
var g0=parseFloat(grVal[2].replace(",","."));
var d0=parseFloat(drVal[2].replace(",","."));
var g1=grVal[2];
var d1=drVal[2];
var g2=grVal[3];
var d2=drVal[3];

//İki biletinde biletleme ücretleri boş geliyorsa
//if (radio_gidis_sonuclar[2]=="" && radio_donus_sonuclar[2]==0){
//var genel_toplam=parseFloat(radio_gidis_sonuclar[1].replace(",","."))*1000+parseFloat(radio_donus_sonuclar[1].replace(",","."))*1000;
//
//genel_toplam=genel_toplam/1000;
//genel_toplam=genel_toplam+" "+radio_gidis_sonuclar[3];
//
//}

if ((g==0 && d>0) || (g>0 && d==0)){
var genel_toplam=parseFloat(grVal[2].replace(",","."))*1000+parseFloat(drVal[2].replace(",","."))*1000;

			/*document.getElementById("toplam4").value="cem"+"|"+g0+"|"+d0+"|"+g+"|"+d;
			document.getElementById("toplam5").value="cem"+"|"+g1+"|"+d1+"|"+g2+"|"+d2;*/
			
genel_toplam=genel_toplam/1000;
genel_toplam=genel_toplam+" "+grVal[4];


}
else{

if (g<d){
	if (grVal[3]==""){
		grVal[3]=drVal[3];
	}
	if (grVal[3]==0){
		drVal[3]=grVal[3];
	}
	if (drVal[3]==0){
		grVal[1]=drVal[3];
	}
	
	
//ücret tipleri aynı ise
	if (grVal[4]==drVal[4]){
		
			/*document.getElementById("toplam4").value="cem"+"|"+g0+"|"+d0+"|"+g+"|"+d;
			document.getElementById("toplam5").value="cem"+"|"+g1+"|"+d1+"|"+g2+"|"+d2;*/
			
var genel_toplam=parseFloat(grVal[2].replace(",","."))*1000+parseFloat(drVal[2].replace(",","."))*1000-parseFloat(drVal[3].replace(",","."))*1000;

genel_toplam=genel_toplam/1000;
genel_toplam=genel_toplam+" "+radio_gidis_sonuclar[3];

	//genel_toplam=genel_toplam+" "+radio_gidis_sonuclar[3];
	}
//ücret tipleri farklı ise
	else{
		/*document.getElementById("toplam4").value="cem2"+"|"+g0+"|"+d0+"|"+g+"|"+d;
		document.getElementById("toplam5").value="cem2"+"|"+g1+"|"+d1+"|"+g2+"|"+d2;*/
	var genel_toplam=grVal[2]+" "+grVal[4]+" + "+	drVal[2]+" "+drVal[4];
	}




}
else{
	//Bazı firmalar için dönüş hizmet bedeli boş geliyor, onu düzeltmek için (Pegasus hariç
	if (drVal[3]=="" && drVal[1].indexOf("Pegasus")==0){
		drVal[3]=grVal[3];
	}
	
//ücret tipleri aynı ise
	if (grVal[4]==drVal[4]){
			/*document.getElementById("toplam4").value="cem3"+"|"+g0+"|"+d0+"|"+g+"|"+d;
			document.getElementById("toplam5").value="cem3"+"|"+g1+"|"+d1+"|"+g2+"|"+d2;*/
var genel_toplam=parseFloat(grVal[2].replace(",","."))*1000+parseFloat(drVal[2].replace(",","."))*1000-parseFloat(grVal[3].replace(",","."))*1000;
	
	genel_toplam=genel_toplam/1000;
genel_toplam=genel_toplam+" "+grVal[4];
	}
//ücret tipleri farklı ise
	else{
			/*document.getElementById("toplam4").value="cem4"+"|"+g0+"|"+d0+"|"+g+"|"+d;
			document.getElementById("toplam5").value="cem4"+"|"+g1+"|"+d1+"|"+g2+"|"+d2;*/
		var genel_toplam=grVal[2]+" "+grVal[4]+" + "+	drVal[2]+" "+drVal[4];
		}

}


//var a=parseFloat(radio_gidis_sonuclar[1].replace(",","."));
//var b=parseFloat(radio_donus_sonuclar[1].replace(",","."));
//var c=parseFloat(radio_gidis_sonuclar[2].replace(",","."));
//var genel_toplam=a+b+c;
//genel_toplam=genel_toplam/1000;
//genel_toplam=genel_toplam+" "+radio_gidis_sonuclar[3];
}

}//if (radio_gidis_sonuclar[2]=="" && radio_donus_sonuclar[2]==0){



//Farklı firmalar ise
else{
//ücret tipleri aynı ise
	if (grVal[4]==drVal[4]){
	var genel_toplam=parseFloat(grVal[2].replace(",","."))+parseFloat(drVal[2].replace(",","."));
	genel_toplam=genel_toplam+" "+grVal[4];
	}
//ücret tipleri farklı ise
	else{
	var genel_toplam=grVal[2]+" "+grVal[4]+" + "+	drVal[2]+" "+drVal[4];
	}
}

/*document.getElementById("sonuclar_toplam1").style.display = "";
document.getElementById("sonuclar_toplam2").style.display = "";
document.getElementById("sonuclar_toplam3").style.display = "";*/

$("#toplam_ucret").text();

//noktalı ve noktasız sayıların toplanması sonucu oluşan bol sıfırların engellenmesi için
if(genel_toplam.indexOf(".") != -1) {
genel_toplam = genel_toplam.substring(0,(genel_toplam.indexOf(".") + 3));
} 
genel_toplam="Toplam : "+genel_toplam;//+" "+grVal[4]
$("#toplam_ucret").text(genel_toplam);








}

//if($("#donus_fieldset input[type='radio']:checked").val()) donus=$("#donus_fieldset input[type='radio']:checked").val();
//
//alert(gidis+"-"+donus);
}


function liStyleChanger(sonuclar){
//sonuclar = gidis, donus veya gidis_donus olabilir
//id'si   gidis_ucuslar, donus_ucucslar, gidis_donus_ucuslar  olan ul'lerin stilleri değiştirilecek
//alert("cem listyle = "+sonuclar);
var liStil= [];

if(sonuclar=="gidis"){
liStil[0]="c";
liStil[1]="f";
}
else if(sonuclar=="donus"){
liStil[0]="c";
liStil[1]="d";
}
else if(sonuclar=="gidis_donus"){
liStil[0]="d";
liStil[1]="f";
}
//alert("cem listyle2");



$("#"+sonuclar+"_ucuslar li").removeClass("ui-btn-up-c ui-btn-up-d ui-btn-up-f ui-corner-top ui-corner-bottom ui-li-last");

$("#"+sonuclar+"_ucuslar li:nth-child(odd)").addClass("ui-btn-up-"+liStil[0]);
$("#"+sonuclar+"_ucuslar li:nth-child(even)").addClass("ui-btn-up-"+liStil[1]);
$("#"+sonuclar+"_ucuslar li:nth-child(0)").addClass("ui-corner-top");
$("#"+sonuclar+"_ucuslar li:last-child ").addClass("ui-corner-bottom ui-li-last");

//alert("cem listyle3");
$("#"+sonuclar+"_ucuslar li:nth-child(odd)").attr('data-theme', liStil[0]);
//alert("cem listyle4");
$("#"+sonuclar+"_ucuslar li:nth-child(even)").attr('data-theme', liStil[1]);


//alert("cem listyle5");
}

function hy_degistir(id, deger){
var deger2=false;
if(deger=="checked") deger2=true;

$("#"+id).attr("checked", deger2).checkboxradio("refresh");

/*alert("deger2="+deger);
if(deger=="checked"){
if($("#"+id).attr("checked")!=deger){
$("#"+id).attr("checked", true).checkboxradio("refresh");
}
}
else{
if($("#"+id).attr("checked")){
$("#"+id).attr("checked", false).checkboxradio("refresh");
}
}

alert("cem deger");*/
}

function hy_turkey_degis(deger){
var deger2=false;
if(deger=="checked") deger2=true;

$("#atlasjet").attr("checked", deger2).checkboxradio("refresh");
$("#borajet").attr("checked", deger2).checkboxradio("refresh");
$("#onurair").attr("checked", deger2).checkboxradio("refresh");
$("#pegasus").attr("checked", deger2).checkboxradio("refresh");
$("#sunexpress").attr("checked", deger2).checkboxradio("refresh");
$("#turkish_airlines").attr("checked", deger2).checkboxradio("refresh");

}



function hy_kontrol(){
	//alert("kontrol1");
var hy_hepsi=true, hy_turkey=true;
	//alert("kontrol2");
	
//Türkiye havayolları kısmı
if(!$("#atlasjet").attr("checked")) hy_turkey=false;
if(!$("#borajet").attr("checked")) hy_turkey=false;
if(!$("#onurair").attr("checked")) hy_turkey=false;
if(!$("#pegasus").attr("checked")) hy_turkey=false;
if(!$("#sunexpress").attr("checked")) hy_turkey=false;
if(!$("#turkish_airlines").attr("checked")) hy_turkey=false;

if(hy_turkey==false) hy_hepsi=false;
$("#hy_turkey").attr("checked", hy_turkey).checkboxradio("refresh");
$("#hy_hepsi").attr("checked", hy_hepsi).checkboxradio("refresh");

}







$(document).ready(function(){



$("#atlasjet").live("change", function() {
hy_kontrol();									  
});

$("#borajet").live("change", function() {
hy_kontrol();									  
});

$("#onurair").live("change", function() {
hy_kontrol();									  
});

$("#pegasus").live("change", function() {
hy_kontrol();									  
});

$("#sunexpress").live("change", function() {
hy_kontrol();									  
});

$("#turkish_airlines").live("change", function() {
hy_kontrol();									  
});




$("#hy_hepsi").live("change", function() {
deger=$("#hy_hepsi").attr("checked");
//alert("deger="+deger);
hy_turkey_degis(deger);
hy_kontrol();
//hy_degistir("atlasjet", deger);
});

$("#hy_turkey").live("change", function() {
deger=$("#hy_turkey").attr("checked");
hy_turkey_degis(deger);	//O ülke için hazırlanacak kod
hy_kontrol();
});


});


function ara2(){
var a, b;
a=$("#hy_hepsi").attr("checked");
//b=$("#hy_hepsi").parent().children("label").children("span").children("span").eq(1).attr("class");
//alert("hepsi="+a+"-"+b);

if(a=="checked"){
//alert("checked ok");
$("#hy_hepsi").attr("checked", false).checkboxradio("refresh");

//$("#hy_hepsi input[type='checkbox']:first").attr("checked",true).checkboxradio("refresh");


//$("#hy_hepsi").parent().children("label").removeClass("ui-checkbox-on ui-checkbox-off");
//$("#hy_hepsi").parent().children("label").addClass("ui-checkbox-on");
//$("#hy_hepsi").parent().children("label").attr("data-icon", "checkbox-off");


//$("#hy_hepsi").parent().children("label").children("span").children("span").eq(1).removeClass("ui-icon-checkbox-on ui-icon-checkbox-off");
//$("#hy_hepsi").parent().children("label").children("span").children("span").eq(1).addClass("ui-icon-checkbox-on");
}
else{
$("#hy_hepsi").attr('checked', true).checkboxradio("refresh");
//document.getElementById("hy_hepsi").setAttribute("checked", "checked");
//alert("not checked");

//$("#hy_hepsi").parent().children("label").removeClass("ui-checkbox-on ui-checkbox-off");
//$("#hy_hepsi").parent().children("label").addClass("ui-checkbox-off");
//$("#hy_hepsi").parent().children("label").attr("data-icon", "checkbox-on");

//$("#hy_hepsi").parent().children("label").children("span").children("span").eq(1).removeClass("ui-icon-checkbox-on ui-icon-checkbox-off");
//$("#hy_hepsi").parent().children("label").children("span").children("span").eq(1).addClass("ui-icon-checkbox-off");

}

//$('#hy_hepsi').parent().children("label").trigger("click");
//$('#secenekler').trigger("create");
}


</script>
</head> 
<body id="body"> 



<!-- /Sayfa başlangıcı -->   
<div data-role="page" id="ana_sayfa">

<div data-role="header" data-theme="b" data-position="fixed">
<h1 style="background:url(logo_ozgurceuc.png); background-position:bottom; background-repeat:no-repeat; color:#00F; padding-bottom:22px; padding-top:0px;">www.<font size="+1">ozgurceuc</font>.com</h1>
        
<div data-role="navbar" data-iconpos="left">
<ul>
<li><a href="#ana_sayfa" data-icon="home" data-theme="a">Ana</a></li>
<li><a href="#secenekler" data-icon="search" data-theme="b">Arama</a></li>   
<li><a href="#sonuclar" data-icon="grid" data-theme="b">Sonuçlar</a></li>
</ul>
</div><!-- /navbar -->   
</div><!-- /header -->
    
<br><br><br>
<div data-role="content" id="ana_sayfa_icerik">

<div class="ui-bar ui-bar-d ui-corner-all">
Bu uygulama, www.ozgurceuc.com sitesinin sunduğu uçuş arama hizmetini mobil olarak kullanabilmenizi sağlamak amacıyla hazırlanmıştır. 
</div>



<div class="content-primary">
<a href="#ana_sayfa" data-role="button" data-icon="home" data-theme="d">Ana Sayfa</a>
<a href="#secenekler" data-role="button" data-icon="search" data-theme="d">Arama Sayfası</a>
<a href="#sonuclar" data-role="button" data-icon="grid" data-theme="d">Sonuçlar Sayfası</a>
</div>

<div class="ui-bar ui-bar-d ui-corner-all">
Bu uygulama; www.ozgurceuc.com sunduğu bir hizmettir. İnternet bağlantısı gerektirmektedir.
</div>



</div><!-- /content -->

<div data-role="footer" data-position="fixed"  data-theme="b"> 
	<h4>Beta versiyon</h4> 
</div> 

</div><!-- /page -->















<!-- /Sayfa başlangıcı -->   
<div data-role="page" id="secenekler">

<div data-role="header" data-theme="b" data-position="fixed">
<h1 style="background:url(logo_ozgurceuc.png); background-position:bottom; background-repeat:no-repeat; color:#00F; padding-bottom:22px; padding-top:0px;">www.<font size="+1">ozgurceuc</font>.com</h1>

<div data-role="navbar" data-iconpos="left">
<ul>
<li><a href="#ana_sayfa" data-icon="home" data-theme="b">Ana</a></li>
<li><a href="#secenekler" data-icon="search" data-theme="a">Arama</a></li>   
<li><a href="#sonuclar" data-icon="grid" data-theme="b">Sonuçlar</a></li>
</ul>
</div><!-- /navbar -->
</div><!-- /header -->

<br><br><br>

<div data-role="content" data-theme="b">	
   
<div class="ui-bar ui-bar-b ui-corner-all" align="center">
<fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" >

<input type="radio" name="fly" id="fly_single" value="1" />
<label for="fly_single">Sadece Gidiş</label>

<input type="radio" name="fly" id="fly_return" value="2" checked="checked" />
<label for="fly_return">Gidiş-Dönüş</label>

</fieldset>
</div>

<br>

<div class="ui-bar ui-bar-b ui-corner-all">
<h3>Nereden</h3>
<select name="airport_from_country" id="airport_from_country" data-mini="true">
<option value="0">Bir Ülke Seçiniz</option>
</select>

<select name="airport_from" id="airport_from" data-mini="true">
<option value="0">Bir Havaalanı Seçiniz</option>
<option value="1">İstanbul Atatürk (IST)</option>
<option value="2">İstanbul Sabiha Gökçen (SAW)</option>
</select>
</div>


<br>


<div class="ui-bar ui-bar-b ui-corner-all">
<h3>Nereye</h3>
<select name="airport_to_country" id="airport_to_country" data-mini="true">
<option value="0">Bir Ülke Seçiniz</option>
</select>

<select name="airport_to" id="airport_to" data-mini="true">
<option value="0">Bir Havaalanı Seçiniz</option>
<option value="1">İstanbul Atatürk (IST)</option>
<option value="2">İstanbul Sabiha Gökçen (SAW)</option>
</select> 
</div>

<br>

<div class="ui-bar ui-bar-b ui-corner-all">
<h3>Gidiş Tarihi</h3>
<input type="date" name="date_from" data-mini="true" id="date_from" value="" />
</div>

<br>

<div class="ui-bar ui-bar-b ui-corner-all" id="return">
<h3>Dönüş Tarihi</h3>
<input type="date" name="date_to" id="date_to" value=""  />
</div>

<div data-role="collapsible" data-content-theme="b">
<h3>Diğer Seçenekler</h3>

<div data-role="collapsible" data-content-theme="b">
<h3>Yolcular</h3>

<div class="ui-grid-b">

<div class="ui-block-b">
<label for="adult" class="select">Yetişkin:</label>
<select name="adult" id="adult" data-mini="true" data-native-menu="false" data-overlay-theme="c">
<option value="0">0</option>
<option value="1" selected="selected">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select> 
</div>


<div class="ui-block-b">
<label for="child" class="select">Çocuk:</label>
<select name="child" id="child" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>


<div class="ui-block-b">
<label for="infant" class="select">Bebek:</label>
<select name="infant" id="infant" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>


<div class="ui-block-b">
<label for="yolcular0" class="select" data-native-menu="false">60+:</label>
<select name="yolcular0" id="yolcular0" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>


<div class="ui-block-b">
<label for="yolcular1" class="select">65+:</label>
<select name="yolcular1" id="yolcular1" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>


<div class="ui-block-b">
<label for="yolcular5" class="select">Genç:</label>
<select name="yolcular5" id="yolcular5" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>




<div class="ui-block-b">
<label for="yolcular2" class="select">Öğrenci:</label>
<select name="yolcular2" id="yolcular2" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>




<div class="ui-block-b">
<label for="yolcular3" class="select">Asker:</label>
<select name="yolcular3" id="yolcular3" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>




<div class="ui-block-b">
<label for="yolcular4" class="select">Denizci:</label>
<select name="yolcular4" id="yolcular4" data-mini="true" data-native-menu="false">
<option value="0" selected="selected">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</div>

</div><!-- /grid -->

</div>




<div data-role="collapsible" data-content-theme="b">
<!--	<div class="ui-bar ui-bar-b ui-corner-all">-->
<h3>Havayolları</h3>
<label><input type="checkbox" name="hy_hepsi" id="hy_hepsi" checked="checked" />Hepsi</label>

<div class="ui-bar ui-bar-b ui-corner-all">
<label><input type="checkbox" name="hy_turkey" id="hy_turkey" checked="checked" />Türkiye</label>

<div data-role="collapsible" data-content-theme="b">
<h3>Türkiye</h3>
<label><input type="checkbox" name="atlasjet" id="atlasjet" value="atlasjet" checked="checked" />Atlasjet</label>
<label><input type="checkbox" name="borajet" id="borajet" checked="checked" />Borajet</label>
<label><input type="checkbox" name="onurair" id="onurair" checked="checked" />Onurair</label>
<label><input type="checkbox" name="pegasus" id="pegasus" checked="checked" />Pegasus</label>
<label><input type="checkbox" name="sunexpress" id="sunexpress" checked="checked" />Sunexpress</label>
<label><input type="checkbox" name="turkish_airlines" id="turkish_airlines" checked="checked" />THY/Anadolujet</label>
</div>
</div>

</div>




<div class="ui-bar ui-bar-b ui-corner-all">
<h3>Sınıf</h3>
<select name="kabin" id="kabin" data-mini="true">
<option value="ekonomi" selected="selected" >Ekonomi</option>
<option value="premium">Premium</option>
<option value="business">Business</option>
<option value="first">First Class</option>
</select>
</div>

<br>

<div class="ui-bar ui-bar-b ui-corner-all">
<h3>Para Birimi</h3>
<select name="para" id="para" data-mini="true">
<option value="EUR">EUR</option>
<option value="TRY" selected="selected" >TRY</option>
<option value="USD">USD</option>
</select>
</div>

</div>



<a href="#" data-role="button" data-icon="star" data-theme="b" onClick="ara();">Ara</a>		


</div><!-- /content -->

<div data-role="footer" data-position="fixed"  data-theme="b"> 
	<h4>Beta versiyon</h4> 
</div> 

</div><!-- /page -->























<!-- /Sayfa başlangıcı -->   
<div data-role="page" id="sonuclar">

<div data-role="header" data-theme="b" data-position="fixed">
<h1 style="background:url(logo_ozgurceuc.png); background-position:bottom; background-repeat:no-repeat; color:#00F; padding-bottom:22px; padding-top:0px;">www.<font size="+1">ozgurceuc</font>.com</h1>

<div data-role="navbar" data-iconpos="left">
<ul>
<li><a href="#ana_sayfa" data-icon="home" data-theme="b">Ana</a></li>
<li><a href="#secenekler" data-icon="search" data-theme="b">Arama</a></li>   
<li><a href="#sonuclar" data-icon="grid" data-theme="a">Sonuçlar</a></li>
</ul>
</div><!-- /navbar -->        
</div><!-- /header -->

<br><br><br>

<div data-role="content" id="sonuclar_content">

<div>

<ul class="ui-listview" data-role="listview" id="arama_sonuclar">
	
    <li class="ui-li" data-theme="f" data-wrapperels="div" data-shadow="false" data-corners="false" style="text-align:center"><br><br>Henüz hiç bir uçuş araması gerçekleştirmediniz!
    </li>
    
    <li class="ui-li" data-theme="f" data-wrapperels="div" data-shadow="false" data-corners="false" style="text-align:center"><br>Uçuş aramasını Arama sayfasından gerçekleştirbilirsiniz.
    </li>

</ul>


</div>







</div><!-- /content -->

<div data-role="footer" data-position="fixed" data-theme="b"> 
	<h4 id="toplam_ucret">Beta versiyon</h4> 
</div> 


</div><!-- /page -->

</body>
</html>

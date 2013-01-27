/*
* jQuery Mobile Framework : temporary extension to port jQuery UI's datepicker for mobile
* Copyright (c) jQuery Project
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://jquery.org/license
*Degisiklik yaptim, d�zeltmeler var, istedigim gibi �alismiyordu
*
*D�zeltme 1
*�ok sayfali (multipage) durumda, sayfalardan birinden digerine ge�iste
*datepicker'in kopyasini olusturuyordu, d�zeltmeyi internetten bulup ekledim
*
*D�zeltme 2
*Takvimin disindaki (yaninda) bir yere veya ay ve yilin yazili oldugu kisma tiklayinca
*takvimi bosaltiyordu (tarihleri siliyordu)
*Sorunun yerini belirleyip, kendim d�zetlme kodu ekledim
*
*D�zeltme 3
*Normalde bu satir var. Ancak minDate tanimlandiginda sorun yaratiyor.
*mindate'ten k���k aylara ge�is yerine, sayfa degistiriyor.
*�ikarinca herhangi bir sorunla karsilasmadim.
*/
(function($, undefined ) {
		  
	//cache previous datepicker ui method
	var prevDp = $.fn.datepicker;
	
	//rewrite datepicker
	$.fn.datepicker = function( options ){
		
		var dp = this;
	
		//call cached datepicker plugin
		prevDp.call( this, options );
		
		//extend with some dom manipulation to update the markup for jQM
		//call immediately
		function updateDatepicker(){
			$( ".ui-datepicker-header", dp ).addClass("ui-body-c ui-corner-top").removeClass("ui-corner-all");
			
			//D�zeltme 3 		Normalde bu satir var
			//$( ".ui-datepicker-prev, .ui-datepicker-next", dp ).attr("href", "#");

			$( ".ui-datepicker-prev", dp ).buttonMarkup({iconpos: "notext", icon: "arrow-l", shadow: true, corners: true});

			$( ".ui-datepicker-next", dp ).buttonMarkup({iconpos: "notext", icon: "arrow-r", shadow: true, corners: true});

			$( ".ui-datepicker-calendar th", dp ).addClass("ui-bar-c");
			$( ".ui-datepicker-calendar td", dp ).addClass("ui-body-c");
			$( ".ui-datepicker-calendar a", dp ).buttonMarkup({corners: false, shadow: false}); 
			$( ".ui-datepicker-calendar a.ui-state-active", dp ).addClass("ui-btn-active"); // selected date
			$( ".ui-datepicker-calendar a.ui-state-highlight", dp ).addClass("ui-btn-up-e"); // today"s date

	        $( ".ui-datepicker-calendar .ui-btn", dp ).each(function(){
				var el = $(this);
				// remove extra button markup - necessary for date value to be interpreted correctly		
				//D�zeltme 2
				//Bu if olmazsa hatali �alisiyor.
				if(el.find( ".ui-btn-text" ).text()){
				el.html( el.find( ".ui-btn-text" ).text() ); 
				}
				
	        });
			
		};
		
		//update now
		updateDatepicker();
		
		// and on click
		$( dp ).click( updateDatepicker );
		
		//return jqm obj 
		return this;
	};
	
	
//D�zeltme 1
//Bu d�zeltme ile �ok sayfali (multi page) durumda, sayfalar arasinda ge�iste datepicker'larin kopya olusturmasi engellenmis oluyor. 
	$( ".ui-page" ).live( "pagecreate", function(){     
    $( "input[type='date'], input[data-type='date']" ).each(function(){
        if ($(this).hasClass("hasDatepicker") == false) {
            $(this).after( $( "<div />" ).datepicker({ altField: "#" + $(this).attr( "id" ), showOtherMonths: true }) );
            $(this).addClass("hasDatepicker");
        }
    }); 
});
	
	//bind to pagecreate to automatically enhance date inputs	
	/*$( ".ui-page" ).live( "pagecreate", function(){		
		$( "input[type='date'], input:jqmData(type='date')" ).each(function(){
			$(this).after( $( "<div />" ).datepicker({ altField: "#" + $(this).attr( "id" ), showOtherMonths: true }) );
		});	
	});*/
//
	
})( jQuery );
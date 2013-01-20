/*
 * jquery.jqmts
 * https://github.com/commadelimited/jquery.jqmts.js
 * Version: 0.5
 * 
 * Copyright (c) 2012 andy matthews
 * Licensed under the MIT license.
 * Packed with: http://jsutility.pjoneil.net/
 */
(function($, window) {
	"use strict";
//alert("cem1");
	var defaults = {
		useNativeMenu: false,
		attributes: {},
		showCounts: true,
		className: 'jqmts'
	},
	buildMenu = function($el, options) {
		//alert("cem2");
		// build out the select menu
		var $select = $('<li></li>').addClass(options.className)
						.prepend(
							$('<select></select>')
							.attr(
								{'id': $el.attr('id') + '-sort'}
							)
							.data('native-menu',options.useNativeMenu)
							.html(function(){
								var str = [];
								for (var o in options.attributes) {
									str.push('<option value="' + o + '">' + options.attributes[o] + '</option>');
								}
								return str.join('');
							}).on('change', function(e){
								$('li:not(.' + options.className + ')',$el).tsort({data: 'sort-' + e.currentTarget.value});
							})
						);
		// insert it
		$el.prepend( $select ).trigger('create').listview('refresh');
		//alert("cem2_1");
	},
	compileKeys = function($el, options) {
		//alert("cem3");
		var $list = $('li:not(.' + options.className + ')',$el);
		var $dropdown = $('#' + $el.attr('id') + '-sort');
		var scope = window;

		// populate counts for the sort dropdown
		$list.each(function(i,el){
			var $li = $(this);
			for (var d in $li.data()) {
				// we only want items prepended with "sort"
				if (d.indexOf('sort') >= 0) {
					// make sure the item doesn't already exist
					if (!scope[d]) {
						// if it doesn't, then create it
						scope[d] = {};
						// make sure that the sortKeys variable exists
						if (typeof scope.sortKeys == "undefined") scope.sortKeys = {};
						// then populate it
						scope.sortKeys[d] = d;
					} else {
						// if it does then populate it
						scope[d][$li.data(d)] = $li.data(d);
					}
				}
			}
		});
//alert("cem3_2");
		// if there are no stream items then sortKeys is undefined
		if (typeof scope.sortKeys != "undefined") {
			//alert("cem3_4");
			for(var s in scope.sortKeys) {
				//alert("cem3_5");
				var prep = s.toLowerCase().replace('sort','');
				//alert("prep="+prep);
				$('option[value=' + prep + ']',$dropdown).text(function(i,old){
					//alert("cem3_6");
					
					var value = $(this).val();
					//alert("value="+value);
					//alert("old="+old);
					//alert("s="+s);
					//alert("scope="+scope[s]);
					
					//alert("length="+Object.keys(scope[s]).length);
					//alert("object="+Object);
					//object=function Object() {
				    //[native code]
					//}
					//alert("oksl="+Object.keys(scope[s]));
					//var c1=old + ' (' + Object.keys(scope[s]).length + ')';
					//alert("c1="+c1);
					//return old + ' (' + Object.keys(scope[s]).length + ')';
					//return false;
					return old;
				});
			}
			//alert("cem3_3");
			$dropdown.selectmenu('refresh');
		}
		//alert("cem4");
	},
	methods = {
		init: function(options) {
			//alert("cem5");
			// enforce hard dependancy on TinySort
			if (typeof window.jQuery.tinysort != 'object') {
				window.alert('TinySort is not defined.\nhttp://tinysort.sjeiti.com/');
				return;
			}
			this.jqmData("jqmts", $.extend({}, defaults, options));
			buildMenu(this,this.jqmData("jqmts"));
			if (options.showCounts) compileKeys(this,this.jqmData("jqmts"));
			//alert("cem6");
			return this;
		}
	};

	$.fn.jqmts = function(method) {
		//alert("cem7");
		//alert(this.selector);
		//alert(method[0]);
		if (methods[method]) {
			//alert("cem7_1");
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			//alert("cem7_2");
			return methods.init.apply(this, arguments);
		}
		//alert("cem8");
	};
	
	
	//alert("cem9");
})(jQuery, window);
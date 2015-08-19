/* global $ */

$(document).ready(function(){
	'use strict';

	$('input[name=confirmar_email], input[name=confirmar_senha]').bind('paste',function(e) {
    	e.preventDefault();
  	});

});
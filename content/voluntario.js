/* global $ */

$(document).ready(function () {

	'use strict';

	$('form').submit(function (ev) {

		var valid = false;
		$('input[type=checkbox]').each(function (index, el) {
			valid = el.checked || valid;
		});

		if (!valid) {
			window.alert('Atenção: selecione ao menos um turno!');
			ev.preventDefault();
		}
	});

});
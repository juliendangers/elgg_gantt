/* http://keith-wood.name/datepick.html
   Estonian localisation for jQuery Datepicker.
   Written by Mart Sõmermaa (mrts.pydev at gmail com). */ 
(function($) {
	$.datepicker.regional['et'] = {
		monthNames: ['Jaanuar','Veebruar','Märts','Aprill','Mai','Juuni', 
			'Juuli','August','September','Oktoober','November','Detsember'],
		monthNamesShort: ['Jaan', 'Veebr', 'Märts', 'Apr', 'Mai', 'Juuni',
			'Juuli', 'Aug', 'Sept', 'Okt', 'Nov', 'Dets'],
		dayNames: ['Pühapäev', 'Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev'],
		dayNamesShort: ['Pühap', 'Esmasp', 'Teisip', 'Kolmap', 'Neljap', 'Reede', 'Laup'],
		dayNamesMin: ['P','E','T','K','N','R','L'],
		dateFormat: 'dd.mm.yyyy', firstDay: 1,
		renderer: $.datepicker.defaultRenderer,
		prevText: 'Eelnev', prevStatus: '',
		prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
		nextText: 'Järgnev', nextStatus: '',
		nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
		currentText: 'Täna', currentStatus: '',
		todayText: 'Täna', todayStatus: '',
		clearText: '', clearStatus: '',
		closeText: 'Sulge', closeStatus: '',
		yearStatus: '', monthStatus: '',
		weekText: 'Sm', weekStatus: '',
		dayStatus: '', defaultStatus: '',
		isRTL: false
	};
	$.datepicker.setDefaults($.datepicker.regional['et']);
})(jQuery);

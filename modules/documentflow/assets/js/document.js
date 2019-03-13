$('#datepicker_from input').datepicker({
	  format: 'yyyy-mm-dd',
	  orientation: 'bottom left',
	  inline: false,
	  sideBySide: false,
	  showWeekDays: false
  	}).on('changeDate',function(e) {
});
$('#datepicker_to input').datepicker({
	  format: 'yyyy-mm-dd',
	  orientation: 'bottom left',
	  inline: false,
	  sideBySide: false,
	  showWeekDays: false
  	}).on('changeDate',function(e) {
});
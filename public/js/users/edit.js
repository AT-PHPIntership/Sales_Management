$('#avatarInput').change( function(event) {
  var tmppath = URL.createObjectURL(event.target.files[0]);
  $('.my-avatar-preview').fadeIn('fast').attr('src',URL.createObjectURL(event.target.files[0]));
});

$('#avatarInput').change( function(event) {
  var tmppath = URL.createObjectURL(event.target.files[0]);
  $('.my-avatar-preview').fadeIn('fast').attr('src',URL.createObjectURL(event.target.files[0]));
});


$(function() {
  $('#birthday').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    endDate: '+0d',
    locale: {
      format : dateFormat
    }
  }, 
  function(start, end, label) {
    var years = moment().diff(start, 'years');
  });
});

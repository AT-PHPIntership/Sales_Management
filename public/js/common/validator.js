// Override validate message
validator.message.min = errorMessages.min_6;
validator.message.max = errorMessages.max_32;
validator.message.date = errorMessages.invalid_date;
validator.message.email = errorMessages.invalid_email;
validator.message.empty = errorMessages.field_required;
validator.message.select = errorMessages.select_option;
validator.message.complete = errorMessages.at_least_2_words;
validator.message.password_repeat = errorMessages.passwords_not_match;

// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
$('.form-validate')
  .on('blur', 'input[required], input.optional, select.required', validator.checkField)
  .on('change', 'select.required', validator.checkField)
  .on('keypress', 'input[required][pattern]', validator.keypress);

$('.multi.required').on('keyup blur', 'input', function() {
  validator.checkField.apply($(this).siblings().last()[0]);
});

$('.form-validate').submit(function(e) {
  e.preventDefault();
  var submit = true;

  // evaluate the form using generic validaing
  if (!validator.checkAll($(this))) {
    submit = false;
  }

  if (submit)
    this.submit();

  return false;
});

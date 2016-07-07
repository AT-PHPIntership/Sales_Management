@extends('layouts.app')
@section('page-title')
  Add Staff
@stop

@push('scripts')
  <!-- Bootstrap -->
  <link href="bower_resources/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="bower_resources/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="bower_resources/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-wysiwyg -->
  <link href="bower_resources/gentelella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="bower_resources/gentelella/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="bower_resources/gentelella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- starrr -->
  <link href="bower_resources/gentelella/vendors/starrr/dist/starrr.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="bower_resources/gentelella/build/css/custom.min.css" rel="stylesheet">
@endpush

@section('section-title')
  Create a new account
@stop

@section('page-content')
  <div class="x_content">

    <form class="form-horizontal form-label-left" novalidate>

      <p>Fill out the these fields to create a new account.</a>
      </p>
      <span class="section">Account Info</span>

      <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
        </div>
      </div>
      <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="item form-group">
        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
        </div>
      </div>
      <div class="item form-group">
        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Permission <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <select class="form-control">
            <option value="1">Manager Account</option>
            <option value="0">Staff Account</option>
          </select>
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
          <button type="submit" class="btn btn-primary">Cancel</button>
          <button id="send" type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div>
@stop

@push('end-page-scripts')
<!-- jQuery -->
<script src="bower_resources/gentelella/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="bower_resources/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_resources/gentelella/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="bower_resources/gentelella/vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="bower_resources/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="bower_resources/gentelella/vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<script src="js/datepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="bower_resources/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="bower_resources/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="bower_resources/gentelella/vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="bower_resources/gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="bower_resources/gentelella/vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="bower_resources/gentelella/vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="bower_resources/gentelella/vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="bower_resources/gentelella/vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="bower_resources/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="bower_resources/gentelella/vendors/starrr/dist/starrr.js"></script>

<!-- Custom Theme Scripts -->
<script src="bower_resources/gentelella/build/js/custom.min.js"></script>

<!-- bootstrap-daterangepicker -->
<script>
  $(document).ready(function() {
    $('#birthday').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_4"
    }, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
    });
  });
</script>
<!-- /bootstrap-daterangepicker -->

<!-- bootstrap-wysiwyg -->
<script>
  $(document).ready(function() {
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
          'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
          'Times New Roman', 'Verdana'
        ],
        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function(idx, fontName) {
        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
      });
      $('a[title]').tooltip({
        container: 'body'
      });
      $('.dropdown-menu input').click(function() {
          return false;
        })
        .change(function() {
          $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
        })
        .keydown('esc', function() {
          this.value = '';
          $(this).change();
        });

      $('[data-role=magic-overlay]').each(function() {
        var overlay = $(this),
          target = $(overlay.data('target'));
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });

      if ("onwebkitspeechchange" in document.createElement("input")) {
        var editorOffset = $('#editor').offset();

        $('.voiceBtn').css('position', 'absolute').offset({
          top: editorOffset.top,
          left: editorOffset.left + $('#editor').innerWidth() - 35
        });
      } else {
        $('.voiceBtn').hide();
      }
    }

    function showErrorAlert(reason, detail) {
      var msg = '';
      if (reason === 'unsupported-file-type') {
        msg = "Unsupported format " + detail;
      } else {
        console.log("error uploading file", reason, detail);
      }
      $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
    }

    initToolbarBootstrapBindings();

    $('#editor').wysiwyg({
      fileUploadError: showErrorAlert
    });

    window.prettyPrint;
    prettyPrint();
  });
</script>
<!-- /bootstrap-wysiwyg -->

<!-- Select2 -->
<script>
  $(document).ready(function() {
    $(".select2_single").select2({
      placeholder: "Select a state",
      allowClear: true
    });
    $(".select2_group").select2({});
    $(".select2_multiple").select2({
      maximumSelectionLength: 4,
      placeholder: "With Max Selection limit 4",
      allowClear: true
    });
  });
</script>
<!-- /Select2 -->

<!-- jQuery Tags Input -->
<script>
  function onAddTag(tag) {
    alert("Added a tag: " + tag);
  }

  function onRemoveTag(tag) {
    alert("Removed a tag: " + tag);
  }

  function onChangeTag(input, tag) {
    alert("Changed a tag: " + tag);
  }

  $(document).ready(function() {
    $('#tags_1').tagsInput({
      width: 'auto'
    });
  });
</script>
<!-- /jQuery Tags Input -->

<!-- Parsley -->
<script>
  $(document).ready(function() {
    $.listen('parsley:field:validate', function() {
      validateFront();
    });
    $('#demo-form .btn').on('click', function() {
      $('#demo-form').parsley().validate();
      validateFront();
    });
    var validateFront = function() {
      if (true === $('#demo-form').parsley().isValid()) {
        $('.bs-callout-info').removeClass('hidden');
        $('.bs-callout-warning').addClass('hidden');
      } else {
        $('.bs-callout-info').addClass('hidden');
        $('.bs-callout-warning').removeClass('hidden');
      }
    };
  });

  $(document).ready(function() {
    $.listen('parsley:field:validate', function() {
      validateFront();
    });
    $('#demo-form2 .btn').on('click', function() {
      $('#demo-form2').parsley().validate();
      validateFront();
    });
    var validateFront = function() {
      if (true === $('#demo-form2').parsley().isValid()) {
        $('.bs-callout-info').removeClass('hidden');
        $('.bs-callout-warning').addClass('hidden');
      } else {
        $('.bs-callout-info').addClass('hidden');
        $('.bs-callout-warning').removeClass('hidden');
      }
    };
  });
  try {
    hljs.initHighlightingOnLoad();
  } catch (err) {}
</script>
<!-- /Parsley -->

<!-- Autosize -->
<script>
  $(document).ready(function() {
    autosize($('.resizable_textarea'));
  });
</script>
<!-- /Autosize -->

<!-- jQuery autocomplete -->
<script>
  $(document).ready(function() {
    var countries = { AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barthélemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"Réunion",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tomé and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region" };

    var countriesArray = $.map(countries, function(value, key) {
      return {
        value: value,
        data: key
      };
    });

    // initialize autocomplete with custom appendTo
    $('#autocomplete-custom-append').autocomplete({
      lookup: countriesArray,
      appendTo: '#autocomplete-container'
    });
  });
</script>
<!-- /jQuery autocomplete -->

<!-- Starrr -->
<script>
  $(document).ready(function() {
    $(".stars").starrr();

    $('.stars-existing').starrr({
      rating: 4
    });

    $('.stars').on('starrr:change', function (e, value) {
      $('.stars-count').html(value);
    });

    $('.stars-existing').on('starrr:change', function (e, value) {
      $('.stars-count-existing').html(value);
    });
  });
</script>
<!-- /Starrr -->
@endpush

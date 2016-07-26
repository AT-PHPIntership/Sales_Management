<!-- Datatables -->
  $(document).ready(function() {
    var handleDataTableButtonsBills = function() {
      if ($("#bills-datatable-buttons").length) {
        $("#bills-datatable-buttons").DataTable({
          dom: "Bfrtip",
          buttons: [
            {
              extend: language.btn_copy,
              className: "btn-sm"
            },
            {
              extend: language.btn_csv,
              className: "btn-sm"
            },
            {
              extend: language.btn_excel,
              className: "btn-sm"
            },
            {
              extend: language.btn_pdf,
              className: "btn-sm"
            },
            {
              extend: language.btn_print,
              className: "btn-sm"
            },
          ],
          responsive: true,
          "order": [[ 4, "desc" ]]
        });
      }
    };

    TableManageButtons = function() {
      "use strict";
      return {
        init: function() {
          handleDataTableButtonsBills();
        }
      };
    }();

    TableManageButtons.init();

    var handleDataTableButtonsOrders = function() {
      if ($("#orders-datatable-buttons").length) {
        $("#orders-datatable-buttons").DataTable({
          dom: "Bfrtip",
          buttons: [
            {
              extend: language.btn_copy,
              className: "btn-sm"
            },
            {
              extend: language.btn_csv,
              className: "btn-sm"
            },
            {
              extend: language.btn_excel,
              className: "btn-sm"
            },
            {
              extend: language.btn_pdf,
              className: "btn-sm"
            },
            {
              extend: language.btn_print,
              className: "btn-sm"
            },
          ],
          responsive: true,
          "order": [[ 5, "desc" ]]
        });
      }
    };

    TableManageButtons = function() {
      "use strict";
      return {
        init: function() {
          handleDataTableButtonsOrders();
        }
      };
    }();

    TableManageButtons.init();
  });
<!-- /Datatables -->

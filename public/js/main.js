$(document).ready(function() {

  // Call function once ask modal has been shown
  $('#askModal').on('shown.bs.modal', function () {

      // Select Category by select2 plugin
      $(".select-category").select2({
        placeholder: "Select a Category"
      });
  });

  // Initialize tooltip
   $('[data-toggle="tooltip"]').tooltip();
});
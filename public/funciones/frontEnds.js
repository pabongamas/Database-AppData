
$('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    language: "es",
});

$(".datepickerYear").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    ignoreReadonly: false
});

$('[data-toggle="tooltip"]').tooltip()

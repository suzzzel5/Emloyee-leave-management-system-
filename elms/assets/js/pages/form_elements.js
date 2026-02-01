$(document).ready(function(){
    // Improved datepicker for smoother birthdate selection
    var now = new Date();
    $('.datepicker').pickadate({
        selectMonths: true,                              // Dropdown for month
        selectYears: [1980, now.getFullYear()],         // Years from 1980 up to current year
        format: 'yyyy-mm-dd',                           // Match database-friendly format
        min: new Date(1980, 0, 1),                      // Do not allow dates before 1980
        max: now                                        // Do not allow future dates
    });

    $('input.autocomplete').autocomplete({
        data: {
            "Apple": null,
            "Microsoft": null,
            "Google": 'assets/images/google.png'
        }
    });
});

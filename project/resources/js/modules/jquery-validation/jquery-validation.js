if(jQuery.validator){

    //Default validation error messages positioning
    jQuery.validator
        .setDefaults({
            errorPlacement: function(error, element) {
                let fieldType = element.attr("type");
                
                if(fieldType == 'file'){
                    error.insertAfter(element.parent().parent())
                }
                else if(fieldType == undefined){
                    if(element.is("textarea") || element.hasClass("datetimepicker")){
                        error.insertAfter(element.parent())
                    }
                    else if(element.is("select")){
                        error.insertAfter(element.parent().parent())
                    }
                }
                else{
                    error.insertAfter(element.parent(".input-group"));
                }
            }
        });

    //Custom falidation for phone numbers
    jQuery.validator.addMethod('phonePL', function(value){
        return /^\(?([0-9]{3})\)?[ ]?([0-9]{3})[ ]?([0-9]{3})$/.test(value);
    }, 'Podaj numer telefonu w notacji XXX XXX XXX');

    //Validate is one date greater than other
    jQuery.validator.addMethod("dateGreaterStart", function (value, element, params) {
        return this.optional(element) || new Date(value) > new Date($(params).val());
    }, 'Data końcowa musi być większa od początkowej.');
};
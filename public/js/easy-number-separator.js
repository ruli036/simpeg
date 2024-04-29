$(document).ready(function () {

    // Currency Separator
    var commaCounter = 10;
	function numberSeparator(Number) {
        Number += '';

        for (var i = 0; i < commaCounter; i++) {
            Number = Number.replace(',', '');
        }

        x = Number.split('.');
        y = x[0];
        z = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(y)) {
            y = y.replace(rgx, '$1' + ',' + '$2');
        }
        commaCounter++;
        return y + z;
    }
    // Set Currency Separator to input fields
    $(document).on('keypress , paste', '.number-separator', function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $('.number-separator').on('input', function () {
                console.log(e.target.value);
                e.target.value = numberSeparator(e.target.value);
            });
        } else {
            e.preventDefault();
            return false;
        }
    });
	$(document).on('focus', '.number-separator', function (e) {
        if (e.target.value == 0) {
            e.target.value = "";
        } 
    });
	$(document).on('blur', '.number-separator', function (e) {
        if (e.target.value == "") {
            e.target.value = 0;
        } 
    });

});
function number_format(Number) {
	var commaCounter = 10;
	Number += '';

	for (var i = 0; i < commaCounter; i++) {
		Number = Number.replace(',', '');
	}

	x = Number.split('.');
	y = x[0];
	z = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;

	while (rgx.test(y)) {
		y = y.replace(rgx, '$1' + ',' + '$2');
	}
	commaCounter++;
	return y + z;
}
function removeComma(val){
	var angka = val.split(",");
	var temp = '';
	for(var i=0;i<angka.length;i++){
		temp = temp+angka[i];
	}
	return temp;
}
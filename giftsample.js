jQuery(document).ready(function() {

});

function giftAjaxTest() {
    var tid = $('#txtTID').val();
    var clientKey = $('#txtClientKey').val();
    var cardnumber = $('#txtCardNumber').val(); // get card number
    var amount = $('#txtAmount').val(); // get amount

    $.ajax({
        type: 'post',
        url: 'giftcardapi.php',
        data: { txtTID: tid, txtClientKey: clientKey, txtCardNumber: cardnumber, txtAmount: amount },
        success: function(info) {
            alert(info);
        }
    });
}
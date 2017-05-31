-Valutec & GiftcardApi  are main core files.

-index.php is a file for simple interface.

-giftsample.js send ajax request to giftcardapi.php for test.


Here's sample of AjaxRequest

$.ajax({
        type: 'post',
        url: 'giftcardapi.php',
        data: { txtTID: tid, txtClientKey: clientKey, txtCardNumber: cardnumber, txtAmount: amount },
        success: function(info) {
            alert(info);
        }
    });
function showPaypal(){
    var show = false;
    if($("#accept-marketing").is(":checked") && $("#confirm-terms").is(":checked")){
        $("#paypal-div").show();
    }else{
        $("#paypal-div").hide();
    }
}

paypal.Buttons({
    locale: 'en_US',
    style: {
        layout: 'horizontal',
        size: 'medium',
        color: 'gold',
        shape: 'rect',
        label: 'buynow',
        height: 40,
        tagline: 'false'
    },



    // Set up the transaction
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: item_price,
                }
            }]
        });
    },

    // Finalize the transaction
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
            var transaction = orderData.purchase_units[0].payments.captures[0];
            $("#transactionid").val(transaction.id);
            $("#order-form").submit();
        });
    }
}).render('#paypal-button');

<div id="checkout-payment" style="display: none;">
    <div id="smart-button-container">
        <div style="text-align: center;">
          <div style="margin-bottom: 1.25rem; display: none;">
            {{-- <p>Full Report</p> --}}
            <select id="item-options">
                <option value="Full Report" price="28">Full Report - 28 USD</option>
            </select>
            <select style="visibility: hidden" id="quantitySelect"></select>
          </div>
        <div id="paypal-button-container"></div>
        </div>
      </div>
      <script src="https://www.paypal.com/sdk/js?client-id=AZlBwKx9SnbLz6koA5ih1wHDmG4livpnW--4mtDYZHhcJfczPh-Z3JGB6ucq_9VYsye_tIqMsEV-4ivt&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
      <script>
        function initPayPalButton() {
            var vin = '<?=$vin?>';
            var email = $('#checkout-email').val();
            var phone = $('#checkout-phone').val();
            var status_payment = "pending";

            var shipping = 0;
            var itemOptions = document.querySelector("#smart-button-container #item-options");
            var quantity = parseInt();
            var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
            if (!isNaN(quantity)) {
                quantitySelect.style.visibility = "visible";
            }
            var orderDescription = 'Full Report';
            if(orderDescription === '') {
                orderDescription = 'Item';
            }
            paypal.Buttons({
                style: {
                shape: 'pill',
                color: 'gold',
                layout: 'horizontal',
                label: 'checkout',
                
                },
                createOrder: function(data, actions) {
                var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
                var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
                var tax = (0 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
                if(quantitySelect.options.length > 0) {
                    quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
                } else {
                    quantity = 1;
                }
    
                tax *= quantity;
                tax = Math.round(tax * 100) / 100;
                var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
                priceTotal = Math.round(priceTotal * 100) / 100;
                var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;
    
                return actions.order.create({
                    purchase_units: [{
                    description: orderDescription,
                    amount: {
                        currency_code: 'USD',
                        value: priceTotal,
                        breakdown: {
                        item_total: {
                            currency_code: 'USD',
                            value: itemTotalValue,
                        },
                        shipping: {
                            currency_code: 'USD',
                            value: shipping,
                        },
                        tax_total: {
                            currency_code: 'USD',
                            value: tax,
                        }
                        }
                    },
                    items: [{
                        name: selectedItemDescription,
                        unit_amount: {
                        currency_code: 'USD',
                        value: selectedItemPrice,
                        },
                        quantity: quantity
                    }]
                    }],
                    application_context: {
                        shipping_preference: 'NO_SHIPPING'
                    }
                });
                },
                onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    
                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
    
                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thanks for your order , the report will come to your email soon!</h3>';

                    var data = {
                        vin : vin,
                        phone : phone,
                        email :email,
                        status_payment : "pending"
                    };
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : "{{ route('checkout.store') }}",
                        method : "POST",
                        data: JSON.stringify(data),
                        contentType: "application/json",
                        dataType: "json",
                        success : function (res) {
                            if (res.success) {
                                
                            }
                        },
                        error:function (xhr) {  
                        }
                    });
    
                    // Or go to another URL:  actions.redirect('thank_you.html');
    
                });
                },
                onError: function(err) {
                console.log(err);
                },
            }).render('#paypal-button-container');
            }
            initPayPalButton();
      </script>
</div>

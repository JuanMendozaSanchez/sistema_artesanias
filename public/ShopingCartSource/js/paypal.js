
    paypal.Button.render({
      env: 'sandbox', //'sandbox' Or 'production',

      client: {
            sandbox:    'ASMdytTfR2AJUMHqHHWfgmVMsgcFtsoSOk-Tdl1uyRADmd62mkv-7v5dDJ8fwaq1Z8781XwQg4QqPcnE',
            production: 'AbJXOC3SZLN5uZRATED05cLF8UAsPJ9id2-IdcpQxSuXhVpfJ1VN43rIEkBvFntdYj0cZ66Mn92sk5wk'
        },

      commit: true, // Show a 'Pay Now' button

      style: {
        color: 'gold',
        size: 'medium'
      },
      
      
      payment: function(data, actions) {
        var monto=$('#totalFinal').text();
        //console.log("entro al payment: ",monto);
        return actions.payment.create({
            payment: {
              transactions: [
                {
                  amount: { total: '1.00', currency: 'MXN' }
                }
              ]
            }
        });
      },

      onAuthorize: function(data, actions) {
        return actions.payment.get().then(function(data) {
          var buyer=data.payer.payer_info;
          //var shipping = data.payer.payer_info.shipping_address;

              return actions.payment.execute().then(function(payment) {
                //window.alert('Pago Completo!');
                var lista =JSON.parse(sessionStorage.getItem('articulos')) ;
                //var lista =sessionStorage.getItem('articulos');
                var total=parseFloat(sessionStorage.getItem('total'));

                var myJsonStringArticulos = JSON.stringify(lista);
                var myJsonStringBuyer = JSON.stringify(buyer);

                $('#cargaBuyer').val(myJsonStringBuyer);
                $('#cargaArticulos').val(myJsonStringArticulos);
                $('#cargaTotal').val(total);

                $('#mensajeParaBuyer').show();
                ///console.log(buyer2,lista);
                $('#vaciar').trigger("click");
                $('#seguir').hide();
                $('#vaciar').hide();
              });
        });
      },

      onCancel: function(data, actions) {
        /* 
         * Buyer cancelled the payment 
         */
      },

      onError: function(err) {
        window.alert("Ocurrio un error vuelva a intentarlo");
      }
    }, '#paypal-button');
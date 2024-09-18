paypal
  .Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [
          {
            amount: {
              value: "0.01",
            },
          },
        ],
      });
    },
    // Finalize the transaction after payer approval
    onApprove: async (data, actions) => {
      // faire la redirection en javascript

      request.url = "<?= URI . ";
      commandes / commander;
      ("; ?>");

      const order = await actions.order.capture();
      console.log(order);
      alert("Transaction completed by " + order.payer.name.given_name);
    },
  })
  .render("#paypal-button-container");

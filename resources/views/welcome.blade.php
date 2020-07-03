<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pay</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
     <div class="row">
       <div class="col-md-8 col-md-offset-2">
	<br><br><br>
<div class="braintree-sheet__text"><b>Product Name: </b>{{$product}}
<div class="braintree-sheet__text"><b>Total Amount: </b>${{$amount}}
<div class="braintree-sheet__text"><b>Receiver's Name: </b>{{$receiver}}
         <div id="dropin-container"></div>
         <button id="submit-button">Request payment method</button>

       </div>
     </div>
  </div>
  <script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('{{ route('payment.make')}}', {payload}, function (response) {
            if (response.success) {

              alert(response.transaction.id);
            } else {
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });
  </script>
</body>
</html>


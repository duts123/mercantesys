<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Braintree_Gateway;
use Braintree_Transaction;
class PaymentsController extends Controller
{

public function make(Request $request)
{

$amount = Session::get('productprice');
$payload = $request->input('payload', false);
    $nonce = $payload['nonce'];
    $status = Braintree_Transaction::sale([
                            'amount' => $amount,
                            'paymentMethodNonce' => $nonce,
                            'options' => [
                                       'submitForSettlement' => True
                                         ]
              ]);


\Log::error($status->transaction->id);

error_log($status->transaction->id);
    return response()->json($status);
}
/* Function is to create a customer on braintree */
      public function createCustomer(){
        $gateway = $this->brainConfig();
        $result = $gateway->customer()->create([
            'firstName' => 'Aman',
            'lastName' => 'Dhiman',
            'email' => 'rooprai.aman@gmail.com'
          ]);

          $result->success;
          # true

          echo $result->customer->id;

      }

      /* Function is to save a card for a specific customer on braintree*/
      public function saveCard(){
          $gateway = $this->brainConfig();
          $result = $gateway->creditCard()->create([
                        'customerId' => 818752506,
                        'number' => '4000111111111115',
                        'expirationDate' => '06/22',
                        'cvv' => '100'
                    ]);
          echo "<pre>"; print_r($result);
          echo $token = $result->creditCard->token;
      }

      /* Get saved cards from braintree */
      public function getSavedCard(){
        $gateway = $this->brainConfig();
        $creditCard = $gateway->creditCard()->find('hc3mw5');
        echo "<pre>"; print_r($creditCard);

      }

      /* Get a saved card's nonce to process a Payment */
      public function getPaymentToken()
      {
          $gateway = $this->brainConfig();
          $result = $gateway->paymentMethodNonce()->create('7s8q8f');
          echo  $nonce = $result->paymentMethodNonce->nonce;
      }

      /* Function to delete the saved card on braintree */
      public function deleteCard(){
        $gateway = $this->brainConfig();
        $msg = $gateway->creditCard()->delete('hc3mw5');
        echo "<pre>"; print_r($msg);
      }

      /* Config function to get the braintree config data to process all the apis on braintree gateway */
      public function brainConfig()
      {
        return $gateway = new Braintree_Gateway([
                          'environment' => env('BRAINTREE_ENV'),
                          'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                          'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                          'privateKey' => env('BRAINTREE_PRIVATE_KEY')
                      ]);
      }
    //
}

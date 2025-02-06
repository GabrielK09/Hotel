<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PayMentController extends Controller
{
    public function index()
    {
        try {
            MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

            $client = new PaymentClient();

            $request = [
                "transaction_amount" => 100,
                "token" => "5031 4332 1540 6351",
                "description" => "description",
                "installments" => 1,
                "payment_method_id" => "mastercard",
                "payer" => [
                    "email" => "user@test.com",
                ]
            ];

            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

            $payment = $client->create($request, $request_options);
            echo $payment->id;

        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Content: ";
            var_dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PayMentController extends Controller
{
    public function index()
    {
        try {
            // Definir Access Token correto (substituir pelo real)
            MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

            $client = new PaymentClient();

            // Dados da requisição
            $request = [
                "transaction_amount" => 100,
                "token" => "3753 651535 56885", // Substituir pelo token real do cartão
                "description" => "Compra de produto X",
                "installments" => 1,
                "payment_method_id" => "american_express",
                "payer" => [
                    "email" => "user@test.com",
                ]
            ];

            // Configurar Idempotência
            $request_options = new RequestOptions();
            //$request_options->setCustomHeaders(["X-Idempotency-Key" => uniqid()]);


            $payment = $client->create($request, $request_options);

            return response()->json([
                'status' => 'success',
                'payment_id' => $payment->id,
                'status_detail' => $payment->status_detail
            ]);

        } catch (MPApiException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro na API do Mercado Pago',
                'error_code' => $e->getApiResponse()->getStatusCode(),
                'error_details' => $e->getApiResponse()->getContent()

            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}*/

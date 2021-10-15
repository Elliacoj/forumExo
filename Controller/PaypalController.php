<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;
use App\Model\Manager\UserManager;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class PaypalController {
    use RenderController;

    /**
     * Create a paypal instance
     */
    public function createInstance() {
        $gateway = Omnipay::create('PayPal_Express');

        if (method_exists($gateway, 'setDeveloperMode')) {
            $gateway->setDeveloperMode(TRUE);
        } else {
            $gateway->setTestMode(TRUE);
        }

        $gateway->setUsername('sb-o0dav8137748_api1.business.example.com');
        $gateway->setPassword('RZ6RJ4DU4ERVURFX');
        $gateway->setSignature("AM1aGgn2bz5QbLwfJWgM8rQPCVdfAEUBB46kag.IWC2u.4uHTp7sVKl1");

        try {
            $response = $gateway->purchase(
                ['amount' => '10.00', 'returnUrl' => "https://Forum.elliacoj.be/index.php?controller=paypal&action=paymentCheck",
                    "cancelUrl" => "https://Forum.elliacoj.be/index.php?controller=home&action=paypalPage&error=10"
                ])->send();
            if ($response->isSuccessful()) {
                echo "success";
            } elseif ($response->isRedirect()) {
                $response->redirect();
            } else {
                exit($response->getMessage());
            }
        } catch (\Exception $e) {
            exit('Sorry, there was an error processing your payment. Please try again later.');
        }
    }

    /**
     * Update
     */
    public function paymentCheck () {
        $user = UserManager::getManager()->search($_SESSION['id']);
        $user->setPremium(1);
        $user->setDatePremium(date(date("Y-m-d H:i:s")));
        UserManager::getManager()->updatePremium($user);

        header("Location: /index.php?error=11");
    }
}
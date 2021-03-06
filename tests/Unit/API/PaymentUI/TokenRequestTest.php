<?php

namespace Xsolla\SDK\Tests\Unit\API\PaymentUI;

use Xsolla\SDK\API\PaymentUI\TokenRequest;

/**
 * @group unit
 */
class TokenRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testSetters()
    {
        $tokenRequest = new TokenRequest('PROJECT_ID', 'USER_ID');
        $actualRequest = $tokenRequest->setUserEmail('email@example.com')
            ->setCustomParameters(array('a' => 1, 'b' => 2))
            ->setCurrency('USD')
            ->setExternalPaymentId(12345)
            ->setSandboxMode(true)
            ->setUserName('USER_NAME')
            ->setPurchase(1.5, 'EUR')
            ->toArray();

        $expectedRequest = array(
            'user' => array(
                'id' => array('value' => 'USER_ID'),
                'email' => array('value' => 'email@example.com'),
                'name' => array('value' => 'USER_NAME'),
            ),
            'settings' => array(
                'project_id' => 'PROJECT_ID',
                'currency' => 'USD',
                'external_id' => 12345,
                'mode' => 'sandbox',
            ),
            'custom_parameters' => array(
                'a' => 1,
                'b' => 2,
            ),
            'purchase' => array(
                'checkout' => array(
                    'amount' => 1.5,
                    'currency' => 'EUR',
                ),
            ),
        );
        static::assertSame($expectedRequest, $actualRequest);
    }
}

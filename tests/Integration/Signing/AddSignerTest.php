<?php
namespace Isign\Gateway\Tests\Integration\Signing;

use Isign\Gateway\Query\Signing\AddSigner;
use Isign\Gateway\Result\Signing\AddSignerResult;
use Isign\Gateway\Tests\Integration\TestCase;

class AddSignerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->createSigning();
    }

    public function testSuccess()
    {
        /** @var AddSignerResult $result */
        $result = $this->client->get(new AddSigner(
            $this->signingToken,
            [
                [
                    'id' => self::SIGNER2_ID,
                    'name' => 'Fleur',
                    'surname' => 'Boland',
                    'signing_purpose' => 'signature',
                ],
            ]
        ));

        $this->assertSame('ok', $result->getStatus());
        $signers = $result->getSigners();
        $this->assertNotEmpty($signers);
        $this->assertArrayHasKey(self::SIGNER1_ID, $signers);
        $this->assertArrayHasKey(self::SIGNER2_ID, $signers);
        $this->assertNotEmpty($signers[self::SIGNER1_ID]);
        $this->assertNotEmpty($signers[self::SIGNER2_ID]);
    }
}
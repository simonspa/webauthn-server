<?php


namespace MadWizard\WebAuthn\Tests\Attestation;

use MadWizard\WebAuthn\Dom\AuthenticatorAttestationResponseInterface;
use MadWizard\WebAuthn\Json\JsonConverter;
use MadWizard\WebAuthn\Tests\Helper\FixtureHelper;
use PHPUnit\Framework\TestCase;

abstract class VerifierTest extends TestCase
{
    protected function getFidoResponse(string $name): AuthenticatorAttestationResponseInterface
    {
        $json = FixtureHelper::getJsonFixture('fido2-helpers/attestation.json');
        $message = $json[$name];
        $message['type'] = 'public-key';
        $credential = JsonConverter::decodeAttestationCredential(json_encode($message));
        $response = $credential->getResponse();
        /**
         * @var AuthenticatorAttestationResponseInterface $response
         */
        return $response;
    }
}

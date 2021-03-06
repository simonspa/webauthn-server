<?php


namespace MadWizard\WebAuthn\Tests\Dom;

use MadWizard\WebAuthn\Dom\AttestationConveyancePreference;
use MadWizard\WebAuthn\Dom\AuthenticatorAttachment;
use MadWizard\WebAuthn\Dom\AuthenticatorTransport;
use MadWizard\WebAuthn\Dom\PublicKeyCredentialType;
use MadWizard\WebAuthn\Dom\TokenBindingStatus;
use MadWizard\WebAuthn\Dom\UserVerificationRequirement;
use PHPUnit\Framework\TestCase;

class EnumerationTest extends TestCase
{
    public function testAttestationPreference()
    {
        $this->assertTrue(AttestationConveyancePreference::isValidValue(AttestationConveyancePreference::NONE));
        $this->assertTrue(AttestationConveyancePreference::isValidValue(AttestationConveyancePreference::DIRECT));
        $this->assertTrue(AttestationConveyancePreference::isValidValue(AttestationConveyancePreference::INDRECT));

        $this->assertFalse(AttestationConveyancePreference::isValidValue('xyz'));
    }

    public function testPublicKeyCredentialType()
    {
        $this->assertTrue(PublicKeyCredentialType::isValidType(PublicKeyCredentialType::PUBLIC_KEY));
        $this->assertFalse(PublicKeyCredentialType::isValidType('xyz'));
    }

    public function testUserVerificationRequirement()
    {
        $this->assertTrue(UserVerificationRequirement::isValidValue(UserVerificationRequirement::REQUIRED));
        $this->assertTrue(UserVerificationRequirement::isValidValue(UserVerificationRequirement::PREFERRED));
        $this->assertTrue(UserVerificationRequirement::isValidValue(UserVerificationRequirement::DISCOURAGED));

        $this->assertFalse(UserVerificationRequirement::isValidValue('xyz'));
    }

    public function testTransports()
    {
        $known = AuthenticatorTransport::allKnownTransports();
        $this->assertContains(AuthenticatorTransport::USB, $known);
        $this->assertContains(AuthenticatorTransport::NFC, $known);
        $this->assertContains(AuthenticatorTransport::BLE, $known);
        // $this->assertContains(AuthenticatorTransport::INTERNAL, $known);
    }

    public function testAttachment()
    {
        $this->assertTrue(AuthenticatorAttachment::isValidValue(AuthenticatorAttachment::PLATFORM));
        $this->assertTrue(AuthenticatorAttachment::isValidValue(AuthenticatorAttachment::CROSS_PLATFORM));
        $this->assertFalse(AuthenticatorAttachment::isValidValue('xyz'));
    }

    public function testTokenBindingStatus()
    {
        $this->assertTrue(TokenBindingStatus::isValidValue(TokenBindingStatus::SUPPORTED));
        $this->assertTrue(TokenBindingStatus::isValidValue(TokenBindingStatus::PRESENT));
        $this->assertFalse(TokenBindingStatus::isValidValue('xyz'));
    }

    public function testAuthenticatorTransport()
    {
        $this->assertTrue(AuthenticatorTransport::isValidValue(AuthenticatorTransport::USB));
        $this->assertFalse(AuthenticatorTransport::isValidValue('xyz'));
    }
}

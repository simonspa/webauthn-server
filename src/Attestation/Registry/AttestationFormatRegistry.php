<?php

namespace MadWizard\WebAuthn\Attestation\Registry;

use MadWizard\WebAuthn\Attestation\AttestationObject;
use MadWizard\WebAuthn\Attestation\Statement\AttestationStatementInterface;
use MadWizard\WebAuthn\Attestation\Verifier\StatementVerifierInterface;
use MadWizard\WebAuthn\Exception\FormatNotSupportedException;

class AttestationFormatRegistry
{
    /**
     * @var AttestationFormatInterface[]
     */
    private $formats = [];

    public function __construct()
    {
    }

    public function addFormat(AttestationFormatInterface $format)
    {
        $this->formats[$format->getFormatId()] = $format;
    }

    public function createStatement(AttestationObject $attestationObject) : AttestationStatementInterface
    {
        $formatId = $attestationObject->getFormat();
        $format = $this->formats[$formatId] ?? null;
        if ($format === null) {
            throw new FormatNotSupportedException(sprintf('Format "%s" is not supported.', $formatId));
        }
        return $format->createStatement($attestationObject);
    }

    public function getVerifier(string $formatId) : StatementVerifierInterface
    {
        $format = $this->formats[$formatId] ?? null;
        if ($format === null) {
            throw new FormatNotSupportedException(sprintf('Format "%s" is not supported.', $formatId));
        }
        return $format->getVerifier();
    }
}

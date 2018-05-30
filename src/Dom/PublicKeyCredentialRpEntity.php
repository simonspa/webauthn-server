<?php


namespace MadWizard\WebAuthn\Dom;

use const FILTER_VALIDATE_DOMAIN;
use MadWizard\WebAuthn\Exception\WebAuthnException;

class PublicKeyCredentialRpEntity extends PublicKeyCredentialEntity
{
    /**
     * @var string|null
     */
    private $id;

    /**
     * PublicKeyCredentialRpEntity constructor.
     * @param null|string $id Relaying party ID (valid domain string)
     * @throws WebAuthnException
     */
    public function __construct(string $name, ?string $id = null)
    {
        parent::__construct($name);
        if ($id !== null) {
            $id = filter_var($id, FILTER_VALIDATE_DOMAIN);
            if ($id === false) {
                throw new WebAuthnException('Invalid domain name');
            }
            $this->id = $id;
        }
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAsArray(): array
    {
        $map = parent::getAsArray();
        if ($this->id !== null) {
            $map['id'] = $this->id;
        }
        return $map;
    }
}

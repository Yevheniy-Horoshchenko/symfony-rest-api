<?php

namespace App\Response;

class SuccessResponse
{
    private bool $success;

    private ?array $data = null;

    public function toArray(): array
    {
        $response = [
            'success' => $this->success,
        ];

        if ($this->data) {
            $response['data'] = $this->data;
        }
        
        return $response;
    }
    
    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): static
    {
        $this->success = $success;

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
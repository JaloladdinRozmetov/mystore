<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function __construct(private Contact $model) {}

    public function create(array $attributes): Contact
    {
        return $this->model->create($attributes);
    }
}

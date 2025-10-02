<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    public function index()
    {
        return view('new.contact');
    }

    public function store(ContactRequest $contactRequest)
    {
        $dto = \App\DTOs\ContactData::fromRequest($contactRequest);
        $this->contactService->store($dto->toArray());

        return back()->with('success', __('messages.contact_sent'));
    }
}

<?php

namespace App\Services;

use App\Models\Contact;
use App\Notifications\ContactCreatedTelegram;
use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ContactService
{
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Store a contact message.
     * @param array{name:string,phone:string,description?:string,user_id?:int|null} $data
     */
    public function store(array $data): Contact
    {

        return DB::transaction(function () use ($data) {
            $contact = $this->contactRepository->create([
                'name'        => $data['name'],
                'phone'       => $data['phone'],
                'description' => $data['description'] ?? null,
                'user_id'     => $data['user_id'] ?? null,
            ]);
            Notification::route('telegram', config('services.telegram.chat_id'))
                ->notify(new ContactCreatedTelegram($contact));

            return $contact;
        });
    }
}

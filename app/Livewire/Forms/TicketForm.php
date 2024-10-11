<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TicketForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string|max:100')]
    public string $subject = '';

    #[Validate('required|string|max:1000')]
    public string $description = '';

    #[Validate('required|string')]
    public string $priority = '';

    #[Validate('required|string')]
    public string $category = '';

    #[Validate(['attachments.*' => 'required|file|mimes:png,jpg,jpeg,pdf,doc,docx|max:10240'])]
    public array $attachments = [];
}

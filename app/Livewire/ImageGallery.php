<?php

namespace App\Livewire;

use App\Models\TicketResponse;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class ImageGallery extends Component
{
    use WithFileUploads;

    public $attachments = [];
    public $uploadedAttachments;

    public TicketResponse $response;

    public function save()
    {
        /*        $this->validate([
                    'uploaded' => 'nullable|image|max:10240'
                ]);*/
        if ($this->uploadedAttachments) {
            foreach ($this->uploadedAttachments as $image) {
                $path = $image->store('attachments');
                array_push($this->attachments, $path);
            }
        }

        $this->response->attachments = $this->attachments;
        $this->response->save();
    }

    public function render()
    {
        return view('livewire.image-gallery');
    }

    public function mount(TicketResponse $response)
    {
        $this->response = $response;
        $this->attachments = (array) json_decode($response->attachments);
    }

    public function deleteImage($index)
    {
        $image = $this->attachments[$index];
        Storage::delete($image);
        unset($this->attachments[$index]);
    }
}

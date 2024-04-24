<?php

namespace App\Livewire;

use App\AttachmentsEnabledInterface;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class ImageGallery extends Component
{
    use WithFileUploads;

    public $attachments = [];
    public $uploadedAttachments;

    public AttachmentsEnabledInterface $resource;

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

        $this->resource->attachments = $this->attachments;
        $this->uploadedAttachments = null;
        $this->resource->save();
    }

    public function render()
    {
        return view('livewire.image-gallery');
    }

    public function mount(AttachmentsEnabledInterface $resource)
    {
        $this->resource = $resource;
        $this->attachments = (array) json_decode($resource->attachments);
    }

    public function deleteImage($index)
    {
        $image = $this->attachments[$index];
        Storage::delete($image);
        unset($this->attachments[$index]);
    }
}

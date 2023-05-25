<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use App\Models\Slider;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Language;
use App\Http\Livewire\Quill;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal',
        Quill::EVENT_VALUE_UPDATED,
    ];

    public $editModal = false;

    public $slider;

    public $photo;

    public $description;

    protected $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string', 'max:255'],
        'slider.details'       => ['nullable'],
        'slider.link'          => ['nullable', 'string'],
        'slider.language_id'   => ['nullable', 'integer'],
        'slider.bg_color'      => ['nullable', 'string'],
        'slider.embeded_video' => ['nullable'],
    ];

    public function quill_value_updated($value)
    {
        $this->slider->details = $value;
    }

    public function editModal(Slider $slider)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->description = $slider->details;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->photo) {
            $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->photo->extension();

            $this->slider->clearMediaCollection('media');

            $this->slider->addMediaFromDisk($this->photo->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->slider->photo = $imageName;
        }

        $this->slider->save();

        $this->alert('success', __('Slider updated successfully.'));

        $this->editModal = false;
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function render(): View
    {
        return view('livewire.admin.slider.edit');
    }
}

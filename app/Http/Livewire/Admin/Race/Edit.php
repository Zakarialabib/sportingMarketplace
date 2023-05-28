<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Models\Category;
use App\Models\Race;
use App\Models\RaceLocation;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\Quill;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal',
        'trumbowygEditorUpdated' => 'updateDescription',
    ];

    public $editModal = false;

    public $race;

    public $images;

    public $options = [];

    public $social_media = [];

    public $sponsors = [];

    public $courses = [];

    public $features = [];

    public $calendar = [];

    public $description = null;

    public array $listsForFields = [];

    protected $rules = [

        'race.name'             => ['required', 'string', 'max:255'],
        'race.date'             => ['required', 'date', 'max:255'],
        'race.price'            => ['required', 'numeric', 'max:2147483647'],
        'race.race_location_id' => ['required', 'integer'],
        'race.category_id'      => ['required', 'integer'],
        'race.number_of_days'   => ['required', 'numeric', 'max:2147483647'],
        'race.number_of_racers' => ['required', 'numeric', 'max:2147483647'],
        'description'           => ['nullable'],
        'images'    => [ 'nullable'],
        // 'race.meta_title'       => ['nullable', 'string', 'max:255'],
        // 'race.meta_description' => ['nullable', 'string', 'max:255'],

        'social_media.*.name'  => ['nullable', 'string'],
        'social_media.*.value' => ['nullable', 'string'],

        'sponsors.*.name'  => ['nullable', 'string'],
        'sponsors.*.image' => ['nullable', 'string'],
        'sponsors.*.link'  => ['nullable', 'string'],

        'courses.*.name'    => ['nullable', 'string'],
        'courses.*.content' => ['nullable', 'string'],

        'features.*.name'  => ['nullable', 'string'],
        'features.*.value' => ['nullable', 'string'],

        'calendar.*.date' => ['nullable'],
        'calendar.*.events.*.start_time' => ['nullable'],
        'calendar.*.events.*.end_time' => ['nullable'],
        'calendar.*.events.*.activity' => ['nullable', 'string'],

        'options.*.type'  => ['nullable', 'string'],
        'options.*.value' => ['nullable', 'string'],

    ];

    public function updateDescription($value)
    {
        $this->description = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addOption()
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function addRaceDate()
    {
        $this->calendar[] = [
            'date' => '',
            'events' => [
                [
                    'start_time' => '',
                    'end_time' => '',
                    'activity' => '',
                ],
            ],
        ];
    }

    public function removeRaceDate($date)
    {
        unset($this->calendar[$date]);
    }

    public function removeRaceEvent($date, $eventIndex)
    {
        unset($this->calendar[$date]['events'][$eventIndex]);
        $this->calendar[$date]['events'] = array_values($this->calendar[$date]['events']);
    }

    public function addRaceEvent($date)
    {
        $this->calendar[$date]['events'][] = [
            'start_time' => '',
            'end_time' => '',
            'activity' => '',
        ];
    }


    public function editModal($id)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->race = Race::findOrFail($id);

        $this->description = $this->race->description;

        $this->options = $this->race->options ?? [];
        
        $this->calendar = $this->race->calendar ?? [];
        // dd($this->calendar);
        $this->images = $this->race->getMedia('local_files');

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->images) {
            foreach($this->images as $image) {
                $this->race->addMedia($image)->toMediaCollection('local_files');
            }
        }
        
        
        // $this->race->options[] = $this->options;

        // $this->race->social_media[] = $this->social_media;

        // $this->race->sponsors[] = $this->sponsors;

        // $this->race->courses[] = $this->courses;

        // $this->race->features[] = $this->features;

        $this->race->calendar = $this->calendar;

        $this->race->save();

        $this->alert('success', 'Race updated successfully');

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getRaceLocationsProperty()
    {
        return RaceLocation::select('name', 'id')->get();
    }

    public function render()
    {
        return view('livewire.admin.race.edit');
    }
}

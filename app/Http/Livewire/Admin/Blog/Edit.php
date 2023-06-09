<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $image;

    public $blog;
    
    public $description;

    public $listeners = ['editModal'];

    protected $rules = [
        'blog.title'       => 'required|min:3|max:255',
        'blog.category_id' => 'required|integer',
        'blog.slug'        => 'required|string',
        'description'     => 'required|min:3',
        'blog.language_id' => 'nullable|integer',
        'blog.meta_title'  => 'nullable|max:100',
        'blog.meta_description'   => 'nullable|max:200',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.edit');
    }

    public function editModal($id)
    {
        // abort_if(Gate::denies('blog_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = Blog::where('id', $id)->firstOrFail();

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->blog->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->description = $this->description;

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Blog updated successfully.'));

        $this->editModal = false;
    }

    public function getCategoriesProperty()
    {
        return BlogCategory::select('title', 'id')->get();
    }

    public function getLanguagesProperty()
    {
        return Language::select('name', 'id')->get();
    }
}

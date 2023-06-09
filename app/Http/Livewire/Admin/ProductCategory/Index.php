<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\ProductCategory;

use App\Http\Livewire\WithSorting;
use App\Imports\CategoriesImport;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $category;

    public $file;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'importModal',
    ];

    public int $perPage;

    public $importModal;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new ProductCategory())->orderable;
    }

    public function render(): View|Factory
    {
        $query = ProductCategory::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $categories = $query->paginate($this->perPage);

        return view('livewire.admin.product-category.index', compact('categories'))->extends('layouts.dashboard');
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('category_delete'), 403);

        ProductCategory::whereIn('id', $this->selected)->delete();

        $this->alert('success', __('ProductCategory deleted successfully.'));

        $this->resetSelected();
    }

    public function delete(ProductCategory $category)
    {
        abort_if(Gate::denies('category_delete'), 403);

        if ($category->products()->isNotEmpty()) {
            $this->alert('error', __('Can\'t delete beacuse there are products associated with this category !'));
        }
        $category->delete();

        $this->alert('success', __('ProductCategory deleted successfully.'));
    }

    public function importModal()
    {
        abort_if(Gate::denies('category_access'), 403);

        $this->importModal = true;
    }

    public function import()
    {
        abort_if(Gate::denies('category_access'), 403);

        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv,txt',
        ]);

        $file = $this->file('file');

        Excel::import(new CategoriesImport(), $file);

        $this->alert('success', __('Categories imported successfully.'));

        $this->importModal = false;
    }
}

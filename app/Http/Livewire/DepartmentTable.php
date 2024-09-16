<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Department;

class DepartmentTable extends DataTableComponent
{
    protected $model = Department::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;
        return [
            Column::make('ID','id')
                ->searchable()
                ->format(fn () => ++$this->index),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}

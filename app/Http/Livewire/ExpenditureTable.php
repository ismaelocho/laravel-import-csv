<?php

namespace App\Http\Livewire;


use App\Models\Expenditure;
use App\Models\Category;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ExpenditureTable extends DataTableComponent
{
    
    protected $model = Expenditure::class;
 
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
    }
 
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Expense', 'expense')
                ->sortable(),
            Column::make('Amount', 'amount')
                ->sortable(),
            Column::make('Date', 'date')
                ->sortable(),
            Column::make('Category', 'category.name'),
            Column::make('Create at', 'created_at'),
            Column::make('Updated at', 'updated_at'),
        ];
    }
}

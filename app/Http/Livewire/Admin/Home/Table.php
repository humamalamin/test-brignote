<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends TableComponent
{
    use HtmlComponents;

    public function query() : Builder
    {
        return User::query();
    }

    public function columns() : array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable(),
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function (User $model) {
                    return $this->mailto($model->email, null, [
                        'target' => '_blank'
                    ]);
                })
        ];
    }
}

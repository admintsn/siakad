<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Dashboard as PagesDashboard;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\WSDashboard as Dashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class WSDashboard extends PagesDashboard
{

    public function getColumns(): int | string | array
    {
        return 2;
    }

    protected static ?string $title = 'SiakadTSN';


    protected ?string $heading = "";
    protected ?string $subheading = "SiakadTSN";

    // protected static ?string $navigationLabel = '';

    use HasFiltersForm;
    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([


            ]);
    }
}

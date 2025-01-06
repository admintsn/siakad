<?php

namespace App\Filament\Admin\Clusters;

use Filament\Clusters\Cluster;

class User extends Cluster
{
    // protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 900000000;

    protected static ?string $navigationGroup = 'Users';
}

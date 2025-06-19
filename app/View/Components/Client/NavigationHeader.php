<?php

namespace App\View\Components\Client;

use App\Models\categoria;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavigationHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public array $categorias;

    public function __construct()
    {
        //
          $this->categorias = categoria::all()->toArray(); // O aplica filtros si es necesario
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.navigation-header');
    }
}

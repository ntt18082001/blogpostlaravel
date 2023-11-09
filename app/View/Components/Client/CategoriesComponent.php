<?php

namespace App\View\Components\Client;

use App\Repositories\Category\CategoryRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoriesComponent extends Component
{
    protected $cateRepo;
    /**
     * Create a new component instance.
     */
    public function __construct(CategoryRepositoryInterface $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->cateRepo->getAll()->get();
        return view('components.client.categories-component')->with('data', $data);
    }
}

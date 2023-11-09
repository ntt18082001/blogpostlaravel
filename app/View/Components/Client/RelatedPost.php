<?php

namespace App\View\Components\Client;

use App\Repositories\Post\PostRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RelatedPost extends Component
{
    public $id;
    protected $postRepo;
    /**
     * Create a new component instance.
     */
    public function __construct($id, PostRepositoryInterface $postRepo)
    {
        $this->id = $id;
        $this->postRepo = $postRepo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->postRepo->getRelatedPosts($this->id);
        return view('components.client.related-post')->with('data', $data);
    }
}

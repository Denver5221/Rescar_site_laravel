<?php

namespace App\Http\Livewire;

use App\Models\Forum;
use Livewire\Component;

class LikeDislike extends Component
{
    public $forum;

    public function mount(Forum $forum)
    {
        $this->forum = $forum;
    }

    public function toggleVote()
    {
        $user = auth()->user();
        $existingVote = $this->forum->likes()->where('id_user', $user->id)->first();

        if ($existingVote) {
            // $dernier =$this->forum->likes()->latest()->take(1)->get();
            // $existingVote->update(['compteur' => ($existingVote->compteur === 1) ? -1 : 1]);
            $existingVote->delete();
        } else {
            $this->forum->likes()->create([
                'id_user' => $user->id,
                'compteur' => 1,
            ]);
        }

        $this->forum->refresh(); // Update the post model with the latest vote count
    }

    public function render()
    {
        return view('livewire.like-dislike');
    }
}

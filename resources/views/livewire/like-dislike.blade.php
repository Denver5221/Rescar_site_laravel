{{-- <div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled.
</div> --}}
{{-- <div>

    <div>
        <button wire:click="like">J'aime</button>
        <button wire:click="dislike">Je n'aime pas</button>
    </div>

</div> --}}
<div class="widget-content widget-content-area text-center">

    <button type="submit" class="btn btn-outline-success mb-2 me-4" id="likeButton">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
      </svg>
      <span wire:click="toggleVote" class="btn-text-inner" >{{ $forum->likes->count() }} J'aimes</span>
    </button>

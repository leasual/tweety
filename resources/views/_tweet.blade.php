<a href="{{ route('show-tweet',$tweet) }}">
<div class="flex p-4 {{ $loop->last ? '' :  'border-b border-gray-400'}}">

    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile',$tweet->user) }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="40"
                height="40"
            >
        </a>
    </div>

    <div class="flex-1">
        <div class="flex items-baseline mb-2">
            <a href="{{ route('profile',$tweet->user) }}" class="mr-3">
                <h5 class="font-bold">{{ $tweet->user->name }}</h5>
            </a>
            <span class="font-bold text-sm text-gray-600 mr-3">{{ '@'. $tweet->user->username }}</span>
           
            <span class="text-sm text-gray-600">{{ '. '.$tweet->created_at->diffForHumans() }}</span>
        </div>
        
        <a class="mb-4" href="{{ route('show-tweet',$tweet) }}">
            {!! $tweet->body !!}
        </a>

        @if($tweet->image !== null)
        <div class="mt-2 mb-3">
            <img
                src="{{ asset($tweet->image) }}"
                alt="tweet-image"
                class="rounded-lg mb-1 h-64 w-full object-cover"
                width="50"
                height="50"
            >
        </div>
        @endif

        {{-- <x-like-buttons :tweet="$tweet"></x-like-buttons> --}}
        <like-buttons :tweet="{{ $tweet }}"></like-buttons>
    </div>
    <div>
        
       @can('edit',$tweet->user)
            <dropdown align="right" width="200px" v-cloak>
                <template v-slot:trigger>
                    <button
                        class="flex items-center text-default no-underline text-sm focus:outline-none"
                        v-pre
                        
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-700">
                        <path fill="currentColor" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/>
                    </svg>
                    
                    </button>
                </template>


                <button type="submit" class="px-2 py-2 w-full text-left class text-red-500 rounded hover:bg-red-600 hover:text-white"  @click.prevent="$modal.show('confirm-delete',{'id':{{$tweet->id }}})">
                    Delete
                </button>

            </dropdown>
       @endcan
    </div>

    @can('edit',$tweet->user)
     <confirm-delete-modal></confirm-delete-modal>
    @endcan
</div>
</a>
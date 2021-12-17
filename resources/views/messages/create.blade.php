<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Send Message') }}
        </h2>
    </x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto lg:px-8 sm:px-6">
    <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div class="col-md-12" style="padding-right:18%;padding-left: 18%">
        @if (count($errors) > 0)
        <div class="alert alert-danger" >
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::has('success'))
        <p class="alert alert-success">{{Session('success')}}</p>
        @endif

    </div>

        <form method="POST" action="{{ route('messages.store') }}">
            @csrf
<input type="hidden" name="listing_id" value="{{request('listing_id')}}">
            <div>
                <x-jet-label for="Message" value="{{ __('Message') }}" />
                <textarea required class="block mt-1 w-full" name="message"></textarea>
            </div>

            



            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="ml-4">
                    {{ __('Send Message') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
</div>
</x-app-layout>

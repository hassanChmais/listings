<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listing Create') }}
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

        <form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <textarea id="description" class="block mt-1 w-full" name="description">
                    {{old('description')}}
                </textarea>
            </div>
            <div>
                <x-jet-label for="price" value="{{ __('Price') }}" />
                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('title')"/>
            </div>
            <div>
                <x-jet-label for="photo" value="{{ __('Add Photos') }}" />
                <input id="price" class="block mt-1 w-full" type="file" name="photos[]" multiple/>
            </div>

            <div>
                <x-jet-label for="categories" value="{{ __('Categories') }}" />
                @foreach($categories as $category)
                <input type="checkbox" name="categories[]" value="{{$category->id}}" />
                {{$category->name}}
            </br>
                @endforeach
            </div>

            <div>
                <x-jet-label for="colors" value="{{ __('Colors') }}" />
                @foreach($colors as $color)
                <input type="checkbox" name="colors[]" value="{{$color->id}}" />
                {{$color->name}}
            </br>
                @endforeach
            </div>



            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="ml-4">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
</div>
</x-app-layout>

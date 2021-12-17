<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register-step2.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('name')"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('email')" required />
            </div>

            
            <div class="mt-4">
                <x-jet-label for="city" value="{{ __('City') }}" />
 <select name="city_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
    @foreach($cities as $city)
     <option value="{{$city->id}}">
         {{$city->name}}
     </option>
     @endforeach
 </select>
            </div>
        <div class="mt-4">
                <x-jet-label for="Profile Photo" value="{{ __('Profile Photo') }}" />
<input type="file" name="photo" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

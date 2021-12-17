<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="py-12">
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
         <a class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('listings.create')}}">{{__('Add New Listing')}}</a>
         <div class="mb-4">
             <form method="GET" action="">
                <input type="text" name="title" placeholder="Title" value="{{request('title')}}">
                <select name="category">
                    <option value="">--Categories--</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}"
                   @if(request('category') == $category->id)
                       selected
                   @endif
                        >{{$category->name}}</option>
                    @endforeach
                </select>
                <select name="color">
                    <option value="">--Colors--</option>
                    @foreach($colors as $color)
                    <option value="{{$color->id}}" 
                   @if(request('color') == $color->id)
                       selected
                   @endif
                        >{{$color->name}}</option>
                    @endforeach
                </select>
                @livewire('listing-saved-checkbox')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Search</button>
                 
             </form>
         </div>
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categories</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Colors</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="relative px-6 py-3">Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                            @foreach($listings as $listing)
                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ $listing->getFirstMediaUrl('listings','thumb')}}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$listing->title}}
                                <a href="{{route('messages.create')}}?listing_id={{$listing->id}}" class="text-indigo-600 hover:text-indigo-900">Send Message</a>
                            </br>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($listing->categories as $category)

                                {{$category->name}}

                                @endforeach
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($listing->colors as $color)

                                {{$color->name}}

                                @endforeach
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$listing->description}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$listing->price}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @can('update',$listing)
                            <a href="{{route('listings.edit' , $listing)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            /
                            @endcan
                            @can('delete',$listing)
                    <form action="{{ route('listings.destroy', $listing) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="font-style: italic; color: red;" class="btn btn-sm btn-danger" type="submit"
                            onclick="return confirm('{{ __('Are you sure?') }}')">delete</button>
                    </form>
                    @endcan
                            </td>
                            <td>
                                @if(!$listing->user_id == auth()->id() )
                                @livewire('listing-save-button',['listingId' => $listing->id])
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
                <div class="mb-4 mt-4 ml-4">
                    {{$listings->links()}}
                </div>
            </div></div></div></div>

    </div>
</x-app-layout>

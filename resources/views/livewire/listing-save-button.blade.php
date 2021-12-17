<span class="ml-2 mr-2" >
    @if($savedListing)
        <a href="#" wire:click.prevent="unsaveListing"
    class="text-indigo-600 hover:text-indigo-900">UnSave</a>
    @else
        <a href="#" wire:click.prevent="saveListing"
    class="text-indigo-600 hover:text-indigo-900">Save</a>
    @endif
<span>

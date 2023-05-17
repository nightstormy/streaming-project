<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\Redirector;
use Illuminate\Http\RedirectResponse;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

/**
 * @method authorize(string $string, mixed $channel)
 */
class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public mixed $channel;
    public $image;

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'channel.name' => 'required|max:255|unique:channels,name,' . $this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,' . $this->channel->id,
            'channel.description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:1024'
        ];
    }

    /**
     * @param Channel $channel
     * @return void
     */
    public
    function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public
    function render(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.channel.edit-channel');
    }

    /**
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->authorize('update', $this->channel);
        $this->validate();

        $this->channel->update([
            'name' => $this->channel->name,
            'slug' => $this->channel->slug,
            'description' => $this->channel->description,
        ]);

        //check if image is submitted
        if (isset($this->image)) {
            //save the image
            $image = $this->image->storeAs('images', $this->channel->uid . '.png');
            $imageImage = explode('/', $image)[1];
            /* resize and convert to png */
            $img = Image::make(storage_path() . '/app/' . $image)
                ->encode('png')
                ->fit(80, 80, function ($constraint) {
                    $constraint->upsize();
                })
                ->save();


            //update file path
            $this->channel->update([
                'image' => $imageImage
            ]);
        }

        session()->flash('message', 'Channel updated');
        return redirect()->route('channel.edit', ['channel' => $this->channel->slug]);
    }
}

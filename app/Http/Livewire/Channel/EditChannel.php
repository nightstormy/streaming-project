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

/**
 * @method authorize(string $string, mixed $channel)
 */
class EditChannel extends Component
{
    use AuthorizesRequests;
    public mixed $channel;

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'channel.name' => 'required|max:255|unique:channels,name,' . $this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,' . $this->channel->id,
            'channel.description' => 'nullable|max:1000',
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
        session()->flash('message', 'Channel updated');
        return redirect()->route('channel.edit', ['channel' => $this->channel->slug]);
    }
}

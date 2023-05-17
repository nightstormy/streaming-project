<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Video $video
     * @return bool
     */
    public function update(User $user, Video $video): bool
    {
        return $user->id === intVal($video->channel->user_id);
    }
}

<?php

namespace App\Notifications;

namespace App\Notifications;

use App\Models\Progress;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ProgressUpdated extends Notification
{
    use Queueable;

    protected $progress;
    protected $isUpdate;

    public function __construct(Progress $progress, $isUpdate = false)
    {
        $this->progress = $progress;
        $this->isUpdate = $isUpdate;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->isUpdate ? 'Progres Diperbarui' : 'Progres Ditambahkan',
            'message' => $this->isUpdate
                ? 'Mahasiswa telah memperbarui progres proyek: ' . $this->progress->project->title
                : 'Mahasiswa telah menambahkan progres baru untuk proyek: ' . $this->progress->project->title,
            'project_id' => $this->progress->project_id,
            'progress_id' => $this->progress->id,
        ];
    }
}


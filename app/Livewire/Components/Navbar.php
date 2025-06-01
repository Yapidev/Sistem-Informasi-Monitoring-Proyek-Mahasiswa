<?php

namespace App\Livewire\Components;

use App\Models\Lecturer;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Navbar extends Component
{

    public function render()
    {
        $notifications = auth()->user()->Lecturer?->unreadNotifications;
        $unreadCount = auth()->user()->lecturer?->unreadNotifications->count();

        return view('livewire.components.navbar', [
            'user' => auth()->user(),
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }

    public function markAllAsRead()
    {
        auth()->user()->lecturer?->unreadNotifications->markAsRead();
    }

    public function markNotificationAsRead($notificationId)
    {
        $notif = DatabaseNotification::find($notificationId);
        if ($notif && $notif->notifiable_id == auth()->user()->lecturer?->id) {
            $notif->markAsRead();
        }
    }

    public function logout()
    {
        auth()->logout();

        session()->flash('success', 'Logout berhasil');

        return $this->redirect('/auth/login', navigate: true);
    }
}

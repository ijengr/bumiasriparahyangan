<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        // filter param: all (default), unread, read
        $filter = request()->query('filter', 'all');
        // Read per_page preference: query param overrides cookie; default to 5
        $perPage = (int) request()->query('per_page', request()->cookie('admin_messages_per_page', 5));
        if (! in_array($perPage, [5,10,20,50,100], true)) {
            $perPage = 5;
        }

        $query = Message::query();

        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        // search query: name, email, subject
        if ($q = request()->query('q')) {
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('subject', 'like', "%{$q}%");
            });
        }

        // show unread first when listing mixed/all
        if ($filter === 'all') {
            $query->orderBy('is_read', 'asc');
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
        return view('admin.messages', compact('messages', 'filter', 'perPage'));
    }

    /**
     * Persist per-page preference into a cookie (AJAX or POST).
     */
    public function setPerPage(Request $request)
    {
    $this->validate($request, ['per_page' => 'required|in:5,10,20,50,100']);
        $per = (int) $request->input('per_page');

        $cookie = cookie('admin_messages_per_page', $per, 60 * 24 * 30); // 30 days

        // If AJAX, return JSON with cookie header
        if ($request->ajax()) {
            return response()->json(['per_page' => $per])->cookie($cookie);
        }

        // Otherwise redirect back with cookie
        return redirect()->back()->cookie($cookie);
    }

    public function show(Message $message)
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages_show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index');
    }

    /**
     * Bulk delete messages. Currently deletes all messages.
     */
    public function bulkDelete(Request $request)
    {
        // Only delete messages that are already read.
        $deleted = 0;
        DB::transaction(function () use (&$deleted) {
            $deleted = Message::where('is_read', true)->delete();
        });

        // log for audit
        Log::info('Bulk delete read messages via admin', ['user_id' => $request->user()?->id, 'deleted' => $deleted]);

        return redirect()->route('admin.messages.index')->with('status', "Telah dihapus {$deleted} pesan yang sudah dibaca.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Tampilkan semua task
     */
    public function index()
    {
        $tasks = Task::with(['requester', 'helper'])->where('status', 'pending')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Buat task baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'reward_points' => 'required|integer|min:1|max:1000',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'reward_points' => $request->reward_points,
            'requester_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dibuat!');
    }

    /**
     * Ambil task (terima task)
     */
    public function accept($id)
    {
        $task = Task::findOrFail($id);

        // Pastikan task belum diambil dan bukan oleh pembuatnya sendiri
        if ($task->status !== 'pending' || $task->requester_id === Auth::id()) {
            return back()->with('error', 'Task tidak tersedia!');
        }

        $task->accept(Auth::id());

        return back()->with('success', 'Task berhasil diambil!');
    }

    /**
     * Selesaikan task
     */
    public function complete($id)
    {
        $task = Task::findOrFail($id);

        // Pastikan task diambil oleh user ini
        if ($task->helper_id !== Auth::id() || $task->status !== 'accepted') {
            return back()->with('error', 'Anda tidak dapat menyelesaikan task ini!');
        }

        $task->complete();

        // Tambahkan poin ke helper
        $helper = User::find($task->helper_id);
        $helper->addPoints($task->reward_points);

        return back()->with('success', 'Task berhasil diselesaikan!');
    }
}
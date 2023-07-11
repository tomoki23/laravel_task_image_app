<x-app-layout>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="w-2/3 bg-white shadow-md rounded-md p-6">
      <h1 class="text-4xl font-bold text-center mb-4"
        style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        マイタスク</h1>
        <p class="text-right font-bold">ユーザー：{{ $user->name }}</p>
      <div class="bg-white rounded-md">
        <table class="w-full">
          <thead>
            <tr>
              <th class="bg-gray-100 text-left px-4 py-2">タイトル</th>
              <th class="bg-gray-100 text-left px-4 py-2">本文</th>
              <th class="bg-gray-100 text-left px-4 py-2">カテゴリー</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tasks as $task)
            <tr>
              <td class="border-t px-4 py-2"><a href="{{ route('tasks.show',['id' => $task->id]) }}">{{ $task->title
                  }}</a></td>
              <td class="border-t px-4 py-2">{{ $task->body }}</td>
              <td class="border-t px-4 py-2">{{ $task->category->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $tasks->links() }}
      </div>
    </div>
  </div>
</x-app-layout>

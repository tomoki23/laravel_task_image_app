<x-app-layout>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="w-2/3 bg-white shadow-md rounded-md p-6">
      <h1 class="text-4xl font-bold text-center mb-4" style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        TODO一覧画面</h1>
      <form action="#" method="#" class="flex flex-wrap gap-2 mb-4">
        <label for="title" class="flex flex-col items-center justify-center">タイトル：</label>
        <input type="text" name="title" id="title" class="border border-gray-300 rounded px-2 py-1 w-40">
        <select name="category" class="border border-gray-300 rounded px-8 py-1 ml-1">
          <option value="">カテゴリー</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <select name="user" class="border border-gray-300 rounded px-8 py-1 ml-1">
          <option value="">ユーザー</option>
          @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
        <select name="status" class="border border-gray-300 rounded px-8 py-1 ml-1 mr-1">
          <option value="">ステータス</option>
          @foreach (config('status.statusLabels') as $statusValue => $status)
          <option value="{{ $statusValue }}">{{ $status }}</option>
          @endforeach
        </select>
        <x-primary-button>検索</x-primary-button>
      </form>
      <div class="bg-white rounded-md">
        <table class="w-full">
          <thead>
            <tr>
              <th class="bg-gray-100 text-left px-4 py-2">タイトル</th>
              <th class="bg-gray-100 text-left px-4 py-2">本文</th>
              <th class="bg-gray-100 text-left px-4 py-2">カテゴリー</th>
              <th class="bg-gray-100 text-left px-4 py-2">ユーザー</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tasks as $task)
            <tr>
              <td class="border-t px-4 py-2"><a href="{{ route('tasks.show',['id' => $task->id]) }}">{{ $task->title }}</a></td>
              <td class="border-t px-4 py-2">{{ $task->body }}</td>
              <td class="border-t px-4 py-2">{{ $task->category->name }}</td>
              <td class="border-t px-4 py-2">{{ $task->user->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>

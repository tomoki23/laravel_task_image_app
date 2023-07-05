<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
      <div class="w-2/3 bg-white shadow-md rounded-md p-6">
        <h1 class="text-4xl font-bold text-center mb-4 text-gray-900"
          style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
          TODO詳細画面
        </h1>
        <div class="flex">
          <div class="w-1/2">
            <div class="mb-4">
              <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $task->title }}</h2>
              <hr class="my-2 border-gray-300">
              <p class="text-lg mb-2 text-gray-600">担当者: {{ $task->assignedUser->name }}</p>
              <hr class="my-2 border-gray-300">
              <p class="text-lg mb-2 text-gray-600">カテゴリー: {{ $task->category->name }}</p>
              <hr class="my-2 border-gray-300">
              <p class="text-lg mb-2 text-gray-600">ステータス: {{ $task->status }}</p>
            </div>
            <div class="mb-4">
              <h3 class="text-xl font-bold mb-2 text-gray-800">タスク内容</h3>
              <div class="border-b-2 border-gray-300">
                <p class="text-lg text-gray-700 font-semibold">{{ $task->body }}</p>
              </div>
            </div>
            @if (auth()->id() === $task->assignedUser->id)
            <div class="flex justify-end">
              <x-primary-button class="mr-4"><a href="{{ route('tasks.edit',['id' => $task->id]) }}" >更新</a></x-primary-button>
              <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button>削除</x-danger-button>
              </form>
            </div>
            @endif
          </div>
          @if ($task->image_path)
          <div class="w-1/2 pl-4">
            <div class="w-96 mx-auto mb-4 pr-4">
              <img src="{{ Storage::url($task->image_path) }}" alt="タスクの関連画像" class="max-w-full max-h-full rounded-md">
            </div>
          </div>
          @else
          <div class="w-1/2 flex justify-center items-center text-red-600">
            <p>関連画像はありません。</p>
          </div>
          @endif
        </div>
        <div class="w-4/5 mx-auto mt-4">
                  <div class="mb-4">
                    <form action="{{ route('tasks.comments.store', ['id' => $task->id]) }}" class="w-full" method="POST">
                      @csrf
                      <input type="text" name="comment" placeholder="コメントを入力してください"
                        class="w-full border border-gray-300 rounded py-2 px-4 mb-2">
                        @error('comment')
                        <div class="text-red-500 bg-red-100">{{ $message }}</div>
                        @enderror
                      <div class="flex justify-end">
                        <x-primary-button>投稿</x-primary-button>
                      </div>
                    </form>
                  </div>
                  @foreach ($comments as $comment)
                  <div class="mb-4 mt-4">
                    <div class="border border-gray-300 rounded py-2 px-4 relative">
                      <div class="flex justify-between mb-2">
                        <p class="font-semibold">{{ $comment->user->name }}</p>
                        <p class="text-gray-500">{{ $comment->created_at }}</p>
                      </div>
                      <hr>
                      <p class="text-gray-700 mt-4">{{ $comment->body }}</p>
                      @if ($comment->user_id === auth()->id())
                      <div class="flex justify-end mt-2">
                        <form action="{{ route('tasks.comments.destroy', ['id' => $comment->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <x-danger-button>削除</x-danger-button>
                        </form>
                      </div>
                      @endif
                    </div>
                  </div>
                  @endforeach
                  {{ $comments->links() }}
                </div>
      </div>
    </div>
</x-app-layout>

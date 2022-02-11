<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>実践ウェブアプリ</title>
  <!-- 追加以下 -->
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css"/>
  <!-- 追加終了 -->
</head>
<body>
  <div class="container flex">
    <h2 class="ttl-todo">Todo List</h2>
    <div class="main-container">
      @if (count($errors) > 0)
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
      <form action="/todos" method="POST" class="form-add flex">
        @csrf
        <input type="text" name="content" class="input-add">
        <input type="submit" class="btn btn-add" value="追加">
      </form>
      <!-- end store form -->

      <table>
        <tr>
          <th>作成日</th>
          <th>タスク名</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        @foreach ($items as $item)
          <tr>
            <td>{{$item->created_at}}</td>
              <form action="/todos/{{$item->id}}" method="POST">
                @method('PUT')
                @csrf
                <td>
                  <input type="text" name="content" class="input-text" value="{{$item->content}}">
                </td>
                <td>
                  <input type="submit" class="btn btn-update" value="更新">
                </td>
              </form>
            <td>
              <form action="/todos/{{$item->id}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-delete" value="削除">
              </form>
            </td>
          </tr>
        @endforeach
      </table>
      <div class="pagination-container flex">
        {{ $items->links('vendor.pagination.default') }}
      </div>
    </div>
  </div>
</body>
</html>
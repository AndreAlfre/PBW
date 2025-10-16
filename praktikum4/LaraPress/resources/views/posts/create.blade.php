<!DOCTYPE html>
<html>
<head>
    <title>Buat Post Baru</title>
</head>
<body>
    <h1>Buat Post Baru</h1>
    <p><strong>Halaman ini HANYA bisa diakses setelah login!</strong></p>
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 10px;">
            <label>Title:</label><br>
            <input type="text" name="title" required style="width: 300px;">
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Content:</label><br>
            <textarea name="content" required rows="5" style="width: 300px;"></textarea>
        </div>
        
        <button type="submit">Save Post</button>
    </form>
    
    <br>
    <a href="{{ route('posts.index') }}">← Kembali ke Daftar Posts</a>
</body>
</html>
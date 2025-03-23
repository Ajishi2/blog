<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    
    <form action="/edit-post/{{ $post->id }}" method="POST">  <!-- ✅ Fixed Syntax -->
        @csrf
        @method('PUT')  <!-- ✅ Ensures Laravel treats it as a PUT request -->
        
        <label>Title:</label>
        <input type="text" name="title" value="{{ $post->title }}" required>
        
        <label>Body:</label>
        <textarea name="body" required>{{ $post->body }}</textarea>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

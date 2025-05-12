<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slug Generator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter a name" class="form-control">
        
        <br>
        <label for="slug">Generated Slug:</label>
        <input type="text" id="slug" name="slug" placeholder="Slug will be generated here" class="form-control" readonly>

    </div>

    <script>
        $(document).ready(function() {
            // Function to generate the slug
            $('#name').on('input', function() {
                var name = $(this).val(); // Get the value of the input
                var slug = name
                    .toLowerCase()  // Convert to lowercase
                    .trim()         // Remove leading/trailing spaces
                    .replace(/[^a-z0-9\s-]/g, '')  // Remove non-alphanumeric characters
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-');  // Remove multiple hyphens
                
                // Set the generated slug in the slug field
                $('#slug').val(slug);
            });
        });
    </script>
</body>
</html>

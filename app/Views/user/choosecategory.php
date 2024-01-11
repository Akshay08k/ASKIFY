<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Selection</title>
    
    <link rel="stylesheet" href="<?= base_url('css/choosecategory.css') ?>">
</head>

<body>

    <header>
        <h1>Category Selection</h1>
    </header>
    <div>
        <div id="container">
            <?php foreach ($categories as $category): ?>
                <div class="category-item" onclick="toggleCategory(this)">
                    <img src="<?= base_url('uploads/' . $category['image']); ?>" alt="<?= $category['name']; ?>">
                    <?= $category['name']; ?>
                </div>
            <?php endforeach; ?>
            <button id="confirm-button" onclick="confirmSelection()">Confirm</button>   
        </div>
    </div>
    <script>
        

        function toggleCategory(element) {
            element.classList.toggle('selected');
        }

        function confirmSelection() {
            var selectedCategories = document.querySelectorAll('.category-item.selected');

            if (selectedCategories.length > 0) {
                var categoryNames = Array.from(selectedCategories).map(function (categoryItem) {
                    return categoryItem.textContent.trim().replace(/\s+/g, ' ');
                });

                alert('You have confirmed the selection of: ' + categoryNames.join(', '));
            } else {
                alert('No categories selected.');
            }
        }
    </script>
   

</body>

</html>

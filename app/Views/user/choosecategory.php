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
        <form method="post" action="<?= base_url('updatecategory/processCategorySelection') ?>">
            <div id="container">
                <?php foreach ($categories as $category): ?>
                    <label for="category<?= $category['id']; ?>" id="catlabel">
                        <div class="categorybox">
                            <input type="checkbox" id="category<?= $category['id']; ?>" name="selected_categories[]"
                                value="<?= $category['id']; ?>" class="checkbox" style="opacity:0;">
                            <img src="<?= base_url('uploads/categoryimages/' . $category['image']) ?>"
                                alt="<?= $category['name']; ?>">
                            <?= $category['name']; ?>
                        </div>
                    </label>
                <?php endforeach; ?>
                <div class="btndiv"><button type="submit" id="confirm-button">Confirm</button></div>
            </div>
        </form>
    </div>

    <script>
        let checkboxes = document.querySelectorAll('.checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let categorybox = checkbox.closest('.categorybox');
                let label = document.querySelector(`label[for="${checkbox.id}"]`);

                if (checkbox.checked) {
                    categorybox.style.backgroundColor = "#34495e";
                    label.style.color = "white"; //
                } else {
                    categorybox.style.backgroundColor = "";
                    label.style.color = "";
                }
            });
        });
    </script>


</body>

</html>
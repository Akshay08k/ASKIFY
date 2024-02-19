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
                        <div class="category-item">
                            <input type="checkbox" id="category<?= $category['id']; ?>" name="selected_categories[]"
                                value="<?= $category['id']; ?>">
                            <img src="data:image/jpeg;base64,<?= $category['image']; ?>" alt="<?= $category['name']; ?>">
                            <?= $category['name']; ?>
                        </div>
                    </label>
                <?php endforeach; ?>
                <div class="btndiv"><button type="submit" id="confirm-button">Confirm</button></div>
            </div>
        </form>




    </div>
    <script>


        document.addEventListener('DOMContentLoaded', function () {
            var categoryLabels = document.querySelectorAll('.category-item');

            categoryLabels.forEach(function (label) {
                label.addEventListener('click', function () {
                    toggleCategory(this);
                });
            });
        });

        function toggleCategory(element) {
            element.classList.toggle('selected');
        }


    </script>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('css/output.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <title>Login - Askify</title>
</head>

<body>

    <div class="mx-auto w-1/2 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">



            <form method="post" action="<?= base_url('updatepassword/save') ?>"
                class="mb-0 mt-6 bg-white space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                <p class="text-center text-lg font-medium">Update Your Password</p>

                <div>
                    <label for="email" class="sr-only">Enter Your Current Password</label>

                    <div class="relative">
                        <input type="password" name="oldpassword"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter Your Current Password" />


                    </div>
                </div>

                <div>
                    <label for="password" class="sr-only">New Password</label>

                    <div class="relative">
                        <input type="password" name="newpassword"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="New Password" />


                    </div>
                </div>
                <div>
                    <label for="password" class="sr-only">Confirm New Password</label>

                    <div class="relative">
                        <input type="password" name="confpassword"
                            class="w-full outline-none rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Confirm New Password" />


                    </div>
                </div>
                <?php if (isset ($error)): ?>
                    <div class="error text-center text-red-600">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset ($successMessage)): ?>
                    <div class="success text-center text-green-500">
                        <?php echo $successMessage; ?>
                    </div>
                <?php endif; ?>

                <button type="submit"
                    class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                    Update Password
                </button>

            </form>
        </div>
    </div>

</body>

</html>